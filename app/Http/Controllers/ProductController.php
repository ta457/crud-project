<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Models\Product;
use App\Services\ProductService;
use App\Services\SubCategoryService;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    protected $prodService;
    protected $subCateService;

    public function __construct(ProductService $prodService, SubCategoryService $subCateService)
    {
        $this->prodService = $prodService;
        $this->subCateService = $subCateService;
    }

    public function index($products = null)
    {
        if (!$products) {
            $products = $this->prodService->getLatestProducts();
        }

        $user = auth()->user();

        $subCategories = $this->subCateService->getAll();

        return view('products.index', compact('products', 'user', 'subCategories'));
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

        $this->prodService->deleteProduct($product->id);

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
        $products = $this->prodService->search($request->input('search'), $request->input('sub_category_id'));

        return $this->index($products);
    }
}
