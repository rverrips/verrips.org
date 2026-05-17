@blaze(fold: true, unsafe: ['search:placeholder'])

@php $searchPlaceholder ??= $attributes->pluck('search:placeholder'); @endphp

@aware([ 'searchable' ])

@props([
    'searchPlaceholder' => null,
    'searchable' => null,
    'search' => null,
    'empty' => null,
    'indicator' => null,
])

@php
$classes = Flux::classes()
    ->add('[:where(&)]:min-w-48 [:where(&)]:max-h-[14rem] p-[.3125rem] scroll-py-[.3125rem]')
    ->add('rounded-lg shadow-xs')
    ->add('border border-zinc-200 dark:border-zinc-600')
    ->add('bg-white dark:bg-zinc-700')
    ;

// Searchable can also be a slot...
if (is_object($searchable)) $search = $searchable;
@endphp

<?php if (! $searchable): ?>
    <ui-options popover="manual" {{ $attributes->class($classes) }} data-flux-listbox-options>
        {{ $slot }}
    </ui-options>
<?php else: ?>
    <div popover="manual" class="[:where(&)]:min-w-48 [&:popover-open]:flex [&:popover-open]:flex-col rounded-lg shadow-xs border border-zinc-200 dark:border-zinc-600 bg-white dark:bg-zinc-700 p-[.3125rem]" data-flux-options>
        <?php if ($search): ?> {{ $search }} <?php else: ?>
            <flux:pillbox.search :placeholder="$searchPlaceholder" />
        <?php endif; ?>

        <ui-options class="max-h-[20rem] overflow-y-auto -me-[.3125rem] -mt-[.3125rem] pt-[.3125rem] pe-[.3125rem] -mb-[.3125rem] pb-[.3125rem] scroll-py-[.3125rem]">
            <?php if ($empty): ?>
                 <?php if (is_string($empty)): ?>
                    <flux:pillbox.option.empty>{!! __($empty) !!}</flux:pillbox.option.empty>
                <?php else: ?>
                    {{ $empty }}
                <?php endif; ?>
            <?php else: ?>
                <flux:pillbox.option.empty when-loading="{!! __('Loading...') !!}">
                    {!! __('No results found') !!}
                </flux:pillbox.option.empty>
            <?php endif; ?>

            {{ $slot }}
        </ui-options>
    </div>
<?php endif; ?>