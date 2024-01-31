<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCategoryRequest;
use App\Http\Requests\UpdateCategoryRequest;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::paginate(10);

        $user = auth()->user();

        return view('categories.index', compact('categories', 'user'));
    }

    public function store(StoreCategoryRequest $request)
    {
        Category::create($request->validated());

        return redirect()->route('web.categories.index');
    }

    public function show(Category $category)
    {
        $user = auth()->user();

        $subCategories = $category->subCategories()->get();

        return view('categories.show', compact('category', 'user', 'subCategories'));
    }

    public function update(UpdateCategoryRequest $request, Category $category)
    {
        $category->update($request->validated());

        return redirect()->route('web.categories.show', $category->id);
    }

    public function destroy(Category $category)
    {
        $category->delete();
        
        return redirect()->route('web.categories.index');
    }
}

