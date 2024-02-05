@php
    $route = '/roles';
@endphp

<x-app-layout>
    <x-slot name="sidebar">
        <x-sidebar></x-sidebar>
    </x-slot>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Roles') }}
        </h2>

        @if ($user->hasPermission('create-role'))
            <div>
                <x-create-item-btn btnId="createRoleModalBtn" modalId="createRoleModal">
                    New role
                </x-create-item-btn>
            </div>
        @endif
    </x-slot>

    <div class="">
        <div class="mx-auto sm:px-6 lg:px-8">
            <div class="overflow-hidden">
                <div class="text-gray-900 dark:text-gray-100">

                    <x-table :head="['Order', 'Name', 'Description']">
                        
                        <x-slot name="search">
                        </x-slot>

                        <x-slot name="tbody">
                            @php $count = 1; @endphp
                            @foreach ($roles as $role)
                                <tr class="border-b dark:border-gray-700 hover:bg-gray-50">
                                    <x-table-cell :route="$route.'/'.$role->id" :data="$count" />
                                    <x-table-cell :route="$route.'/'.$role->id" :data="$role->name" />
                                    <x-table-cell :route="$route.'/'.$role->id" :data="$role->description" />
                                    @if ($user->hasPermission('delete-role'))
                                        <x-table-row-delete-btn :route="$route" :id="$role->id" />
                                    @endif
                                    @php $count++; @endphp
                                </tr>
                            @endforeach
                        </x-slot>

                        <x-slot name="links">
                            {{ $roles->links() }}
                        </x-slot>
                    </x-table>

                </div>
            </div>
        </div>
    </div>

    @if ($user->hasPermission('create-role'))
        <x-create-item-modal :route="$route" header="Add role" modalId="createRoleModal">
            <div class="sm:col-span-2">
                <label for="name"
                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Role name</label>
                <input type="text" name="name" id="name"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                    placeholder="Type role name">
            </div>
            <div class="sm:col-span-2">
                <label for="description"
                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Role description</label>
                <input type="text" name="description" id="description"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                    placeholder="Type role description">
            </div>
            <div class="sm:col-span-2">
                <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Role
                    permissions</label>
                <div class="grid grid-cols-2 gap-4">
                    <div class="checkbox-group">
                        <input type="checkbox" id="full-role-access">
                        <label for="full-role-access" class="font-bold">Full Role Access</label>
                        <x-permissions-row :perms="$sortedPerms['role']" />
                    </div>
                    <div class="checkbox-group">
                        <input type="checkbox" id="full-perm-access">
                        <label for="full-perm-access" class="font-bold">Full Permission Access</label>
                        <x-permissions-row :perms="$sortedPerms['permission']" />
                    </div>
                    <div class="checkbox-group">
                        <input type="checkbox" id="full-user-access">
                        <label for="full-user-access" class="font-bold">Full User Access</label>
                        <x-permissions-row :perms="$sortedPerms['user']" />
                    </div>
                    <div class="checkbox-group">
                        <input type="checkbox" id="full-cate-access">
                        <label for="full-cate-access" class="font-bold">Full Category Access</label>
                        <x-permissions-row :perms="$sortedPerms['category']" />
                    </div>
                    <div class="checkbox-group">
                        <input type="checkbox" id="full-product-access">
                        <label for="full-product-access" class="font-bold">Full Product Access</label>
                        <x-permissions-row :perms="$sortedPerms['product']" />
                    </div>
                </div>
            </div>
        </x-create-item-modal>
    @endif

    @if ($user->hasPermission('delete-role'))
        <x-delete-modal />
    @endif

    <script src="{{ asset('js/role.js') }}"></script>
</x-app-layout>
