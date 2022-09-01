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

    public function store(Request $request)
    {

    }

    public function updateStatus(Category $category)
    {
        try {
            $category->is_active = !($category->is_active);

            $category->save();

            return back()->with('success', "$category->name is now " . statusValue($category->is_active));
        }
        catch (\Exception $exception) {
            return back()->with($this->getExceptionMsg($exception));
        }
    }
}
