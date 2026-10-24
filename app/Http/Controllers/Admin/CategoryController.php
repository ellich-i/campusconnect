<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryRequest;
use App\Models\Category;

class CategoryController extends Controller
{
    public function index()
    {
        return view('admin.categories.index', [
            'categories' => Category::withCount('events')->orderBy('name')->get(),
        ]);
    }

    public function store(CategoryRequest $request)
    {
        Category::create($request->validated());

        return back()->with('status', 'Category added.');
    }

    public function edit(Category $category)
    {
        return view('admin.categories.edit', ['category' => $category]);
    }

    public function update(CategoryRequest $request, Category $category)
    {
        $category->update($request->validated());

        return redirect()->route('admin.categories.index')->with('status', 'Category updated.');
    }

    public function destroy(Category $category)
    {
        // Friendly message first. The RESTRICT foreign key is the backup lock.
        if ($category->events()->exists()) {
            return back()->withErrors(['delete' => 'Cannot delete: this category still has events.']);
        }

        $category->delete();

        return back()->with('status', 'Category deleted.');
    }
}