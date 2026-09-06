<?php

use App\Http\Controllers\AboutController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\ServicesController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('frontend.index');
})->name('home');

Route::get('/contact', [ContactController::class, 'create'])->name('contact');
Route::post('/contact', [ContactController::class, 'store'])
    ->middleware('throttle:5,1')
    ->name('contact.store');
Route::redirect('/contact.html', '/contact', 301);
Route::get('/about', AboutController::class)->name('about');
Route::redirect('/about.html', '/about', 301);
Route::get('/services', ServicesController::class)->name('services');
Route::redirect('/services.html', '/services', 301);
