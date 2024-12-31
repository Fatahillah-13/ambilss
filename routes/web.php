<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\WebcamController;

Route::get('/', function () {
    return view('webcam');
});
Route::post('/webcam/store', [WebcamController::class, 'store'])->name('capture.store');