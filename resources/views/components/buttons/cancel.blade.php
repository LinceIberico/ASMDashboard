@props(['type' => 'reset'])

<button type="{{$type}}" {{ $attributes->merge(['class' => 'rounded-lg p-2 bg-orange-600 hover:bg-orange-700 text-white text-bold uppercase'])}} >
    <span class="px-0">
        <i class="fas fa-times"></i>
    </span>

    {{ $slot }}

</button>