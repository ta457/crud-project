<?php

namespace App\Services;

use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Models\Product;
use App\Repositories\ProductRepository;

class ProductService
{
    protected $productRepo;

    public function __construct(ProductRepository $productRepo)
    {
        $this->productRepo = $productRepo;
    }

    public function getLatestProducts()
    {
        return $this->productRepo->getLatestProducts();
    }

    public function getProductsByCate($cateId)
    {
        return $this->productRepo->getProductsByCate($cateId);
    }

    public function storeProduct(StoreProductRequest $request)
    {
        return $this->productRepo->create($request->all());
    }

    public function updateProduct (UpdateProductRequest $request, Product $product)
    {
        return $this->productRepo->update($request->validated(), $product->id);
    }

    public function deleteProduct(Product $product)
    {
        return $this->productRepo->delete($product->id);
    }

    public function search($searchKeyword, $cateId = null)
    {
        return $this->productRepo->search($searchKeyword, $cateId);
    }

    public function storeProductImage($file, Product $product)
    {
        return $this->productRepo->storeProductImage($file, $product);
    }

    public function deleteProductImage(Product $product)
    {
        return $this->productRepo->deleteProductImage($product);
    }
}