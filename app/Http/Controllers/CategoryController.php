<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCategoryRequest;
use App\Http\Requests\UpdateCategoryRequest;
use App\Models\Category;
use App\Services\CategoryService;
use App\Services\SubCategoryService;

class CategoryController extends Controller
{
    protected $cateService;

    protected $subCateService;

    public function __construct(CategoryService $cateService, SubCategoryService $subCateService)
    {
        $this->cateService = $cateService;
        $this->subCateService = $subCateService;
    }

    public function index()
    {
        $categories = $this->cateService->getAll();

        $subCategories = $this->subCateService->getSubCateWithCate();

        $user = auth()->user();

        return view('categories.index', compact('categories','subCategories', 'user'));
    }

    public function store(StoreCategoryRequest $request)
    {
        $this->cateService->storeCategory($request);

        return redirect()->route('web.categories.index');
    }

    public function show(Category $category)
    {
        $user = auth()->user();

        return view('categories.show', compact('category', 'user'));
    }

    public function update(UpdateCategoryRequest $request, Category $category)
    {
        $this->cateService->updateCategory($request, $category);

        return redirect()->route('web.categories.show', $category->id);
    }

    public function destroy(Category $category)
    {
        $this->cateService->deleteCategory($category);
        
        return redirect()->route('web.categories.index');
    }
}

