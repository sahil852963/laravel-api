<?php

namespace App\Http\Controllers;

use App\Models\Category;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::with('parent')->get();
        
        return view('categories.index', ['categoriesList' => $categories]);
    }
}
