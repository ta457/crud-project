<td class="px-4 py-3 justify-end">
    <form action="{{ $route }}" method="POST">
        @csrf
        @method('DELETE')
        <button type="submit"
            class="text-gray-800 hover:text-rose-600 hover:cursor-pointer dark:text-white flex align-items-center">
            <svg class="w-4 h-4 dark:text-white" aria-hidden="true"
                xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 18 20">
                <path stroke="currentColor" stroke-linecap="round"
                    stroke-linejoin="round" stroke-width="2"
                    d="M1 5h16M7 8v8m4-8v8M7 1h4a1 1 0 0 1 1 1v3H6V2a1 1 0 0 1 1-1ZM3 5h12v13a1 1 0 0 1-1 1H4a1 1 0 0 1-1-1V5Z" />
            </svg>
        </button>
    </form>
</td>