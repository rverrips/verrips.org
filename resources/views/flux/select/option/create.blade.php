@blaze(fold: true)

@props([
    'modal' => null,
])

@php
$classes = Flux::classes()
    ->add('group/option overflow-hidden data-hidden:hidden group flex items-center px-2 py-1.5 w-full focus:outline-hidden')
    ->add('rounded-md')
    ->add('text-start text-sm font-medium select-none')
    ->add('text-zinc-800 data-active:bg-zinc-100 [&[disabled]]:text-zinc-400 dark:text-white dark:data-active:bg-zinc-600 dark:[&[disabled]]:text-zinc-400')
    ->add('[&[disabled]]:pointer-events-none')
    ;

if ($modal) {
    $attributes = $attributes->merge(['x-data' => '', 'x-on:click' => "\$dispatch('modal-show', { name: '{$modal}' })"]);
}

if ($attributes->whereStartsWith('wire:click')->isNotEmpty()) {
    $attributes = $attributes->merge(['wire:loading.attr' => 'data-flux-loading']);
}
@endphp

<ui-option-create {{ $attributes->class($classes) }} action data-flux-option-create>
    <div class="w-6 shrink-0">
        <flux:icon variant="mini" icon="plus" />
    </div>

    <span class="overflow-hidden text-nowrap text-ellipsis">{{ $slot }}</span>

    <flux:icon.loading class="hidden [[data-flux-loading]>&]:block ms-auto text-zinc-400 [[data-flux-menu-item]:hover_&]:text-current" variant="micro" />
</ui-option-create>
