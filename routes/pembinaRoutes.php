<?php

use App\Http\Controllers\AjuanController;
use App\Http\Controllers\AnggotaController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\MahasiswaController;
use App\Http\Controllers\PembinaController;

    Route::post('pembina/verify/anggota/{id}/verify', [PembinaController::class, 'verifyAnggota'])->name('pembina.verify.anggota.verify');
    Route::post('pembina/verify/anggota/{id}/reject', [PembinaController::class, 'rejectAnggota'])->name('pembina.verify.anggota.reject');
    Route::post('pembina/verify/anggota/{id}/deactivate', [PembinaController::class, 'deactivateAnggota'])->name('pembina.verify.anggota.deactivate');
    Route::get('review/ajuan/proker/{id}', [AjuanController::class, 'reviewProker'])->middleware(['role:admin'])->name('pembina.review.proker');
    Route::put('review/ajuan/proker/{id}/approve', [AjuanController::class, 'approveProker'])->name('pembina.review.proker.approve');
    Route::put('review/ajuan/proker/{id}/reject', [AjuanController::class, 'rejectProker'])->name('pembina.review.proker.reject');
    Route::put('review/ajuan/proker/{id}/revisi', [AjuanController::class, 'revisiProker'])->name('pembina.review.proker.revisi');
    Route::post('pembina/assign/proker/{id}', [PembinaController::class, 'assignProker'])->name('pembina.assign.proker');
    Route::get('pembina/verify/anggota', [AnggotaController::class, 'index'])->name('pembina.verify.anggota');