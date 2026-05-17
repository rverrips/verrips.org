@blaze(fold: true)

@props([
    'placeholder' => null,
])

@php
$inputClasses = Flux::classes()
    ->add('w-full')
    ->add('tabular-nums')
    ->add('text-base sm:text-sm')
    ->add('bg-white dark:bg-white/10')
    ->add('text-zinc-700 dark:text-zinc-300')
    ->add('placeholder-zinc-400 dark:placeholder-zinc-400')
    ->add('border border-zinc-200 border-b-zinc-300/80 dark:border-white/10')
    ->add('shadow-xs')
    ->add('rounded-lg')
    ->add('h-10 sm:h-8 px-2.5')
    ;

$placeholder ??= '#000000';
@endphp

<input
    type="text"
    {{ $attributes->class($inputClasses) }}
    placeholder="{{ $placeholder }}"
    aria-label="{{ __('Color value') }}"
    data-flux-color-picker-popover-input
/>
