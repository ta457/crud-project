<td>
    <a @if (isset($route)) href="{{ $route }}" @endif 
        class="block w-full h-full px-4 py-2">
        {{ $data }}
    </a>
</td>