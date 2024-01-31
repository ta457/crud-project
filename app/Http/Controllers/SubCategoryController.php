<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCategoryRequest;
use App\Http\Requests\UpdateCategoryRequest;
use App\Models\Category;
use App\Models\SubCategory;
use Illuminate\Http\Request;

class SubCategoryController extends Controller
{
    public function index(Category $category)
    {
        $subCategories = $category->subCategories()->paginate(10);

        $user = auth()->user();

        return view('subCategories.index', compact('subCategories', 'user', 'category'));
    }

    public function show(Category $category, SubCategory $subCategory)
    {
        $user = auth()->user();

        return view('subCategories.show', compact('subCategory', 'user', 'category'));
    }

    public function store(Category $category, StoreCategoryRequest $request)
    {
        $category->subCategories()->create($request->validated());

        return redirect()->route('web.sub-categories.index', $category->id);
    }

    public function destroy(Category $category, SubCategory $subCategory)
    {
        $subCategory->delete();

        return redirect()->route('web.sub-categories.index', $category->id);
    }

    public function update(Category $category, SubCategory $subCategory, UpdateCategoryRequest $request)
    {
        $subCategory->update($request->validated());

        return redirect()->route('web.sub-categories.show', [$category->id, $subCategory->id]);
    }
}
