<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Student\CalificacionesController;
use App\Http\Controllers\Student\CursosController;
use App\Http\Controllers\Student\HomeController;
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
    return view('welcome');
});

Route::group(['middleware' => ['role:Estudiante']], function () {
    Route::get("/alumno",HomeController::class);
    Route::resource('/calificaciones',CalificacionesController::class);
    Route::resource('cursos',CursosController::class);
   
});


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
