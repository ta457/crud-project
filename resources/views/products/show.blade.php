<x-app-layout>
    <x-slot name="sidebar">
        <x-sidebar></x-sidebar>
    </x-slot>

    <x-slot name="header">
        <h2 class="font-semibold text-xl leading-tight">
            <a href="/products" class="text-primary-600">Products</a> / {{ $product->name }}
        </h2>
    </x-slot>

    <div class="">
        <div class="mx-auto sm:px-6 lg:px-8">
            <div class="overflow-hidden">
                @if ($user->hasPermission('update-product'))
                <form action="/products/{{ $product->id }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PATCH') @endif
                    <div class="text-gray-900 dark:text-gray-100 flex flex-col gap-4">
                        <div class="max-w-lg">
                            @if ($product->img)
                                <img src="{{ $product->image_path }}" alt="product_img" class="w-40 h-40 rounded-lg">
                            @else
                                <div class="w-40 h-40 rounded-lg bg-gray-400 flex items-center justify-center">No img</div>
                            @endif
                        </div>
                        @if ($user->hasPermission('update-product'))
                            <div class="max-w-lg">
                                <label for="img" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                    Change product image
                                </label>
                                <input type="file" name="img" id="img"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full px-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                            </div>
                        @endif
                        <div class="max-w-lg">
                            <label for="sub_category_id"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Product category</label>
                            <input type="hidden" name="sub_category_id" id="sub_category_id" value="{{ $product->subCategory->id }}">
                            <div class="flex gap-2">
                                <select name="category" id="category"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                                    @foreach ($categories as $category)
                                        <option value="{{ $category->id }}" 
                                            @if ($category->id === $product->subCategory->category->id) selected @endif>
                                            {{ $category->name }}
                                        </option>
                                    @endforeach
                                </select>
                                @foreach ($categories as $category)
                                    <select name="sub_category_{{ $category->id }}" id="sub_category_{{ $category->id }}"
                                        class="@if ($category->id !== $product->subCategory->category->id) hidden @endif
                                            bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                                        @foreach ($category->subCategories()->get() as $subCategory)
                                            <option value="{{ $subCategory->id }}" 
                                                @if ($subCategory->id === $product->subCategory->id) selected @endif>
                                                {{ $subCategory->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                @endforeach
                            </div>
                        </div>
                        <div class="max-w-lg">
                            <label for="name"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Product name</label>
                            <input type="text" name="name" id="name"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                placeholder="Type product name" value="{{ $product->name }}">
                        </div>
                        <div class="max-w-lg">
                            <label for="description"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Product description</label>
                            <input type="text" name="description" id="description"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                placeholder="Type product description" value="{{ $product->description }}">
                        </div>
                        <div class="max-w-lg">
                            <label for="price" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Product
                                price</label>
                            <input onkeypress="return isNumberKey(event)" type="text" name="price" id="price"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                placeholder="Type product price" value="{{ $product->price }}">
                        </div>
                        <div class="max-w-lg">
                            <label for="quantity" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Product
                                quantity</label>
                            <input onkeypress="return isNumberKey(event)" type="text" name="quantity" id="quantity"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                placeholder="Type product quantity" value="{{ $product->quantity }}">
                        </div>
                        @if ($user->hasPermission('update-product'))
                            <div class="max-w-lg">
                                <button
                                    class="flex items-center justify-center text-white bg-primary-700 hover:bg-primary-800 focus:ring-4 focus:ring-primary-300 font-medium rounded-lg text-sm px-4 py-2 dark:bg-primary-600 dark:hover:bg-primary-700 focus:outline-none dark:focus:ring-primary-800"
                                    type="submit">
                                    Save
                                </button>
                            </div>
                        @endif               
                    </div>
                @if ($user->hasPermission('update-product')) </form> @endif
            </div>
        </div>
    </div>
</x-app-layout>
