<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreSubCategoryRequest;
use App\Models\Category;
use App\Models\SubCategory;
use App\Services\CategoryService;
use App\Services\SubCategoryService;

class SubCategoryController extends Controller
{
    protected $cateService;
    protected $subCateService;

    public function __construct(CategoryService $cateService, SubCategoryService $subCateService)
    {
        $this->cateService = $cateService;
        $this->subCateService = $subCateService;
    }

    public function show(SubCategory $subCategory)
    {
        $user = auth()->user();

        $categories = $this->cateService->getAll();

        return view('subCategories.show', compact('subCategory','user','categories'));
    }

    public function store(StoreSubCategoryRequest $request)
    {
        $this->subCateService->storeSubCategory($request);

        return redirect()->route('web.categories.index');
    }

    public function destroy(SubCategory $subCategory)
    {
        $this->subCateService->deleteSubCategory($subCategory);

        return redirect()->route('web.categories.index');
    }

    public function update(SubCategory $subCategory, StoreSubCategoryRequest $request)
    {
        $this->subCateService->updateSubCategory($subCategory, $request);

        return redirect()->route('web.categories.index');
    }
}
