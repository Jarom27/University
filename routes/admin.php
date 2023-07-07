<?php

    use App\Http\Controllers\Admin\HomeController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\TeacherController;
use Illuminate\Support\Facades\Route;

    Route::get("/",[HomeController::class,"index"]);
    Route::resource("permisos",RoleController::class);
    Route::resource("maestros",TeacherController::class);

?>