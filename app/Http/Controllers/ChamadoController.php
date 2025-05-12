<?php

namespace App\Http\Controllers;

use App\Models\Chamado;
use App\Models\ChamadoAnexo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

class ChamadoController extends Controller
{
    /**
     * Exibe uma lista de chamados.
     */
    public function index(): View
    {
        $chamados = Chamado::with(['usuario', 'atendente'])
            ->where('is_draft', false)
            ->latest()
            ->paginate(10);
        
        return view('chamados.index', compact('chamados'));
    }

    /**
     * Exibe o formulário para criar um novo chamado.
     */
    public function create(): View
    {
        return view('chamados.create');
    }

    /**
     * Armazena um novo chamado recém-criado.
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'titulo' => 'required|string|max:255',
            'descricao' => 'required|string',
            'prioridade' => 'required|in:baixa,media,alta,critica',
            'categoria' => 'required|in:hardware,software,rede,acesso,outros',
            'departamento' => 'required|in:ti,rh,financeiro,marketing,vendas,operacoes',
            'localizacao' => 'required|in:sede,filial_a,filial_b,remoto',
            'responsavel' => 'nullable|exists:users,id',
            'data_limite' => 'nullable|date',
            'arquivos.*' => 'nullable|file|max:10240', // 10MB máximo por arquivo
        ]);

        $isDraft = $request->has('is_draft');

        $chamado = Chamado::create([
            'titulo' => $request->titulo,
            'descricao' => $request->descricao,
            'prioridade' => $request->prioridade,
            'categoria' => $request->categoria,
            'departamento' => $request->departamento,
            'localizacao' => $request->localizacao,
            'status' => $isDraft ? 'aberto' : 'aberto',
            'usuario_id' => Auth::id(),
            'atendente_id' => $request->responsavel ?: null,
            'data_abertura' => now(),
            'data_limite' => $request->data_limite,
            'is_draft' => $isDraft,
            'notificar_email' => $request->has('notificar_email'),
        ]);

        // Processar anexos
        if ($request->hasFile('arquivos')) {
            foreach ($request->file('arquivos') as $arquivo) {
                $path = $arquivo->store('chamados/' . $chamado->id, 'public');
                
                ChamadoAnexo::create([
                    'chamado_id' => $chamado->id,
                    'nome_arquivo' => $arquivo->getClientOriginalName(),
                    'caminho_arquivo' => $path,
                    'tipo_arquivo' => $arquivo->getClientMimeType(),
                    'tamanho_arquivo' => $arquivo->getSize(),
                ]);
            }
        }

        if ($isDraft) {
            return redirect()->route('chamados.edit', $chamado)
                ->with('success', 'Chamado salvo como rascunho.');
        }

        return redirect()->route('chamados.index')
            ->with('success', 'Chamado criado com sucesso.');
    }

    /**
     * Exibe um chamado específico.
     */
    public function show(Chamado $chamado): View
    {
        $chamado->load(['usuario', 'atendente', 'anexos']);
        return view('chamados.show', compact('chamado'));
    }

    /**
     * Exibe o formulário para editar um chamado.
     */
    public function edit(Chamado $chamado): View
    {
        $chamado->load(['anexos']);
        return view('chamados.edit', compact('chamado'));
    }

    /**
     * Atualiza um chamado específico.
     */
    public function update(Request $request, Chamado $chamado): RedirectResponse
    {
        $request->validate([
            'titulo' => 'required|string|max:255',
            'descricao' => 'required|string',
            'status' => 'required|in:aberto,em_andamento,resolvido,fechado',
            'prioridade' => 'required|in:baixa,media,alta,critica',
            'categoria' => 'required|in:hardware,software,rede,acesso,outros',
            'departamento' => 'required|in:ti,rh,financeiro,marketing,vendas,operacoes',
            'localizacao' => 'required|in:sede,filial_a,filial_b,remoto',
            'responsavel' => 'nullable|exists:users,id',
            'data_limite' => 'nullable|date',
            'arquivos.*' => 'nullable|file|max:10240', // 10MB máximo por arquivo
        ]);

        $isDraft = $request->has('is_draft');
        if (!$isDraft && $chamado->is_draft) {
            $chamado->is_draft = false;
        }

        $chamado->update([
            'titulo' => $request->titulo,
            'descricao' => $request->descricao,
            'status' => $request->status,
            'prioridade' => $request->prioridade,
            'categoria' => $request->categoria,
            'departamento' => $request->departamento,
            'localizacao' => $request->localizacao,
            'atendente_id' => $request->responsavel ?: $chamado->atendente_id,
            'data_limite' => $request->data_limite,
            'notificar_email' => $request->has('notificar_email'),
        ]);

        // Se o status foi alterado para fechado, registre a data de fechamento
        if ($request->status === 'fechado' && $chamado->data_fechamento === null) {
            $chamado->update(['data_fechamento' => now()]);
        }

        // Processar anexos
        if ($request->hasFile('arquivos')) {
            foreach ($request->file('arquivos') as $arquivo) {
                $path = $arquivo->store('chamados/' . $chamado->id, 'public');
                
                ChamadoAnexo::create([
                    'chamado_id' => $chamado->id,
                    'nome_arquivo' => $arquivo->getClientOriginalName(),
                    'caminho_arquivo' => $path,
                    'tipo_arquivo' => $arquivo->getClientMimeType(),
                    'tamanho_arquivo' => $arquivo->getSize(),
                ]);
            }
        }

        return redirect()->route('chamados.show', $chamado)
            ->with('success', 'Chamado atualizado com sucesso.');
    }

    /**
     * Remove um chamado específico.
     */
    public function destroy(Chamado $chamado): RedirectResponse
    {
        // Excluir anexos do armazenamento
        foreach ($chamado->anexos as $anexo) {
            Storage::disk('public')->delete($anexo->caminho_arquivo);
        }
        
        $chamado->delete();

        return redirect()->route('pages.index')
            ->with('success', 'Chamado excluído com sucesso.');
    }
    
    /**
     * Atribui um atendente ao chamado.
     */
    public function atribuir(Request $request, Chamado $chamado): RedirectResponse
    {
        $request->validate([
            'atendente_id' => 'required|exists:users,id',
        ]);

        $chamado->update([
            'atendente_id' => $request->atendente_id,
            'status' => 'em_andamento',
        ]);

        return redirect()->route('chamados.show', $chamado)
            ->with('success', 'Chamado atribuído com sucesso.');
    }
    
    /**
     * Remove um anexo específico.
     */
    public function removerAnexo(ChamadoAnexo $anexo): RedirectResponse
    {
        $chamadoId = $anexo->chamado_id;
        
        // Excluir arquivo do armazenamento
        Storage::disk('public')->delete($anexo->caminho_arquivo);
        
        // Excluir registro do banco de dados
        $anexo->delete();
        
        return redirect()->route('chamados.edit', $chamadoId)
            ->with('success', 'Anexo removido com sucesso.');
    }
    
    /**
     * Visualiza rascunhos do usuário atual.
     */
    public function rascunhos(): View
    {
        $rascunhos = Chamado::with(['usuario', 'atendente'])
            ->where('usuario_id', Auth::id())
            ->where('is_draft', true)
            ->latest()
            ->paginate(10);
        
        return view('chamados.rascunhos', compact('rascunhos'));
    }
}