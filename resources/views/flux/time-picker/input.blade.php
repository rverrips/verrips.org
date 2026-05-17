@blaze(fold: true)

@props([
    'variant' => 'outline',
    'clearable' => null,
    'dropdown' => null,
    'invalid' => false,
    'size' => null,
])

@php

$classes = Flux::classes()
    ->add('w-full border rounded-lg block group disabled:shadow-none dark:shadow-none')
    ->add('px-3 flex items-center')
    ->add('tabular-nums cursor-default select-none')
    ->add(match ($size) {
        default => 'text-base sm:text-sm py-2 h-10 leading-[1.375rem]', // This makes the height of the input 40px (same as buttons and such...)
        'sm' => 'text-sm py-1.5 h-8 leading-[1.125rem]',
        'xs' => 'text-xs py-1.5 h-6 leading-[1.125rem]',
    })
    ->add(match ($variant) { // Background...
        'outline' => 'bg-white dark:bg-white/10 dark:disabled:bg-white/[7%]',
        'filled'  => 'bg-zinc-800/5 dark:bg-white/10 dark:disabled:bg-white/[7%]',
    })
    ->add(match ($variant) { // Text color
        'outline' => 'text-zinc-700 disabled:text-zinc-500 placeholder-zinc-400 disabled:placeholder-zinc-400/70 dark:text-zinc-300 dark:disabled:text-zinc-400 dark:placeholder-zinc-400 dark:disabled:placeholder-zinc-500',
        'filled'  => 'text-zinc-700 placeholder-zinc-500 disabled:placeholder-zinc-400 dark:text-zinc-200 dark:placeholder-white/60 dark:disabled:placeholder-white/40',
    })
    ->add(match ($variant) { // Border...
        'outline' => $invalid ? 'border-red-500' : 'shadow-xs border-zinc-200 border-b-zinc-300/80 disabled:border-b-zinc-200 dark:border-white/10 dark:disabled:border-white/5',
        'filled'  => $invalid ? 'border-red-500' : 'border-0',
    })
    ;

$inputClasses = Flux::classes()
    ->add('w-[calc(2ch+2px)] text-center')
    ->add('rounded-sm')
    ->add('disabled:text-zinc-500 dark:disabled:text-zinc-400')
    ->add('placeholder-zinc-400 dark:placeholder-zinc-400')
    ->add('caret-transparent')
    // The below reverts styles added by Tailwind Forms plugin
    ->add('border-0 bg-transparent p-0 [font-size:inherit] [line-height:inherit] focus:ring-0 focus:ring-offset-0 focus:outline-[revert] focus:outline-offset-[revert]')
    ;

@endphp


<div {{ $attributes->class($classes) }}>
    <flux:icon.clock variant="mini" class="me-2 shrink-0 text-zinc-400/75 [[disabled]_&]:text-zinc-200! dark:text-white/60 dark:[[disabled]_&]:text-white/40!" />

    <div class="-ml-px flex items-center min-w-0 overflow-hidden" dir="ltr" wire:ignore>
        <input x-on:click.stop type="text" inputmode="numeric" aria-label="{{ __('Hour') }}" data-flux-hour-input class="{{ $inputClasses->add('font-mono') }}" />:
        <input x-on:click.stop type="text" inputmode="numeric" aria-label="{{ __('Minute') }}" data-flux-minute-input class="{{ $inputClasses->add('font-mono') }}" />&nbsp;
        <input x-on:click.stop type="text" aria-label="{{ __('AM/PM') }}" data-flux-meridiem-input class="{{ $inputClasses->add('font-mono') }}" />
    </div>

    <span class="flex-1"></span>

    <?php if ($clearable): ?>
        <flux:button
            as="div"
            class="cursor-pointer [ui-time-picker[data-empty]_&]:hidden [ui-time-picker:has([disabled])_&]:hidden"
            variant="subtle"
            :size="$size === 'sm' || $size === 'xs' ? 'xs' : 'sm'"
            square
            tabindex="-1"
            aria-label="{{ __('Clear time') }}"
            x-on:click.prevent.stop="$el.closest('ui-time-picker').clear();"
            inset
        >
            <flux:icon.x-mark variant="micro" />
        </flux:button>
    <?php endif; ?>

    <?php if ($dropdown !== false && $dropdown !== 'false'): ?>
        <flux:icon.chevron-down variant="mini" class="ms-2 -me-1 shrink-0 text-zinc-400/75 [ui-time-picker-trigger:hover:not(:has(input:hover))_&]:text-zinc-800 [[disabled]_&]:text-zinc-200! dark:text-white/60 dark:[ui-time-picker-trigger:hover:not(:has(input:hover))_&]:text-white dark:[[disabled]_&]:text-white/40!" />
    <?php endif; ?>
</div>
