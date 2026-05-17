@blaze(fold: true)

@props([
    'icon' => 'cloud-arrow-up',
    'withProgress' => false,
    'inline' => false,
    'heading' => null,
    'text' => null,
    'size' => null,
])

@php
$classes = Flux::classes()
    ->add('w-full')
    ->add($inline ? 'p-4 ps-4 sm:ps-5 pe-6 sm:pe-8' : 'py-5 px-6 sm:py-10 sm:px-16')
    ->add($inline ? 'flex items-center' : 'flex flex-col items-center justify-center')
    ->add('rounded-lg border-dashed border-zinc-200 dark:border-white/10')
    ->add($inline ? 'border-1' : 'border-2')
    ->add('bg-zinc-50 dark:bg-white/10 transition-colors')
    ->add('in-data-dragging:bg-zinc-100 in-data-dragging:border-zinc-300')
    ->add('dark:in-data-dragging:bg-white/15 dark:in-data-dragging:border-white/20')
    ->add('[[disabled]_&]:opacity-75 [[disabled]_&]:pointer-events-none')
    ;

$iconClasses = Flux::classes()
    ->add('text-zinc-400 dark:text-white/60 transition')
    ->add('[[disabled]:hover_&]:text-zinc-400 dark:[[disabled]:hover_&]:text-white/60')
    ->add('in-data-dragging:text-zinc-800 dark:in-data-dragging:text-white')
    ->add('[[data-flux-file-upload-trigger]:hover_&]:text-zinc-800 dark:[[data-flux-file-upload-trigger]:hover_&]:text-white')
    ->add($withProgress ? '' : 'in-data-loading:opacity-0')
    ;

$loadingClasses = Flux::classes()
    ->add('absolute inset-0 text-zinc-800 dark:text-white transition')
    ->add($withProgress ? 'opacity-0' : 'opacity-0 in-data-loading:opacity-100')
    ;
@endphp

<div {{ $attributes->class($classes) }} data-flux-file-upload-dropzone>
    <div class="relative {{ $inline ? 'me-4' : 'mb-4' }}">
        <flux:icon
            name="{{ $icon }}"
            variant="solid"
            class="{{ $iconClasses }}"
        />

        <flux:icon
            name="loading"
            variant="solid"
            class="{{ $loadingClasses }}"
        />
    </div>

    <div class="flex flex-col {{ $inline ? 'gap-1' : 'items-center gap-2' }}">
        <?php if ($heading) : ?>
            <div class="text-sm font-medium text-zinc-800 dark:text-white cursor-default [[disabled]_&]:opacity-75">
                {{ $heading }}
            </div>
        <?php endif; ?>

        <?php if ($text) : ?>
            <div class="relative text-zinc-500 dark:text-white/60 cursor-default {{ $inline ? 'text-xs' : 'text-sm' }}">
                @if ($withProgress)
                    <div class="not-in-data-loading:opacity-0 absolute inset-x-0 top-0 flex gap-3 items-center">
                        <div class="flex-1 h-1 rounded-full bg-zinc-200 dark:bg-white/10">
                            <div class="h-full rounded-full bg-zinc-500 dark:bg-white" style="width: var(--flux-file-upload-progress)"></div>
                        </div>

                        <div class="text-zinc-500 dark:text-white/70 tabular-nums font-medium after:content-[var(--flux-file-upload-progress-as-string)]"></div>
                    </div>

                    <span class="in-data-loading:opacity-0">{{ $text }}</span>
                @else
                    {{ $text }}
                @endif
            </div>
        <?php endif; ?>
    </div>
</div>
