<?php

namespace App\Http\Controllers;

use App\Models\Ativo;
use Illuminate\Http\Request;

class AtivoController extends Controller
{
    public function index()
    {
        $ativos = Ativo::all();
        return view('ativos.index', compact('ativos'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nome' => 'required|string|max:255',
            'categoria' => 'required|string|max:255',
            'marca' => 'nullable|string|max:255',
            'modelo' => 'nullable|string|max:255',
            'numero_serie' => 'nullable|string|max:255',
            'descricao' => 'nullable|string',
            'quantidade' => 'required|integer|min:1',
        ]);

        Ativo::create($request->all());

        return redirect()->route('ativos.index')->with('success', 'Ativo criado com sucesso.');
    }

    public function edit(Ativo $ativo)
    {
        return view('ativos.edit', compact('ativo'));
    }

    public function update(Request $request, Ativo $ativo)
    {
        $request->validate([
            'nome' => 'required|string|max:255',
            'categoria' => 'required|string|max:255',
            'marca' => 'nullable|string|max:255',
            'modelo' => 'nullable|string|max:255',
            'numero_serie' => 'nullable|string|max:255',
            'descricao' => 'nullable|string',
            'quantidade' => 'required|integer|min:1',
        ]);

        $ativo->update($request->all());

        return redirect()->route('ativos.index')->with('success', 'Ativo atualizado com sucesso.');
    }

    public function destroy(Ativo $ativo)
    {
        $ativo->delete();

        return redirect()->route('ativos.index')->with('success', 'Ativo deletado com sucesso.');
    }
}