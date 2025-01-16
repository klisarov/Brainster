<?php

use App\Http\Controllers\ProjectController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ContactController;

// public
Route::get('/', [ProjectController::class, 'index']);
Route::post('/contact', [ContactController::class, 'store']);

// auth
Route::get('/login', [AuthController::class, 'showLogin']);
Route::post('/login', [AuthController::class, 'login']);
Route::get('/logout', [AuthController::class, 'logout']);

// admin
Route::get('/admin/projects', [ProjectController::class, 'adminIndex']);
Route::get('/admin/projects/create', [ProjectController::class, 'create']);
Route::post('/admin/projects', [ProjectController::class, 'store']);
Route::get('/admin/projects/{id}/edit', [ProjectController::class, 'edit']);
Route::put('/admin/projects/{id}', [ProjectController::class, 'update']);
Route::delete('/admin/projects/{id}', [ProjectController::class, 'destroy']);

?>