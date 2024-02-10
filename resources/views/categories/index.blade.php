<script src="{{ asset('js/category.js') }}" defer></script>

@php $route = '/categories'; @endphp

<x-app-layout>
    <x-slot name="sidebar">
        <x-sidebar></x-sidebar>
    </x-slot>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Categories') }}
        </h2>

        @userCan('create-category')
            <div class="flex gap-2">
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

                    <x-table :head="['Order','Group','Name', 'Description']">
                        
                        <x-slot name="search">
                        </x-slot>

                        <x-slot name="tbody">
                            @php $count = 1; @endphp
                            @foreach ($categories as $cate)
                                <tr class="cursor-pointer border-b dark:border-gray-700 hover:bg-gray-50">
                                    <x-table-cell :route="$route.'/'.$cate->id" :data="$count" />
                                    <x-table-cell :route="$route.'/'.$cate->id" :data="$cate->group" />
                                    <x-table-cell :route="$route.'/'.$cate->id" :data="$cate->name" />
                                    <x-table-cell :route="$route.'/'.$cate->id" :data="$cate->description" />
                                    </a>
                                    @userCan('delete-category')
                                        <x-table-row-delete-btn :route="$route" :dataId="$cate->id" />
                                    @endif
                                </tr>

                                @php $count++; @endphp
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

    @userCan('create-category')
        <x-create-item-modal route="{{ $route }}" header="Add category" modalId="createCategoryModal" formId="createSubCate">
            <div class="sm:col-span-2">
                <label for="select-group"
                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Group</label>
                <select class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500""
                    name="select-group" id="select-group">
                    <option value="0">New group</option>
                    @foreach ($groups as $group)
                        <option value="{{ $group->group }}">{{ $group->group }}</option>
                    @endforeach
                </select>
            </div>
            <div class="sm:col-span-2" id="group-name">
                <label for="group"
                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">New group name</label>
                <input type="text" name="group" id="group"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                    placeholder="Type group name">
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

    @userCan('delete-category')
        <x-delete-modal />
    @endif
</x-app-layout>
