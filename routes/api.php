<?php

use App\Http\Controllers\ChartController;
use App\Http\Controllers\ClickController;
use App\Http\Controllers\ScrollController;
use App\Http\Controllers\SiteEntranceController;
use App\Http\Controllers\TrackController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/click', ClickController::class);
Route::post('/scroll', ScrollController::class);
Route::post('/entrance', SiteEntranceController::class);

Route::get('/entrance/{range}', [ChartController::class, 'getEntrances']);
Route::get('/click/{range}', [ChartController::class, 'getClicks']);
Route::get('/most-clicked/{range}', [ChartController::class, 'getMostClicked']);
Route::get('/click-map/{range}', [ChartController::class, 'getClickMap']);
