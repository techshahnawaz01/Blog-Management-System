<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\AuthController;

// Authentication Routes
 
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
    Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
    Route::post('/register', [AuthController::class, 'register']);
});

Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

 // Blog Public Routes
 
Route::get('/', [BlogController::class, 'index'])->name('blogs.index');
Route::get('/blog/{blog}', [BlogController::class, 'show'])->name('blogs.show');

// protected routes. 
Route::middleware(['auth'])->group(function () {
    
    // Blog Management
    Route::get('/blogs/create', [BlogController::class, 'create'])->name('blogs.create');
    Route::post('/blogs', [BlogController::class, 'store'])->name('blogs.store');
    
    // Authorization via Policies  
    Route::get('/blogs/{blog}/edit', [BlogController::class, 'edit'])
        ->name('blogs.edit')
        ->can('update', 'blog');

    Route::put('/blogs/{blog}', [BlogController::class, 'update'])
        ->name('blogs.update')
        ->can('update', 'blog');

    Route::delete('/blogs/{blog}', [BlogController::class, 'destroy'])
        ->name('blogs.destroy')
        ->can('delete', 'blog');

    // Likes & Comments
    Route::post('/blogs/{blog}/like', [BlogController::class, 'toggleLike'])->name('blogs.like');
    Route::post('/blog/{blog}/comments', [CommentController::class, 'store'])->name('comments.store');
});