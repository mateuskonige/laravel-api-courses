<?php

use App\Http\Controllers\Api\{
    CourseController,
    LessonController,
    ModuleController
};
use Illuminate\Support\Facades\Route;

/**
 * Rotas para cursos
 */
Route::put('/courses/{course}', [CourseController::class, 'update']);
Route::delete('/courses/{identify}', [CourseController::class, 'destroy']);
Route::get('/courses/{identify}', [CourseController::class, 'show']);
Route::post('/courses', [CourseController::class, 'store']);
Route::get('/courses', [CourseController::class, 'index']);

/**
 * Rotas para módulos
 */
Route::apiResource('/courses/{course}/modules', ModuleController::class);

/**
 * Rotas para lições
 */
Route::apiResource('/modules/{module}/lessons', LessonController::class);

/**
 * Rota inicial
 */
Route::get('/', function() {
    return response()->json(['message' => 'ok']);
});
