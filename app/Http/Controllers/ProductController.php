<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Models\Category;
use App\Models\Product;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;

class ProductController extends Controller
{
    public function index()
    {
        $categories = Category::all();

        $products = Product::with('subCategory')->paginate(10);

        $user = auth()->user();

        return view('products.index', compact('products','user','categories'));
    }

    public function show(Product $product)
    {
        $categories = Category::all();

        $user = auth()->user();

        return view('products.show', compact('product','user','categories'));
    }

    public function store(StoreProductRequest $request)
    {
        $product = Product::create($request->validated());

        if ($request->file('img')) {
            $manager = new ImageManager(new Driver());
            $imageName = $request->file('img')->getClientOriginalName();
            $img = $manager->read($request->file('img'));
            $img = $img->resize(300, 300);
            $img->save(base_path('public/images/products/' . $imageName));
            $product->img = $imageName;
            $product->save();
        }

        return redirect()->route('web.products.index');
    }

    public function destroy(Product $product)
    {
        $product->delete();

        return redirect()->route('web.products.index');
    }

    public function update(UpdateProductRequest $request, Product $product)
    {
        //dd($request->validated());
        $product->update($request->validated());

        if ($request->file('img')) {
            $manager = new ImageManager(new Driver());
            $imageName = $request->file('img')->getClientOriginalName();
            $img = $manager->read($request->file('img'));
            $img = $img->resize(300, 300);
            $img->save(base_path('public/images/products/' . $imageName));
            $product->img = $imageName;
            $product->save();
        }

        return redirect()->route('web.products.show', $product);
    }
}
