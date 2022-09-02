<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::query()->orderBy('name')->get();

        return view('pages.admin.categories', compact('categories'));
    }

    public function store(Request $request)
    {
        $data = $request->validate(['name' => 'required|string|unique:categories,name']);

        try {
              $data['slug'] = str($data['name'])->slug();

              Category::query()->create($data);

              return back()->with('success', 'New Category added!');
        }
        catch (\Exception $exception) {
            return back()->with($this->getExceptionMsg($exception));
        }
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

    public function delete(Category $category)
    {
        try {
            $category->tasks()->delete();
            $category->delete();

            return back()->with('success', 'Category has been deleted!');
        }
        catch (\Exception $exception) {
            return back()->with($this->getExceptionMsg($exception));
        }
    }
}
