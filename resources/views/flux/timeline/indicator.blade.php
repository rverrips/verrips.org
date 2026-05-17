@props([
    'variant' => null,
    'color' => null,
])

@php
$classes = Flux::classes()
    ->add('rounded-full font-semibold text-sm')
    ->add('grid place-items-center *:col-start-1 *:row-start-1')
    ;

if ($variant !== 'bare') {
    $classes = $classes
        ->add('[:where(&)]:size-[var(--flux-timeline-indicator-size)]')
        // Status-driven styles via CSS attribute selectors (allows dynamic Alpine binding)...
        ->add('[[data-flux-timeline-status=complete]_&]:bg-accent [[data-flux-timeline-status=complete]_&]:text-accent-foreground')
        ->add('[[data-flux-timeline-status=current]_&]:border-2 [[data-flux-timeline-status=current]_&]:border-accent [[data-flux-timeline-status=current]_&]:bg-transparent')
        ->add('[[data-flux-timeline-status=current]_&]:text-zinc-800 dark:[[data-flux-timeline-status=current]_&]:text-zinc-300')
        ->add('[[data-flux-timeline-status=incomplete]_&]:border-2 [[data-flux-timeline-status=incomplete]_&]:bg-transparent')
        ->add('[[data-flux-timeline-status=incomplete]_&]:border-zinc-100 dark:[[data-flux-timeline-status=incomplete]_&]:border-zinc-700')
        ->add('[[data-flux-timeline-status=incomplete]_&]:text-zinc-500 dark:[[data-flux-timeline-status=incomplete]_&]:text-zinc-300')
        // Default styles (when no status is set, or with explicit color)...
        ->add(match ($color) {
            default => [
                'bg-zinc-100 dark:bg-zinc-700',
                'text-zinc-500 dark:text-zinc-300',
                'in-data-[flux-timeline-size=lg]:text-zinc-800 dark:in-data-[flux-timeline-size=lg]:text-white',
            ],
            'red' => 'text-white dark:text-white bg-red-500 dark:bg-red-600',
            'orange' => 'text-white dark:text-white bg-orange-500 dark:bg-orange-600',
            'amber' => 'text-white dark:text-zinc-950 bg-amber-500 dark:bg-amber-500',
            'yellow' => 'text-white dark:text-zinc-950 bg-yellow-500 dark:bg-yellow-400',
            'lime' => 'text-white dark:text-white bg-lime-500 dark:bg-lime-600',
            'green' => 'text-white dark:text-white bg-green-500 dark:bg-green-600',
            'emerald' => 'text-white dark:text-white bg-emerald-500 dark:bg-emerald-600',
            'teal' => 'text-white dark:text-white bg-teal-500 dark:bg-teal-600',
            'cyan' => 'text-white dark:text-white bg-cyan-500 dark:bg-cyan-600',
            'sky' => 'text-white dark:text-white bg-sky-500 dark:bg-sky-600',
            'blue' => 'text-white dark:text-white bg-blue-500 dark:bg-blue-600',
            'indigo' => 'text-white dark:text-white bg-indigo-500 dark:bg-indigo-600',
            'violet' => 'text-white dark:text-white bg-violet-500 dark:bg-violet-600',
            'purple' => 'text-white dark:text-white bg-purple-500 dark:bg-purple-600',
            'fuchsia' => 'text-white dark:text-white bg-fuchsia-500 dark:bg-fuchsia-600',
            'pink' => 'text-white dark:text-white bg-pink-500 dark:bg-pink-600',
            'rose' => 'text-white dark:text-white bg-rose-500 dark:bg-rose-600',
        })
        ;
}

@endphp

<div {{ $attributes->class($classes) }} data-flux-timeline-indicator>
    <div data-flux-timeline-baseline class="opacity-0 [:where(&)]:text-sm" aria-hidden="true">&ZeroWidthSpace;</div>

    <div>
        {{ $slot }}
    </div>
</div>