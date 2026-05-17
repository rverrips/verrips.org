@php
$classes = Flux::classes()
    ->add('');
@endphp

<div {{ $attributes->class($classes) }} data-flux-timeline-subgrid>
   {{ $slot }}
</div>