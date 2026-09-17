<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Category;

class ProductWebController extends Controller
{
    public function index()
    {
        $products = Product::all();
        return response()->view('products', compact('products'))->header('Content-Type', 'text/html');
    }

    public function show($id)
    {
        $product = Product::findOrFail($id);
        return view('product-details', compact('product'));
    }

    public function edit($id)
    {
        $product = Product::findOrFail($id);
        $categories = Category::all();
        return view('product-edit', compact('product', 'categories'));
    }
}