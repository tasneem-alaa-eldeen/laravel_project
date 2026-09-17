<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index()
    {
        return response()->json([
            'status' => true,
            'data' => Order::with(['product', 'category'])->get()
        ], 200);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'customer_name' =>'required|string',
            'product_id'  => 'required|exists:products,id',
            'category_id' => 'required|exists:categories,id',
            'total' => 'required|numeric',
            'status'      => 'nullable|string',
        ]);

        $order = Order::create($validated);

        return response()->json([
            'status' => true,
            'data'   => $order
        ], 201);
    }

    public function show($id)
    {
        $order = Order::with(['product', 'category'])->find($id);

        if (!$order) {
            return response()->json(['status' => false, 'message' => 'Order not found'], 404);
        }

        return response()->json(['status' => true, 'data' => $order], 200);
    }

    public function update(Request $request, $id)
    {
        $order = Order::find($id);

        if (!$order) {
            return response()->json(['status' => false, 'message' => 'Order not found'], 404);
        }

        $order->update($request->all());

        return response()->json(['status' => true, 'data' => $order], 200);
    }

    public function destroy($id)
    {
        $order = Order::find($id);

        if (!$order) {
            return response()->json(['status' => false, 'message' => 'Order not found'], 404);
        }

        $order->delete();

        return response()->json(['status' => true, 'message' => 'Order deleted successfully'], 200);
    }
}