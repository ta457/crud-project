<script src="{{ asset('js/role.js') }}" defer></script>

<x-app-layout>
    <x-slot name="sidebar">
        <x-sidebar></x-sidebar>
    </x-slot>

    <x-slot name="header">
        <h2 class="font-semibold text-xl leading-tight">
            <a href="/roles" class="text-primary-600">Roles</a> / {{ $role->name }}
        </h2>
    </x-slot>

    <div class="">
        <div class="mx-auto sm:px-6 lg:px-8">
            <div class="overflow-hidden">
                @userCan('update-role') <form action="/roles/{{ $role->id }}" method="POST" id="updateRole">
                    @csrf
                    @method('PATCH') @endif
                    <div class="text-gray-900 dark:text-gray-100 flex flex-col gap-4">
                        <div class="max-w-lg">
                            <label for="name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Role
                                name</label>
                            <input type="text" name="name" id="name"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                placeholder="Type role name" value="{{ $role->name }}">
                        </div>
                        <div class="max-w-lg">
                            <label for="description"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Role
                                description</label>
                            <input type="text" name="description" id="description"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                placeholder="Type role description" value="{{ $role->description }}">
                        </div>

                        <div class="max-w-2xl">
                            <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Role
                                permissions</label>
                            <div class="grid grid-cols-2 gap-4">
                                <div class="checkbox-group">
                                    <input type="checkbox" id="full-role-access"
                                        @if ($role->hasAllPermissions($sortedPerms['role']))
                                            @checked(true)
                                        @endif>
                                    <label for="full-role-access" class="font-bold">Full Role Access</label>
                                    <x-permissions-row :perms="$sortedPerms['role']" :role="$role" />
                                </div>
                                <div class="checkbox-group">
                                    <input type="checkbox" id="full-perm-access"
                                        @if ($role->hasAllPermissions($sortedPerms['permission']))
                                            @checked(true)
                                        @endif>
                                    <label for="full-perm-access" class="font-bold">Full Permission Access</label>
                                    <x-permissions-row :perms="$sortedPerms['permission']" :role="$role" />
                                </div>
                                <div class="checkbox-group">
                                    <input type="checkbox" id="full-user-access"
                                        @if ($role->hasAllPermissions($sortedPerms['user']))
                                            @checked(true)
                                        @endif>
                                    <label for="full-user-access" class="font-bold">Full User Access</label>
                                    <x-permissions-row :perms="$sortedPerms['user']" :role="$role" />
                                </div>
                                <div class="checkbox-group">
                                    <input type="checkbox" id="full-cate-access"
                                        @if ($role->hasAllPermissions($sortedPerms['category']))
                                            @checked(true)
                                        @endif>
                                    <label for="full-cate-access" class="font-bold">Full Category Access</label>
                                    <x-permissions-row :perms="$sortedPerms['category']" :role="$role" />
                                </div>
                                <div class="checkbox-group">
                                    <input type="checkbox" id="full-product-access"
                                        @if ($role->hasAllPermissions($sortedPerms['product']))
                                            @checked(true)
                                        @endif>
                                    <label for="full-product-access" class="font-bold">Full Product Access</label>
                                    <x-permissions-row :perms="$sortedPerms['product']" :role="$role" />
                                </div>
                            </div>
                        </div>

                        @userCan('update-role')
                        <div class="max-w-lg">
                            <button onclick="AppUtils.validateForm('updateRole')"
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
