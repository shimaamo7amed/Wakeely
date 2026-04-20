<a href="{{ route(activeGuard() . '.clients.show', $Model) }}">
    @if($Model->deleted_at)
        <i class="fa-solid fa-circle text-danger"></i>
    @endif
    {{ $Model->name }}
</a>