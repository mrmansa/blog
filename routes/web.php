<?php

use App\Http\Controllers\BlogController;
use App\Http\Controllers\Admin\BlogAdminController;
use App\Http\Controllers\DashboardController;

// Public: show published blogs
Route::get('/', [BlogController::class, 'index'])->name('home');
Route::get('/blog/{blog}', [BlogController::class, 'show'])->name('blog.show');

// Auth (Breeze provides auth routes)
require __DIR__.'/auth.php';

Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
});

// Admin area using custom middleware
Route::middleware(['auth','admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/blogs', [BlogAdminController::class, 'index'])->name('blogs.index');
    Route::get('/blogs/create', [BlogAdminController::class, 'create'])->name('blogs.create');
    Route::post('/blogs', [BlogAdminController::class, 'store'])->name('blogs.store');
    Route::get('/blogs/{blog}/edit', [BlogAdminController::class, 'edit'])->name('blogs.edit');
    Route::put('/blogs/{blog}', [BlogAdminController::class, 'update'])->name('blogs.update');
    Route::delete('/blogs/{blog}', [BlogAdminController::class, 'destroy'])->name('blogs.destroy');

    // AJAX status update
    Route::post('/blogs/{blog}/status', [BlogAdminController::class, 'updateStatus'])->name('blogs.status');
});
