@blaze(fold: true)

<div {{ $attributes->class('[:where(&)]:relative') }}>
    {{ $slot }}
</div>