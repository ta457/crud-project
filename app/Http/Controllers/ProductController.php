<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Models\Product;
use App\Services\CategoryService;
use App\Services\ProductService;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    protected $prodService;
    protected $cateService;

    public function __construct(ProductService $prodService, CategoryService $cateService)
    {
        $this->prodService = $prodService;
        $this->cateService = $cateService;
    }

    public function index($products = null)
    {
        if (!$products) {
            $products = $this->prodService->getLatestProducts();
        }

        $categories = $this->cateService->getAll();

        return view('products.index', compact('products','categories'));
    }

    public function store(StoreProductRequest $request)
    {
        $product = $this->prodService->storeProduct($request);

        if ($request->file('img')) {
            $this->prodService->storeProductImage($request->file('img'), $product);
        }

        return redirect()->route('web.products.index');
    }

    public function destroy(Product $product)
    {
        $this->prodService->deleteProductImage($product);

        $this->prodService->deleteProduct($product);

        return redirect()->route('web.products.index');
    }

    public function update(UpdateProductRequest $request, Product $product)
    {
        $this->prodService->updateProduct($request, $product);

        if ($request->file('img')) {
            $this->prodService->deleteProductImage($product);
            $this->prodService->storeProductImage($request->file('img'), $product);
        }

        return redirect()->route('web.products.index');
    }

    public function search(Request $request)
    {
        $products = $this->prodService->search($request->search, $request->category_id);

        return $this->index($products);
    }
}
