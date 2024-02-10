<div class="flex items-center">
    <form action="{{ $route }}/search" method="POST">
        @csrf
        <label for="title" class="sr-only">Search</label>
        <div class="relative w-full mr-4 flex">
            <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
            </div>
            <input type="text" id="search" name="search"
                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full pl-10 p-2 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                placeholder="Search"
                value="{{ request()->search }}">
            {{ $slot }}
            <button type="submit" class="hidden"></button>
        </div>
    </form>
</div>