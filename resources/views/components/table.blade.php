<section>
    <div class="mx-auto">
        <!-- Start coding here -->
        <div class="relative sm:rounded-lg overflow-hidden">
            <div class="flex flex-col md:flex-row items-center justify-between space-y-3 md:space-y-0 md:space-x-4 py-4">
                <div class="max-w-md">
                    {{ $search }}
                </div>
            </div>
            <div class="overflow-x-auto">
                <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                    <thead class="text-xs text-gray-700 uppercase dark:text-gray-400 border-b border-gray-700">
                        <tr>
                            @foreach ($head as $h)
                                <th scope="col" class="px-4 py-3">{{ $h }}</th>
                            @endforeach
                            <th scope="col" class="px-4 py-3">
                                <span class="sr-only">Actions</span>
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        {{ $tbody }}
                    </tbody>
                </table>
            </div>
            <nav class="px-4 py-2">
                {{ $links }}
            </nav>
        </div>
    </div>
</section>
