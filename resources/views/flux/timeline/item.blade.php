@props([
    'status' => null,
    'align' => null,
    'size' => null,
])

@php
$classes = Flux::classes();

$leadingLineClasses = Flux::classes()
    ->add('[[data-flux-timeline-status=complete]+[data-flux-timeline-item]_&]:*:bg-accent')
    ->add('*:bg-zinc-200 dark:*:bg-zinc-700')
    ->add('[[data-flux-timeline][data-flux-timeline-size=lg]_&]:*:bg-zinc-100')
    ;

$trailingLineClasses = Flux::classes()
    ->add('[[data-flux-timeline-status=complete]_&]:*:bg-accent')
    ->add('*:bg-zinc-200 dark:*:bg-zinc-700')
    ->add('[[data-flux-timeline][data-flux-timeline-size=lg]_&]:*:bg-zinc-100')
    ;

$attributes = $attributes->merge([
    'data-flux-timeline-status' => $status,
]);

if ($align) {
    $attributes = $attributes->merge([
        'data-flux-timeline-align' => $align,
    ]);
}

if ($size) {
    $attributes = $attributes->merge([
        'data-flux-timeline-size' => $size,
    ]);
}
@endphp

<li {{ $attributes->class($classes) }} data-flux-timeline-item>
    <div class="{{ $leadingLineClasses }}" data-flux-timeline-line-leading>
        <div></div>
    </div>

    <div data-flux-timeline-gap-leading></div>

    {{ $slot }}

    <div class="{{ $trailingLineClasses }}" data-flux-timeline-line-trailing>
        <div></div>
    </div>

    <div data-flux-timeline-gap-trailing></div>
</li>