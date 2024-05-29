<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\GradeController;
use Illuminate\Support\Facades\Route;

// Rotas para registro e login de usuários
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

// Rotas para manipular as notas dos alunos e professores
Route::middleware('auth:sanctum')->group(function () {
    // Rotas para notas dos alunos
    Route::get('/grades', [GradeController::class, 'index']); // Obter todas as notas do usuário autenticado
    Route::post('/grades', [GradeController::class, 'store']); // Criar uma nova nota para o usuário autenticado
    Route::get('/grades/{id}', [GradeController::class, 'show']); // Obter uma nota específica do usuário autenticado
    Route::put('/grades/{id}', [GradeController::class, 'update']); // Atualizar uma nota específica do usuário autenticado
    Route::delete('/grades/{id}', [GradeController::class, 'destroy']); // Excluir uma nota específica do usuário autenticado

    // Rotas para notas dos professores (opcional, dependendo dos requisitos)
    // Aqui você pode adicionar rotas para manipular as notas dos alunos pelos professores, se necessário
});
