@blaze(fold: true, memo: true)

<flux:button
    {{ $attributes->class('self-start cursor-pointer _my-1 _ms-2 _me-1.25') }}
    variant="subtle"
    size="sm"
    square
    aria-label="{{ __('Remove file') }}"
    data-flux-file-item-remove
>
    <flux:icon.x-mark variant="micro" />
</flux:button>