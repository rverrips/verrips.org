@blaze(fold: true)

@props([
    'placeholder' => null,
    'clearable' => null,
    'invalid' => false,
    'size' => null,
])

@php

$classes = Flux::classes()
    ->add('group/color-picker-button cursor-default py-2')
    ->add('overflow-hidden')
    ->add('flex items-center')
    ->add('shadow-xs')
    ->add('bg-white dark:bg-white/10 dark:disabled:bg-white/[7%]')
    ->add('disabled:shadow-none')
    ->add(match ($size) {
        default => 'h-10 text-base sm:text-sm rounded-lg ps-[7px] pe-3 block w-full',
        'sm' => 'h-8 text-sm rounded-md ps-[5px] pe-2 block w-full',
        'xs' => 'h-6 text-xs rounded-md ps-[3px] pe-2 block w-full',
    })
    ->add($invalid
        ? 'border border-red-500'
        : 'border border-zinc-200 border-b-zinc-300/80 dark:border-white/10'
    )
    ;

$chipClasses = match ($size) {
    'xs' => 'size-[17px] rounded-[4px]',
    'sm' => 'size-5 rounded',
    default => 'size-6 rounded',
};
@endphp

<button type="button" {{ $attributes->class($classes) }} @if ($invalid) data-invalid @endif data-flux-group-target data-flux-color-picker-button>
    <div class="me-2 shrink-0 cursor-default [[disabled]_&]:opacity-50">
        <div data-flux-color-picker-preview class="{{ $chipClasses }} border border-black/10 dark:border-white/10"></div>
    </div>

    <span data-flux-color-picker-display class="truncate text-start flex-1 text-zinc-700 [[disabled]_&]:text-zinc-500 dark:text-zinc-300 dark:[[disabled]_&]:text-zinc-400">
        <span class="[ui-color-picker[value]_&]:hidden text-zinc-400 [[disabled]_&]:text-zinc-400/70 dark:text-zinc-400 dark:[[disabled]_&]:text-zinc-500" data-flux-color-picker-placeholder>{{ $placeholder ?? __('Select a color') }}</span>
        <span class="[ui-color-picker:not([value])_&]:hidden" data-flux-color-picker-value></span>
    </span>

    <?php if ($clearable): ?>
        <flux:button as="div"
            class="cursor-default ms-2 {{ $size === 'sm' || $size === 'xs' ? '-me-1' : '-me-2' }} [ui-color-picker:not([value])_&]:hidden [ui-color-picker[disabled]_&]:hidden"
            variant="subtle"
            :size="$size === 'sm' || $size === 'xs' ? 'xs' : 'sm'"
            square
            tabindex="-1"
            aria-label="{{ __('Clear color') }}"
            x-on:click.prevent.stop="$el.closest('ui-color-picker').clear()"
        >
            <flux:icon.x-mark variant="micro" />
        </flux:button>
    <?php endif; ?>

    <flux:icon.chevron-down variant="mini" class="ms-2 -me-1 text-zinc-400/75 [[data-flux-color-picker-button]:hover_&]:text-zinc-800 [[disabled]_&]:text-zinc-200! dark:text-white/60 dark:[[data-flux-color-picker-button]:hover_&]:text-white dark:[[disabled]_&]:text-white/40!" />
</button>
