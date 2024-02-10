<?php

namespace App\Repositories;

use App\Models\Product;
use App\Repositories\BaseRepository;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;

class ProductRepository extends BaseRepository
{
    public function model()
    {
        return Product::class;
    }

    public function getLatestProducts()
    {
        return $this->model->latest()->paginate(10);
    }

    public function getProductsByCate($cateId)
    {
        return $this->model->where('category_id', $cateId)->paginate(10);
    }

    public function storeProductImage($file, Product $product)
    {
        $manager = new ImageManager(new Driver());
        $imageName = 'prodId_' . $product->id . '_' . $file->getClientOriginalName();
        $img = $manager->read($file)->resize(300, 300);
        $img->save(base_path('public/images/products/' . $imageName));
        $product->img = $imageName;
        $product->save();
    }

    public function deleteProductImage(Product $product)
    {
        if (
            $product->img !== null &&
            file_exists(base_path('public/images/products/' . $product->img))
        ) {
            unlink(base_path('public/images/products/' . $product->img));
        }
    }

    public function search($searchKeyword, $cateId = null)
    {
        return $this->model->search($searchKeyword, $cateId)->paginate(10);
    }
}
