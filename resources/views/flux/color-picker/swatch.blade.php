@blaze(fold: true)

@props([
    'value' => null,
    'label' => null,
])

@php
$label ??= $value;

$classes = Flux::classes()
    ->add('size-8 sm:size-6 rounded border border-black/10 dark:border-white/10')
    ->add('data-[selected]:ring-2 data-[selected]:ring-(--color-accent) data-[selected]:ring-offset-1')
    ;
@endphp

<button
    type="button"
    {{ $attributes->class($classes) }}
    style="background-color: {{ $value }}"
    data-flux-color-picker-swatch
    data-value="{{ $value }}"
    role="option"
    aria-selected="false"
    aria-label="{{ $label }}"
    tabindex="-1"
>
</button>
