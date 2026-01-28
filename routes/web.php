<?php

use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\RoleController;
use App\Models\User;
use SebastianBergmann\CodeCoverage\Report\Html\Dashboard;
use Spatie\Permission\Models\Role;

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

Route::get('/', function () {
    return view('welcome');
})->name('index');

Route::get('/dashboard', [HomeController::class, 'index'])->name('dashboard');

Auth::routes();

Route::prefix('dashboard')     
    ->middleware(['auth', 'admin']) 
    ->group(base_path('routes/adminRoutes.php'));

Route::prefix('dashboard')
    ->middleware(['auth', 'user']) 
    ->group(base_path('routes/userRoutes.php'));

Route::prefix('dashboard')
    ->middleware(['auth'])
    ->group(base_path('routes/pembinaRoutes.php'));

