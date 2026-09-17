<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Category;

class CategoryWebController extends Controller
{
    public function index()
    {
        $categories = Category::all();
        return response()->view('categories', compact('categories'))->header('Content-Type', 'text/html');
    }

    public function show($id)
    {
        $category = Category::findOrFail($id);
        return view('category-details', compact('category'));
    }

    public function edit($id)
    {
        $category = Category::findOrFail($id);
        return view('category-edit', compact('category'));
    }
}