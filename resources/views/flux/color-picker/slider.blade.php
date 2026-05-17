@blaze(fold: true)

@props([
    'channel' => 'hue',
])

@php
$min = 0;
$max = $channel === 'hue' ? 360 : 100;
$step = 1;

$trackClasses = Flux::classes()
    ->add('shrink-0 relative [:where(&)]:h-4 sm:[:where(&)]:h-3 rounded-full select-none')
    ;

$thumbClasses = Flux::classes()
    ->add('absolute top-1/2 [:where(&)]:size-5 sm:[:where(&)]:size-4 rounded-full bg-white ring ring-black/15 shadow-[0px_1px_2px_0px_rgba(0,0,0,.05),0px_2px_4px_0px_rgba(0,0,0,.1)] select-none -translate-y-1/2 -translate-x-1/2 dark:ring-black/30 rtl:translate-x-1/2 has-focus-visible:outline-2 has-focus-visible:outline-[-webkit-focus-ring-color]')
    ;
@endphp

<ui-slider
    {{ $attributes }}
    min="{{ $min }}"
    max="{{ $max }}"
    step="{{ $step }}"
    big-step="10"
    data-flux-color-picker-slider
    data-channel="{{ $channel }}"
    tabindex="-1"
    role="presentation"
    class="flex flex-col justify-center w-full [:where(&)]:min-h-4 isolate select-none touch-none"
>
    <div class="h-full flex flex-col justify-center" data-flux-slider-track>
        <div data-flux-slider-track class="{{ $trackClasses }}">
            {{-- Custom track background for color picker --}}
            @if ($channel === 'hue')
                <div class="absolute inset-0 rounded-full" style="background: linear-gradient(to right, #ff0000, #ffff00, #00ff00, #00ffff, #0000ff, #ff00ff, #ff0000);"></div>
            @else
                <div class="absolute inset-0 rounded-full" style="background-image: linear-gradient(45deg, #ccc 25%, transparent 25%), linear-gradient(-45deg, #ccc 25%, transparent 25%), linear-gradient(45deg, transparent 75%, #ccc 75%), linear-gradient(-45deg, transparent 75%, #ccc 75%); background-size: 8px 8px; background-position: 0 0, 0 4px, 4px -4px, -4px 0px;" data-flux-color-picker-slider-checkerboard></div>
                <div class="absolute inset-0 rounded-full" data-flux-color-picker-slider-track></div>
            @endif

            {{-- Hidden indicator (not used visually, but ui-slider expects it) --}}
            <div class="relative w-full h-full rounded-full overflow-hidden select-none">
                <div data-flux-slider-indicator class="absolute inset-y-0 opacity-0"></div>
            </div>

            <div data-flux-slider-thumb class="{{ $thumbClasses }}" wire:ignore>
                <input type="range" class="sr-only" min="{{ $min }}" max="{{ $max }}" step="{{ $step }}" aria-label="{{ $channel === 'hue' ? __('Hue') : __('Opacity') }}" />
            </div>
        </div>
    </div>
</ui-slider>
