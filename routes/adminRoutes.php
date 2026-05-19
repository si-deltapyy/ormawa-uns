<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\RABController;
use App\Http\Controllers\ReviewerController;
use App\Http\Controllers\RoleController;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\UserController;
use Termwind\Components\Raw;

    Route::get('admin/home', [AdminController::class, 'index'])->name('admin.index');
    Route::get('admin/show', [AdminController::class, 'show'])->name('admin.show');
    Route::get('admin/insert', [AdminController::class, 'insert'])->name('admin.insert');
    Route::post('admin/insert', [AdminController::class, 'store'])->name('admin.store');
    Route::get('admin/info/{id}', [AdminController::class, 'info'])->name('admin.info');
    Route::post('admin/info/{id}', [AdminController::class, 'detail'])->name('admin.detail');
    Route::patch('admin/info/{id}', [UserController::class, 'final'])->name('admin.final');
    Route::get('admin/print/{id}', [AdminController::class, 'pdf'])->name('admin.pdf');
    Route::get('admin/edit/{id}', [AdminController::class, 'edit'])->name('admin.edit');
    Route::post('admin/edit/{id}', [AdminController::class, 'update'])->name('admin.update');
    Route::delete('admin/delete/{id}', [AdminController::class, 'destroy'])->name('admin.destroy');

    Route::get('admin/role', [RoleController::class, 'index'])->name('role.index');
    Route::get('admin/role/insert', [RoleController::class, 'insert'])->name('role.insert');
    Route::post('admin/role/insert', [RoleController::class, 'store'])->name('role.store');
    Route::get('admin/role/edit/{id}', [RoleController::class, 'edit'])->name('role.edit');
    Route::post('admin/role/edit/{id}', [RoleController::class, 'update'])->name('role.update');

    Route::get('reviewer/list', [ReviewerController::class, 'index'])->name('admin.reviewerList');
    Route::get('admin/list/review', [AdminController::class, 'review'])->name('admin.review.proker');
    Route::get('admin/list/ormawa/{id}/proker', [AdminController::class, 'listProker'])->name('admin.review.proker.list');
    Route::get('admin/list/ormawa/{id}/rab', [AdminController::class, 'listRab'])->name('admin.review.rab.list');
    Route::put('admin/review/ajuan/proker/{id}/revisi', [AdminController::class, 'revisi'])->name('admin.review.proker.revisi');
    

    Route::get('admin/review/tor/{id}', [ReviewerController::class, 'reviewTor'])->name('admin.review.tor');
    Route::put('admin/review/tor/{id}/approve', [ReviewerController::class, 'approveTor'])->name('admin.review.tor.approve');
    Route::put('admin/review/tor/{id}/reject', [ReviewerController::class, 'rejectTor'])->name('admin.review.tor.reject');
    Route::put('admin/review/tor/{id}/revisi', [ReviewerController::class, 'revisiTor'])->name('admin.review.tor.revisi');

    Route::get('admin/review/rab/{id}', [ReviewerController::class, 'reviewRab'])->name('admin.review.rab');
    Route::put('admin/review/rab/{id}/approve', [ReviewerController::class, 'approveRab'])->name('admin.review.rab.approve');
    Route::put('admin/review/rab/{id}/reject', [ReviewerController::class, 'rejectRab'])->name('admin.review.rab.reject');
    Route::put('admin/review/rab/{id}/revisi', [ReviewerController::class, 'revisiRab'])->name('admin.review.rab.revisi');
    Route::get('admin/review/rab/{id}/view/edit', [ReviewerController::class, 'adminRABedit'])->name('admin.review.rab.edit');
    Route::get('admin/review/rab/edit/{id}/data', [RABController::class, 'edit'])->name('admin.review.rab.edit.data');
    Route::post('admin/review/rab/{id}/admin/edit', [RABController::class, 'update'])->name('admin.review.rab.update');
    Route::get('admin/review/proker/{id}/bypass', [ReviewerController::class, 'bypassApprove'])->name('admin.review.rab.bypass');