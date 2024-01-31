<x-app-layout>
    <x-slot name="sidebar">
        <x-sidebar></x-sidebar>
    </x-slot>

    <x-slot name="header">
        <h2 class="font-semibold text-xl leading-tight">
            <a href="/permissions" class="text-primary-600">Permissions</a> / {{ $permission->name }}
        </h2>
    </x-slot>

    <div class="">
        <div class="mx-auto sm:px-6 lg:px-8">
            <div class="overflow-hidden">
                <form action="/permissions/{{ $permission->id }}" method="POST">
                    @csrf
                    @method('PATCH')
                    <div class="text-gray-900 dark:text-gray-100 flex flex-col gap-4">
                        <div class="max-w-lg">
                            <label for="name"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Permission name</label>
                            <input type="text" name="name" id="name" required
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                placeholder="Type permission name" value="{{ $permission->name }}">
                        </div>
                        <div class="max-w-lg">
                            <label for="description"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Permission description</label>
                            <input type="text" name="description" id="description" required
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                placeholder="Type permission description" value="{{ $permission->description }}">
                        </div>
                        <div class="max-w-lg">
                            <button
                                class="flex items-center justify-center text-white bg-primary-700 hover:bg-primary-800 focus:ring-4 focus:ring-primary-300 font-medium rounded-lg text-sm px-4 py-2 dark:bg-primary-600 dark:hover:bg-primary-700 focus:outline-none dark:focus:ring-primary-800"
                                type="submit">
                                Save
                            </button>
                        </div>               
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>