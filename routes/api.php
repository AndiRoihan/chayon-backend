<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\CoursesController;
use App\Http\Controllers\Api\ArtikelController;

Route::prefix('course')->group(function() {
    Route::get('/', [CoursesController::class, 'index']);
    Route::get('course_slug/{course_slug}', [CoursesController::class, 'findBySlug']);
    Route::get('category/{category}', [CoursesController::class, 'getByCategory']);
    
    Route::apiResource('courses', CoursesController::class)
         ->parameters(['courses' => 'id']);
});

Route::prefix('artikel')->group(function() {
    Route::get('/', [ArtikelController::class, 'index']);
    Route::get('slug/{slug}', [ArtikelController::class, 'findBySlug']);
    Route::get('category/{category}', [ArtikelController::class, 'getByCategory']);
    
    Route::apiResource('artikel', ArtikelController::class)
         ->parameters(['artikel' => 'id']);
});

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});