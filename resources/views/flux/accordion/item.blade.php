@blaze(fold: true)

@aware([ 'transition' ])

@props([
    'transition' => false,
    'disabled' => false,
    'expanded' => false,
    'heading' => null,
])

@php
// Support adding the .self modifier to the wire:model directive...
if (($wireModel = $attributes->wire('model')) && $wireModel->directive && ! $wireModel->hasModifier('self')) {
    unset($attributes[$wireModel->directive]);

    $wireModel->directive .= '.self';

    $attributes = $attributes->merge([$wireModel->directive => $wireModel->value]);
}

// Support binding the state to a Livewire property
$state = $wireModel?->value ? '$wire.' . $wireModel->value : ($expanded ? 'true' : 'false');

$classes = Flux::classes()
    ->add('block pt-4 first:pt-0 pb-4 last:pb-0')
    ->add('border-b last:border-b-0 border-zinc-800/10 dark:border-white/10')
    ;
@endphp

<ui-disclosure
    {{ $attributes->class($classes) }}
    x-data="{ open: {{ $state }} }"
    x-model.self="open"
    @if ($disabled) disabled @endif
    data-flux-accordion-item
>
    <?php if ($heading): ?>
        <flux:accordion.heading>{{ $heading }}</flux:accordion.heading>

        <flux:accordion.content>{{ $slot }}</flux:accordion.content>
    <?php else: ?>
        {{ $slot }}
    <?php endif; ?>
</ui-disclosure>
