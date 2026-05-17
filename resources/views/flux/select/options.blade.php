@blaze(fold: true)

@aware([ 'searchable' ])

@props([
    'searchable' => null,
    'search' => null,
    'empty' => null,
])

@php
$classes = Flux::classes()
    ->add('[:where(&)]:min-w-48 [:where(&)]:max-h-[20rem] p-[.3125rem] scroll-py-[.3125rem]')
    ->add('rounded-lg shadow-xs')
    ->add('border border-zinc-200 dark:border-zinc-600')
    ->add('bg-white dark:bg-zinc-700')
    ;

// Searchable can also be a slot...
if (is_object($searchable)) $search = $searchable;
@endphp

<?php if (! $searchable): ?>
    <ui-options popover="manual" {{ $attributes->class($classes) }} data-flux-options>
        {{ $slot }}
    </ui-options>
<?php else: ?>
    <div popover="manual" class="[:where(&)]:min-w-48 [&:popover-open]:flex [&:popover-open]:flex-col rounded-lg shadow-xs border border-zinc-200 dark:border-zinc-600 bg-white dark:bg-zinc-700 p-[.3125rem]" data-flux-options>
        <?php if ($search): ?> {{ $search }} <?php else: ?>
            <flux:select.search />
        <?php endif; ?>

        <ui-options class="max-h-[20rem] overflow-y-auto -me-[.3125rem] -mt-[.3125rem] pt-[.3125rem] pe-[.3125rem] -mb-[.3125rem] pb-[.3125rem] scroll-py-[.3125rem]">
            <?php if ($empty): ?>
                <?php if (is_string($empty)): ?>
                    <flux:select.option.empty>{!! __($empty) !!}</flux:select.option.empty>
                <?php else: ?>
                    {{ $empty }}
                <?php endif; ?>
            <?php else: ?>
                <flux:select.option.empty when-loading="{!! __('Loading...') !!}">
                    {!! __('No results found') !!}
                </flux:select.option.empty>
            <?php endif; ?>

            {{ $slot }}
        </ui-options>
    </div>
<?php endif; ?>
