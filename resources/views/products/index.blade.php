@php
    $route = '/products';
@endphp

<x-app-layout>
    <x-slot name="sidebar">
        <x-sidebar></x-sidebar>
    </x-slot>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Products') }}
        </h2>

        @if ($user->hasPermission('create-product'))
            <div>
                <x-create-item-btn>New product</x-create-item-btn>
            </div>
        @endif
    </x-slot>

    <div class="">
        <div class="mx-auto sm:px-6 lg:px-8">
            <div class="overflow-hidden">
                <div class="text-gray-900 dark:text-gray-100">

                    <x-table :head="['ID', 'Category', 'Name', 'Description', 'Price', 'Qty']">

                        <x-slot name="search">
                            <x-table-search :route="$route">
                                <select class="ml-2 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full pl-10 p-2 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" 
                                    name="sub_category_id" id="sub_category_id">
                                    <option value="0">All</option>
                                    @foreach ($subCategories as $subCate)
                                        <option value="{{ $subCate->id }}">{{ $subCate->name }}</option>
                                    @endforeach
                                </select>
                            </x-table-search>
                        </x-slot>

                        <x-slot name="tbody">
                            @foreach ($products as $product)
                                <tr class="border-b dark:border-gray-700 hover:bg-gray-50">
                                    <td>
                                        <a onclick="showProduct({{ $product->id }})" class="cursor-pointer block w-full h-full px-4 py-2">
                                            {{ $product->id }}
                                        </a>
                                    </td>
                                    <td>
                                        <a onclick="showProduct({{ $product->id }})" class="cursor-pointer block w-full h-full px-4 py-2">
                                            {{ $product->category_name }}
                                        </a>
                                    </td>
                                    <td>
                                        <a onclick="showProduct({{ $product->id }})" class="cursor-pointer block w-full h-full px-4 py-2">
                                            {{ $product->name }}
                                        </a>
                                    </td>
                                    <td>
                                        <a onclick="showProduct({{ $product->id }})" class="cursor-pointer block w-full h-full px-4 py-2">
                                            {{ $product->description }}
                                        </a>
                                    </td>
                                    <td>
                                        <a onclick="showProduct({{ $product->id }})" class="cursor-pointer block w-full h-full px-4 py-2">
                                            {{ $product->price }}
                                        </a>
                                    </td>
                                    <td>
                                        <a onclick="showProduct({{ $product->id }})" class="cursor-pointer block w-full h-full px-4 py-2">
                                            {{ $product->quantity }}
                                        </a>
                                    </td>
                                    @if ($user->hasPermission('delete-product'))
                                        <x-table-row-delete-btn :route="$route . '/' . $product->id" />
                                    @endif
                                </tr>
                            @endforeach
                        </x-slot>

                        <x-slot name="links">
                            {{ $products->links() }}
                        </x-slot>
                    </x-table>

                </div>
            </div>
        </div>
    </div>

    @if ($user->hasPermission('create-product'))
        <x-create-item-modal :route="$route" header="Add product">
            <div class="sm:col-span-2">
                <label for="sub_category_id"
                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Product category</label>
                <input type="hidden" name="sub_category_id" id="sub_category_id" value="">
                <div class="flex gap-2">
                    <select name="category" id="category"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                        <option value="" selected>Choose category</option>
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                        @endforeach
                    </select>
                    @foreach ($categories as $category)
                        <select name="sub_category_{{ $category->id }}" id="sub_category_{{ $category->id }}"
                            class="hidden bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                            <option value="" selected>Choose sub-category</option>
                            @foreach ($category->subCategories()->get() as $subCategory)
                                <option value="{{ $subCategory->id }}">{{ $subCategory->name }}</option>
                            @endforeach
                        </select>
                    @endforeach
                </div>
            </div>
            <div class="sm:col-span-2">
                <label for="name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Product
                    name</label>
                <input type="text" name="name" id="name"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                    placeholder="Type product name">
            </div>
            <div class="sm:col-span-2">
                <label for="description" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Product
                    description</label>
                <input type="text" name="description" id="description"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                    placeholder="Type product description">
            </div>
            <div class="sm:col-span-2">
                <label for="price" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Product
                    price</label>
                <input min="0" type="number" name="price" id="price"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                    placeholder="Type product price">
            </div>
            <div class="sm:col-span-2">
                <label for="quantity" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Product
                    quantity</label>
                <input min="0" type="number" name="quantity" id="quantity"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                    placeholder="Type product quantity">
            </div>
            <div class="sm:col-span-2">
                <label for="img" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Product
                    image</label>
                <input type="file" name="img" id="img"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full px-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
            </div>

        </x-create-item-modal>

        <x-update-product-modal :subCategories="$subCategories" :user="$user"></x-update-product-modal>
    @endif
    
    <x-products-script />
</x-app-layout>
