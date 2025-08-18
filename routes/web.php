<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\DataController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ContentController;

/* Auth */
Route::get('/login',  [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.process');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

/* Publik */
Route::get('/', [UserController::class, 'home'])->name('user.home');
Route::get('/content/{id}', [ContentController::class, 'show'])->name('content.show'); // detail publik
Route::get('/data-penduduk', [UserController::class, 'data'])->name('user.data');

/* Area admin (auth wajib) */
Route::prefix('admin')->name('admin.')->middleware('auth')->group(function () {

    // hanya ADMIN: dashboard + data
    Route::middleware('role:admin')->group(function () {
        Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');

        Route::get('/data',            [DataController::class, 'index'])->name('data.index');
        Route::get('/data/create',     [DataController::class, 'create'])->name('data.create');
        Route::post('/data',           [DataController::class, 'store'])->name('data.store');
        Route::get('/data/{id}/edit',  [DataController::class, 'edit'])->name('data.edit');
        Route::put('/data/{id}',       [DataController::class, 'update'])->name('data.update');
        Route::delete('/data/{id}',    [DataController::class, 'destroy'])->name('data.destroy');
        Route::get('/data/export',     [DataController::class, 'export'])->name('data.export');
    });

    // ADMIN & PEMUDA: CRUD konten
    Route::middleware('role:admin,pemuda')->group(function () {
        Route::resource('content', ContentController::class)->except(['show']);
    });

    // (opsional) halaman beranda pemuda

    // fallback /admin/*
    Route::fallback(fn () => abort(404));
    
});
