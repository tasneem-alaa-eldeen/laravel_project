<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use App\Models\Category;
use App\Http\Requests\OrderRequest;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Order::with(['product', 'category'])->get();
        return view('orders', compact('orders'));
    }

    public function create()
    {
        $products = Product::all();
        $categories = Category::all();
        return view('order-details', compact('products', 'categories'));
    }

    public function store(OrderRequest $request)
    {
        Order::create($request->validated());
        return redirect()->route('orders.index')->with('success', 'Order created successfully.');
    }

    public function show($id)
    {
        $order = Order::with(['product', 'category'])->findOrFail($id);
        return view('order-details', compact('order'));
    }

    public function edit($id)
    {
        $order = Order::findOrFail($id);
        $products = Product::all();
        $categories = Category::all();
        return view('order-details', compact('order', 'products', 'categories'));
    }

    public function update(OrderRequest $request, $id)
    {
        $order = Order::findOrFail($id);
        $order->update($request->validated());
        return redirect()->route('orders.index')->with('success', 'Order updated successfully.');
    }

    public function destroy($id)
    {
        $order = Order::findOrFail($id);
        $order->delete();
        return redirect()->route('orders.index')->with('success', 'Order deleted successfully.');
    }
}