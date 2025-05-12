<?php
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ChamadoController;
use App\Http\Controllers\AtivoController;
use Illuminate\Support\Facades\Route;

// Rotas para o CRUD de usuários (Admin)
Route::middleware(['auth'])->group(function () {
    Route::delete('/users/{user}/delete', [UserController::class, 'destroy'])->name('users.destroy');
    Route::get('/users/{user}', [UserController::class, 'show'])->name('users.show');
    Route::put('/users/{user}', [UserController::class, 'update'])->name('users.update');
    Route::get('/users/{user}/edit', [UserController::class, 'edit'])->name('users.edit');
    Route::post('/users', [UserController::class, 'store'])->name('users.store');
    Route::get('/users/create', [UserController::class, 'create'])->name('users.create');
    Route::get('/users', [UserController::class, 'index'])->name('users.index');
});

// Rotas para o CRUD de chamados
Route::middleware(['auth'])->group(function () {
    Route::resource('chamados', ChamadoController::class);
    Route::get('/chamados/create', [ChamadoController::class, 'create'])->name('chamados.create');
    Route::get('/chamados/rascunhos', [ChamadoController::class, 'rascunhos'])->name('chamados.rascunhos');
    Route::post('/chamados/{chamado}/atribuir', [ChamadoController::class, 'atribuir'])->name('chamados.atribuir');
    Route::delete('/anexos/{anexo}', [ChamadoController::class, 'removerAnexo'])->name('anexos.remover');
});

// Rotas para o CRUD de ativos (estoque de equipamentos)
Route::middleware(['auth'])->group(function () {
    Route::get('/ativos', [AtivoController::class, 'index'])->name('ativos.index');
    Route::get('/ativos/create', [AtivoController::class, 'create'])->name('ativos.create');
    Route::post('/ativos', [AtivoController::class, 'store'])->name('ativos.store');
    Route::get('/ativos/{ativo}', [AtivoController::class, 'show'])->name('ativos.show');
    Route::get('/ativos/{ativo}/edit', [AtivoController::class, 'edit'])->name('ativos.edit');
    Route::put('/ativos/{ativo}', [AtivoController::class, 'update'])->name('ativos.update');
    Route::delete('/ativos/{ativo}', [AtivoController::class, 'destroy'])->name('ativos.destroy');
});

// Página inicial
Route::get('/', function () {
    return view('welcome');
});

// Dashboard (apenas para usuários autenticados)
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// Rotas para o perfil do usuário autenticado
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
