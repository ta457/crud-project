<?php


namespace App\Repositories;

use App\Models\SubCategory;
use App\Repositories\BaseRepository;

class SubCategoryRepository extends BaseRepository
{
    public function model()
    {
        return SubCategory::class;
    }

    public function getSubCateWithCate()
    {
        return $this->model->with('category')->paginate(10);
    }
}