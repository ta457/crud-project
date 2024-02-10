<script src="{{ asset('js/product.js') }}" defer></script>

@php $route = '/products'; @endphp

<x-app-layout>
    <x-slot name="sidebar">
        <x-sidebar></x-sidebar>
    </x-slot>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Products') }}
        </h2>

        @userCan('create-product')
            <div>
                <x-create-item-btn btnId="createProductModalBtn" modalId="createProductModal">
                    New product
                </x-create-item-btn>
            </div>
        @endif
    </x-slot>

    <div class="">
        <div class="mx-auto sm:px-6 lg:px-8">
            <div class="overflow-hidden">
                <div class="text-gray-900 dark:text-gray-100">

                    <x-table :head="['Order', 'Category', 'Name', 'Description', 'Price', 'Qty']">

                        <x-slot name="search">
                            <x-table-search :route="$route">
                                <select
                                    class="ml-2 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full pl-10 p-2 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                    name="category_id" id="category_id">
                                    <option value="0">All</option>
                                    @foreach ($categories as $cate)
                                        <option value="{{ $cate->id }}"
                                            @if (request()->category_id == $cate->id)
                                                selected
                                            @endif>
                                            {{ $cate->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </x-table-search>
                        </x-slot>

                        <x-slot name="tbody">
                            @php $count = 1; @endphp
                            @foreach ($products as $product)
                                <tr class="cursor-pointer border-b dark:border-gray-700 hover:bg-gray-50" 
                                    data-route="{{ route('products.show', $product->id) }}">

                                    <x-table-cell :data="$count" />
                                    <x-table-cell :data="$product->category_name" />
                                    <x-table-cell :data="$product->name" />
                                    <x-table-cell :data="$product->description" />
                                    <x-table-cell :data="$product->price" />
                                    <x-table-cell :data="$product->quantity" />
                                    @userCan('delete-product')
                                        <x-table-row-delete-btn class="prod-delete-btn" :route="$route" :dataId="$product->id" />
                                    @endif
                                    
                                </tr>
                                @php $count++; @endphp
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

    @userCan('create-product')
        <x-create-item-modal :route="$route" header="Add product" modalId="createProductModal" formId="createProd">
            <div class="sm:col-span-2 w-fit relative" id="preview-create">
            </div>
            <div class="">
                <label for="img" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Product
                    image</label>
                <input type="file" name="img" id="img" accept="image/*"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full px-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
            </div>
            <div class="">
                <label for="category_id"
                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Product category</label>
                <div class="flex gap-2">
                    <select name="category_id" id="category_id"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="">
                <label for="name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Product
                    name</label>
                <input type="text" name="name" id="name"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                    placeholder="Type product name">
            </div>
            <div class="">
                <label for="description" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Product
                    description</label>
                <input type="text" name="description" id="description"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                    placeholder="Type product description">
            </div>
            <div class="">
                <label for="price" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Product
                    price</label>
                <input min="0" type="number" name="price" id="price"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                    placeholder="Type product price">
            </div>
            <div class="">
                <label for="quantity" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Product
                    quantity</label>
                <input min="0" type="number" name="quantity" id="quantity"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                    placeholder="Type product quantity">
            </div>
        </x-create-item-modal>
    @endif

    <x-update-product-modal :categories="$categories"></x-update-product-modal>

    @userCan('delete-product')
        <x-delete-modal />
    @endif
</x-app-layout>