<?php

namespace App\Http\Controllers;
use App\Models\Product;
use App\Models\Category;

class HomeController extends Controller
{
    public function index()
    {
        $categories = Category::all();
        $featured = Product::where('is_active', true)
            ->latest()
            ->take(8)
            ->get();
        return view('home', compact('featured', 'categories'));
    }
}