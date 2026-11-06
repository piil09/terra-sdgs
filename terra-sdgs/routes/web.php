<?php

use App\Http\Controllers\SiteController;
use Illuminate\Support\Facades\Route;

Route::get('/', [SiteController::class, 'home'])->name('home');
Route::get('/about', [SiteController::class, 'about'])->name('about');
Route::get('/events', [SiteController::class, 'events'])->name('events');
Route::get('/events/register', [SiteController::class, 'registerEvent'])->name('events.register');
Route::post('/events/register', [SiteController::class, 'storeEventRegistration'])->name('events.register.store');
Route::get('/articles', [SiteController::class, 'articles'])->name('articles');
Route::get('/articles/{slug}', [SiteController::class, 'articleDetail'])->name('articles.detail');
Route::get('/donate', [SiteController::class, 'donate'])->name('donate');
Route::post('/donate', [SiteController::class, 'storeDonation'])->name('donate.store');
Route::get('/login', [SiteController::class, 'login'])->name('login');
