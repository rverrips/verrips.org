<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'Verrips Family' }}</title>
    <meta name="description" content="{{ $description ?? 'Updates and details about Roy, Angela, Nathan, Luke and Don Verrips — a Christian family in Reidville, South Carolina.' }}">

    <!-- Open Graph -->
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:type" content="website">
    <meta property="og:title" content="{{ $title ?? 'Verrips Family' }}">
    <meta property="og:description" content="{{ $description ?? 'Updates and details about Roy, Angela, Nathan, Luke and Don Verrips.' }}">
    <meta property="og:image" content="{{ asset('docs/images/verrips-2025.png') }}">

    <!-- Twitter -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="{{ $title ?? 'Verrips Family' }}">
    <meta name="twitter:image" content="{{ asset('docs/images/verrips-2025.png') }}">

    <link rel="shortcut icon" href="{{ asset('docs/favicon.ico') }}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Merriweather:ital,wght@0,300;0,400;0,700;1,300;1,400&family=Inter:wght@300;400;500;600&display=swap" rel="stylesheet">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @fluxAppearance
    @livewireStyles
</head>
<body class="antialiased">

    <!-- Navigation -->
    <nav class="sticky top-0 z-50 border-b"
         style="background: rgba(253,250,245,0.96); border-color: #e8dfc9; backdrop-filter: blur(8px);"
         x-data="{ open: false }">
        <div class="max-w-6xl mx-auto px-6 flex items-stretch justify-between">

            <a href="/#home" class="flex items-center gap-3 py-4">
                <span class="font-serif text-xl text-bark">Verrips Family</span>
                <span class="text-sage text-xs mt-0.5">✦</span>
                <span class="text-xs text-muted uppercase tracking-widest mt-0.5 hidden sm:block">Reidville, SC</span>
            </a>

            <!-- Desktop nav -->
            <ul class="hidden md:flex gap-8 items-center text-sm font-medium text-muted-dark">
                <li><a href="/#gallery"  class="py-5 border-b-2 border-transparent hover:border-sage hover:text-sage transition-colors inline-block">Gallery</a></li>
                <li><a href="/#about"    class="py-5 border-b-2 border-transparent hover:border-sage hover:text-sage transition-colors inline-block">About</a></li>
                <li><a href="/#family"   class="py-5 border-b-2 border-transparent hover:border-sage hover:text-sage transition-colors inline-block">Family</a></li>
                <li><a href="/#believe"  class="py-5 border-b-2 border-transparent hover:border-sage hover:text-sage transition-colors inline-block">Belief</a></li>
                <li><a href="timeline/index.html" class="py-5 border-b-2 border-transparent hover:border-sage hover:text-sage transition-colors inline-block text-xs">History</a></li>
            </ul>

            <!-- Mobile hamburger -->
            <button class="md:hidden py-4 px-2 text-muted-dark" @click="open = !open" aria-label="Toggle menu">
                <svg x-show="!open" class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/></svg>
                <svg x-show="open" class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
            </button>
        </div>

        <!-- Mobile menu -->
        <div x-show="open" x-transition class="md:hidden border-t px-6 py-4 space-y-3 text-sm font-medium" style="border-color: #e8dfc9;">
            <a href="/#gallery"  class="block text-muted-dark hover:text-sage" @click="open=false">Gallery</a>
            <a href="/#about"    class="block text-muted-dark hover:text-sage" @click="open=false">About</a>
            <a href="/#family"   class="block text-muted-dark hover:text-sage" @click="open=false">Family</a>
            <a href="/#believe"  class="block text-muted-dark hover:text-sage" @click="open=false">What We Believe</a>
            <a href="timeline/index.html" class="block text-muted-dark hover:text-sage" @click="open=false">History</a>
        </div>
    </nav>

    <!-- Page content -->
    {{ $slot }}

    <!-- Footer -->
    <footer class="bg-bark text-muted py-10 text-center text-xs">
        <p>
            Licensed under
            <a href="https://creativecommons.org/licenses/by-sa/4.0/" class="underline hover:text-cream transition-colors">
                Creative Commons Attribution-ShareAlike 4.0
            </a>
            <img src="https://mirrors.creativecommons.org/presskit/icons/cc.svg"  alt="" class="inline-block w-4 h-4 ml-1 opacity-60">
            <img src="https://mirrors.creativecommons.org/presskit/icons/by.svg"  alt="" class="inline-block w-4 h-4 ml-0.5 opacity-60">
            <img src="https://mirrors.creativecommons.org/presskit/icons/sa.svg"  alt="" class="inline-block w-4 h-4 ml-0.5 opacity-60">
        </p>
        <p class="mt-2 text-bark-light opacity-50">verrips.org</p>
    </footer>

    @livewireScripts
    @fluxScripts
</body>
</html>
