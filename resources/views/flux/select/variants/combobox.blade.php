@blaze

@props([
    'placeholder' => null,
    'searchable' => null,
    'clearable' => null,
    'multiple' => null,
    'invalid' => null,
    'empty' => null,
    'input' => null,
    'size' => null,
    'name' => null,
])

@php
// We only want to show the name attribute on the checkbox if it has been set
// manually, but not if it has been set from the wire:model attribute...
$showName = isset($name);

if (! isset($name)) {
    $name = $attributes->whereStartsWith('wire:model')->first();
}

if ($searchable) {
    throw new \Exception('Comboboxes do not support the searchable prop.');
}

if ($multiple) {
    throw new \Exception('Comboboxes do not support the multiple prop.');
}

$invalid ??= ($name && $errors->has($name));

$class = Flux::classes()
    ->add('w-full');
@endphp

<ui-select autocomplete="strict" clear="esc" {{ $attributes->class($class)->merge(['filter' => true]) }} @if($showName) name="{{ $name }}" @endif data-flux-control data-flux-select>
    <?php if ($input): ?> {{ $input }} <?php else: ?>
        <flux:select.input :$placeholder :$invalid :$size :$clearable />
    <?php endif; ?>

    <flux:select.options>
        <?php if ($empty): ?>
            <?php if (is_string($empty)): ?>
                <flux:select.option.empty>{!! __($empty) !!}</flux:select.option.empty>
            <?php else: ?>
                {{ $empty }}
            <?php endif; ?>
        <?php else: ?>
            <flux:select.option.empty when-loading="{!! __('Loading...') !!}">
                {!! __('No results found') !!}
            </flux:select.option.empty>
        <?php endif; ?>

        {{ $slot }}
    </flux:select.options>
</ui-select>
