@blaze(fold: true)

@props([
    'variant' => 'native',
])

<flux:delegate-component :component="'date-picker.input.variants.' . $variant">{{ $slot }}</flux:delegate-component>
