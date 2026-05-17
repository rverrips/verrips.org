@blaze(fold: true)

@props([
    //
])

@php
$classes = Flux::classes()
    ->add('rounded-lg w-80 max-w-80')
    ->add('[:where(&)]:bg-zinc-100 dark:[:where(&)]:bg-zinc-800')
    ;
@endphp

<div data-flux-kanban-column>
    <div {{ $attributes->class($classes) }}>
        {{ $slot }}
    </div>
</div>