@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <!-- Cabeçalho da página -->
    <div class="flex justify-between items-center mb-8">
        <h1 class="text-2xl font-bold text-white">Todos os Chamados</h1>
        <div class="flex space-x-4">
            <button class="px-4 py-2 bg-blue-600 hover:bg-blue-500 text-white rounded-md flex items-center transition-all">
                <a href="{{ route('chamados.create') }}"><i class="fas fa-plus mr-2"></i> Novo Chamado</a>
            </button>
        </div>
    </div>

    @if (session('success'))
        <div class="bg-green-500 text-white p-4 rounded-md mb-6">
            {{ session('success') }}
        </div>
    @endif

    <!-- Filtros e pesquisa -->
    <div class="bg-gray-800 border border-gray-700 p-4 rounded-lg mb-6">
        <form action="{{ route('chamados.index') }}" method="GET" class="grid grid-cols-1 md:grid-cols-4 gap-4">
            <div>
                <label for="search" class="block text-sm font-medium text-gray-300 mb-1">Pesquisar</label>
                <input type="text" id="search" name="search" placeholder="Buscar chamados..." 
                    class="px-4 py-2 rounded-md bg-gray-700 border border-gray-600 text-white focus:outline-none focus:border-blue-500 w-full"
                    value="{{ request('search') }}">
            </div>
            <div>
                <label for="status" class="block text-sm font-medium text-gray-300 mb-1">Status</label>
                <select id="status" name="status" 
                    class="px-4 py-2 rounded-md bg-gray-700 border border-gray-600 text-white focus:outline-none focus:border-blue-500 w-full">
                    <option value="">Todos</option>
                    <option value="aberto" {{ request('status') == 'aberto' ? 'selected' : '' }}>Aberto</option>
                    <option value="em_andamento" {{ request('status') == 'em_andamento' ? 'selected' : '' }}>Em Andamento</option>
                    <option value="resolvido" {{ request('status') == 'resolvido' ? 'selected' : '' }}>Resolvido</option>
                    <option value="fechado" {{ request('status') == 'fechado' ? 'selected' : '' }}>Fechado</option>
                </select>
            </div>
            <div>
                <label for="prioridade" class="block text-sm font-medium text-gray-300 mb-1">Prioridade</label>
                <select id="prioridade" name="prioridade" 
                    class="px-4 py-2 rounded-md bg-gray-700 border border-gray-600 text-white focus:outline-none focus:border-blue-500 w-full">
                    <option value="">Todas</option>
                    <option value="baixa" {{ request('prioridade') == 'baixa' ? 'selected' : '' }}>Baixa</option>
                    <option value="media" {{ request('prioridade') == 'media' ? 'selected' : '' }}>Média</option>
                    <option value="alta" {{ request('prioridade') == 'alta' ? 'selected' : '' }}>Alta</option>
                    <option value="critica" {{ request('prioridade') == 'critica' ? 'selected' : '' }}>Crítica</option>
                </select>
            </div>
            <div class="flex items-end">
                <button type="submit" class="px-4 py-2 bg-blue-600 hover:bg-blue-500 text-white rounded-md flex items-center transition-all">
                    <i class="fas fa-search mr-2"></i> Filtrar
                </button>
            </div>
        </form>
    </div>

    <!-- Tabela de chamados -->
    <div class="bg-gray-800 border border-gray-700 rounded-lg dashboard-card">
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-700">
                <thead class="bg-gray-700">
                    <tr>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">ID</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">Título</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">Status</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">Prioridade</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">Categoria</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">Solicitante</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">Responsável</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">Data</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">Ações</th>
                    </tr>
                </thead>
                <tbody class="bg-gray-800 divide-y divide-gray-700">
                    @forelse ($chamados as $chamado)
                        <tr class="hover:bg-gray-700 transition-colors">
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-300">
                                #{{ $chamado->id }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-white">
                                {{ $chamado->titulo }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm">
                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full 
                                    @if($chamado->status == 'aberto') bg-blue-100 text-blue-800
                                    @elseif($chamado->status == 'em_andamento')
                                    @elseif($chamado->status == 'resolvido')
                                    @else
                                    @endif">
                                    {{ ucfirst(str_replace('_', ' ', $chamado->status)) }}
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm">
                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full 
                                    @if($chamado->prioridade == 'baixa') bg-green-100 text-green-800
                                    @elseif($chamado->prioridade == 'media')
                                    @elseif($chamado->prioridade == 'alta')
                                    @else
                                    @endif">
                                    {{ ucfirst($chamado->prioridade) }}
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-300">
                                {{ ucfirst(str_replace('_', ' ', $chamado->categoria)) }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-300">
                                {{ $chamado->usuario->name ?? 'N/A' }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-300">
                                {{ $chamado->atendente->name ?? 'Não atribuído' }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-300">
                                {{ $chamado->created_at->format('d/m/Y H:i') }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                <div class="flex space-x-2">
                                    <a href="{{ route('chamados.show', $chamado) }}" class="text-blue-400 hover:text-blue-300">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    <a href="{{ route('chamados.edit', $chamado) }}" class="text-yellow-400 hover:text-yellow-300">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <form action="{{ route('chamados.destroy', $chamado) }}" method="POST" class="inline" onsubmit="return confirm('Tem certeza que deseja excluir este chamado?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-400 hover:text-red-300">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="9" class="px-6 py-4 text-center text-gray-300">
                                Nenhum chamado encontrado.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="px-6 py-4">
            {{ $chamados->links() }}
        </div>
    </div>
</div>
@endsection