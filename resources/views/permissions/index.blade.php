<x-app-layout>
    <x-slot name="sidebar">
        <x-sidebar></x-sidebar>
    </x-slot>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Permissions') }}
        </h2>
    </x-slot>

    <div class="">
        <div class="mx-auto sm:px-6 lg:px-8">
            <div class="overflow-hidden">
                <div class="text-gray-900 dark:text-gray-100">

                    <x-table :head="['Order', 'Name', 'Description']">
                        @php $route = '/permissions'; @endphp

                        @php $count = 1; @endphp
                        <x-slot name="tbody">
                            @foreach ($permissions as $permission)
                                <tr class="border-b dark:border-gray-700 hover:bg-gray-50">
                                    <x-table-cell :route="$route.'/'.$permission->id" :data="$count" />
                                    <x-table-cell :route="$route.'/'.$permission->id" :data="$permission->name" />
                                    <x-table-cell :route="$route.'/'.$permission->id" :data="$permission->description" />
                                </tr>
                                @php $count++; @endphp
                            @endforeach
                        </x-slot>

                        <x-slot name="links">
                            {{ $permissions->links() }}
                        </x-slot>
                    </x-table>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>