<?php


namespace App\Repositories;

use App\Models\Category;
use App\Repositories\BaseRepository;

class CategoryRepository extends BaseRepository
{
    public function model()
    {
        return Category::class;
    }

    public function getAll()
    {
        return $this->model->all();
    }

    public function getLatestCategories()
    {
        return $this->model->latest()->paginate(10);
    }

    public function getGroups()
    {
        return $this->model->select('group')->distinct()->get();
    }
}