<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield ('title') Help Rocket</title>
    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>
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
                            <a href="/dashboard" class="text-white px-3 py-2 rounded-md text-sm font-medium">Dashboard</a>
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

    @yield('Navbar superior')

    
</body>
</html>