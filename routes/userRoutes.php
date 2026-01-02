<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;

    Route::get('user/home', [UserController::class, 'index'])->name('user.index');
    Route::get('user/profile', [UserController::class, 'profile'])->name('user.profile');
    Route::patch('user/profile', [UserController::class, 'change'])->name('user.change.profile');
    Route::get('user/show', [UserController::class, 'show'])->name('user.show');
    Route::get('user/insert', [UserController::class, 'insert'])->name('user.insert');
    Route::get('user/search', [UserController::class, 'search'])->name('user.search');
    Route::post('user/insert', [UserController::class, 'store'])->name('user.store');
    Route::get('user/info/{id}', [UserController::class, 'info'])->name('user.info');
    Route::post('user/info/{id}', [UserController::class, 'detail'])->name('user.detail');
    Route::get('user/print/{id}', [UserController::class, 'pdf'])->name('user.pdf');
    Route::patch('user/info/{id}', [UserController::class, 'final'])->name('user.final');
    Route::get('user/edit/{id}', [UserController::class, 'edit'])->name('user.edit');
    Route::post('user/edit/{id}', [UserController::class, 'update'])->name('user.update');