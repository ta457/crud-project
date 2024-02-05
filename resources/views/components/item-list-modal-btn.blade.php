<button type="button" 
    id="{{ $btnId }}" data-modal-target="{{ $modalId }}" data-modal-toggle="{{ $modalId }}"
    class="flex items-center justify-center text-gray-900 bg-gray-100 border border-gray-300 hover:bg-gray-300 focus:ring-4 focus:ring-gray-300 font-medium rounded-lg text-sm px-4 py-2 dark:bg-primary-600 dark:hover:bg-primary-700 focus:outline-none dark:focus:ring-primary-800">

    {{ $slot }}
</button>