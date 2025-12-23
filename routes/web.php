<?php

use Illuminate\Support\Facades\File;
use App\Http\Controllers\AdminController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\RoleController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [HomeController::class, 'index'])->name('index');
Route::get('/home', [HomeController::class, 'home'])->name('home');

Auth::routes();

Route::middleware(['auth', 'admin'])->group(function () {
    // Admin
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
});


Route::middleware('auth')->group(function () {
    // User
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
    // Route::delete('user/delete/{id}', [UserController::class, 'destroy'])->name('user.destroy');
});
