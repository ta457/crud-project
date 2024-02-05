<x-app-layout>
    <x-slot name="sidebar">
        <x-sidebar></x-sidebar>
    </x-slot>

    <x-slot name="header">
        <h2 class="font-semibold text-xl leading-tight">
            <a href="/categories" class="text-primary-600">Categories</a> / {{ $category->name }}
        </h2>

        {{-- <a href="/categories/{{ $category->id }}/sub-categories"
            class="flex items-center justify-center text-gray-900 bg-gray-100 border border-gray-300 hover:bg-gray-300 focus:ring-4 focus:ring-gray-300 font-medium rounded-lg text-sm px-4 py-2 dark:bg-primary-600 dark:hover:bg-primary-700 focus:outline-none dark:focus:ring-primary-800">
            View sub-categories
        </a> --}}
    </x-slot>

    <div class="">
        <div class="mx-auto sm:px-6 lg:px-8">
            <div class="overflow-hidden">
                @if ($user->hasPermission('update-category'))
                <form action="/categories/{{ $category->id }}" method="POST">
                    @csrf
                    @method('PATCH') @endif
                    <div class="text-gray-900 dark:text-gray-100 flex flex-col gap-4">
                        <div class="max-w-lg">
                            <label for="name"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Category name</label>
                            <input type="text" name="name" id="name"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                placeholder="Type category name" value="{{ $category->name }}">
                        </div>
                        <div class="max-w-lg">
                            <label for="description"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Category description</label>
                            <input type="text" name="description" id="description"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                placeholder="Type category description" value="{{ $category->description }}">
                        </div>

                        @if ($user->hasPermission('update-category'))
                            <div class="max-w-lg flex gap-2">
                                <button
                                    class="flex items-center justify-center text-white bg-primary-700 hover:bg-primary-800 focus:ring-4 focus:ring-primary-300 font-medium rounded-lg text-sm px-4 py-2 dark:bg-primary-600 dark:hover:bg-primary-700 focus:outline-none dark:focus:ring-primary-800"
                                    type="submit">
                                    Save
                                </button>

                                <button onclick="changeDeleteFormAction('/categories/', {{ $category->id }})"\
                                    data-modal-target="deleteModal" data-modal-toggle="deleteModal"
                                    class="text-rose-600 inline-flex items-center hover:text-white border border-rose-600 hover:bg-rose-600 focus:ring-4 focus:outline-none focus:ring-rose-300 font-medium rounded-lg text-sm px-4 py-2 text-center dark:border-rose-500 dark:text-rose-500 dark:hover:text-white dark:hover:bg-rose-600 dark:focus:ring-rose-900"
                                    type="button">
                                    Delete
                                </button>
                            </div>
                        @endif               
                    </div>
                @if ($user->hasPermission('update-category')) </form> @endif
            </div>
        </div>
    </div>
    
    @if ($user->hasPermission('delete-category'))
        <x-delete-modal />
    @endif
</x-app-layout>
