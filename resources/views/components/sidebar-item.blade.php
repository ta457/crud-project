<li>
    <a href="{{ $href }}"
        class="@if ($active) bg-gray-700 @endif
            flex items-center p-2 text-base font-normal text-white rounded-lg dark:text-white hover:bg-gray-700 dark:hover:bg-gray-700 group">
        {{ $slot }}
        <span class="ml-3">{{ $text }}</span>
    </a>
</li>