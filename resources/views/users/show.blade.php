<x-app-layout>
    <x-slot name="sidebar">
        <x-sidebar></x-sidebar>
    </x-slot>

    <x-slot name="header">
        <h2 class="font-semibold text-xl leading-tight">
            <a href="/users" class="text-primary-600">Users</a> / {{ $user->name }}
        </h2>
    </x-slot>

    <div class="">
        <div class="mx-auto sm:px-6 lg:px-8">
            <div class="overflow-hidden">
                @if ($currentUser->hasPermission('update-user'))
                <form action="/users/{{ $user->id }}" method="POST">
                    @csrf
                    @method('PATCH') @endif
                    <div class="text-gray-900 dark:text-gray-100 flex flex-col gap-4">
                        <div class="max-w-lg">
                            <label for="name"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">User name</label>
                            <input type="text" name="name" id="name"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                placeholder="Type user name" value="{{ $user->name }}">
                        </div>
                        <div class="max-w-lg">
                            <label for="email"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Email</label>
                            <input type="email" name="email" id="email"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                placeholder="Type user email" value="{{ $user->email }}">
                        </div>
                        <div class="max-w-lg">
                            <label for="password"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Password</label>
                            <input type="password" name="password" id="password"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                placeholder="Type user password" value="{{ $user->password }}">
                        </div>
                        <div class="max-w-2xl">
                            <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Roles</label>
                            
                            <div class="grid grid-cols-4 gap-2">
                                @foreach ($roles as $role)
                                    <div class="flex items-center gap-1">
                                        <input type="checkbox" name="selected[]" 
                                            id={{ $role->id }} value="{{ $role->id }}"
                                            @if ($user->hasRole($role->name)) checked @endif>
                                        <label for="{{ $role->id }}">
                                            <a class="text-primary-600" href="/roles/{{ $role->id }}">{{ $role->name }}</a>
                                        </label>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                        @if ($currentUser->hasPermission('update-user'))
                            <div class="max-w-lg">
                                <button
                                    class="flex items-center justify-center text-white bg-primary-700 hover:bg-primary-800 focus:ring-4 focus:ring-primary-300 font-medium rounded-lg text-sm px-4 py-2 dark:bg-primary-600 dark:hover:bg-primary-700 focus:outline-none dark:focus:ring-primary-800"
                                    type="submit">
                                    Save
                                </button>
                            </div>
                        @endif         
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
