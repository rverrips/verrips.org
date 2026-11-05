<?php

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Support\Facades\Route;

it('serves livewire from the published static assets', function () {
    $this->get('/')
        ->assertOk()
        ->assertSee('/vendor/livewire/livewire', false);
});

it('does not register the local storage serving route', function () {
    expect(Route::has('storage.local'))->toBeFalse();
});

it('schedules the github stats cache warm', function () {
    $commands = collect(app(Schedule::class)->events())->pluck('command')->implode(' ');

    expect($commands)->toContain('github:refresh');
});
