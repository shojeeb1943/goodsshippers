@props(['value'])

<label {{ $attributes->merge(['class' => 'block font-semibold text-sm text-primary']) }}>
    {{ $value ?? $slot }}
</label>
