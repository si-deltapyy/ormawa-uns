<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\RoleController;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\UserController;

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