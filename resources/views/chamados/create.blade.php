<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Criar Chamado - HelpRocket</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/tailwindcss/2.2.19/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <!-- Quill editor CSS -->
    <link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">
    <style>
        /* Animações e transições */
        .transition-all {
            transition: all 0.3s ease;
        }
        
        /* Cards com efeito hover */
        .dashboard-card {
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }
        
        .dashboard-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 25px -5px rgba(59, 130, 246, 0.1), 0 10px 10px -5px rgba(59, 130, 246, 0.04);
        }

        /* Dropdown */
        .dropdown-menu {
            display: none;
            position: absolute;
            right: 0;
            top: 100%;
            background-color: #1f2937;
            border-radius: 0.375rem;
            border: 1px solid #374151;
            box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05);
            width: 12rem;
            z-index: 10;
        }

        .dropdown-menu.show {
            display: block;
        }

        .dropdown-item {
            display: block;
            padding: 0.5rem 1rem;
            color: #d1d5db;
            font-size: 0.875rem;
            transition: all 0.15s ease;
        }

        .dropdown-item:hover {
            background-color: #374151;
            color: #60a5fa;
        }

        .dropdown-divider {
            height: 1px;
            background-color: #374151;
            margin: 0.25rem 0;
        }

        /* Personalizações para o editor Quill */
        .ql-toolbar.ql-snow {
            border: 1px solid #4b5563;
            background-color: #374151;
            border-top-left-radius: 0.375rem;
            border-top-right-radius: 0.375rem;
        }

        .ql-container.ql-snow {
            border: 1px solid #4b5563;
            border-top: none;
            border-bottom-left-radius: 0.375rem;
            border-bottom-right-radius: 0.375rem;
            background-color: #1f2937;
            color: #e5e7eb;
            min-height: 200px;
        }

        .ql-editor {
            min-height: 200px;
        }

        .ql-editor.ql-blank::before {
            color: #9ca3af;
        }

        .ql-snow .ql-stroke {
            stroke: #d1d5db;
        }

        .ql-snow .ql-fill, .ql-snow .ql-stroke.ql-fill {
            fill: #d1d5db;
        }

        .ql-snow.ql-toolbar button:hover, 
        .ql-snow .ql-toolbar button:hover,
        .ql-snow.ql-toolbar button:focus, 
        .ql-snow .ql-toolbar button:focus,
        .ql-snow.ql-toolbar button.ql-active, 
        .ql-snow .ql-toolbar button.ql-active {
            background-color: #4b5563;
        }

        .ql-snow.ql-toolbar button:hover .ql-stroke, 
        .ql-snow .ql-toolbar button:hover .ql-stroke,
        .ql-snow.ql-toolbar button:focus .ql-stroke, 
        .ql-snow .ql-toolbar button:focus .ql-stroke,
        .ql-snow.ql-toolbar button.ql-active .ql-stroke, 
        .ql-snow .ql-toolbar button.ql-active .ql-stroke {
            stroke: #60a5fa;
        }

        .ql-snow.ql-toolbar button:hover .ql-fill, 
        .ql-snow .ql-toolbar button:hover .ql-fill,
        .ql-snow.ql-toolbar button:focus .ql-fill, 
        .ql-snow .ql-toolbar button:focus .ql-fill,
        .ql-snow.ql-toolbar button.ql-active .ql-fill, 
        .ql-snow .ql-toolbar button.ql-active .ql-fill {
            fill: #60a5fa;
        }
        
        /* Upload de arquivos */
        .file-upload-label {
            display: flex;
            align-items: center;
            justify-content: center;
            border: 2px dashed #4b5563;
            border-radius: 0.375rem;
            padding: 1.5rem;
            cursor: pointer;
            transition: all 0.3s ease;
        }
        
        .file-upload-label:hover {
            border-color: #60a5fa;
            background-color: rgba(96, 165, 250, 0.05);
        }
        
        .file-preview {
            display: flex;
            flex-wrap: wrap;
            gap: 0.5rem;
            margin-top: 1rem;
        }
        
        .file-item {
            position: relative;
            background-color: #374151;
            padding: 0.5rem;
            border-radius: 0.375rem;
            display: flex;
            align-items: center;
            max-width: 250px;
        }
        
        .file-item-remove {
            position: absolute;
            top: -8px;
            right: -8px;
            background-color: #ef4444;
            color: white;
            border-radius: 50%;
            width: 20px;
            height: 20px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 10px;
            cursor: pointer;
        }
    </style>
