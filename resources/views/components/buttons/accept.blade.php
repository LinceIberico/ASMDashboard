@props(['type' => 'submit'])

<button type="{{$type}}" {{ $attributes->merge(['class' => 'rounded-lg p-2 bg-emerald-600 hover:bg-emerald-700 text-white text-bold'])}} >
    <span class="px-0">
        <i class="fas fa-check"></i>
      </span>

      {{ $slot }}

</button>