@blaze(fold: true)

@props([
    'selected' => false,
    'name' => null,
])

@php
$classes = Flux::classes()
    ->add('[&:not([data-selected])]:hidden [:where(&)]:pt-8')
;

if ($name) {
    $attributes = $attributes->merge([
        'name' => $name,
        'wire:key' => $name,
    ]);
}
@endphp

<div {{ $attributes->class($classes)->merge(['data-selected' => $selected]) }} data-flux-tab-panel>
    {{ $slot }}
</div>
