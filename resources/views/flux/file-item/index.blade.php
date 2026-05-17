@blaze(fold: true)

@props([
    'icon' => 'document',
    'invalid' => false,
    'actions' => null,
    'heading' => null,
    'inline' => false,
    'image' => null,
    'text' => null,
    'size' => null,
])

@php
$classes = Flux::classes()
    ->add('cursor-default')
    ->add('overflow-hidden') // Overflow hidden is here to prevent the button from growing when selected text is too long.
    ->add('flex items-start')
    ->add('shadow-xs')
    ->add('bg-white dark:bg-white/10 dark:disabled:bg-white/[7%]')
    // Make the placeholder match the text color of standard input placeholders...
    ->add('disabled:shadow-none')
    ->add('min-h-10 text-base sm:text-sm rounded-lg block w-full')
    ->add($invalid
        ? 'border border-red-500'
        : 'border border-zinc-200 border-b-zinc-300/80 dark:border-white/10'
    )
    ;

$figureWrapperClasses = Flux::classes()
    ->add('p-[calc(0.75rem-1px)] flex items-baseline')
    ->add('[&:has([data-slot=image])]:p-[calc(0.5rem-1px)]')
    ;

$imageWrapperClasses = Flux::classes()
    ->add('relative mr-1 size-11 rounded-sm overflow-hidden')
    ->add([
        'after:absolute after:inset-0 after:inset-ring-[1px] after:inset-ring-black/7 dark:after:inset-ring-white/10',
        'after:rounded-sm',
    ])
    ;

if ($size) {
    if ($size < 1024) {
        $text = round($size) . ' B';
    } elseif ($size < 1024 * 1024) {
        $text = round($size / 1024) . ' KB';
    } elseif ($size < 1024 * 1024 * 1024) {
        $text = round($size / 1024 / 1024) . ' MB';
    } else {
        $text = round($size / 1024 / 1024 / 1024) . ' GB';
    }
}

$iconVariant = $text ? 'solid' : 'micro';
@endphp

<div {{ $attributes->class($classes) }} data-flux-file-item>
    <div class="{{ $figureWrapperClasses }}">
        <flux:icon name="{{ $icon }}" variant="{{ $iconVariant }}" class="text-zinc-400 [&:has(+[data-slot=image])]:hidden" />

        <?php if ($image): ?>
            <div class="{{ $imageWrapperClasses }}" data-slot="image">
                <img class="h-full w-full object-cover" src="{{ $image }}" alt="">
            </div>
        <?php endif; ?>
    </div>

    <div class="flex-1 overflow-hidden py-[calc(0.75rem-3px)] me-3 flex flex-col justify-center gap-1" data-slot="content">
        <?php if ($heading): ?>
            <div class="text-sm font-medium text-zinc-500 dark:text-white/80 whitespace-nowrap overflow-hidden text-ellipsis">{{ $heading }}</div>
        <?php endif; ?>

        <?php if ($text): ?>
            <div class="text-xs text-zinc-500">{{ $text }}</div>
        <?php endif; ?>
    </div>

    <?php if ($actions): ?>
        <div {{ $actions->attributes->class([
            'p-[calc(0.25rem-1px)]',
            'flex-shrink-0 self-start flex h-full items-center gap-2'
        ]) }} data-slot="actions">
            {{ $actions }}
        </div>
    <?php endif; ?>
</div>