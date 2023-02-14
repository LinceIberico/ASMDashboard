<div class="container mx-auto bg-gray-300 rounded-lg p-4 w-2/3">
    <form {{ $attributes->merge(['class' => 'form'])}}>
        {{ $slot }}
    </form>
</div>