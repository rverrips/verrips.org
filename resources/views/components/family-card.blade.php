@props(['member'])

@php $isMemorial = $member['memorial'] ?? false; @endphp

<article
    class="rounded-2xl overflow-hidden transition-shadow duration-300 {{ $isMemorial ? 'border-dashed' : 'hover:shadow-md' }}"
    style="background: {{ $isMemorial ? '#fdfaf5' : '#fff' }}; border: 1px {{ $isMemorial ? 'dashed' : 'solid' }} #e8dfc9;"
>
    <!-- Photo -->
    <div class="aspect-square overflow-hidden {{ $isMemorial ? 'flex items-center justify-center' : '' }}"
         style="{{ $isMemorial ? 'background:#f5f0e8;' : '' }}">
        @if ($isMemorial)
            <div class="text-center">
                <img src="{{ asset($member['photo']) }}"
                     alt="{{ $member['name'] }}"
                     class="h-32 w-32 rounded-full object-cover mx-auto border-4"
                     style="border-color: #d4c9b0;">
                <p class="mt-2 font-serif italic text-sm" style="color:#b0a090;">
                    {{ $member['memorial_year'] ?? '' }}
                </p>
            </div>
        @else
            <img src="{{ asset($member['photo']) }}"
                 alt="{{ $member['name'] }}"
                 class="w-full h-full object-cover {{ $member['focus'] ?? 'object-center' }} transition-transform duration-500 hover:scale-105">
        @endif
    </div>

    <!-- Content -->
    <div class="p-6 border-t" style="border-color: #e8dfc9;">
        <div class="flex items-start justify-between gap-2 mb-2">
            <h3 class="font-serif text-2xl" style="color: #2d2a24;">{{ $member['name'] }}</h3>
            @if ($isMemorial)
                <span class="text-xs px-2 py-0.5 rounded-full shrink-0 mt-1" style="background:#f5f0e8; color:#9a8c78;">
                    {{ $member['role'] }}
                </span>
            @else
                <span class="text-xs px-2 py-0.5 rounded-full shrink-0 mt-1" style="background:#eef4e8; color:#4a6741;">
                    {{ $member['role'] }}
                </span>
            @endif
        </div>

        <p class="text-sm leading-relaxed mb-5 {{ $isMemorial ? 'italic' : '' }}"
           style="color: {{ $isMemorial ? '#9a8c78' : '#6b5e4e' }};">
            {!! $member['bio'] !!}
        </p>

        @if (!empty($member['links']))
            <div class="flex gap-2 flex-wrap">
                @foreach ($member['links'] as $link)
                    <a href="{{ $link['url'] }}"
                       target="_blank"
                       rel="noopener noreferrer"
                       class="text-xs px-3 py-1.5 rounded-lg font-medium transition-colors hover:opacity-80"
                       style="background:#f0ebe0; color:#4a3f33;">
                        {{ $link['label'] }}
                    </a>
                @endforeach
            </div>
        @endif
    </div>
</article>
