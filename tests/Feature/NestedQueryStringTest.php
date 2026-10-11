<?php

use Illuminate\Contracts\Http\Kernel;
use Illuminate\Http\Request;

/**
 * Build a request the way PHP-FPM does: the raw QUERY_STRING is passed through
 * untouched, so Symfony only parses it when something calls getQueryString().
 */
function requestWithRawQueryString(string $query): Request
{
    return new Request(server: [
        'REQUEST_METHOD' => 'GET',
        'REQUEST_URI' => '/?'.$query,
        'QUERY_STRING' => $query,
        'HTTP_HOST' => 'localhost',
    ]);
}

it('returns 400 for query strings that exceed max_input_vars', function () {
    $query = implode('&', array_map(fn (int $i): string => "v{$i}=1", range(1, 1500)));

    $response = app(Kernel::class)->handle(requestWithRawQueryString($query));

    expect($response->getStatusCode())->toBe(400);
});

it('does not fail on deeply nested query strings', function () {
    $query = 'a'.str_repeat('[k]', 100).'=1';

    $response = app(Kernel::class)->handle(requestWithRawQueryString($query));

    expect($response->getStatusCode())->toBeIn([200, 400]);
});

it('serves normal query strings', function () {
    $response = app(Kernel::class)->handle(requestWithRawQueryString('utm_source=test&a[b]=c'));

    expect($response->getStatusCode())->toBe(200);
});
