<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = auth()->user()->categories()->latest()->get();
        return view('categories.index', compact('categories'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'icon' => 'required|string',
            'color' => 'required|string'
        ]);

        auth()->user()->categories()->create($validated);

        return back()->with('success', 'Category created successfully');
    }

    public function update(Request $request, Category $category)
    {
        if ($category->user_id !== auth()->id()) abort(403);

        $validated = $request->validate([
            'name' => 'sometimes|required|string|max:255',
            'icon' => 'sometimes|required|string',
            'color' => 'sometimes|required|string'
        ]);

        $category->update($validated);

        return back()->with('success', 'Category updated successfully');
    }

    public function destroy(Category $category)
    {
        if ($category->user_id !== auth()->id()) abort(403);
        $category->delete();
        return back()->with('success', 'Category deleted successfully');
    }
}
