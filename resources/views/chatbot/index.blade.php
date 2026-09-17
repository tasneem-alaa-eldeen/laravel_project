<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Store Assistant') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">

                <div id="conversation" class="space-y-4 mb-6 max-h-[28rem] overflow-y-auto">
                    <div class="max-w-lg rounded-lg bg-gray-100 p-3 text-gray-700">
                        Hi {{ auth()->user()->name }}. Ask me about products, categories, or orders.
                    </div>
                </div>

                <form id="chat-form">
                    @csrf
                    <textarea id="message" name="message" required maxlength="4000" rows="3"
                        class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                        placeholder="e.g. How many products are in the Electronics category?"></textarea>

                    <div class="mt-3 flex justify-end">
                        <x-primary-button type="submit">
                            {{ __('Send') }}
                        </x-primary-button>
                    </div>
                </form>

            </div>
        </div>
    </div>

    <script>
        const form = document.getElementById('chat-form');
        const conversation = document.getElementById('conversation');
        const textarea = document.getElementById('message');

        form.addEventListener('submit', async (event) => {
            event.preventDefault();

            const message = textarea.value.trim();
            if (!message) return;

            const question = document.createElement('div');
            question.className = 'ml-auto max-w-lg rounded-lg bg-indigo-500 text-white p-3';
            question.textContent = message;
            conversation.append(question);

            const pending = document.createElement('div');
            pending.className = 'max-w-lg rounded-lg bg-gray-100 p-3 text-gray-500';
            pending.textContent = 'Thinking...';
            conversation.append(pending);
            conversation.scrollTop = conversation.scrollHeight;

            const button = form.querySelector('button');
            button.disabled = true;
            textarea.value = '';

            try {
                const response = await fetch('{{ route('chatbot.respond') }}', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                        'Accept': 'application/json',
                    },
                    body: JSON.stringify({ message }),
                });

                const result = await response.json();
                if (!response.ok) throw new Error(result.message ?? 'The request failed.');

                pending.textContent = result.content;
                pending.classList.remove('text-gray-500');
                pending.classList.add('text-gray-700');
            } catch (error) {
                pending.textContent = error.message;
                pending.classList.remove('text-gray-500');
                pending.classList.add('text-red-600');
            } finally {
                button.disabled = false;
                conversation.scrollTop = conversation.scrollHeight;
            }
        });
    </script>
</x-app-layout>
