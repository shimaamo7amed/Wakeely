<a href="{{ route(activeGuard() . '.lawyers.show', $Model) }}">
    @if($Model->deleted_at)
        <i class="fa-solid fa-circle text-danger"></i>
    @endif
    {{ $Model->first_name . ' ' . $Model->last_name }}
</a>