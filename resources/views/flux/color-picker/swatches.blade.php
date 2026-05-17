@blaze(fold: true)

@props([
    'colors' => [],
])

@php
$classes = Flux::classes()
    ->add('grid grid-cols-8 gap-2 sm:gap-1.5')
    ;
@endphp

<div {{ $attributes->class($classes) }} data-flux-color-picker-swatches role="listbox" aria-label="{{ __('Color swatches') }}">
    <?php if ($slot->isNotEmpty()): ?>
        {{ $slot }}
    <?php else: ?>
        @foreach ($colors as $swatch)
            <flux:color-picker.swatch :value="$swatch[0]" :label="$swatch[1] ?? $swatch[0]" />
        @endforeach
    <?php endif; ?>
</div>
