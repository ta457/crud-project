<?php

namespace App\Services;

use App\Http\Requests\StoreCategoryRequest;
use App\Http\Requests\UpdateCategoryRequest;
use App\Repositories\CategoryRepository;

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
    }

    public function updateCategory(UpdateCategoryRequest $request, $category)
    {
        $this->cateRepo->update($request->validated(), $category->id);
    }

    public function deleteCategory($category)
    {
        $this->cateRepo->delete($category->id);
    }
}