<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Http\Client\PendingRequest;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;
use RuntimeException;

class ChatbotService
{
    /**
     * Whitelist of tables and columns the chatbot is ever allowed to read.
     * Anything not listed here (passwords, remember_token, etc.) can never
     * be selected, no matter what the model returns.
     */
    private const TABLES = [
        'categories' => ['id', 'name', 'description', 'created_at', 'updated_at'],
        'products' => ['id', 'name', 'description', 'price', 'category_id', 'created_at', 'updated_at'],
        'orders' => ['id', 'customer_name', 'status', 'product_id', 'category_id', 'total', 'created_at', 'updated_at'],
        'order_items' => ['id', 'order_id', 'product_id', 'quantity', 'price', 'created_at', 'updated_at'],
    ];

    public function respond(User $user, string $message): array
    {
        $databaseContext = $this->answerFromDatabase($message);

        return [
            'type' => 'text',
            'content' => $this->generateText($user, $message, $databaseContext),
        ];
    }

    /**
     * Step 2: ask the model to write a natural-language answer using the
     * (already validated) database rows as context.
     */
    private function generateText(User $user, string $message, ?array $databaseContext): string
    {
        $context = $databaseContext === null
            ? 'No database query was needed for this request.'
            : json_encode($databaseContext, JSON_THROW_ON_ERROR);

        $response = $this->client()->post('/chat/completions', [
            'model' => config('services.groq.model'),
            'messages' => [
                [
                    'role' => 'system',
                    'content' => "You are a helpful assistant for an ecommerce store. The current user is {$user->name}. Answer using the database context when it is provided. Never invent data that isn't in the context, and never reveal passwords or tokens.\n\nDatabase context:\n{$context}",
                ],
                [
                    'role' => 'user',
                    'content' => $message,
                ],
            ],
        ])->throw()->json();

        return $this->extractMessage($response);
    }

    /**
     * Step 1: ask the model whether this request needs store data, and if
     * so, have it write the SELECT statement. The SQL is then strictly
     * validated before it ever touches the database.
     */
    private function answerFromDatabase(string $message): ?array
    {
        $schema = json_encode(self::TABLES, JSON_THROW_ON_ERROR);

        $response = $this->client()->post('/chat/completions', [
            'model' => config('services.groq.model'),
            'response_format' => ['type' => 'json_object'],
            'messages' => [
                [
                    'role' => 'system',
                    'content' => 'You translate ecommerce questions into read-only SQL. Reply with ONLY a JSON object with keys needs_database (boolean) and sql (string). The SQL must be a single SELECT statement using only the supplied tables/columns, with no comments and no semicolons. If the request does not need database data, reply {"needs_database": false, "sql": ""}.',
                ],
                [
                    'role' => 'user',
                    'content' => "Schema: {$schema}\nRequest: {$message}",
                ],
            ],
        ])->throw()->json();

        $decision = json_decode($this->extractMessage($response), true);

        if (! is_array($decision) || ! ($decision['needs_database'] ?? false)) {
            return null;
        }

        $sql = $decision['sql'] ?? null;

        if (! is_string($sql) || $sql === '') {
            return null;
        }

        $this->validateSql($sql);

        return [
            'rows' => DB::select($sql.' limit 100'),
        ];
    }

    private function validateSql(string $sql): void
    {
        $normalized = strtolower(trim($sql));

        if (! Str::startsWith($normalized, 'select ') || str_contains($normalized, ';') || str_contains($normalized, '--') || str_contains($normalized, '/*')) {
            throw new RuntimeException('Only read-only SELECT queries are allowed.');
        }

        if (preg_match('/\b(insert|update|delete|drop|alter|create|replace|attach|pragma|union|into\s+outfile)\b/i', $normalized)) {
            throw new RuntimeException('Only read-only SELECT queries are allowed.');
        }

        $tables = preg_match_all('/\b(?:from|join)\s+([a-z_][a-z0-9_]*)/i', $normalized, $matches)
            ? $matches[1]
            : [];

        foreach ($tables as $table) {
            if (! array_key_exists($table, self::TABLES)) {
                throw new RuntimeException("Table '{$table}' is not available to the chatbot.");
            }
        }

        if (preg_match('/\b(password|remember_token|token|secret)\b/i', $normalized)) {
            throw new RuntimeException('Sensitive columns cannot be queried.');
        }

        if (empty($tables)) {
            throw new RuntimeException('Query must reference at least one known table.');
        }
    }

    private function client(): PendingRequest
    {
        $apiKey = config('services.groq.api_key');

        if (! is_string($apiKey) || $apiKey === '') {
            throw new RuntimeException('GROQ_API_KEY is not configured.');
        }

        return Http::baseUrl(config('services.groq.base_url'))
            ->withToken($apiKey)
            ->acceptJson()
            ->timeout(60);
    }

    /**
     * Groq uses the standard OpenAI "chat completions" response shape:
     * choices[0].message.content — NOT the newer "responses" API shape.
     */
    private function extractMessage(array $response): string
    {
        $text = data_get($response, 'choices.0.message.content');

        if (! is_string($text) || $text === '') {
            throw new RuntimeException('The chatbot provider returned no response.');
        }

        return $text;
    }
}
