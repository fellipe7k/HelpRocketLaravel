@extends('layouts.app')

@section('content')
<div class="container mx-auto py-8">
    <h1 class="text-2xl font-bold text-white mb-4">Gerenciar Ativos</h1>

    <!-- Success Message with Auto-Close -->
    @if(session('success'))
        <div id="success-message" class="bg-green-500 text-white p-3 rounded-md mb-4 flex items-center justify-between">
            <span>{{ session('success') }}</span>
            <button type="button" class="text-white" onclick="this.parentElement.remove()">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd" />
                </svg>
            </button>
        </div>
    @endif

    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        <!-- Asset Creation Form -->
        <div class="md:col-span-1 bg-gray-800 p-4 rounded-md">
            <h2 class="text-xl font-bold text-white mb-4">Adicionar Novo Ativo</h2>
            <form action="{{ route('ativos.store') }}" method="POST">
                @csrf
                <div class="space-y-4">
                    <!-- Name -->
                    <div>
                        <label for="nome" class="text-sm font-medium text-gray-300 block mb-1">Nome <span class="text-red-500">*</span></label>
                        <input type="text" id="nome" name="nome" class="px-4 py-2 rounded-md bg-gray-700 text-white w-full" value="{{ old('nome') }}" required>
                        @error('nome')
                            <div class="text-red-500 text-xs mt-1">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Category -->
                    <div>
                        <label for="categoria" class="text-sm font-medium text-gray-300 block mb-1">Categoria <span class="text-red-500">*</span></label>
                        <input type="text" id="categoria" name="categoria" class="px-4 py-2 rounded-md bg-gray-700 text-white w-full" value="{{ old('categoria') }}" required>
                        @error('categoria')
                            <div class="text-red-500 text-xs mt-1">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <!-- Brand -->
                    <div>
                        <label for="marca" class="text-sm font-medium text-gray-300 block mb-1">Marca</label>
                        <input type="text" id="marca" name="marca" class="px-4 py-2 rounded-md bg-gray-700 text-white w-full" value="{{ old('marca') }}">
                        @error('marca')
                            <div class="text-red-500 text-xs mt-1">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <!-- Model -->
                    <div>
                        <label for="modelo" class="text-sm font-medium text-gray-300 block mb-1">Modelo</label>
                        <input type="text" id="modelo" name="modelo" class="px-4 py-2 rounded-md bg-gray-700 text-white w-full" value="{{ old('modelo') }}">
                        @error('modelo')
                            <div class="text-red-500 text-xs mt-1">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <!-- Serial Number -->
                    <div>
                        <label for="numero_serie" class="text-sm font-medium text-gray-300 block mb-1">Número de Série</label>
                        <input type="text" id="numero_serie" name="numero_serie" class="px-4 py-2 rounded-md bg-gray-700 text-white w-full" value="{{ old('numero_serie') }}">
                        @error('numero_serie')
                            <div class="text-red-500 text-xs mt-1">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <!-- Description -->
                    <div>
                        <label for="descricao" class="text-sm font-medium text-gray-300 block mb-1">Descrição</label>
                        <textarea id="descricao" name="descricao" rows="3" class="px-4 py-2 rounded-md bg-gray-700 text-white w-full">{{ old('descricao') }}</textarea>
                        @error('descricao')
                            <div class="text-red-500 text-xs mt-1">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Quantity -->
                    <div>
                        <label for="quantidade" class="text-sm font-medium text-gray-300 block mb-1">Quantidade <span class="text-red-500">*</span></label>
                        <input type="number" id="quantidade" name="quantidade" class="px-4 py-2 rounded-md bg-gray-700 text-white w-full" value="{{ old('quantidade', 1) }}" required min="1">
                        @error('quantidade')
                            <div class="text-red-500 text-xs mt-1">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Submit Button -->
                    <div class="pt-2">
                        <button type="submit" class="w-full px-4 py-2 bg-blue-500 hover:bg-blue-700 text-white rounded-md flex items-center justify-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                            </svg>
                            Adicionar Ativo
                        </button>
                    </div>
                </div>
            </form>
        </div>

        <!-- Assets Table -->
        <div class="md:col-span-2">
            <div class="bg-gray-800 p-4 rounded-md">
                <h2 class="text-xl font-bold text-white mb-4">Ativos Cadastrados</h2>
                <div class="overflow-x-auto">
                    <table class="min-w-full">
                        <thead>
                            <tr class="border-b border-gray-700">
                                <th class="px-4 py-2 text-left text-gray-300">Nome</th>
                                <th class="px-4 py-2 text-left text-gray-300">Categoria</th>
                                <th class="px-4 py-2 text-left text-gray-300">Marca/Modelo</th>
                                <th class="px-4 py-2 text-left text-gray-300">Qtd</th>
                                <th class="px-4 py-2 text-left text-gray-300">Ações</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($ativos as $ativo)
                            <tr class="border-b border-gray-700">
                                <td class="px-4 py-2 text-gray-300">{{ $ativo->nome }}</td>
                                <td class="px-4 py-2 text-gray-300">{{ $ativo->categoria }}</td>
                                <td class="px-4 py-2 text-gray-300">
                                    @if($ativo->marca || $ativo->modelo)
                                        {{ $ativo->marca }} {{ $ativo->modelo }}
                                    @else
                                        <span class="text-gray-500">Não informado</span>
                                    @endif
                                </td>
                                <td class="px-4 py-2 text-gray-300">{{ $ativo->quantidade }}</td>
                                <td class="px-4 py-2 text-gray-300">
                                    <div class="flex space-x-3">
                                        <button type="button" 
                                            data-id="{{ $ativo->id }}" 
                                            data-nome="{{ $ativo->nome }}" 
                                            data-categoria="{{ $ativo->categoria }}" 
                                            data-marca="{{ $ativo->marca ?? 'Não informado' }}" 
                                            data-modelo="{{ $ativo->modelo ?? 'Não informado' }}" 
                                            data-serie="{{ $ativo->numero_serie ?? 'Não informado' }}" 
                                            data-descricao="{{ $ativo->descricao ?? 'Nenhuma descrição disponível' }}" 
                                            data-quantidade="{{ $ativo->quantidade }}"
                                            class="view-btn flex items-center text-blue-500 hover:underline">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                            </svg>
                                            <span>Ver</span>
                                        </button>
                                        <a href="{{ route('ativos.edit', $ativo->id) }}" class="flex items-center text-yellow-500 hover:underline">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                            </svg>
                                            <span>Editar</span>
                                        </a>
                                        <button type="button" 
                                            data-id="{{ $ativo->id }}" 
                                            data-nome="{{ $ativo->nome }}" 
                                            class="delete-btn flex items-center text-red-500 hover:underline">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                            </svg>
                                            <span>Excluir</span>
                                        </button>
                                        <form id="form-delete-{{ $ativo->id }}" action="{{ route('ativos.destroy', $ativo->id) }}" method="POST" class="hidden">
                                            @csrf
                                            @method('DELETE')
                                        </form>
                                    </div>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="5" class="px-4 py-6 text-center text-gray-400">Nenhum ativo cadastrado</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Edit Asset Form (shown only on edit route) -->
    @if(Route::currentRouteName() == 'ativos.edit')
    <div class="mt-8 bg-gray-800 p-4 rounded-md">
        <h2 class="text-xl font-bold text-white mb-4">Editar Ativo</h2>
        <form action="{{ route('ativos.update', $ativo->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                <!-- Name -->
                <div>
                    <label for="edit_nome" class="text-sm font-medium text-gray-300 block mb-1">Nome <span class="text-red-500">*</span></label>
                    <input type="text" id="edit_nome" name="nome" class="px-4 py-2 rounded-md bg-gray-700 text-white w-full" value="{{ old('nome', $ativo->nome) }}" required>
                    @error('nome')
                        <div class="text-red-500 text-xs mt-1">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Category -->
                <div>
                    <label for="edit_categoria" class="text-sm font-medium text-gray-300 block mb-1">Categoria <span class="text-red-500">*</span></label>
                    <input type="text" id="edit_categoria" name="categoria" class="px-4 py-2 rounded-md bg-gray-700 text-white w-full" value="{{ old('categoria', $ativo->categoria) }}" required>
                    @error('categoria')
                        <div class="text-red-500 text-xs mt-1">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Quantity -->
                <div>
                    <label for="edit_quantidade" class="text-sm font-medium text-gray-300 block mb-1">Quantidade <span class="text-red-500">*</span></label>
                    <input type="number" id="edit_quantidade" name="quantidade" class="px-4 py-2 rounded-md bg-gray-700 text-white w-full" value="{{ old('quantidade', $ativo->quantidade) }}" required min="1">
                    @error('quantidade')
                        <div class="text-red-500 text-xs mt-1">{{ $message }}</div>
                    @enderror
                </div>
                
                <!-- Brand -->
                <div>
                    <label for="edit_marca" class="text-sm font-medium text-gray-300 block mb-1">Marca</label>
                    <input type="text" id="edit_marca" name="marca" class="px-4 py-2 rounded-md bg-gray-700 text-white w-full" value="{{ old('marca', $ativo->marca ?? '') }}">
                    @error('marca')
                        <div class="text-red-500 text-xs mt-1">{{ $message }}</div>
                    @enderror
                </div>
                
                <!-- Model -->
                <div>
                    <label for="edit_modelo" class="text-sm font-medium text-gray-300 block mb-1">Modelo</label>
                    <input type="text" id="edit_modelo" name="modelo" class="px-4 py-2 rounded-md bg-gray-700 text-white w-full" value="{{ old('modelo', $ativo->modelo ?? '') }}">
                    @error('modelo')
                        <div class="text-red-500 text-xs mt-1">{{ $message }}</div>
                    @enderror
                </div>
                
                <!-- Serial Number -->
                <div>
                    <label for="edit_numero_serie" class="text-sm font-medium text-gray-300 block mb-1">Número de Série</label>
                    <input type="text" id="edit_numero_serie" name="numero_serie" class="px-4 py-2 rounded-md bg-gray-700 text-white w-full" value="{{ old('numero_serie', $ativo->numero_serie ?? '') }}">
                    @error('numero_serie')
                        <div class="text-red-500 text-xs mt-1">{{ $message }}</div>
                    @enderror
                </div>
                
                <!-- Description -->
                <div class="md:col-span-3">
                    <label for="edit_descricao" class="text-sm font-medium text-gray-300 block mb-1">Descrição</label>
                    <textarea id="edit_descricao" name="descricao" rows="3" class="px-4 py-2 rounded-md bg-gray-700 text-white w-full">{{ old('descricao', $ativo->descricao ?? '') }}</textarea>
                    @error('descricao')
                        <div class="text-red-500 text-xs mt-1">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Submit Buttons -->
                <div class="md:col-span-3">
                    <button type="submit" class="px-4 py-2 bg-yellow-500 hover:bg-yellow-600 text-white rounded-md flex items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                        </svg>
                        Atualizar Ativo
                    </button>
                    <a href="{{ route('ativos.index') }}" class="px-4 py-2 bg-gray-600 hover:bg-gray-700 text-white rounded-md ml-2 inline-flex items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                        Cancelar
                    </a>
                </div>
            </div>
        </form>
    </div>
    @endif
    
    <!-- Asset Details Modal -->
