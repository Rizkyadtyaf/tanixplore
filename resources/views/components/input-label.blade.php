@props(['value'])

<label {{ $attributes->merge(['class' => 'block text-sm/6 font-medium text-gray-900 dark:text-slate-300']) }}>
    {{ $value ?? $slot }}
</label>
