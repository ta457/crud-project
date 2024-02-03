<x-app-layout>
    <x-slot name="sidebar">
        <x-sidebar></x-sidebar>
    </x-slot>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Users') }}
        </h2>

        @if ($currentUser->hasPermission('create-user'))
            <div class="">
                <x-create-item-btn>New user</x-create-item-btn>
            </div>
        @endif
    </x-slot>

    <div class="">
        <div class="mx-auto sm:px-6 lg:px-8">
            <div class="overflow-hidden">
                <div class="text-gray-900 dark:text-gray-100">

                    <x-table :head="['ID', 'Name', 'Email', 'Roles']">
                        @php $route = '/users'; @endphp

                        <x-slot name="search">
                            <x-table-search :route="$route"></x-table-search>
                        </x-slot>

                        <x-slot name="tbody">
                            @foreach ($users as $user)
                                <tr class="border-b dark:border-gray-700 hover:bg-gray-50">
                                    <x-table-cell :route="$route.'/'.$user->id" :data="$user->id" />
                                    <x-table-cell :route="$route.'/'.$user->id" :data="$user->name" />
                                    <x-table-cell :route="$route.'/'.$user->id" :data="$user->email" />
                                    <x-table-cell :route="$route.'/'.$user->id" :data="$user->roleNameList"></x-table-cell>
                                    @if ($currentUser->hasPermission('delete-user'))
                                        <x-table-row-delete-btn :route="$route" :id="$user->id" />
                                    @endif
                                </tr>
                            @endforeach
                        </x-slot>

                        <x-slot name="links">
                            {{ $users->links() }}
                        </x-slot>
                    </x-table>

                </div>
            </div>
        </div>
    </div>

    @if ($currentUser->hasPermission('create-user'))
        <x-create-item-modal :route="$route" header="Add user">
            <div class="sm:col-span-2">
                <label for="name"
                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">User name</label>
                <input type="text" name="name" id="name"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                    placeholder="Type user name">
            </div>
            <div class="sm:col-span-2">
                <label for="email"
                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Email</label>
                <input type="email" name="email" id="email"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                    placeholder="Type user email">
            </div>
            <div class="sm:col-span-2">
                <label for="password"
                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Password</label>
                <input type="password" name="password" id="password"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                    placeholder="Type user password">
            </div>
            <div class="sm:col-span-2">
                <label for="role"
                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Role</label>
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
        </x-create-item-modal>
    @endif

    @if ($user->hasPermission('delete-user'))
        <x-delete-modal />
    @endif
</x-app-layout>
