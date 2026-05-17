@blaze(fold: true)

@php
$classes = Flux::classes()
    ->add('data-hidden:hidden block items-center px-2 py-1.5 w-full')
    ->add('rounded-md')
    ->add('text-start text-sm font-medium')
    ->add('text-zinc-500 data-active:bg-zinc-100 dark:text-zinc-300 dark:data-active:bg-zinc-600')
    ;
@endphp

<ui-option-empty {{ $attributes->class($classes) }} data-flux-listbox-empty wire:ignore>
    {{ $slot }}
</ui-option-empty>
