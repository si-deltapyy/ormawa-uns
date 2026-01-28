<?php

use App\Http\Controllers\AjuanController;
use App\Http\Controllers\AnggotaController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\MahasiswaController;

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
    Route::get('user/ajuan/proker', [AjuanController::class, 'ajuanProker'])->name('user.ajuan.proker');
    Route::get('user/ajuan/proker/create', [AjuanController::class, 'createProker'])->name('user.ajuan.proker.create');
    Route::post('user/ajuan/proker/store', [AjuanController::class, 'storeProker'])->name('user.ajuan.proker.store');
    Route::get('pembina/verify/anggota', [AnggotaController::class, 'index'])->name('pembina.verify.anggota');

    Route::get('cek-mahasiswa/{nim}', [MahasiswaController::class, 'cekNim'])->name('api.cek.nim');
    Route::put('/user/ajuan/proker/update/{id}', [AjuanController::class, 'update'])->name('user.ajuan.proker.update');
    Route::get('/user/ajuan/proker/edit/{id}', [AjuanController::class, 'edit'])->name('user.ajuan.proker.edit');