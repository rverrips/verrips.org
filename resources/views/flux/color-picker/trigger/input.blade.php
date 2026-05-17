@blaze(fold: true)

@aware([ 'placeholder' ])

@props([
    'placeholder' => null,
    'clearable' => false,
    'copyable' => false,
    'invalid' => null,
    'size' => null,
])

@php

$hasTrailingIcons = $clearable || $copyable;

$classes = Flux::classes()
    ->add('w-full border block [ui-color-picker[disabled]_&]:shadow-none! dark:shadow-none')
    ->add('flex items-center overflow-hidden')
    ->add('cursor-text [ui-color-picker[disabled]_&]:cursor-default')
    ->add(match ($size) {
        default => 'h-10 text-base sm:text-sm rounded-lg ps-[7px] py-2 leading-[1.375rem]' . ($hasTrailingIcons ? ' pe-[3px]' : ' pe-3'),
        'sm' => 'h-8 text-sm rounded-lg ps-[5px] py-1.5 leading-[1.125rem]' . ($hasTrailingIcons ? ' pe-[3px]' : ' pe-2'),
        'xs' => 'h-6 text-xs rounded-md ps-[3px] py-1.5 leading-[1.125rem]' . ($hasTrailingIcons ? ' pe-[0px]' : ' pe-1.5'),
    })
    // Focus: show outline on the container when the inner input has focus-visible
    ->add('has-focus-visible:outline-2 has-focus-visible:outline-offset-[-1px] has-focus-visible:outline-[-webkit-focus-ring-color]')
    ->add('bg-white dark:bg-white/10 dark:[ui-color-picker[disabled]_&]:bg-white/[7%]')
    ->add('text-zinc-700 [ui-color-picker[disabled]_&]:text-zinc-500 dark:text-zinc-300 dark:[ui-color-picker[disabled]_&]:text-zinc-400')
    ->add($invalid
        ? 'border-red-500 shadow-none'
        : 'shadow-xs border-zinc-200 border-b-zinc-300/80 [ui-color-picker[disabled]_&]:border-b-zinc-200 dark:border-white/10 dark:[ui-color-picker[disabled]_&]:border-white/5'
    )
    ;

$inputClasses = Flux::classes()
    ->add('min-w-0 flex-1')
    ->add('border-0 bg-transparent p-0 [font-size:inherit] [line-height:inherit]')
    ->add('text-zinc-700 dark:text-zinc-300 disabled:text-zinc-500 dark:disabled:text-zinc-400')
    ->add('placeholder-zinc-400 disabled:placeholder-zinc-400/70 dark:placeholder-zinc-400 dark:disabled:placeholder-zinc-500')
    // Suppress native focus ring — the container shows focus instead
    ->add('focus:outline-none')
    ;

$chipClasses = match ($size) {
    'xs' => 'size-[17px] rounded-[4px]',
    'sm' => 'size-5 rounded',
    default => 'size-6 rounded',
};

$placeholder ??= '#000000';
@endphp

<div {{ $attributes->class($classes) }} @if ($invalid) data-invalid @endif data-flux-group-target data-flux-color-picker-trigger>
    <button type="button" class="me-2 shrink-0 cursor-pointer [[disabled]_&]:opacity-50" data-flux-color-picker-swatch-button aria-label="{{ __('Open color picker') }}">
        <div data-flux-color-picker-preview class="{{ $chipClasses }} border border-black/10 dark:border-white/10"></div>
    </button>

    <input
        type="text"
        size="1" {{-- Safari treats the default size=20 as a hard intrinsic minimum that min-width:0 can't override, preventing flex shrink. size=1 neutralizes it. --}}
        class="{{ $inputClasses }}"
        placeholder="{{ $placeholder }}"
        role="combobox"
        aria-autocomplete="none"
        aria-label="{{ __('Color') }}"
        data-flux-color-picker-input
    />

    <?php if ($copyable): ?>
        <flux:button
            as="div"
            class="cursor-default shrink-0 ms-1 [[disabled]_&]:hidden"
            variant="subtle"
            :size="$size === 'sm' || $size === 'xs' ? 'xs' : 'sm'"
            square
            tabindex="-1"
            aria-label="{{ __('Copy to clipboard') }}"
            data-flux-color-picker-copy
            x-data="{ copied: false }"
            x-on:click="copied = true; clearTimeout($el._copyTimer); $el._copyTimer = setTimeout(() => copied = false, 2000)"
            x-bind:data-copyable-copied="copied"
        >
            <flux:icon.clipboard-document-check variant="mini" class="hidden [[data-copyable-copied]>&]:block" />
            <flux:icon.clipboard-document variant="mini" class="block [[data-copyable-copied]>&]:hidden" />
        </flux:button>
    <?php endif; ?>

    <?php if ($clearable): ?>
        <flux:button
            as="div"
            class="cursor-default shrink-0 ms-1 [ui-color-picker:not([value])_&]:hidden [[disabled]_&]:hidden"
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
</div>
