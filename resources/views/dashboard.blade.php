<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Dashboard - HelpRocket</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/tailwindcss/2.2.19/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
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
    </style>
</head>
<body class="font-sans antialiased bg-gray-900 text-gray-100">
    <!-- Navbar superior -->
    <nav class="bg-gray-800 shadow-lg border-b border-blue-500 sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16">
                <div class="flex">
                    <div class="flex-shrink-0 flex items-center">
                        <span class="text-blue-400 text-2xl font-bold">HelpRocket</span>
                        <i class="fas fa-rocket text-blue-400 ml-2"></i>
                    </div>
                    <!-- Links de navegação na navbar -->
                    <div class="hidden md:flex ml-10 items-center space-x-4">
                        <a href="#" class="text-white px-3 py-2 rounded-md text-sm font-medium">Dashboard</a>
                        <a href="#" class="text-gray-300 hover:text-white px-3 py-2 rounded-md text-sm font-medium">Chamados</a>
                        <a href="#" class="text-gray-300 hover:text-white px-3 py-2 rounded-md text-sm font-medium">Estoque</a>
                        <a href="#" class="text-gray-300 hover:text-white px-3 py-2 rounded-md text-sm font-medium">Usuários</a>
                        <a href="#" class="text-gray-300 hover:text-white px-3 py-2 rounded-md text-sm font-medium">Relatórios</a>
                        <a href="#" class="text-gray-300 hover:text-white px-3 py-2 rounded-md text-sm font-medium">Configurações</a>
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
                    <a href="#" class="text-white block px-3 py-2 rounded-md text-base font-medium">Dashboard</a>
                    <a href="#" class="text-gray-300 hover:text-white block px-3 py-2 rounded-md text-base font-medium">Chamados</a>
                    <a href="#" class="text-gray-300 hover:text-white block px-3 py-2 rounded-md text-base font-medium">Estoque</a>
                    <a href="#" class="text-gray-300 hover:text-white block px-3 py-2 rounded-md text-base font-medium">Usuários</a>
                    <a href="#" class="text-gray-300 hover:text-white block px-3 py-2 rounded-md text-base font-medium">Relatórios</a>
                    <a href="#" class="text-gray-300 hover:text-white block px-3 py-2 rounded-md text-base font-medium">Configurações</a>
                </div>
            </div>
        </div>
    </nav>

    <!-- Conteúdo principal (sem sidebar) -->
    <div class="container mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <!-- Cabeçalho da página -->
        <div class="flex justify-between items-center mb-8">
            <h1 class="text-2xl font-bold text-white">Dashboard</h1>
            <div class="flex space-x-4">
                <div class="relative">
                    <input type="text" placeholder="Buscar..." class="px-4 py-2 rounded-md bg-gray-700 border border-gray-600 text-white focus:outline-none focus:border-blue-500">
                    <i class="fas fa-search absolute right-3 top-2.5 text-gray-400"></i>
                </div>
                <button class="px-4 py-2 bg-blue-600 hover:bg-blue-500 text-white rounded-md flex items-center transition-all">
                    <a href="/criar-chamado"><i class="fas fa-plus mr-2"></i> Novo Chamado</a>
                </button>
            </div>
        </div>

        <!-- Cards de resumo -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
            <div class="bg-gray-800 border border-gray-700 p-6 rounded-lg dashboard-card">
                <div class="flex items-center">
                    <div class="p-3 rounded-full bg-blue-900 text-blue-400">
                        <i class="fas fa-ticket-alt text-xl"></i>
                    </div>
                    <div class="ml-4">
                        <h3 class="text-gray-400 text-sm">Total de Chamados</h3>
                        <span class="text-2xl font-bold text-white">247</span>
                    </div>
                </div>
                <div class="mt-4">
                    <div class="flex items-center text-green-400">
                        <i class="fas fa-arrow-up mr-1"></i>
                        <span>12% acima do mês anterior</span>
                    </div>
                </div>
            </div>
            
            <div class="bg-gray-800 border border-gray-700 p-6 rounded-lg dashboard-card">
                <div class="flex items-center">
                    <div class="p-3 rounded-full bg-green-900 text-green-400">
                        <i class="fas fa-check-circle text-xl"></i>
                    </div>
                    <div class="ml-4">
                        <h3 class="text-gray-400 text-sm">Chamados Resolvidos</h3>
                        <span class="text-2xl font-bold text-white">184</span>
                    </div>
                </div>
                <div class="mt-4">
                    <div class="flex items-center text-green-400">
                        <i class="fas fa-arrow-up mr-1"></i>
                        <span>8% acima do mês anterior</span>
                    </div>
                </div>
            </div>
            
            <div class="bg-gray-800 border border-gray-700 p-6 rounded-lg dashboard-card">
                <div class="flex items-center">
                    <div class="p-3 rounded-full bg-yellow-900 text-yellow-400">
                        <i class="fas fa-clock text-xl"></i>
                    </div>
                    <div class="ml-4">
                        <h3 class="text-gray-400 text-sm">Chamados Pendentes</h3>
                        <span class="text-2xl font-bold text-white">42</span>
                    </div>
                </div>
                <div class="mt-4">
                    <div class="flex items-center text-red-400">
                        <i class="fas fa-arrow-up mr-1"></i>
                        <span>5% acima do mês anterior</span>
                    </div>
                </div>
            </div>
            
            <div class="bg-gray-800 border border-gray-700 p-6 rounded-lg dashboard-card">
                <div class="flex items-center">
                    <div class="p-3 rounded-full bg-red-900 text-red-400">
                        <i class="fas fa-exclamation-triangle text-xl"></i>
                    </div>
                    <div class="ml-4">
                        <h3 class="text-gray-400 text-sm">Chamados Críticos</h3>
                        <span class="text-2xl font-bold text-white">21</span>
                    </div>
                </div>
                <div class="mt-4">
                    <div class="flex items-center text-red-400">
                        <i class="fas fa-arrow-down mr-1"></i>
                        <span>3% abaixo do mês anterior</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Gráficos e Tabelas -->
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <!-- Gráfico de Chamados por Status -->
            <div class="bg-gray-800 border border-gray-700 p-6 rounded-lg col-span-2 dashboard-card">
                <h3 class="text-xl font-semibold text-white mb-4">Chamados por Status</h3>
                <div class="h-64 flex items-center justify-center">
                    <!-- Representação simplificada de um gráfico -->
                    <div class="w-full flex space-x-4 items-end h-40">
                        <div class="flex flex-col items-center">
                            <div class="bg-blue-500 w-20 h-40 rounded-t-md"></div>
                            <span class="mt-2 text-gray-400">Abertos</span>
                        </div>
                        <div class="flex flex-col items-center">
                            <div class="bg-yellow-500 w-20 h-24 rounded-t-md"></div>
                            <span class="mt-2 text-gray-400">Em Progresso</span>
                        </div>
                        <div class="flex flex-col items-center">
                            <div class="bg-green-500 w-20 h-32 rounded-t-md"></div>
                            <span class="mt-2 text-gray-400">Resolvidos</span>
                        </div>
                        <div class="flex flex-col items-center">
                            <div class="bg-red-500 w-20 h-16 rounded-t-md"></div>
                            <span class="mt-2 text-gray-400">Críticos</span>
                        </div>
                        <div class="flex flex-col items-center">
                            <div class="bg-gray-500 w-20 h-8 rounded-t-md"></div>
                            <span class="mt-2 text-gray-400">Fechados</span>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Chamados Recentes -->
            <div class="bg-gray-800 border border-gray-700 p-6 rounded-lg dashboard-card">
                <h3 class="text-xl font-semibold text-white mb-4">Chamados Recentes</h3>
                <ul class="space-y-4">
                    <li class="flex items-center">
                        <div class="w-8 h-8 rounded-full bg-red-500 flex items-center justify-center mr-3">
                            <span class="text-white text-xs font-bold">CR</span>
                        </div>
                        <div>
                            <p class="text-white">Servidor fora do ar</p>
                            <p class="text-gray-400 text-sm">Há 32 minutos - Alto</p>
                        </div>
                    </li>
                    <li class="flex items-center">
                        <div class="w-8 h-8 rounded-full bg-yellow-500 flex items-center justify-center mr-3">
                            <span class="text-white text-xs font-bold">MD</span>
                        </div>
                        <div>
                            <p class="text-white">Problema com impressora</p>
                            <p class="text-gray-400 text-sm">Há 1 hora - Médio</p>
                        </div>
                    </li>
                    <li class="flex items-center">
                        <div class="w-8 h-8 rounded-full bg-blue-500 flex items-center justify-center mr-3">
                            <span class="text-white text-xs font-bold">BX</span>
                        </div>
                        <div>
                            <p class="text-white">Solicitação de headset</p>
                            <p class="text-gray-400 text-sm">Há 3 horas - Baixo</p>
                        </div>
                    </li>
                    <li class="flex items-center">
                        <div class="w-8 h-8 rounded-full bg-yellow-500 flex items-center justify-center mr-3">
                            <span class="text-white text-xs font-bold">MD</span>
                        </div>
                        <div>
                            <p class="text-white">E-mail não sincroniza</p>
                            <p class="text-gray-400 text-sm">Há 4 horas - Médio</p>
                        </div>
                    </li>
                    <li class="flex items-center">
                        <div class="w-8 h-8 rounded-full bg-green-500 flex items-center justify-center mr-3">
                            <span class="text-white text-xs font-bold">RS</span>
                        </div>
                        <div>
                            <p class="text-white">Instalação de software</p>
                            <p class="text-gray-400 text-sm">Há 5 horas - Resolvido</p>
                        </div>
                    </li>
                </ul>
                <div class="mt-4">
                    <a href="#" class="text-blue-400 hover:underline text-sm flex items-center">
                        Ver todos os chamados <i class="fas fa-arrow-right ml-2"></i>
                    </a>
                </div>
            </div>
        </div>

        <!-- Status do Sistema e Inventário -->
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8 mt-8">
            <!-- Status do Sistema -->
            <div class="bg-gray-800 border border-gray-700 p-6 rounded-lg dashboard-card">
                <h3 class="text-xl font-semibold text-white mb-4">Status do Sistema</h3>
                <ul class="space-y-3">
                    <li class="flex items-center justify-between">
                        <span class="text-gray-300">Servidor Principal</span>
                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                            Online
                        </span>
                    </li>
                    <li class="flex items-center justify-between">
                        <span class="text-gray-300">Servidor de Backup</span>
                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                            Online
                        </span>
                    </li>
                    <li class="flex items-center justify-between">
                        <span class="text-gray-300">Email Server</span>
                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                            Online
                        </span>
                    </li>
                    <li class="flex items-center justify-between">
                        <span class="text-gray-300">Database</span>
                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                            Online
                        </span>
                    </li>
                    <li class="flex items-center justify-between">
                        <span class="text-gray-300">VPN</span>
                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800">
                            Instável
                        </span>
                    </li>
                </ul>
                <div class="mt-4 pt-4 border-t border-gray-700">
                    <div class="flex items-center">
                        <div class="relative pt-1 flex-1">
                            <div class="flex mb-2 items-center justify-between">
                                <div>
                                    <span class="text-xs font-semibold inline-block text-gray-300">
                                        Carga do Servidor
                                    </span>
                                </div>
                                <div class="text-right">
                                    <span class="text-xs font-semibold inline-block text-blue-400">
                                        78%
                                    </span>
                                </div>
                            </div>
                            <div class="overflow-hidden h-2 text-xs flex rounded bg-gray-700">
                                <div style="width: 78%" class="shadow-none flex flex-col text-center whitespace-nowrap text-white justify-center bg-blue-500"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Alertas de Estoque -->
            <div class="bg-gray-800 border border-gray-700 p-6 rounded-lg dashboard-card">
                <h3 class="text-xl font-semibold text-white mb-4">Alertas de Estoque</h3>
                <ul class="space-y-3">
                    <li class="flex items-center justify-between">
                        <span class="text-gray-300">Toners de Impressora</span>
                        <span class="text-red-400 font-medium">Estoque Baixo (2)</span>
                    </li>
                    <li class="flex items-center justify-between">
                        <span class="text-gray-300">Notebooks Dell</span>
                        <span class="text-yellow-400 font-medium">Estoque Médio (5)</span>
                    </li>
                    <li class="flex items-center justify-between">
                        <span class="text-gray-300">Headsets</span>
                        <span class="text-red-400 font-medium">Estoque Baixo (3)</span>
                    </li>
                    <li class="flex items-center justify-between">
                        <span class="text-gray-300">Cabos HDMI</span>
                        <span class="text-green-400 font-medium">Estoque Normal (20)</span>
                    </li>
                    <li class="flex items-center justify-between">
                        <span class="text-gray-300">Mouses Sem Fio</span>
                        <span class="text-green-400 font-medium">Estoque Normal (15)</span>
                    </li>
                </ul>
                <div class="mt-4">
                    <a href="#" class="text-blue-400 hover:underline text-sm flex items-center">
                        Ver relatório completo <i class="fas fa-arrow-right ml-2"></i>
                    </a>
                </div>
            </div>
            
            <!-- Desempenho da Equipe -->
            <div class="bg-gray-800 border border-gray-700 p-6 rounded-lg dashboard-card">
                <h3 class="text-xl font-semibold text-white mb-4">Desempenho da Equipe</h3>
                <ul class="space-y-3">
                    <li>
                        <div class="flex items-center justify-between mb-1">
                            <span class="text-gray-300">Ana Silva</span>
                            <span class="text-gray-300">87%</span>
                        </div>
                        <div class="overflow-hidden h-2 text-xs flex rounded bg-gray-700">
                            <div style="width: 87%" class="shadow-none flex flex-col text-center whitespace-nowrap text-white justify-center bg-blue-500"></div>
                        </div>
                    </li>
                    <li>
                        <div class="flex items-center justify-between mb-1">
                            <span class="text-gray-300">Carlos Santos</span>
                            <span class="text-gray-300">92%</span>
                        </div>
                        <div class="overflow-hidden h-2 text-xs flex rounded bg-gray-700">
                            <div style="width: 92%" class="shadow-none flex flex-col text-center whitespace-nowrap text-white justify-center bg-green-500"></div>
                        </div>
                    </li>
                    <li>
                        <div class="flex items-center justify-between mb-1">
                            <span class="text-gray-300">Mariana Costa</span>
                            <span class="text-gray-300">78%</span>
                        </div>
                        <div class="overflow-hidden h-2 text-xs flex rounded bg-gray-700">
                            <div style="width: 78%" class="shadow-none flex flex-col text-center whitespace-nowrap text-white justify-center bg-yellow-500"></div>
                        </div>
                    </li>
                    <li>
                        <div class="flex items-center justify-between mb-1">
                            <span class="text-gray-300">Roberto Alves</span>
                            <span class="text-gray-300">95%</span>
                        </div>
                        <div class="overflow-hidden h-2 text-xs flex rounded bg-gray-700">
                            <div style="width: 95%" class="shadow-none flex flex-col text-center whitespace-nowrap text-white justify-center bg-green-500"></div>
                        </div>
                    </li>
                    <li>
                        <div class="flex items-center justify-between mb-1">
                            <span class="text-gray-300">Juliana Lima</span>
                            <span class="text-gray-300">81%</span>
                        </div>
                        <div class="overflow-hidden h-2 text-xs flex rounded bg-gray-700">
                            <div style="width: 81%" class="shadow-none flex flex-col text-center whitespace-nowrap text-white justify-center bg-blue-500"></div>
                        </div>
                    </li>
                </ul>
                <div class="mt-4">
                    <a href="#" class="text-blue-400 hover:underline text-sm flex items-center">
                        Ver relatório detalhado <i class="fas fa-arrow-right ml-2"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Font Awesome -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/js/all.min.js"></script>
    
    <!-- Script para controlar os dropdowns -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
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
    </script>
</body>
</html>