@props([
    'horizontal' => false,
    'align' => 'center',
    'size' => null,
])

@php
$classes = Flux::classes()
    ;

if ($horizontal) {
    $attributes = $attributes->merge([
        'data-flux-timeline-horizontal' => $horizontal,
    ]);
}

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

<ol {{ $attributes->class($classes) }} data-flux-timeline>
    {{ $slot }}
</ol>