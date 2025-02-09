<textarea
    {{ $attributes->merge([
        'class' => 'mt-1 block w-full rounded-md border-gray-300 
                        text-black dark:text-white
                        dark:bg-gray-700 dark:border-gray-600 
                        focus:border-green-500 focus:ring-green-500 
                        transition-all duration-300',
    ]) }}>
    {{ $slot }}
</textarea>
