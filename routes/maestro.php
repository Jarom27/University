<?php

    use App\Http\Controllers\Teacher\HomeController;
    use Illuminate\Support\Facades\Route;

    Route::group(['middleware' => ['role:Maestro']], function () {
        Route::get("/",[HomeController::class,"index"]);
       
    });
    

?>