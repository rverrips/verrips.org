@blaze(fold: true)

@props([
    //
])

@php
$classes = (string) Flux::classes()
    ->add('px-2 pb-2 flex flex-col gap-2')
    ;
@endphp

<div {{ $attributes->class($classes) }} data-flux-kanban-column-cards>
    {{ $slot }}
</div>