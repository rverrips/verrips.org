@blaze(unsafe: [
    // flux:with-field props
    'name', 'label', 'badge',
    'description', 'description:trailing',
    'label:badge', 'label:aside', 'label:trailing',
    'error:name', 'error:bag', 'error:message', 'error:icon', 'error:nested', 'error:deep',
])

@props([
    'placeholder' => null,
    'unavailable' => null,
    'clearable' => null,
    'dropdown' => null,
    'type' => 'button',
    'invalid' => null,
    'value' => null,
    'name' => null,
    'size' => null,
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

$placeholder ??= __('Select a time');

// Mark it invalid if the property or any of it's nested attributes have errors...
$invalid ??= ($name && ($errors->has($name) || $errors->has($name . '.*')));

$classes = Flux::classes()
    ->add('block min-w-0')
    // The below reverts styles added by Tailwind Forms plugin...
    ->add('border-0 p-0 bg-transparent')
    ;

$optionsClasses = Flux::classes()
    ->add('[:where(&)]:min-w-48 [:where(&)]:max-h-[20rem] p-[.3125rem] scroll-py-[.3125rem]')
    ->add('rounded-lg shadow-xs')
    ->add('border border-zinc-200 dark:border-zinc-600')
    ->add('bg-white dark:bg-zinc-700')
    ;

// Add support for `$value` being an array, if for example it's coming from
// the `old()` helper or if a user prefers to pass data in as an array...
if (is_array($value)) {
    $value = collect($value)->join(',');
}

if (isset($unavailable)) {
    $unavailable = collect($unavailable)->join(',');
}

if (isset($dropdown) && $dropdown === false) {
    $dropdown = 'false';
}
@endphp

<flux:with-field :$attributes :$name>
    <ui-time-picker
        {{ $attributes->class($classes) }}
        data-flux-control
        data-flux-time-picker
        @if (isset($dropdown)) dropdown="{{ $dropdown }}" @endif
        @if ($unavailable) unavailable="{{ $unavailable }}" @endif
        @if ($showName) name="{{ $name }}" @endif
        @if (isset($value)) value="{{ $value }}" @endif
        {{ $attributes }}
    >
        <ui-time-picker-trigger>
        <?php if ($type === 'input'): ?>
            <flux:time-picker.input :$invalid :$size :$clearable :$dropdown />
        <?php else: ?>
            <flux:time-picker.button :$placeholder :$invalid :$size :$clearable />
        <?php endif; ?>
        </ui-time-picker-trigger>

        <ui-time-picker-options popover="manual" tabindex="-1" wire:ignore class="{{ $optionsClasses }}">
            <template name="option">
                <button type="button" tabindex="-1" class="w-full px-1 py-1.5 rounded-lg flex items-center justify-start gap-2 text-sm text-zinc-800 dark:text-white data-active:bg-zinc-100 dark:data-active:bg-zinc-600 disabled:text-zinc-400 disabled:pointer-events-none disabled:cursor-default [[readonly]_&]:pointer-events-none [[readonly]_&]:cursor-default [[readonly]_&]:bg-transparent">
                    <div class="w-6 shrink-0" data-checked>
                        <flux:icon.check variant="mini" class="hidden [ui-time-picker-options>[data-selected]_&]:block" />
                    </div>
                    {{-- This need to be `ltr`, otherwise the string will be flipped in RTL mode when it shouldn't be... --}}
                    <div dir="ltr" class="tabular-nums">
                        <slot></slot>
                    </div>
                </button>
            </template>
        </ui-time-picker-options>
    </ui-time-picker>
</flux:with-field>