@blaze(fold: true, unsafe: [
    // flux:with-field props
    'name', 'label', 'badge',
    'description', 'description:trailing',
    'label:badge', 'label:aside', 'label:trailing',
    'error:name', 'error:bag', 'error:message', 'error:icon', 'error:nested', 'error:deep',
])

@props(['range' => false])

@php
$classes = Flux::classes()
    ->add('flex flex-col justify-center w-full [:where(&)]:min-h-4 isolate select-none [&[disabled]]:opacity-50 touch-none')
    ;

$trackClasses = Flux::classes()
    ->add('shrink-0 relative [:where(&)]:h-1.5 bg-zinc-200 rounded-full dark:bg-white/10 select-none')
    ->add($attributes->pluck('track:class'))
    ;

$indicatorWrapperClasses = Flux::classes()
    ->add('relative w-full h-full rounded-full overflow-hidden select-none')
    ;

$indicatorClasses = Flux::classes()
    ->add('absolute inset-y-0 bg-accent')
    ;

$thumbClasses = Flux::classes()
    ->add('absolute top-1/2 [:where(&)]:size-4 rounded-full bg-white ring ring-black/15 shadow-[0px_1px_2px_0px_rgba(0,0,0,.05),0px_2px_4px_0px_rgba(0,0,0,.1)] select-none -translate-y-1/2 -translate-x-1/2 dark:ring-black/30 rtl:translate-x-1/2 has-focus-visible:outline-2 has-focus-visible:outline-[-webkit-focus-ring-color]')
    ->add($attributes->pluck('thumb:class'))
    ;
@endphp

<flux:with-field :$attributes>
    <ui-slider 
        {{ $attributes->class($classes) }}
        @if ($range) range @endif
        data-flux-control
        data-flux-slider
        tabindex="-1"
        data-flux-aria-range-start="{{ __('start range') }}"
        data-flux-aria-range-end="{{ __('end range') }}"
    >
        <div class="h-full flex flex-col justify-center" data-flux-slider-track>
            <div data-flux-slider-track class="{{ $trackClasses }}">
                <div class="{{ $indicatorWrapperClasses }}">
                    <div data-flux-slider-indicator class="{{ $indicatorClasses }}" wire:ignore></div>
                </div>
                
                <div data-flux-slider-thumb class="{{ $thumbClasses }}" wire:ignore>
                    <input type="range" class="sr-only" {{ $attributes->only(['min', 'max', 'step']) }} />
                </div>

                @if ($range)
                    <div data-flux-slider-thumb class="{{ $thumbClasses }}" wire:ignore>
                        <input type="range" class="sr-only" {{ $attributes->only(['min', 'max', 'step']) }} />
                    </div>
                @endif
            </div>
            
            {{-- Step marks --}}
            <?php if ($slot->isNotEmpty()): ?>
                <div class="relative grid *:col-start-1 *:row-start-1 select-none cursor-default">
                    {{ $slot }}
                </div>
            <?php endif; ?>
        </div>
    </ui-slider>
</flux:with-field>
