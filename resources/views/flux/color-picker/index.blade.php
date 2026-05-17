@blaze(safe: ['value'], unsafe: [
    // flux:with-field props
    'name', 'label', 'badge',
    'description', 'description:trailing',
    'label:badge', 'label:aside', 'label:trailing',
    'error:name', 'error:bag', 'error:message', 'error:icon', 'error:nested', 'error:deep',
])

@props([
    'placeholder' => null,
    'withConfirmation' => null,
    'clearable' => null,
    'copyable' => null,
    'swatches' => null,
    'dropper' => null,
    'invalid' => null,
    'format' => 'hex',
    'type' => 'input',
    'value' => null,
    'size' => null,
    'name' => null,
])

@php
// We only want to show the name attribute if it has been set manually
// but not if it has been set from the `wire:model` attribute...
$showName = isset($name);
if (! isset($name)) {
    $name = $attributes->whereStartsWith('wire:model')->first();
}

// Support adding the .self modifier to the wire:model directive...
if (($wireModel = $attributes->wire('model')) && $wireModel->directive && ! $wireModel->hasModifier('self')) {
    unset($attributes[$wireModel->directive]);

    $wireModel->directive .= '.self';

    $attributes = $attributes->merge([$wireModel->directive => $wireModel->value]);
}

// Mark it invalid if the property or any of it's nested attributes have errors...
$invalid ??= ($name && ($errors->has($name) || $errors->has($name . '.*')));

$hasAlpha = in_array($format, ['hexa', 'rgba', 'hsla']);

$hasCustomLayout = $slot->isNotEmpty();

$class = Flux::classes()
    ->add('block min-w-0')
    // The below reverts styles added by Tailwind Forms plugin...
    ->add('border-0 p-0 bg-transparent')
    ;

if ($swatches === null) {
    $swatches = [
        ['#ef4444', 'Red'],
        ['#f97316', 'Orange'],
        ['#f59e0b', 'Amber'],
        ['#eab308', 'Yellow'],
        ['#22c55e', 'Green'],
        ['#14b8a6', 'Teal'],
        ['#0ea5e9', 'Sky'],
        ['#6366f1', 'Indigo'],
        ['#a855f7', 'Purple'],
        ['#ec4899', 'Pink'],
        ['#f43f5e', 'Rose'],
        ['#fb923c', 'Orange light'],
        ['#fbbf24', 'Amber light'],
        ['#a3e635', 'Lime'],
        ['#34d399', 'Emerald'],
        ['#22d3ee', 'Cyan'],
        ['#818cf8', 'Indigo light'],
        ['#c084fc', 'Violet light'],
        ['#f472b6', 'Pink light'],
        ['#fda4af', 'Rose light'],
        ['#78716c', 'Stone'],
        ['#64748b', 'Slate'],
        ['#000000', 'Black'],
        ['#ffffff', 'White'],
    ];
} elseif ($swatches !== false) {
    $swatches = collect($swatches)->map(function ($swatch) {
        if (is_array($swatch)) return $swatch;

        return [$swatch, $swatch];
    })->values()->all();
}

$placeholder ??= in_array($format, ['hex', 'hexa'], true) ? '#000000' : __('Enter a color');
@endphp

<flux:with-field :$attributes :$name>
    <ui-color-picker
        {{ $attributes->class($class) }}
        data-flux-control
        data-flux-color-picker
        format="{{ $format }}"
        @if ($showName) name="{{ $name }}" @endif
        @if (isset($value)) value="{{ $value }}" @endif
    >
        <?php if ($type === 'input'): ?>
            <flux:color-picker.trigger.input :$placeholder :$invalid :$size :$clearable :$copyable />
        <?php else: ?>
            <flux:color-picker.trigger.button :$placeholder :$invalid :$size :$clearable />
        <?php endif; ?>

        <span data-flux-color-picker-announce aria-live="polite" aria-atomic="true" class="sr-only"></span>

        <dialog wire:ignore class="max-sm:max-h-full! rounded-xl shadow-xl sm:shadow-2xs max-sm:fixed! max-sm:inset-0! sm:backdrop:bg-transparent bg-white dark:bg-zinc-700 sm:border border-zinc-200 dark:border-white/10 p-3">
            <?php if ($hasCustomLayout): ?>
                {{ $slot }}
            <?php else: ?>
                <div class="flex flex-col gap-3">
                    <flux:color-picker.area />

                    <flux:color-picker.slider channel="hue" />

                    @if ($hasAlpha)
                        <flux:color-picker.slider channel="alpha" />
                    @endif

                    <div class="flex items-center gap-2">
                        <flux:color-picker.input class="flex-1" :$placeholder />

                        @if ($dropper)
                            <flux:color-picker.dropper />
                        @endif
                    </div>

                    @if ($swatches !== false)
                        <flux:color-picker.swatches :colors="$swatches" />
                    @endif

                    <div class="@unless ($withConfirmation) sm:hidden @endunless flex justify-end gap-2 pt-1">
                        <ui-close>
                            <flux:button variant="ghost">{{ __('Cancel') }}</flux:button>
                        </ui-close>

                        <ui-color-picker-select>
                            <flux:button variant="primary">{{ __('Select') }}</flux:button>
                        </ui-color-picker-select>
                    </div>
                </div>
            <?php endif; ?>
        </dialog>
    </ui-color-picker>
</flux:with-field>
