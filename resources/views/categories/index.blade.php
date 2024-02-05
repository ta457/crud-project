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
            <div class="flex gap-2">
                <x-item-list-modal-btn btnId="parentListModalBtn" modalId="parentListModal">
                    Parents
                </x-item-list-modal-btn>
                <x-create-item-btn btnId="createParentModalBtn" modalId="createParentModal">
                    New parent
                </x-create-item-btn>
                <x-create-item-btn btnId="createCategoryModalBtn" modalId="createCategoryModal">
                    New category
                </x-create-item-btn>
            </div>
        @endif
    </x-slot>

    <div class="">
        <div class="mx-auto sm:px-6 lg:px-8">
            <div class="overflow-hidden">
                <div class="text-gray-900 dark:text-gray-100">

                    <x-table :head="['Order','Parent','Name', 'Description']">
                        
                        <x-slot name="search">
                        </x-slot>

                        <x-slot name="tbody">
                            @php $count = 1; @endphp
                            @foreach ($subCategories as $sub)
                                @php $route = '/sub-categories'; @endphp
                                <tr class="border-b dark:border-gray-700 hover:bg-gray-50">
                                    <x-table-cell :route="$route.'/'.$sub->id" :data="$count" />
                                    <x-table-cell :route="'/categories/'.$sub->category->id" :data="$sub->category->name" :highlight="true" />
                                    <x-table-cell :route="$route.'/'.$sub->id" :data="$sub->name" />
                                    <x-table-cell :route="$route.'/'.$sub->id" :data="$sub->description" />
                                    @if ($user->hasPermission('delete-category'))
                                        <x-table-row-delete-btn :route="$route" :id="$sub->id" />
                                    @endif
                                </tr>

                                @php $count++; @endphp
                            @endforeach
                        </x-slot>

                        <x-slot name="links">
                            {{ $subCategories->links() }}
                        </x-slot>
                    </x-table>

                </div>
            </div>
        </div>
    </div>

    @if ($user->hasPermission('create-category'))
        <x-create-item-modal route="/categories" header="Add parent category" modalId="createParentModal">
            <div class="sm:col-span-2">
                <label for="name"
                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Parent name</label>
                <input type="text" name="name" id="name"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                    placeholder="Type category name">
            </div>
            <div class="sm:col-span-2">
                <label for="description"
                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Parent description</label>
                <input type="text" name="description" id="description"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                    placeholder="Type category description">
            </div>
        </x-create-item-modal>

        <x-create-item-modal route="/sub-categories" header="Add category" modalId="createCategoryModal">
            <div class="sm:col-span-2">
                <label for="category_id"
                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Parent</label>
                <select class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500""
                    name="category_id" id="category_id">
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                    @endforeach
                </select>
            </div>
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

    <x-item-list-modal header="Parent categories" modalId="parentListModal">
        <x-table :head="['Name', 'Description']">
            <x-slot name="tbody">
                @foreach ($categories as $c)
                    @php $route = '/categories/'.$c->id; @endphp

                    <tr class="border-b dark:border-gray-700 hover:bg-gray-50">
                        <x-table-cell :route="$route" :data="$c->name" />
                        <x-table-cell :route="$route" :data="$c->description" />
                    </tr>
                @endforeach
            </x-slot>
        </x-table>
    </x-item-list-modal>

    @if ($user->hasPermission('delete-category'))
        <x-delete-modal />
    @endif
</x-app-layout>
