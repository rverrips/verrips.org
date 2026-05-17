@blaze(fold: true)

@props([
    'placeholder' => null,
    'suffix' => null,
    'size' => null,
    'max' => null,
    'input' => null
])

@php
    $classes = Flux::classes()
        ->add('overflow-hidden flex gap-2 text-start flex-1 text-zinc-700')
        ->add('[[disabled]_&]:text-zinc-500 dark:text-zinc-300 dark:[[disabled]_&]:text-zinc-400');

    $optionClasses = Flux::classes()
        ->add('px-2 flex max-w-full text-zinc-700 dark:text-zinc-200 bg-zinc-400/15 dark:bg-zinc-400/40')
        ->add('cursor-default') // Combobox trigger sets cursor-text, so we need to reset it here...
        ->add(match($size) {
            default => 'rounded-md py-1 text-base sm:text-sm leading-4',
            'sm' => 'rounded-sm py-[calc(0.125rem+1px)] text-sm leading-4',
        });

    $removeClasses = Flux::classes()
        ->add('shrink-0 px-1 -me-2 text-zinc-400 hover:text-zinc-800 dark:text-zinc-400 dark:hover:text-zinc-200')
        ->add(match($size) {
            default => 'py-[calc(0.25rem-1px)] -my-[calc(0.25rem-1px)]',
            'sm' => 'py-[calc(0.25rem-2px)] -my-[calc(0.25rem-2px)]',
        });
@endphp

<ui-selected {{ $attributes->class($classes) }}>
    <?php if ($placeholder): ?>
        <div class="contents" wire:ignore x-ignore>
            <template name="placeholder">
                <span class="ms-1 text-zinc-400 [[disabled]_&]:text-zinc-400/70 dark:text-zinc-400 dark:[[disabled]_&]:text-zinc-500" data-flux-pillbox-placeholder>
                    {{ $placeholder }}
                </span>
            </template>
        </div>
    <?php endif; ?>

    <template name="option">
        <div {{ $attributes->class($optionClasses) }}>
            <div class="font-medium min-w-0"><slot name="text"></slot></div>

            <ui-selected-remove {{ $attributes->class($removeClasses) }}>
                <flux:icon.x-mark variant="micro" :class="$size === 'xs' ? 'size-3' : ''" />
            </ui-selected-remove>
        </div>
    </template>

    <div class="flex flex-wrap gap-1 grow">
        <div class="contents" wire:ignore x-ignore>
            <template name="options">
                <div class="contents">
                    <slot></slot>
                </div>
            </template>
        </div>
        
        {{ $input }}
    </div>
</ui-selected>