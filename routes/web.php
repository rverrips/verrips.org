<?php

use Illuminate\Support\Facades\Route;

// Convenience redirects so /about, /roy etc. go to the relevant anchor on the home page.
// The main / and /rohanne routes are handled by Laravel Folio (resources/views/pages/).
collect(['about', 'roy', 'angela', 'nathan', 'rachel', 'luke', 'don', 'jenny', 'gospel', 'contact'])
    ->each(fn (string $anchor) => Route::redirect($anchor, '/#' . $anchor));
