<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\ArtikelController;
use App\Http\Controllers\Api\CourseController;

Route::apiResource('course', CourseController::class);

Route::get('/artikel', [ArtikelController::class, 'index']);
Route::get('/artikel/slug/{slug}', [ArtikelController::class, 'findBySlug']); // Add this new route
Route::get('/artikel/{id}', [ArtikelController::class, 'show']);
Route::get('/panduan/{category}', [ArtikelController::class, 'getByCategory']);
Route::apiResource('artikel', controller: ArtikelController::class);

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
