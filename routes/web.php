<?php
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ChamadoController;
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
    Route::get('/chamados/create', [ChamadoController::class, 'create'])->name('pages.ChamadoCreate');
    Route::get('/chamados/rascunhos', [ChamadoController::class, 'rascunhos'])->name('chamados.rascunhos');
    Route::post('/chamados/{chamado}/atribuir', [ChamadoController::class, 'atribuir'])->name('chamados.atribuir');
    Route::delete('/anexos/{anexo}', [ChamadoController::class, 'removerAnexo'])->name('anexos.remover');
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
