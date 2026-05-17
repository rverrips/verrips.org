@blaze(fold: true)

@props([])

@php
$classes = Flux::classes()
    ->add('inline-flex items-center justify-center')
    ->add('size-10 sm:size-8 rounded-lg')
    ->add('text-zinc-400 hover:text-zinc-800 hover:bg-zinc-100')
    ->add('dark:hover:text-white dark:hover:bg-white/5')
    ;
@endphp

<button
    type="button"
    {{ $attributes->class($classes) }}
    data-flux-color-picker-dropper
    aria-label="{{ __('Pick a color from the screen') }}"
>
    <flux:icon.eye-dropper variant="mini" />
</button>
