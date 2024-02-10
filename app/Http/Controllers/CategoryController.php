<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCategoryRequest;
use App\Http\Requests\UpdateCategoryRequest;
use App\Models\Category;
use App\Services\CategoryService;

class CategoryController extends Controller
{
    protected $cateService;

    public function __construct(CategoryService $cateService)
    {
        $this->cateService = $cateService;
    }

    public function index()
    {
        $categories = $this->cateService->getLatestCategories();

        $groups = $this->cateService->getGroups();

        return view('categories.index', compact('groups','categories'));
    }

    public function store(StoreCategoryRequest $request)
    {
        $this->cateService->storeCategory($request);

        return redirect()->route('web.categories.index');
    }

    public function show(Category $category)
    {
        $groups = $this->cateService->getGroups();

        return view('categories.show', compact('category', 'groups'));
    }

    public function update(UpdateCategoryRequest $request, Category $category)
    {
        $this->cateService->updateCategory($request, $category);

        return redirect()->route('web.categories.index');
    }

    public function destroy(Category $category)
    {
        $this->cateService->deleteCategory($category);
        
        return redirect()->route('web.categories.index');
    }
}

