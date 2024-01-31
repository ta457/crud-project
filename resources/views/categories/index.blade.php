@php
    $route = '/categories';
@endphp

<x-app-layout>
    <x-slot name="sidebar">
        <x-sidebar></x-sidebar>
    </x-slot>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Categories') }}
        </h2>

        @if ($user->hasPermission('create-category'))
            <div>
                <x-create-item-btn>New category</x-create-item-btn>
            </div>
        @endif
    </x-slot>

    <div class="">
        <div class="mx-auto sm:px-6 lg:px-8">
            <div class="overflow-hidden">
                <div class="text-gray-900 dark:text-gray-100">

                    <x-table :head="['ID', 'Name', 'Description']">
                        
                        <x-slot name="search">
                            <x-table-search :route="$route"></x-table-search>
                        </x-slot>

                        <x-slot name="tbody">
                            @foreach ($categories as $category)
                                <tr class="border-b dark:border-gray-700 hover:bg-gray-50">
                                    <x-table-cell :route="$route.'/'.$category->id" :data="$category->id" />
                                    <x-table-cell :route="$route.'/'.$category->id" :data="$category->name" />
                                    <x-table-cell :route="$route.'/'.$category->id" :data="$category->description" />
                                    @if ($user->hasPermission('delete-category'))
                                        <x-table-row-delete-btn :route="$route.'/'.$category->id" />
                                    @endif
                                </tr>
                            @endforeach
                        </x-slot>

                        <x-slot name="links">
                            {{ $categories->links() }}
                        </x-slot>
                    </x-table>

                </div>
            </div>
        </div>
    </div>

    @if ($user->hasPermission('create-category'))
        <x-create-item-modal :route="$route" header="Add category">
            <div class="sm:col-span-2">
                <label for="name"
                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Category name</label>
                <input type="text" name="name" id="name"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                    placeholder="Type category name">
            </div>
            <div class="sm:col-span-2">
                <label for="description"
                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Category description</label>
                <input type="text" name="description" id="description"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                    placeholder="Type category description">
            </div>
        </x-create-item-modal>
    @endif
</x-app-layout>
