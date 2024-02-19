<?php

namespace App\Services;

use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Models\Product;
use App\Repositories\ProductRepository;
use RealRashid\SweetAlert\Facades\Alert;

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
        $product = $this->productRepo->create($request->validated());

        Alert::success('Success', 'Product created successfully!');

        return $product;
    }

    public function updateProduct (UpdateProductRequest $request, Product $product)
    {
        $product = $this->productRepo->update($request->validated(), $product->id);

        Alert::success('Success', 'Product updated successfully!');

        return $product;
    }

    public function deleteProduct(Product $product)
    {
        $this->productRepo->delete($product->id);

        Alert::success('Success', 'Product deleted successfully!');
    }

    public function search($searchKeyword, $cateId = null)
    {
        return $this->productRepo->search($searchKeyword, $cateId);
    }

    public function storeProductImage($file, Product $product)
    {
        $this->productRepo->storeProductImage($file, $product);
    }

    public function deleteProductImage(Product $product)
    {
        $this->productRepo->deleteProductImage($product);
    }
}