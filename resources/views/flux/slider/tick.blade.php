@blaze(fold: true, safe: ['value'])

@props(['value'])

@php
    $classes = Flux::classes()
        ->add('relative w-px min-h-4 min-w-4 flex flex-col justify-center items-center text-xs font-medium text-zinc-400 data-active:text-zinc-500 dark:text-white/70 dark:data-active:text-white whitespace-nowrap -translate-x-1/2')
        ->add('mt-2 has-data-flux-slider-tick-line:mt-1')
    ;

    $tickLineClasses = Flux::classes()
        ->add('h-1 w-px bg-black/25 dark:bg-white/25')
    ;
@endphp

<div {{ $attributes->class($classes) }} data-flux-slider-tick data-value="{{ $value }}" size="sm" variant="subtle">
    <?php if ($slot->isNotEmpty()): ?>
        {{ $slot }}
    <?php else: ?>
        <span data-flux-slider-tick-line class="{{ $tickLineClasses }}"></span>
    <?php endif; ?>
</div>