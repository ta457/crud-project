<?php

namespace App\Services;

use App\Http\Requests\StoreCategoryRequest;
use App\Http\Requests\UpdateCategoryRequest;
use App\Repositories\CategoryRepository;
use RealRashid\SweetAlert\Facades\Alert;

class CategoryService
{
    protected $cateRepo;

    public function __construct(CategoryRepository $cateRepo)
    {
        $this->cateRepo = $cateRepo;
    }

    public function getGroups()
    {
        return $this->cateRepo->getGroups();
    }

    public function getAll()
    {
        return $this->cateRepo->getAll();
    }

    public function getLatestCategories()
    {
        return $this->cateRepo->getLatestCategories();
    }

    public function storeCategory(StoreCategoryRequest $request)
    {
        $this->cateRepo->create($request->validated());

        Alert::success('Success', 'Category created successfully!');
    }

    public function updateCategory(UpdateCategoryRequest $request, $category)
    {
        $this->cateRepo->update($request->validated(), $category->id);

        Alert::success('Success', 'Category updated successfully!');
    }

    public function deleteCategory($category)
    {
        $this->cateRepo->delete($category->id);

        Alert::success('Success', 'Category deleted successfully!');
    }
}