</head>
<body class="font-sans antialiased bg-gray-900 text-gray-100">
    <!-- Navbar superior -->
    <nav class="bg-gray-800 shadow-lg border-b border-blue-500 sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16">
                <div class="flex">
                    <div class="flex-shrink-0 flex items-center">
                        <a href="/dashboard" class="flex items-center hover:opacity-90 transition-all">
                            <span class="text-blue-400 text-2xl font-bold">HelpRocket</span>
                            <i class="fas fa-rocket text-blue-400 ml-2"></i>
                        </a>
                    </div>
                    <!-- Links de navegação na navbar -->
                    <div class="hidden md:flex ml-10 items-center space-x-4">
                        <a href="/dashboard" class="text-gray-300 hover:text-white px-3 py-2 rounded-md text-sm font-medium">Dashboard</a>
                        <a href="{{ route('chamados.index') }}" class="text-white px-3 py-2 rounded-md text-sm font-medium">Chamados</a>
                        <a href="/estoque" class="text-gray-300 hover:text-white px-3 py-2 rounded-md text-sm font-medium">Estoque</a>
                        <a href="/usuarios" class="text-gray-300 hover:text-white px-3 py-2 rounded-md text-sm font-medium">Usuários</a>
                        <a href="/relatorios" class="text-gray-300 hover:text-white px-3 py-2 rounded-md text-sm font-medium">Relatórios</a>
                        <a href="/configuracoes" class="text-gray-300 hover:text-white px-3 py-2 rounded-md text-sm font-medium">Configurações</a>
                    </div>
                </div>
                <div class="flex items-center">
                    <!-- Notificações -->
                    <button class="p-2 rounded-md text-gray-400 hover:text-blue-400 focus:outline-none relative mr-3">
                        <i class="fas fa-bell"></i>
                        <span class="absolute top-0 right-0 inline-flex items-center justify-center px-2 py-1 text-xs font-bold leading-none text-white transform translate-x-1/2 -translate-y-1/2 bg-red-500 rounded-full">3</span>
                    </button>
                    
                    <!-- Menu do perfil com dropdown -->
                    <div class="ml-3 relative">
                        <div>
                            <button type="button" class="flex text-sm rounded-full focus:outline-none" id="user-menu-button">
                                <div class="h-8 w-8 rounded-full bg-blue-600 flex items-center justify-center text-white">
                                    {{ Auth::user()->name[0] ?? 'U' }}
                                </div>
                            </button>
                        </div>
                        <!-- Dropdown Menu -->
                        <div class="dropdown-menu" id="user-dropdown">
                            <div class="px-4 py-3">
                                <div class="text-sm font-medium text-white">{{ Auth::user()->name }}</div>
                            </div>
                            <div class="dropdown-divider"></div>
                            <a href="{{ route('profile.edit') }}" class="dropdown-item">
                                {{ __('Profile') }}
                            </a>
                            <div class="dropdown-divider"></div>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <a href="{{ route('logout') }}" onclick="event.preventDefault(); this.closest('form').submit();" class="dropdown-item">
                                    {{ __('Log Out') }}
                                </a>
                            </form>
                        </div>
                    </div>
                    
                    <!-- Botão mobile -->
                    <div class="flex md:hidden ml-3">
                        <button type="button" class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-white hover:bg-gray-700 focus:outline-none" aria-controls="mobile-menu" aria-expanded="false" id="mobile-menu-button">
                            <span class="sr-only">Abrir menu principal</span>
                            <i class="fas fa-bars"></i>
                        </button>
                    </div>
                </div>
            </div>
            
            <!-- Menu mobile -->
            <div class="md:hidden hidden" id="mobile-menu">
                <div class="px-2 pt-2 pb-3 space-y-1 sm:px-3">
                    <a href="/dashboard" class="text-gray-300 hover:text-white block px-3 py-2 rounded-md text-base font-medium">Dashboard</a>
                    <a href="{{ route('chamados.index') }}" class="text-white block px-3 py-2 rounded-md text-base font-medium">Chamados</a>
                    <a href="/estoque" class="text-gray-300 hover:text-white block px-3 py-2 rounded-md text-base font-medium">Estoque</a>
                    <a href="/usuarios" class="text-gray-300 hover:text-white block px-3 py-2 rounded-md text-base font-medium">Usuários</a>
                    <a href="/relatorios" class="text-gray-300 hover:text-white block px-3 py-2 rounded-md text-base font-medium">Relatórios</a>
                    <a href="/configuracoes" class="text-gray-300 hover:text-white block px-3 py-2 rounded-md text-base font-medium">Configurações</a>
                </div>
            </div>
        </div>
    </nav>

    <!-- Conteúdo principal -->
    <div class="container mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <!-- Cabeçalho da página -->
        <div class="flex justify-between items-center mb-8">
            <h1 class="text-2xl font-bold text-white">Criar Novo Chamado</h1>
            <div class="flex space-x-4">
                <a href="/chamados" class="px-4 py-2 bg-gray-700 hover:bg-gray-600 text-white rounded-md flex items-center transition-all">
                    <i class="fas fa-arrow-left mr-2"></i> Voltar para Lista
                </a>
            </div>
        </div>

        <!-- Formulário de criação de chamado -->
        <div class="bg-gray-800 border border-gray-700 p-6 rounded-lg dashboard-card">
            <form action="/chamados" method="POST" enctype="multipart/form-data" id="ticketForm">
                @csrf
                
                <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                    <!-- Coluna 1 - Informações Principais -->
                    <div class="lg:col-span-2 space-y-6">
                        <!-- Título do chamado -->
                        <div>
                            <label for="titulo" class="block text-sm font-medium text-gray-300 mb-1">Título do Chamado</label>
                            <input type="text" id="titulo" name="titulo" placeholder="Digite um título descritivo para o chamado" 
                                class="px-4 py-2 rounded-md bg-gray-700 border border-gray-600 text-white focus:outline-none focus:border-blue-500 w-full">
                        </div>
                        
                        <!-- Descrição do chamado com editor rico -->
                        <div>
                            <label for="descricao" class="block text-sm font-medium text-gray-300 mb-1">Descrição Detalhada</label>
                            <div id="editor"></div>
                            <input type="hidden" name="descricao" id="descricao">
                        </div>
                        
                        <!-- Upload de arquivos -->
                        <div>
                            <label class="block text-sm font-medium text-gray-300 mb-1">Anexos</label>
                            <label for="arquivos" class="file-upload-label">
                                <div class="text-center">
                                    <i class="fas fa-cloud-upload-alt text-3xl text-gray-400 mb-2"></i>
                                    <p class="text-gray-300">Arraste e solte arquivos aqui ou clique para selecionar</p>
                                    <p class="text-gray-400 text-sm mt-1">Tamanho máximo: 10MB (PNG, JPG, PDF, DOC, XLSX)</p>
                                </div>
                                <input type="file" id="arquivos" name="arquivos[]" class="hidden" multiple>
                            </label>
                            <div class="file-preview" id="filePreview"></div>
                        </div>
                    </div>
                    
                    <!-- Coluna 2 - Detalhes do Chamado -->
                    <div class="space-y-6">
                        <!-- Prioridade do chamado -->
                        <div>
                            <label for="prioridade" class="block text-sm font-medium text-gray-300 mb-1">Prioridade</label>
                            <select id="prioridade" name="prioridade" 
                                class="px-4 py-2 rounded-md bg-gray-700 border border-gray-600 text-white focus:outline-none focus:border-blue-500 w-full">
                                <option value="baixa">Baixa</option>
                                <option value="media" selected>Média</option>
                                <option value="alta">Alta</option>
                                <option value="critica">Crítica</option>
                            </select>
                        </div>
                        
                        <!-- Categoria do chamado -->
                        <div>
                            <label for="categoria" class="block text-sm font-medium text-gray-300 mb-1">Categoria</label>
                            <select id="categoria" name="categoria" 
                                class="px-4 py-2 rounded-md bg-gray-700 border border-gray-600 text-white focus:outline-none focus:border-blue-500 w-full">
                                <option value="hardware">Problema de Hardware</option>
                                <option value="software">Problema de Software</option>
                                <option value="rede">Problema de Rede</option>
                                <option value="acesso">Problema de Acesso</option>
                                <option value="outros">Outros</option>
                            </select>
                        </div>
                        
                        <!-- Departamento -->
                        <div>
                            <label for="departamento" class="block text-sm font-medium text-gray-300 mb-1">Departamento</label>
                            <select id="departamento" name="departamento" 
                                class="px-4 py-2 rounded-md bg-gray-700 border border-gray-600 text-white focus:outline-none focus:border-blue-500 w-full">
                                <option value="ti">TI</option>
                                <option value="rh">Recursos Humanos</option>
                                <option value="financeiro">Financeiro</option>
                                <option value="marketing">Marketing</option>
                                <option value="vendas">Vendas</option>
                                <option value="operacoes">Operações</option>
                            </select>
                        </div>
                        
                        <!-- Localização -->
                        <div>
                            <label for="localizacao" class="block text-sm font-medium text-gray-300 mb-1">Localização</label>
                            <select id="localizacao" name="localizacao" 
                                class="px-4 py-2 rounded-md bg-gray-700 border border-gray-600 text-white focus:outline-none focus:border-blue-500 w-full">
                                <option value="sede">Sede Principal</option>
                                <option value="filial_a">Filial A</option>
                                <option value="filial_b">Filial B</option>
                                <option value="remoto">Trabalho Remoto</option>
                            </select>
                        </div>
                        
                        <!-- Responsável pelo atendimento -->
                        <div>
                            <label for="responsavel" class="block text-sm font-medium text-gray-300 mb-1">Atribuir para</label>
                            <select id="responsavel" name="responsavel" 
                                class="px-4 py-2 rounded-md bg-gray-700 border border-gray-600 text-white focus:outline-none focus:border-blue-500 w-full">
                                <option value="">Automático</option>
                                <option value="1">Ana Silva</option>
                                <option value="2">Carlos Santos</option>
                                <option value="3">Mariana Costa</option>
                                <option value="4">Roberto Alves</option>
                                <option value="5">Juliana Lima</option>
                            </select>
                        </div>
                        
                        <!-- Data limite (opcional) -->
                        <div>
                            <label for="data_limite" class="block text-sm font-medium text-gray-300 mb-1">
                                Data Limite (opcional)
                            </label>
                            <input type="date" id="data_limite" name="data_limite" 
                                class="px-4 py-2 rounded-md bg-gray-700 border border-gray-600 text-white focus:outline-none focus:border-blue-500 w-full">
                        </div>
                        
                        <!-- Notificar -->
                        <div class="mt-4">
                            <label class="flex items-center">
                                <input type="checkbox" name="notificar_email" class="rounded bg-gray-700 border-gray-600 text-blue-500 focus:ring-blue-500 focus:ring-offset-gray-800">
                                <span class="ml-2 text-gray-300">Receber notificações por e-mail</span>
                            </label>
                        </div>
                        
                        <!-- Botões de ação -->
                        <div class="pt-6 border-t border-gray-700 flex flex-col space-y-3">
                            <button type="submit" class="px-4 py-3 bg-blue-600 hover:bg-blue-500 text-white rounded-md flex items-center justify-center transition-all">
                                <i class="fas fa-paper-plane mr-2"></i> Criar Chamado
                            </button>
                            <button type="button" id="btnSaveAsDraft" class="px-4 py-2 bg-gray-700 hover:bg-gray-600 text-gray-300 rounded-md flex items-center justify-center transition-all">
                                <i class="fas fa-save mr-2"></i> Salvar como Rascunho
                            </button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- Font Awesome -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/js/all.min.js"></script>
    
    <!-- Quill Editor JS -->
    <script src="https://cdn.quilljs.com/1.3.6/quill.min.js"></script>
    
    <!-- Script principal -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Inicialização do Editor Quill
            var quill = new Quill('#editor', {
                theme: 'snow',
                modules: {
                    toolbar: [
                        ['bold', 'italic', 'underline', 'strike'],
                        [{ 'list': 'ordered'}, { 'list': 'bullet' }],
                        [{ 'header': [1, 2, 3, 4, 5, 6, false] }],
                        ['link', 'image', 'code-block'],
                        [{ 'color': [] }, { 'background': [] }],
                        [{ 'align': [] }]
                    ]
                },
                placeholder: 'Descreva detalhadamente o problema ou solicitação...'
            });
            
            // Atualizar campo hidden com HTML do editor ao enviar o formulário
            const form = document.getElementById('ticketForm');
            form.addEventListener('submit', function() {
                document.getElementById('descricao').value = quill.root.innerHTML;
            });
            
            // Gerenciamento de upload de arquivos
            const fileInput = document.getElementById('arquivos');
            const filePreview = document.getElementById('filePreview');
            
            fileInput.addEventListener('change', function(e) {
                filePreview.innerHTML = '';
                const files = e.target.files;
                
                for (let i = 0; i < files.length; i++) {
                    const file = files[i];
                    const fileSize = (file.size / 1024 / 1024).toFixed(2); // em MB
                    
                    const fileItem = document.createElement('div');
                    fileItem.className = 'file-item';
                    
                    // Ícone baseado no tipo de arquivo
                    let fileIcon = 'fa-file';
                    if (file.type.includes('image')) fileIcon = 'fa-file-image';
                    else if (file.type.includes('pdf')) fileIcon = 'fa-file-pdf';
                    else if (file.type.includes('word') || file.name.endsWith('.doc') || file.name.endsWith('.docx')) 
                        fileIcon = 'fa-file-word';
                    else if (file.type.includes('excel') || file.name.endsWith('.xls') || file.name.endsWith('.xlsx')) 
                        fileIcon = 'fa-file-excel';
                    
                    fileItem.innerHTML = `
                        <i class="fas ${fileIcon} text-blue-400 mr-2"></i>
                        <div class="overflow-hidden">
                            <p class="text-sm text-gray-300 truncate" title="${file.name}">${file.name}</p>
                            <p class="text-xs text-gray-400">${fileSize} MB</p>
                        </div>
                        <div class="file-item-remove" onclick="removeFile(this, ${i})">
                            <i class="fas fa-times"></i>
                        </div>
                    `;
                    
                    filePreview.appendChild(fileItem);
                }
            });
            
            // Botão Salvar como Rascunho
            document.getElementById('btnSaveAsDraft').addEventListener('click', function() {
                // Adicionar campo hidden para indicar rascunho
                const draftInput = document.createElement('input');
                draftInput.type = 'hidden';
                draftInput.name = 'is_draft';
                draftInput.value = '1';
                form.appendChild(draftInput);
                
                // Atualizar campo hidden com HTML do editor
                document.getElementById('descricao').value = quill.root.innerHTML;
                
                // Enviar formulário
                form.submit();
            });
            
            // Dropdown do perfil de usuário
            const userMenuButton = document.getElementById('user-menu-button');
            const userDropdown = document.getElementById('user-dropdown');
            
            userMenuButton.addEventListener('click', function() {
                userDropdown.classList.toggle('show');
            });
            
            // Menu mobile
            const mobileMenuButton = document.getElementById('mobile-menu-button');
            const mobileMenu = document.getElementById('mobile-menu');
            
            mobileMenuButton.addEventListener('click', function() {
                mobileMenu.classList.toggle('hidden');
            });
            
            // Fechar dropdowns ao clicar fora deles
            document.addEventListener('click', function(event) {
                if (!userMenuButton.contains(event.target) && !userDropdown.contains(event.target)) {
                    userDropdown.classList.remove('show');
                }
                
                if (!mobileMenuButton.contains(event.target) && !mobileMenu.contains(event.target) && !mobileMenu.classList.contains('hidden')) {
                    mobileMenu.classList.add('hidden');
                }
            });
        });
        
        // Função para remover arquivo da lista
        function removeFile(element, index) {
            // Remove o elemento visual
            element.parentElement.remove();
            
            // Esta parte é um pouco mais complexa no ambiente real,
            // pois o objeto FileList não pode ser modificado diretamente.
            // Em um ambiente de produção, seria necessário criar um novo input
            // ou usar uma biblioteca como FilePond/DropzoneJS para melhor gerenciamento
            console.log("Arquivo removido do índice:", index);
        }
    </script>
</body>
</html>