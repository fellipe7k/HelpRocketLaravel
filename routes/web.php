<?php

use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ChamadoController;
use Illuminate\Support\Facades\Route;

Route::delete('/users/{user}/delete', [UserController::class, 'destroy'])->name('users.destroy');
Route::get('/users/{user}', [UserController::class, 'show'])->name('users.show');
Route::put('/users/{user}', [UserController::class, 'update'])->name('users.update');
Route::get('/users/{user}/edit', [UserController::class, 'edit'])->name('users.edit');
Route::post('/users', [UserController::class, 'store'])->name('users.store');
Route::get('/users/create', [UserController::class, 'create'])->name('users.create');
Route::get('/users', [UserController::class, 'index'])->name('users.index') ;

// Rotas para o CRUD de chamados
Route::middleware(['auth'])->group(function () {
    // Rotas principais de recursos
    Route::resource('chamados', ChamadoController::class);
    
    // Rota explícita para create - garantir que funcione com o link direto
    Route::get('/chamados/create', [ChamadoController::class, 'create'])->name('pages.ChamadoCreate');
    
    // Rotas adicionais
    Route::get('/chamados/rascunhos', [ChamadoController::class, 'rascunhos'])->name('chamados.rascunhos');
    Route::post('/chamados/{chamado}/atribuir', [ChamadoController::class, 'atribuir'])->name('chamados.atribuir');
    Route::delete('/anexos/{anexo}', [ChamadoController::class, 'removerAnexo'])->name('anexos.remover');
});

// Rotas para o CRUD de chamados
Route::middleware(['auth'])->group(function () {
    Route::get('/chamados/rascunhos', [ChamadoController::class, 'rascunhos'])->name('chamados.rascunhos');
    Route::resource('chamados', ChamadoController::class);
    Route::post('/chamados/{chamado}/atribuir', [ChamadoController::class, 'atribuir'])->name('chamados.atribuir');
    Route::delete('/anexos/{anexo}', [ChamadoController::class, 'removerAnexo'])->name('anexos.remover');
});


Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// Route::get('/criar-chamado', function () {
//     return view('chamado.create');
// })->middleware(['auth', 'verified'])->name('chamado.create');


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
