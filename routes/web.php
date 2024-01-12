<?php

use App\Http\Controllers\ChartController;
use App\Http\Controllers\TestPageController;
use App\Http\Controllers\TrackController;
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


Route::get('/', [ChartController::class, 'index']);

Route::get('/test', [TestPageController::class, 'index']);

