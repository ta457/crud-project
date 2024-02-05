<?php

namespace App\Services;

use App\Http\Requests\StoreSubCategoryRequest;
use App\Repositories\SubCategoryRepository;

class SubCategoryService
{
    protected $subCateRepo;

    public function __construct(SubCategoryRepository $subCateRepo)
    {
        $this->subCateRepo = $subCateRepo;
    }

    public function getAll()
    {
        return $this->subCateRepo->all();
    }

    public function getSubCateWithCate()
    {
        return $this->subCateRepo->getSubCateWithCate();
    }

    public function storeSubCategory(StoreSubCategoryRequest $request)
    {
        $this->subCateRepo->create($request->validated());
    }

    public function deleteSubCategory($subCategory)
    {
        $this->subCateRepo->delete($subCategory->id);
    }

    public function updateSubCategory($subCategory, StoreSubCategoryRequest $request)
    {
        $this->subCateRepo->update($request->validated(), $subCategory->id);
    }
}