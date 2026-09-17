<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Order;

class OrderWebController extends Controller
{
    public function index()
    {
        $orders = Order::all();
        return response()->view('orders', compact('orders'))->header('Content-Type', 'text/html');
    }

    public function show($id)
    {
        $order = Order::findOrFail($id);
        return view('order-details', compact('order'));
    }

    public function edit($id)
    {
        $order = Order::findOrFail($id);
        return view('order-edit', compact('order'));
    }
}