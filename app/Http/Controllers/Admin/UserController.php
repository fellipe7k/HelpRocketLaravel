<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class UserController extends Controller
{
    // Exibir a lista de usuários
    public function index()
    {
        // Paginação para exibir 20 usuários por vez
        $usuarios = User::paginate(20);
        
        return view('users.create', compact('usuarios'));
    }

    // Exibir o formulário de criação de usuário
    public function create()
    {
        return view('users.create');
    }

    // Criar um novo usuário
    public function store(StoreUserRequest $request)
    {
        // Criação do usuário com dados validados
        User::create($request->validated());

        // Redirecionamento com mensagem de sucesso
        return redirect()
            ->route('users.index')
            ->with('success', 'Usuário criado com sucesso!');
    }

    // Exibir o formulário para editar um usuário
    public function edit(string $id)
    {
        if (!$usuario = User::find($id)) {
            return redirect()->route('users.index')->with('message', 'Usuário não encontrado!');
        }

        return view('pages.usuarios_edit', compact('usuario'));
    }

    // Atualizar os dados de um usuário
    public function update(UpdateUserRequest $request, string $id)
    {
        if (!$usuario = User::find($id)) {
            return back()->with('message', 'Usuário não encontrado!');
        }

        $data = $request->only('name', 'email');
        
        // Se a senha for fornecida, atualizar a senha
        if ($request->password) {
            $data['password'] = bcrypt($request->password);
        }

        $usuario->update($data);

        // Redirecionamento com mensagem de sucesso
        return redirect()
            ->route('users.index')
            ->with('success', 'Usuário atualizado com sucesso!');
    }

    // Exibir as informações de um usuário específico
    public function show(string $id)
    {
        if (!$usuario = User::find($id)) {
            return back()->with('message', 'Usuário não encontrado!');
        }

        return view('pages.usuarios_show', compact('usuario'));
    }

    // Deletar um usuário
    public function destroy(string $id)
    {
        if (!$usuario = User::find($id)) {
            return back()->with('message', 'Usuário não encontrado!');
        }

        // Impedir que o próprio usuário se exclua
        if (Auth::user()->id === $usuario->id) {
            return back()->with('message', 'Você não pode deletar seu próprio usuário!');
        }

        // Deletar o usuário
        $usuario->delete();

        return redirect()
            ->route('users.index')
            ->with('success', 'Usuário deletado com sucesso!');
    }
}