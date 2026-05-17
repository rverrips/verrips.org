@blaze(fold: true)

<template name="cursor">
    <path {{ $attributes->merge([
        'class' => 'text-zinc-500 dark:text-zinc-300',
        'type' => 'line',
        'fill' => 'none',
        'stroke' => 'currentColor',
        'stroke-width' => '1',
        'stroke-dasharray' => '4,4',
    ]) }}></path>
</template>
