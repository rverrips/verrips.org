@blaze

@php $searchPlaceholder ??= $attributes->pluck('search:placeholder'); @endphp

@props([
    'selectedSuffix' => null,
    'placeholder' => null,
    'searchable' => null,
    'clearable' => null,
    'invalid' => null,
    'trigger' => null,
    'search' => null, // Slot forwarding...
    'empty' => null, // Slot forwarding...
    'clear' => null,
    'close' => null,
    'name' => null,
    'size' => null,
])

@php
// We only want to show the name attribute on the checkbox if it has been set
// manually, but not if it has been set from the wire:model attribute...
$showName = isset($name);

if (! isset($name)) {
    $name = $attributes->whereStartsWith('wire:model')->first();
}

$invalid ??= ($name && $errors->has($name));

$class = Flux::classes()
    ->add('w-full')
    // The below reverts styles added by Tailwind Forms plugin
    ->add('border-0 p-0 bg-transparent')
    ;
@endphp

<ui-pillbox
    clear="{{ $clear ?? 'close esc select' }}"
    @if ($close) close="{{ $close }}" @endif
    {{ $attributes->class($class)->merge(['filter' => true]) }}
    @if($showName) name="{{ $name }}" @endif
    data-flux-control
    data-flux-pillbox
>
    <?php if ($trigger): ?> {{ $trigger }} <?php else: ?>
        <flux:pillbox.trigger :$placeholder :$invalid :$size :$clearable :suffix="$selectedSuffix" />
    <?php endif; ?>

    <flux:pillbox.options :$search :$searchable :$searchPlaceholder :$empty>
        {{ $slot }}
    </flux:pillbox.options>
</ui-pillbox>