<div id="ativo-details-modal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 hidden overflow-y-auto p-4">
    <div class="bg-gray-800 p-6 rounded-lg w-full max-w-md mx-auto my-auto transform transition-all">
        <div class="flex justify-between items-center mb-4">
            <h3 class="text-xl font-bold text-white" id="ativo-details-title">Detalhes do Ativo</h3>
            <button type="button" class="modal-close text-gray-400 hover:text-white transition-colors">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>
        <div class="space-y-3">
            <div>
                <span class="text-gray-400 text-sm">Nome:</span>
                <p class="text-white" id="ativo-details-nome"></p>
            </div>
            <div>
                <span class="text-gray-400 text-sm">Categoria:</span>
                <p class="text-white" id="ativo-details-categoria"></p>
            </div>
            <div>
                <span class="text-gray-400 text-sm">Marca:</span>
                <p class="text-white" id="ativo-details-marca"></p>
            </div>
            <div>
                <span class="text-gray-400 text-sm">Modelo:</span>
                <p class="text-white" id="ativo-details-modelo"></p>
            </div>
            <div>
                <span class="text-gray-400 text-sm">Número de Série:</span>
                <p class="text-white" id="ativo-details-serie"></p>
            </div>
            <div>
                <span class="text-gray-400 text-sm">Quantidade:</span>
                <p class="text-white" id="ativo-details-quantidade"></p>
            </div>
            <div>
                <span class="text-gray-400 text-sm">Descrição:</span>
                <p class="text-white" id="ativo-details-descricao"></p>
            </div>
        </div>
        <div class="mt-6">
            <button type="button" class="modal-close w-full px-4 py-2 bg-blue-500 hover:bg-blue-600 text-white rounded-md transition-colors">
                Fechar
            </button>
        </div>
    </div>
