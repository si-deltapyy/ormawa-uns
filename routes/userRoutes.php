<?php

use App\Http\Controllers\AjuanController;
use App\Http\Controllers\AnggotaController;
use App\Http\Controllers\IndikatorController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\MahasiswaController;
use App\Http\Controllers\RABController;
use Illuminate\Validation\Rules\In;

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

    // Ajuan Proker Routes
    Route::get('user/ajuan/proker', [AjuanController::class, 'ajuanProker'])->name('user.ajuan.proker');
    Route::get('user/ajuan/proker/lacak/{id}', [AjuanController::class, 'lacakProker'])->name('user.ajuan.proker.lacak');
    Route::get('user/ajuan/proker/create', [AjuanController::class, 'createProker'])->name('user.ajuan.proker.create');
    Route::post('user/ajuan/proker/store', [AjuanController::class, 'storeProker'])->name('user.ajuan.proker.store');
    Route::put('/user/ajuan/proker/update/{id}', [AjuanController::class, 'update'])->name('user.ajuan.proker.update');
    Route::get('/user/ajuan/proker/edit/{id}', [AjuanController::class, 'edit'])->name('user.ajuan.proker.edit');

    // RAB Routes
    Route::get('user/ajuan/list/{id}/rab', [RABController::class, 'index'])->name('user.ajuan.rab.index');
    Route::get('user/ajuan/rab/create/{id}', [RABController::class, 'createRAB'])->name('user.ajuan.rab.create');
    Route::post('user/ajuan/rab/store/{id}', [RABController::class, 'storeRAB'])->name('user.ajuan.rab.store');
    Route::post('user/ajuan/rab/req/{id}', [RABController::class, 'requestRAB'])->name('user.ajuan.rab.req');
    Route::delete('user/ajuan/rab/delete/{id}', [RABController::class, 'deleteRAB'])->name('user.ajuan.rab.delete');
    Route::get('/user/ajuan/rab/edit/{id}', [RABController::class, 'edit'])->name('user.ajuan.rab.edit');
    Route::put('/user/ajuan/rab/update/{id}', [RABController::class, 'update'])->name('user.ajuan.rab.update');
    Route::get('/user/rab/show/{id}', [RABController::class, 'show'])->name('user.ajuan.rab.show');
    

    Route::get('cek-mahasiswa/{nim}', [MahasiswaController::class, 'cekNim'])->name('api.cek.nim');

    Route::middleware(['indikator.kosong'])->group(function () {
        Route::get('/user/input/indikator', [IndikatorController::class, 'index'])->name('user.input.indikator');
        Route::post('/user/input/indikator/store', [IndikatorController::class, 'store'])->name('user.input.indikator.store');
    });

    Route::get('/user/input/indikator/edit/{id}', [IndikatorController::class, 'edit'])->name('user.input.indikator.edit');
    Route::put('/user/input/indikator/update/{id}', [IndikatorController::class, 'update'])->name('user.input.indikator.update');