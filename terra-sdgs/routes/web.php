<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\SiteController;
use App\Http\Middleware\AdminOnly;
use App\Http\Middleware\UserOnly;
use Illuminate\Support\Facades\Route;

// Public Website Routes
Route::get('/', [SiteController::class, 'home'])->name('home');
Route::get('/about', [SiteController::class, 'about'])->name('about');
Route::get('/events', [SiteController::class, 'events'])->name('events');
Route::get('/events/register', [SiteController::class, 'registerEvent'])->name('events.register');
Route::post('/events/register', [SiteController::class, 'storeEventRegistration'])->name('events.register.store');
Route::get('/articles', [SiteController::class, 'articles'])->name('articles');
Route::get('/articles/{slug}', [SiteController::class, 'articleDetail'])->name('articles.detail');

// User Authentication & Member Portal (Strictly for regular users)
Route::get('/login', [SiteController::class, 'login'])->name('login');
Route::post('/login', [SiteController::class, 'processUserLogin'])->name('login.submit');
Route::post('/logout', [SiteController::class, 'userLogout'])->name('user.logout');

Route::middleware([UserOnly::class])->group(function () {
    Route::get('/profile', [SiteController::class, 'userProfile'])->name('user.profile');
});

// Admin Portal Routes (Strictly for administrators)
Route::prefix('admin')->name('admin.')->group(function () {
    // Admin Login Routes (Public within /admin prefix)
    Route::get('/login', [AdminController::class, 'showLogin'])->name('login');
    Route::post('/login', [AdminController::class, 'processLogin'])->name('login.submit');
    Route::post('/logout', [AdminController::class, 'logout'])->name('logout');

    // Protected Admin Routes (Requires valid admin token via AdminOnly middleware)
    Route::middleware([AdminOnly::class])->group(function () {
        Route::get('/', [AdminController::class, 'dashboard'])->name('dashboard');
        Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard.index');
        
        // 1. Event (Kegiatan)
        Route::get('/events', [AdminController::class, 'events'])->name('events');
        Route::post('/events', [AdminController::class, 'storeEvent'])->name('events.store');
        Route::delete('/events/{id}', [AdminController::class, 'deleteEvent'])->name('events.destroy');
        
        // 2. Peserta (Registrations)
        Route::get('/participants', [AdminController::class, 'participants'])->name('participants');
        
        // 3. Artikel (Articles CMS)
        Route::get('/articles', [AdminController::class, 'articles'])->name('articles');
        Route::post('/articles', [AdminController::class, 'storeArticle'])->name('articles.store');
        Route::delete('/articles/{id}', [AdminController::class, 'deleteArticle'])->name('articles.destroy');
        
        // 4. Pengguna dan Admin
        Route::get('/users', [AdminController::class, 'users'])->name('users');
        Route::post('/users', [AdminController::class, 'storeUser'])->name('users.store');
        Route::delete('/users/{id}', [AdminController::class, 'deleteUser'])->name('users.destroy');
        
        // 5. Log Aktivitas
        Route::get('/logs', [AdminController::class, 'activityLogs'])->name('logs');
    });
});
