<?php

use Illuminate\Support\Facades\Route;

$home = function (string $locale) {
    app()->setLocale($locale);

    return view('home', [
        'locale' => $locale,
        'tour' => config('tour'),
        'alternates' => [
            'de' => '/de',
            'en' => '/',
            'x-default' => '/',
        ],
    ]);
};

Route::get('/', fn () => $home('en'))->name('home');
Route::get('/de', fn () => $home('de'))->name('home.de');

Route::view('/impressum', 'legal.impressum', ['locale' => 'de'])->name('impressum');
Route::view('/imprint', 'legal.impressum', ['locale' => 'en'])->name('imprint');
Route::view('/datenschutz', 'legal.datenschutz', ['locale' => 'de'])->name('datenschutz');
Route::view('/privacy', 'legal.datenschutz', ['locale' => 'en'])->name('privacy');
