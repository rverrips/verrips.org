@props([
    //
])

@php
$classes = Flux::classes()
    ->add('[[data-flux-timeline-status=incomplete]_&]:opacity-75')
    ;
@endphp

<div {{ $attributes->class($classes) }} data-flux-timeline-content>
   {{ $slot }}
</div>