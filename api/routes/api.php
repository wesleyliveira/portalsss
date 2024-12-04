<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Middleware\CheckAdmin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Laravel\Sanctum\Http\Middleware\EnsureFrontendRequestsAreStateful;

Route::post('/login', [AuthController::class, 'login'])->name('login');

Route::middleware('auth:sanctum')->post('logout', [AuthController::class, 'logout']);

Route::middleware('auth:sanctum')->get('user', [AuthController::class, 'user']);

Route::middleware(['auth:sanctum', CheckAdmin::class])->group(function () {
    Route::post('admin/user', [UserController::class, 'store']);   // Criar usuário
    Route::get('admin/user', [UserController::class, 'index']);    // Listar usuários
    Route::get('admin/user/{id}', [UserController::class, 'show']); // Exibir um usuário
    Route::put('admin/user/{id}', [UserController::class, 'update']); // Atualizar usuário
    Route::delete('admin/user/{id}', [UserController::class, 'destroy']); // Deletar usuário
    });

