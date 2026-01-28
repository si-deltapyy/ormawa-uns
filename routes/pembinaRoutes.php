<?php

use App\Http\Controllers\AjuanController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\MahasiswaController;
use App\Http\Controllers\PembinaController;

    Route::post('pembina/verify/anggota/{id}/verify', [PembinaController::class, 'verifyAnggota'])->name('pembina.verify.anggota.verify');
    Route::post('pembina/verify/anggota/{id}/reject', [PembinaController::class, 'rejectAnggota'])->name('pembina.verify.anggota.reject');
    Route::post('pembina/verify/anggota/{id}/deactivate', [PembinaController::class, 'deactivateAnggota'])->name('pembina.verify.anggota.deactivate');