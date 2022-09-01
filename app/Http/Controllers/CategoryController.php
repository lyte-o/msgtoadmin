<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::query()->orderBy('name')->get();

        return view('pages.admin.categories.index', compact('categories'));
    }
}
