<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AbsenController;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();




Route::resource('absens', AbsenController::class);



