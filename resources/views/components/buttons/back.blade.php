@props(['type' => 'button', 'route' => 'user.index'])

<button type="{{$type}}" onclick="window.location='{{ route($route) }}'" {{ $attributes->merge(['class' => 'rounded-lg p-2 bg-sky-600 hover:bg-sky-700 text-white text-bold uppercase'])}}>
    <span class="px-0">
        <i class="fas fa-undo-alt"></i>
    </span>

    {{ $slot }}

</button>