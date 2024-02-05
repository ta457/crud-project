<div class="">
    @foreach ($perms as $perm)
    <div class="flex items-center gap-1">
        <input type="checkbox" name="selected[]" 
            id={{ $perm->id }} value="{{ $perm->id }}"
            @if (isset($role) && $role->hasPermission($perm->name)) checked @endif>
        <label for="{{ $perm->id }}">{{ $perm->name }}</label>
    </div>
    @endforeach
</div>