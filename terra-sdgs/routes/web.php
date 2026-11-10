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

// Admin Routes
use App\Http\Controllers\AdminController;

Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('/', [AdminController::class, 'dashboard'])->name('dashboard');
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard.index');
    Route::get('/projects', [AdminController::class, 'projects'])->name('projects');
    Route::post('/projects', [AdminController::class, 'storeProject'])->name('projects.store');
    Route::delete('/projects/{id}', [AdminController::class, 'deleteProject'])->name('projects.destroy');
    Route::get('/donations', [AdminController::class, 'donations'])->name('donations');
    Route::get('/users', [AdminController::class, 'users'])->name('users');
});
