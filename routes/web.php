<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

$anchorTags = collect([
    'about',
    'roy',
    'angela',
    'nathan',
    'rachel',
    'luke',
    'gospel',
    'contact'
]);

$anchorTags->map(function ($item) {
    Route::redirect($item, '/#'.$item);
});

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');
