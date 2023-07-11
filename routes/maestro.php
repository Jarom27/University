<?php

use App\Http\Controllers\Teacher\AlumnosController;
use App\Http\Controllers\Teacher\HomeController;
use App\Http\Controllers\Teacher\StudentsController;
use Illuminate\Support\Facades\Route;

    Route::group(['middleware' => ['role:Maestro']], function () {
        Route::get("/",[HomeController::class,"index"]);
        Route::resource("alumnos",AlumnosController::class);
    });
    

?>