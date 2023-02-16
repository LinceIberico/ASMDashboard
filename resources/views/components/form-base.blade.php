<div class="container mx-auto bg-gray-300 rounded-lg p-4 lg:w-2/3 md:2/3 sm:w-full">
    <form {{ $attributes->merge(['class' => 'form'])}}>
        {{ $slot }}
    </form>
</div>