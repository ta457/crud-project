<aside id="default-sidebar"
    class="fixed top-0 left-0 z-40 w-64 h-screen transition-transform -translate-x-full sm:translate-x-0"
    aria-label="Sidenav">
    <div
        class="overflow-y-auto px-3 h-full bg-gray-800 border-r border-gray-200 dark:bg-gray-800 dark:border-gray-700">
        <div class="mb-4">
            <div class="shrink-0 flex items-center pt-6 pb-2 px-5">
                <a href="/" class="flex items-center gap-3">
                    <x-application-logo class="block h-9 w-auto fill-current text-white" />
                    <h1 class="text-white font-bold text-xl">ProductCRUD</h1>
                </a>
            </div>
        </div>
        <ul class="space-y-2 border-t border-gray-700 dark:border-gray-700 pt-5">
            <x-sidebar-item 
                href="/roles" 
                text="Roles" 
                :active="request()->routeIs('web.roles.index')">
                <x-icons.role-icon />
            </x-sidebar-item>

            <x-sidebar-item 
                href="/permissions" 
                text="Permissions" 
                :active="request()->routeIs('web.permissions.index')">
                <x-icons.permission-icon />
            </x-sidebar-item>

            <x-sidebar-item 
                href="/users" 
                text="Users" 
                :active="false">
                <x-icons.user-icon />
            </x-sidebar-item>

            <x-sidebar-item 
                href="/categories" 
                text="Categories" 
                :active="false">
                <x-icons.category-icon />
            </x-sidebar-item>

            <x-sidebar-item 
                href="/products" 
                text="Products" 
                :active="false">
                <x-icons.product-icon />
            </x-sidebar-item>
        </ul>
        <ul class="pt-5 mt-5 space-y-2 border-t border-gray-700 dark:border-gray-700">
            {{-- <li>
                <button type="button" id="createCategoryModalBtn" data-modal-target="createCategoryModal"
                    data-modal-toggle="createCategoryModal"
                    class="w-full flex items-center p-2 text-base font-normal text-white rounded-lg transition duration-75 hover:bg-gray-700 dark:hover:bg-gray-700 dark:text-white group">
                    <svg class="h-3.5 w-3.5 mr-2" fill="currentColor" viewbox="0 0 20 20"
                        xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                        <path clip-rule="evenodd" fill-rule="evenodd"
                            d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z" />
                    </svg>
                    <span class="ml-3">New category</span>
                </button>
            </li> --}}
        </ul>
    </div>
</aside>
<div class="w-64 md:shrink-0 hidden sm:block"></div>
