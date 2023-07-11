<?php

    use App\Http\Controllers\Admin\CoursesController;
    use App\Http\Controllers\Admin\HomeController;
    use App\Http\Controllers\Admin\RoleController;
    use App\Http\Controllers\Admin\StudentController;
    use App\Http\Controllers\Admin\TeacherController;
    use Illuminate\Support\Facades\Route;

    Route::group(['middleware' => ['role:Administrador']], function () {
        Route::get("/",[HomeController::class,"index"]);
        Route::resource("permisos",RoleController::class);
        Route::resource("maestros",TeacherController::class);
        Route::resource("alumnos",StudentController::class);
        Route::resource("clases",CoursesController::class);
    });

    
?>