@blaze(unsafe: [
    // flux:with-field props
    'name', 'label', 'badge',
    'description', 'description:trailing',
    'label:badge', 'label:aside', 'label:trailing',
    'error:name', 'error:bag', 'error:message', 'error:icon', 'error:nested', 'error:deep',
])

@props([
    'name' => $attributes->whereStartsWith('wire:model')->first(),
    'actionsTrailing' => null,
    'actionsLeading' => null,
    'variant' => null,
    'invalid' => null,
    'footer' => null,
    'header' => null,
    'input' => null,
])

@php
$invalid ??= ($name && $errors->has($name));

$classes = Flux::classes()
    ->add('w-full p-2')
    ->add('grid grid-cols-[auto_1fr_1fr_auto]')
    ->add('shadow-xs [&:has([disabled])]:shadow-none border')
    ->add('bg-white dark:bg-white/10 dark:[&:has([disabled])]:bg-white/[7%]')
    ->add(match ($variant) {
        'input' => 'rounded-lg',
        default => 'rounded-2xl [&_[data-flux-button]]:rounded-lg',
    })
    ->add($invalid ? 'border-red-500' : 'border-zinc-200 border-b-zinc-300/80 dark:border-white/10')
    ;

$textareaClasses = Flux::classes()
    ->add('block w-full resize-none px-2 py-1.5')
    ->add('outline-none!')
    ->add('text-base sm:text-sm text-zinc-700 [[disabled]_&]:text-zinc-500 placeholder-zinc-400 [[disabled]_&]:placeholder-zinc-400/70 dark:text-zinc-300 dark:[[disabled]_&]:text-zinc-400 dark:placeholder-zinc-400 dark:[[disabled]_&]:placeholder-zinc-500')
    ;

// Support adding the .self modifier to the wire:model directive...
if (($wireModel = $attributes->wire('model')) && $wireModel->directive && ! $wireModel->hasModifier('self')) {
    unset($attributes[$wireModel->directive]);

    $wireModel->directive .= '.self';

    $attributes = $attributes->merge([$wireModel->directive => $wireModel->value]);
}
@endphp

<flux:with-field :$attributes :$name>
    <ui-composer {{ $attributes->class($classes) }} data-flux-composer>
        <?php if ($header): ?>
            <div {{ $header->attributes->class('col-span-3 flex items-center gap-1 mb-2') }}>
                {{ $header }}
            </div>
        <?php endif; ?>

        <div class="col-span-4 [[inline]_&]:col-span-2 [[inline]_&]:col-start-2">
            <?php if ($input): ?>
                {{ $input }}
            <?php else: ?>
                <textarea class="{{ $textareaClasses }}"></textarea>
            <?php endif; ?>
        </div>

        <?php if ($actionsLeading): ?>
            <div {{ $actionsLeading->attributes->class('col-span-2 [[inline]_&]:col-span-1 [[inline]_&]:col-start-1 [[inline]_&]:row-start-1 flex items-start gap-1') }}>
                {{ $actionsLeading }}
            </div>
        <?php else: ?>
            <div class="col-span-2 [[inline]_&]:col-span-1 [[inline]_&]:col-start-1 [[inline]_&]:row-start-1 flex items-start gap-1"></div>
        <?php endif; ?>

        <?php if ($actionsTrailing): ?>
            <div {{ $actionsTrailing->attributes->class('col-span-2 [[inline]_&]:col-span-1 flex items-start justify-end gap-1') }}>
                {{ $actionsTrailing }}
            </div>
        <?php else: ?>
            <div class="col-span-2 [[inline]_&]:col-span-1 flex items-start justify-end gap-1"></div>
        <?php endif; ?>

        <?php if ($footer): ?>
            <div {{ $footer->attributes->class('col-span-4 flex items-center gap-1') }}>
                {{ $footer }}
            </div>
        <?php endif; ?>
    </ui-composer>
</flux:with-field>
