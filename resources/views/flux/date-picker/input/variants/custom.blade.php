@blaze(fold: true)

@aware([ 'placeholder' ])

@props([
    'placeholder' => null,
    'clearable' => false,
    'dropdown' => null,
    'invalid' => null,
    'variant' => 'outline',
    'size' => null,
])

@php

$variant = 'outline';

$classes = Flux::classes()
    ->add('w-full border block group disabled:shadow-none dark:shadow-none')
    ->add('px-3 flex items-center overflow-hidden')
    ->add('tabular-nums cursor-default')
    ->add(match ($size) {
        default => 'h-10 text-base sm:text-sm rounded-lg px-3 py-2 leading-[1.375rem]',
        'sm' => 'h-8 text-sm rounded-md ps-3 pe-2 py-1.5 leading-[1.125rem]',
        'xs' => 'h-6 text-xs rounded-md ps-3 pe-2 py-1.5 leading-[1.125rem]',
    })
    ->add(match ($variant) {
        'outline' => 'bg-white dark:bg-white/10 dark:disabled:bg-white/[7%]',
        'filled'  => 'bg-zinc-800/5 dark:bg-white/10 dark:disabled:bg-white/[7%]',
    })
    ->add(match ($variant) {
        'outline' => 'text-zinc-700 disabled:text-zinc-500 placeholder-zinc-400 disabled:placeholder-zinc-400/70 dark:text-zinc-300 dark:disabled:text-zinc-400 dark:placeholder-zinc-400 dark:disabled:placeholder-zinc-500',
        'filled'  => 'text-zinc-700 placeholder-zinc-500 disabled:placeholder-zinc-400 dark:text-zinc-200 dark:placeholder-white/60 dark:disabled:placeholder-white/40',
    })
    ->add(match ($variant) {
        'outline' => $invalid ? 'border-red-500' : 'shadow-xs border-zinc-200 border-b-zinc-300/80 disabled:border-b-zinc-200 dark:border-white/10 dark:disabled:border-white/5',
        'filled'  => $invalid ? 'border-red-500' : 'border-0',
    })
    ;

$inputClasses = Flux::classes()
    ->add('text-center')
    ->add('rounded-sm')
    ->add('disabled:text-zinc-500 dark:disabled:text-zinc-400')
    ->add('placeholder-zinc-400 dark:placeholder-zinc-400')
    ->add('caret-transparent')
    ->add('border-0 bg-transparent p-0 [font-size:inherit] [line-height:inherit] focus:ring-0 focus:ring-offset-0 focus:outline-[revert] focus:outline-offset-[revert]')
    ;
@endphp

<flux:with-field :$attributes>
    <ui-date-picker-trigger {{ $attributes->class($classes) }} data-flux-control data-flux-group-target>
        <flux:icon.calendar variant="mini" class="me-2 shrink-0 text-zinc-400/75 [[disabled]_&]:text-zinc-200! dark:text-white/60 dark:[[disabled]_&]:text-white/40!" />

        <div class="-ml-px flex items-center min-w-0 overflow-hidden" dir="ltr" wire:ignore data-flux-date-inputs>
            <input x-on:click.stop type="text" inputmode="numeric" aria-label="{{ __('Day') }}" data-flux-day-input class="{{ $inputClasses->add('font-mono w-[calc(2ch+2px)]') }}" />
            <input x-on:click.stop type="text" inputmode="numeric" aria-label="{{ __('Month') }}" data-flux-month-input class="{{ $inputClasses->add('font-mono w-[calc(2ch+2px)]') }}" />
            <input x-on:click.stop type="text" inputmode="numeric" aria-label="{{ __('Year') }}" data-flux-year-input class="{{ $inputClasses->add('font-mono w-[calc(4ch+2px)]') }}" />
        </div>

        <span class="flex-1"></span>

        <?php if ($clearable): ?>
            <flux:button
                as="div"
                class="cursor-pointer [ui-date-picker[data-empty]_&]:hidden [ui-date-picker:has([disabled])_&]:hidden"
                variant="subtle"
                :size="$size === 'sm' || $size === 'xs' ? 'xs' : 'sm'"
                square
                tabindex="-1"
                aria-label="{{ __('Clear date') }}"
                x-on:click.prevent.stop="$el.closest('ui-date-picker').clear();"
                inset
            >
                <flux:icon.x-mark variant="micro" />
            </flux:button>
        <?php endif; ?>

        <?php if ($dropdown !== false && $dropdown !== 'false'): ?>
            <flux:icon.chevron-down variant="mini" class="ms-2 -me-1 shrink-0 text-zinc-400/75 [ui-date-picker-trigger:hover:not(:has(input:hover))_&]:text-zinc-800 [[disabled]_&]:text-zinc-200! dark:text-white/60 dark:[ui-date-picker-trigger:hover:not(:has(input:hover))_&]:text-white dark:[[disabled]_&]:text-white/40!" />
        <?php endif; ?>
    </ui-date-picker-trigger>
</flux:with-field>
