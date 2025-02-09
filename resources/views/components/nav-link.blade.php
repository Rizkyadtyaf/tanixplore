@props(['active'])

@php
    $classes =
        $active ?? false
            ? 'inline-flex font-bold items-center border-b-2 px-1 pt-1 text-white transition duration-150 ease-in-out scale-100'
            : 'inline-flex text-md md:text-md items-center px-1 pt-1 text-gray-300 hover:text-white transition duration-150 ease-in-out';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>