</div>

    <!-- Delete Confirmation Modal -->
<div id="delete-confirmation-modal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 hidden overflow-y-auto p-4">
    <div class="bg-gray-800 p-6 rounded-lg w-full max-w-md mx-auto my-auto transform transition-all">
        <div class="flex justify-between items-center mb-4">
            <h3 class="text-xl font-bold text-white">Confirmar Exclusão</h3>
            <button type="button" class="modal-close text-gray-400 hover:text-white transition-colors">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>
        <p class="text-gray-300 mb-6">Tem certeza que deseja excluir o ativo <span id="delete-ativo-nome" class="font-bold"></span>?</p>
        <div class="flex flex-col sm:flex-row justify-between gap-3">
            <button type="button" class="modal-close px-4 py-2 bg-gray-600 hover:bg-gray-700 text-white rounded-md transition-colors order-2 sm:order-1">
                Cancelar
            </button>
            <button type="button" id="confirm-delete-btn" class="px-4 py-2 bg-red-500 hover:bg-red-600 text-white rounded-md transition-colors order-1 sm:order-2">
                Confirmar Exclusão
            </button>
        </div>
    </div>
</div>

    <!-- Scripts -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Auto-close success message
            if (document.getElementById('success-message')) {
                setTimeout(function() {
                    const message = document.getElementById('success-message');
                    if (message) {
                        message.remove();
                    }
                }, 4000);
            }
            
            // Modal management
            const modals = {
                details: {
                    element: document.getElementById('ativo-details-modal'),
                    currentId: null
                },
                delete: {
                    element: document.getElementById('delete-confirmation-modal'),
                    currentId: null
                }
            };
            
            // Close modal function
            function closeModal(modalType) {
                if (modals[modalType]) {
                    modals[modalType].element.classList.add('hidden');
                    modals[modalType].currentId = null;
                }
            }
            
            // Close all modals
            function closeAllModals() {
                Object.keys(modals).forEach(type => closeModal(type));
            }
            
            // Setup view asset buttons
            document.querySelectorAll('.view-btn').forEach(btn => {
                btn.addEventListener('click', function() {
                    const data = this.dataset;
                    document.getElementById('ativo-details-nome').textContent = data.nome;
                    document.getElementById('ativo-details-categoria').textContent = data.categoria;
                    document.getElementById('ativo-details-marca').textContent = data.marca;
                    document.getElementById('ativo-details-modelo').textContent = data.modelo;
                    document.getElementById('ativo-details-serie').textContent = data.serie;
                    document.getElementById('ativo-details-descricao').textContent = data.descricao;
                    document.getElementById('ativo-details-quantidade').textContent = data.quantidade;
                    
                    modals.details.currentId = data.id;
                    modals.details.element.classList.remove('hidden');
                });
            });
            
            // Setup delete buttons
            document.querySelectorAll('.delete-btn').forEach(btn => {
                btn.addEventListener('click', function() {
                    const data = this.dataset;
                    document.getElementById('delete-ativo-nome').textContent = data.nome;
                    
                    modals.delete.currentId = data.id;
                    modals.delete.element.classList.remove('hidden');
                });
            });
            
            // Confirm delete action
            document.getElementById('confirm-delete-btn').addEventListener('click', function() {
                if (modals.delete.currentId) {
                    document.getElementById('form-delete-' + modals.delete.currentId).submit();
                }
                closeModal('delete');
            });
            
            // Close modal buttons
            document.querySelectorAll('.modal-close').forEach(btn => {
                btn.addEventListener('click', closeAllModals);
            });
            
            // Close modal on outside click
            window.addEventListener('click', function(event) {
                Object.keys(modals).forEach(type => {
                    if (event.target === modals[type].element) {
                        closeModal(type);
                    }
                });
            });
            
            // Close modals with ESC key
            document.addEventListener('keydown', function(event) {
                if (event.key === 'Escape') {
                    closeAllModals();
                }
            });
        });
    </script>
</div>
@endsection