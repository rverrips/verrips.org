@blaze(fold: true)

@props([])

@php
$classes = Flux::classes()
    ->add('relative block w-full aspect-[3/2] rounded-lg select-none touch-none')
    ;
@endphp

<div {{ $attributes->class($classes) }} data-flux-color-picker-area>
    {{-- Hue background (JS sets the color dynamically) --}}
    <div class="absolute inset-0 rounded-lg overflow-hidden" data-flux-color-picker-area-hue></div>

    {{-- SV gradients: white-to-transparent left-right, transparent-to-black top-bottom --}}
    <div class="absolute inset-0 rounded-lg overflow-hidden bg-gradient-to-r from-white to-transparent" data-flux-color-picker-area-gradient></div>
    <div class="absolute inset-0 rounded-lg overflow-hidden bg-gradient-to-b from-transparent to-black"></div>

    {{-- Thumb (JS positions dynamically) — sits above the overflow-hidden layers --}}
    <div
        data-flux-color-picker-area-thumb
        data-flux-color-picker-initial-focus
        class="absolute size-5 sm:size-4 rounded-full border-2 border-white shadow-[0_0_0_1px_rgba(0,0,0,.15)] -translate-x-1/2 -translate-y-1/2 pointer-events-none outline-offset-2"
        tabindex="0"
        role="slider"
        aria-label="{{ __('Saturation and brightness') }}"
        aria-roledescription="{{ __('2D color picker') }}"
        aria-valuemin="0"
        aria-valuemax="100"
        aria-valuenow="0"
        aria-valuetext="{{ __('Saturation 0%, brightness 0%') }}"
    ></div>
</div>
