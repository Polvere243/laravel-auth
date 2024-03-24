<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\ProjectController/admin;
use App\Http\Controllers\Guest\HomeController as GuestHomeController;
use App\Http\Controllers\Admin\HomeController as AdminHomeController;
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

//rotta per la home dell'utente 
Route::get('/', GuestHomeController::class)->name('guest.home');



Route::prefix('/admin')->name('admin.')->middleware('auth')->group(() => {

    // rotta per la home dell'amministratore
Route::get('/', AdminHomeController::class)->name('home');

// rotte necessarie per il progetto
Route::get('/projects', AdminHomeController::class, 'index')->name('projects.index');
Route::get('/projects/create', AdminHomeController::class, 'create')->name('projects.create');
Route::get('/projects/{project}', AdminHomeController::class, 'show')->name('projects.show');
Route::post('/projects', AdminHomeController::class, 'store')->name('projects.store');
Route::get('/projects/{project}/edit', AdminHomeController::class, 'edit')->name('projects.edit');
Route::put('/projects/{project}', AdminHomeController::class, 'update')->name('projects.update');
Route::delete('/projects/{project}', AdminHomeController::class, 'destroy')->name('projects.destroy')

})

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
