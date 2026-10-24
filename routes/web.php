<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('home', [
        'tour' => config('tour'),
    ]);
});

Route::view('/impressum', 'legal.impressum', ['locale' => 'de'])->name('impressum');
Route::view('/imprint', 'legal.impressum', ['locale' => 'en'])->name('imprint');
Route::view('/datenschutz', 'legal.datenschutz', ['locale' => 'de'])->name('datenschutz');
Route::view('/privacy', 'legal.datenschutz', ['locale' => 'en'])->name('privacy');
