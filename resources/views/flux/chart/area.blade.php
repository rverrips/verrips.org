@blaze(fold: true, safe: ['field'])

@aware(['field'])

@props([
    'field' => 'value',
])

<template name="area" field="{{ $field }}" {{ $attributes->only(['curve']) }}>
    <path {{ $attributes->except('curve')->merge(['fill' => 'currentColor']) }}></path>
</template>
