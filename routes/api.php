<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\AuthController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/



// Ruta de login
// Route::post('/login', 'AuthController@login');
Route::post('/login', [AuthController::class, 'login']);

// Rutas para mostrar la lista de proyectos y crear un nuevo proyecto
Route::get('/projects', [ProjectController::class, 'index'])->name('projects.index');
Route::get('/projects/create', [ProjectController::class, 'create'])->name('projects.create');
Route::post('/projects', [ProjectController::class, 'store'])->name('projects.store');

// Rutas para ver, editar y actualizar un proyecto existente
Route::get('/projects/{id}', [ProjectController::class, 'show'])->name('projects.show');
Route::get('/projects/{id}/edit', [ProjectController::class, 'edit'])->name('projects.edit');
Route::put('/projects/{id}', [ProjectController::class, 'update'])->name('projects.update');

// Ruta para eliminar un proyecto
Route::delete('/projects/{id}', [ProjectController::class, 'destroy'])->name('projects.destroy');
