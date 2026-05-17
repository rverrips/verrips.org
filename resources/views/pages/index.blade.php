<?php
use function Laravel\Folio\name;
name('home');

$family = config('family');
$photos  = $family['photos'];
$members = $family['members'];
?>

<x-layouts.app title="Verrips Family — Roy, Angela, Nathan and Luke Verrips">

    <!-- Hero -->
    <header id="home" class="max-w-6xl mx-auto px-6 pt-14 pb-10 text-center">
        <div class="inline-flex items-center gap-2 mb-5 px-4 py-1.5 rounded-full text-xs font-medium tracking-widest uppercase"
             style="background: #eef4e8; color: #4a6741;">
            ✦ Est. 1996 · South Africa → Middle East → USA
        </div>
        <h1 class="font-serif mb-4" style="font-size: 3.5rem; line-height: 1.15; color: #2d2a24;">
            The Verrips<br>
            <span style="color: #6a7c59; font-style: italic; font-weight: 300;">Family</span>
        </h1>
        <p class="text-lg font-light" style="color: #9a8c78;">Roy · Angela · Nathan · Luke · Don</p>
    </header>

    <!-- Photo mosaic -->
    <section id="gallery" class="max-w-6xl mx-auto px-6 pb-16">
        <div class="mosaic rounded-3xl overflow-hidden shadow-lg">
            @foreach ($photos as $photo)
                <div class="{{ $photo['span'] ? 'mosaic-' . $photo['span'] : '' }} relative group overflow-hidden">
                    <img src="{{ asset($photo['src']) }}"
                         alt="{{ $photo['alt'] }}"
                         class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-105"
                         style="object-position: {{ $photo['focus'] ?? 'center' }};">
                    <div class="absolute inset-x-0 bottom-0 translate-y-full group-hover:translate-y-0 transition-transform duration-300 ease-out"
                         style="background: linear-gradient(to top, rgba(0,0,0,0.75) 0%, rgba(0,0,0,0.3) 60%, transparent 100%);">
                        <div class="px-4 pb-4 pt-8">
                            <p class="text-white text-sm font-medium leading-snug">{{ $photo['people'] }}</p>
                            <p class="text-white/70 text-xs mt-0.5">{{ $photo['location'] }} · {{ $photo['year'] }}</p>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        <p class="text-center mt-4 text-sm italic" style="color: #b0a090;">
            Years of memories, from Dubai to South Carolina
        </p>
    </section>

    <!-- About -->
    <section id="about" class="py-20 border-y" style="background: #eef4e8; border-color: #d4e3c8;">
        <div class="max-w-3xl mx-auto px-6">
            <h2 class="font-serif text-center mb-2" style="font-size: 2.5rem; color: #2d2a24;">About Us</h2>
            <p class="text-center mb-8 text-sm tracking-widest uppercase" style="color: #6a7c59;">
                A Christian Family
            </p>

            <p class="leading-relaxed text-lg mb-5" style="color: #4a3f33;">
                We are <strong>Roy, Angela, Nathan</strong> and <strong>Luke Verrips</strong>, a
                <a href="#believe" class="underline" style="color: #4a6741;">Christian</a> family living in
                Reidville, South Carolina since the summer of 2022 — when Angela's father,
                <strong>Don Kirkwood</strong>, also came to live with us.
            </p>
            <p class="leading-relaxed text-lg mb-5" style="color: #4a3f33;">
                We are originally from South Africa, and spent about 15 years in the Middle East — Dubai,
                Abu Dhabi, and Doha, Qatar — before immigrating to the US in 2016.
            </p>
            <p class="leading-relaxed text-lg mb-8" style="color: #4a3f33;">
                We pray and trust that God will continue to strengthen us in His mercy and grace, and that
                we may be a blessing to those He brings across our path.
            </p>

            <blockquote class="border-l-4 pl-6 py-2 mb-6" style="border-color: #6a7c59;">
                <p class="font-serif italic mb-2" style="font-size: 1.3rem; color: #2d2a24;">
                    "Our Saviour is Gentle and Lowly in heart."
                </p>
                <cite class="text-sm not-italic" style="color: #6a7c59;">
                    — <a href="https://esv.org/Matthew11:29b" target="_blank" class="underline hover:opacity-70">Matthew 11:29</a>
                </cite>
            </blockquote>

            <p class="text-sm text-center" style="color: #9a8c78;">
                Roy and Angela are members of
                <a href="https://reidvillepca.org" target="_blank" class="underline" style="color: #4a3f33;">
                    <strong>Reidville Presbyterian Church in America</strong>
                </a>
            </p>
        </div>
    </section>

    <!-- Family cards -->
    <section id="family" class="max-w-6xl mx-auto px-6 py-20">
        <h2 class="font-serif text-center mb-2" style="font-size: 2.5rem; color: #2d2a24;">Our Family</h2>
        <p class="text-center mb-12 text-sm tracking-widest uppercase" style="color: #6a7c59;">Each one a gift</p>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach ($members as $member)
                <x-family-card :member="$member" />
            @endforeach
        </div>
    </section>

    <!-- What We Believe -->
    <section id="believe" class="py-20" style="background: #2d2a24; color: #f5f0e8;">
        <div class="max-w-3xl mx-auto px-6 text-center">
            <h2 class="font-serif mb-2" style="font-size: 2.5rem; color: #f5f0e8;">What We Believe</h2>
            <p class="mb-8 text-sm tracking-widest uppercase" style="color: #6a7c59;">
                Protestant · Evangelical · Reformed
            </p>
            <p class="leading-relaxed text-lg mb-10" style="color: #c8bfb0;">
                We are a Christian family who believe the Bible to be God's true word. This 7-minute video
                offers a brief summary of what it means to be a Christian.
            </p>
            <div class="aspect-video rounded-2xl overflow-hidden shadow-2xl mb-8">
                <iframe class="w-full h-full"
                        src="https://www.youtube.com/embed/kbcvuu8lCFg?origin={{ urlencode(config('app.url')) }}"
                        allowfullscreen>
                </iframe>
            </div>
            <p class="text-sm" style="color: #9a8c78;">
                Questions? <a href="mailto:roy@verrips.org" class="underline" style="color: #6a7c59;">Email us</a> — we'd love to talk.
            </p>
        </div>
    </section>

</x-layouts.app>
