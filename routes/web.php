<?php

use App\Http\Controllers\AnggaranController;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\RoleController;
use App\Models\User;
use Illuminate\Support\Facades\Artisan;
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

Route::get('/', [HomeController::class, 'welcome'])->name('index');

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

Route::get('/auth/roleselect', [HomeController::class, 'roleSelect'])
    ->name('auth.roleselect')
    ->middleware('auth');

Route::get('symlink', function () {
    $target = storage_path('app');
    $link = public_path('storage');

    if (File::exists($link)) {
        return 'The "public/storage" directory already exists.';
    }

    File::link($target, $link);

    return 'The [public/storage] directory has been linked to [storage/app].';
});

Route::get('docs/{id}', [UserController::class, 'pdfView'])
    ->name('user.pdfView');

Route::get('/maintenance/end', function () {
    Artisan::call('up');
});

Route::get('/maintenance/start', function () {
    Artisan::call('down');
});

Route::get('/anggaran/{id}', [AnggaranController::class, 'index'])->name('anggaran.index');
