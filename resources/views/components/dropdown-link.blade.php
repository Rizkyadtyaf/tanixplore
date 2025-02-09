<a
    {{ $attributes->merge([
        'class' => 'block w-full px-4 py-2 text-start text-sm font-bold
                 text-white hover:text-[#FBC91A]
                transition duration-150 ease-in-out',
    ]) }}>{{ $slot }}</a>
