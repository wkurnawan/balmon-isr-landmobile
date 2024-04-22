<?php

use App\Http\Controllers\GrafikController;
use App\Http\Controllers\LandmobileController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

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
    return view('pages.auth.login');
});

Route::middleware(['auth'])->group(function () {
    Route::controller(UserController::class)->name('users.')->group(function () {
        // Controller profile users
        Route::get('/profile/edit-profile', [UserController::class, 'editProfile'])->name('edit.profile');
        Route::put('/profile/user/{user}/update', [UserController::class, 'updateProfile'])->name('update.profile');
        Route::put('/profile/user/{user}/update-password', [UserController::class, 'updatePasswordProfile'])->name('update.password.profile');

        // Controller users
        Route::get('/menu/data-users', [UserController::class, 'index'])->name('index');
        Route::get('/menu/data-users/tambah', [UserController::class, 'create'])->name('create');
        Route::post('/menu/data-users/tambah/data', [UserController::class, 'store'])->name('store');
        Route::get('/menu/data-users/{user}/edit', [UserController::class, 'edit'])->name('edit');
        Route::put('/menu/data-users/{user}/update', [UserController::class, 'update'])->name('update');
        Route::put('/menu/data-users/{user}/update-password', [UserController::class, 'updatePassword'])->name('update.password');
        Route::delete('/menu/data-users/{user}/destroy', [UserController::class, 'destroy'])->name('destroy');
    });

    // Controller landmobile
    Route::controller(LandmobileController::class)->name('landmobiles.')->group(function () {
        Route::get('/menu/data-landmobiles', [LandmobileController::class, 'index'])->name('index');
        Route::post('/menu/data-landmobiles/import', [LandmobileController::class, 'import'])->name('import');
        Route::get('/menu/data-landmobiles/{landmobile}/edit', [LandmobileController::class, 'edit'])->name('edit');
        Route::put('/menu/data-landmobiles/{landmobile}/update', [LandmobileController::class, 'update'])->name('update');
        Route::delete('/menu/data-landmobiles/{landmobile}/destroy', [LandmobileController::class, 'destroy'])->name('destroy');
    });

    Route::controller(GrafikController::class)->name('grafik.')->group(function () {
        Route::get('/home', [GrafikController::class, 'dashboardGrafik'])->name('dashboard');
        Route::get('/menu/grafik-isr', [GrafikController::class, 'grafik'])->name('index');
    });
});



