@blaze(fold: true)

@props([
    'filter' => true,
    'disabled' => false,
])

<?php $containerAttributes = Flux::attributesAfter('container:', $attributes); ?>
<ui-select autocomplete clear="esc" data-flux-autocomplete {{ $containerAttributes->merge(['filter' => $filter, 'disabled' => $disabled]) }}>
    <flux:input :attributes="$attributes->except('filter')" />

    <flux:autocomplete.items>
        {{ $slot }}
    </flux:autocomplete.items>
</ui-select>
