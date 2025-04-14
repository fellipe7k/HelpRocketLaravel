<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HelpRocket - Sistema de Gestão de TI</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/tailwindcss/2.2.19/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        /* Animações de slide */
        @keyframes slideInDown {
            from {
                transform: translateY(-50px);
                opacity: 0;
            }
            to {
                transform: translateY(0);
                opacity: 1;
            }
        }
        
        @keyframes slideInRight {
            from {
                transform: translateX(50px);
                opacity: 0;
            }
            to {
                transform: translateX(0);
                opacity: 1;
            }
        }
        
        .animate-slide-down {
            animation: slideInDown 0.8s ease forwards;
        }
        
        .animate-slide-down-delay-1 {
            opacity: 0;
            animation: slideInDown 0.8s ease forwards;
            animation-delay: 0.2s;
        }
        
        .animate-slide-down-delay-2 {
            opacity: 0;
            animation: slideInDown 0.8s ease forwards;
            animation-delay: 0.4s;
        }
        
        .animate-slide-right {
            animation: slideInRight 0.8s ease forwards;
        }
        
        .animate-slide-right-delay-1 {
            opacity: 0;
            animation: slideInRight 0.8s ease forwards;
            animation-delay: 0.2s;
        }
        
        .animate-slide-right-delay-2 {
            opacity: 0;
            animation: slideInRight 0.8s ease forwards;
            animation-delay: 0.4s;
        }
        
        /* Melhoria na transição dos links */
        .nav-link {
            transition: all 0.3s ease;
        }
        
        /* Efeito de hover nas cards */
        .feature-card {
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }
        
        .feature-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 25px -5px rgba(59, 130, 246, 0.1), 0 10px 10px -5px rgba(59, 130, 246, 0.04);
        }
        
        /* Indicador visual para rolagem suave */
        .scroll-indicator {
            display: none;
            position: fixed;
            bottom: 20px;
            right: 20px;
            width: 50px;
            height: 50px;
            background-color: rgba(37, 99, 235, 0.7);
            color: white;
            border-radius: 50%;
            justify-content: center;
            align-items: center;
            z-index: 100;
            animation: pulse 1.5s infinite;
            box-shadow: 0 0 0 0 rgba(37, 99, 235, 0.7);
        }
        
        @keyframes pulse {
            0% {
                transform: scale(0.95);
                box-shadow: 0 0 0 0 rgba(37, 99, 235, 0.7);
            }
            
            70% {
                transform: scale(1);
                box-shadow: 0 0 0 10px rgba(37, 99, 235, 0);
            }
            
            100% {
                transform: scale(0.95);
                box-shadow: 0 0 0 0 rgba(37, 99, 235, 0);
            }
        }
    </style>
</head>
<body class="font-sans antialiased bg-gray-900 text-gray-100">
    <!-- Indicador visual durante rolagem -->
    <div class="scroll-indicator" id="scrollIndicator">
        <i class="fas fa-chevron-down"></i>
    </div>

    <!-- Navbar -->
    <nav class="bg-gray-800 shadow-lg border-b border-blue-500 sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16">
                <div class="flex">
                    <div class="flex-shrink-0 flex items-center">
                        <span class="text-blue-400 text-2xl font-bold">HelpRocket</span>
                        <i class="fas fa-rocket text-blue-400 ml-2"></i>
                    </div>
                    <div class="hidden sm:ml-6 sm:flex sm:space-x-8">
                        <a href="#" class="border-blue-500 text-white inline-flex items-center px-1 pt-1 border-b-2 text-sm font-medium nav-link scroll-link">
                            Início
                        </a>
                        <a href="#features" class="border-transparent text-gray-300 hover:border-gray-300 hover:text-blue-400 inline-flex items-center px-1 pt-1 border-b-2 text-sm font-medium nav-link scroll-link">
                            Recursos
                        </a>
                        <a href="#benefits" class="border-transparent text-gray-300 hover:border-gray-300 hover:text-blue-400 inline-flex items-center px-1 pt-1 border-b-2 text-sm font-medium nav-link scroll-link">
                            Benefícios
                        </a>
                        <a href="#contact" class="border-transparent text-gray-300 hover:border-gray-300 hover:text-blue-400 inline-flex items-center px-1 pt-1 border-b-2 text-sm font-medium nav-link scroll-link">
                            Contato
                        </a>
                    </div>
                </div>
                <div class="hidden sm:ml-6 sm:flex sm:items-center">
                    <a href="{{ route('login') }}" class="mr-4 inline-flex items-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-blue-700 hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition duration-300">
                        Acessar Plataforma
                    </a>
                    <a href="#demo" class="inline-flex items-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-blue-400 bg-gray-700 hover:bg-gray-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition duration-300 scroll-link">
                        Solicitar Demo
                    </a>
                </div>
                <div class="-mr-2 flex items-center sm:hidden">
                    <button type="button" class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-white hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-inset focus:ring-white" aria-controls="mobile-menu" aria-expanded="false">
                        <span class="sr-only">Abrir menu principal</span>
                        <i class="fas fa-bars text-white"></i>
                    </button>
                </div>
            </div>
        </div>
    </nav>

    <!-- Hero Section (Centralizada) -->
    <div class="relative bg-gray-800 overflow-hidden">
        <div class="max-w-7xl mx-auto">
            <div class="relative z-10 py-16 bg-gray-800 sm:py-24 md:py-32 w-full">
                <main class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
                    <div class="text-center space-y-12">
                        <h1 class="text-4xl tracking-tight font-extrabold text-white sm:text-5xl md:text-6xl">
                            <span class="block animate-slide-down">Simplifique a gestão de</span>
                            <span class="block text-blue-400 animate-slide-down-delay-1 mt-3">TI da sua empresa</span>
                        </h1>
                        <p class="mt-6 text-base text-gray-300 sm:text-lg sm:max-w-xl sm:mx-auto md:text-xl animate-slide-down-delay-2">
                            Uma solução completa para gerenciar chamados, controlar estoque e atender com eficiência todas as demandas de TI da sua empresa.
                        </p>
                        <div class="mt-10 flex justify-center gap-4">
                            <div class="rounded-md shadow animate-slide-right">
                                <a href="/login" class="w-full flex items-center justify-center px-8 py-3 border border-transparent text-base font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700 md:py-4 md:text-lg md:px-10 transition duration-300">
                                    Acessar Plataforma
                                </a>
                            </div>
                            <div class="animate-slide-right-delay-1">
                                <a href="#features" class="w-full flex items-center justify-center px-8 py-3 border border-transparent text-base font-medium rounded-md text-blue-400 bg-gray-700 hover:bg-gray-600 md:py-4 md:text-lg md:px-10 transition duration-300 scroll-link">
                                    Saiba mais
                                </a>
                            </div>
                        </div>
                    </div>
                </main>
            </div>
        </div>
        <!-- Ícone grande centralizado abaixo do conteúdo principal -->
        <div class="py-12 bg-gray-800 flex justify-center animate-slide-right-delay-2">
            <i class="fas fa-desktop text-blue-400 text-9xl"></i>
        </div>
    </div>

    <!-- Features Section -->
    <div id="features" class="py-16 bg-gray-800">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="lg:text-center">
                <h2 class="text-base text-blue-400 font-semibold tracking-wide uppercase">Recursos</h2>
                <p class="mt-2 text-3xl leading-8 font-extrabold tracking-tight text-white sm:text-4xl">
                    Tudo que você precisa em um só lugar
                </p>
                <p class="mt-4 max-w-2xl text-xl text-gray-300 lg:mx-auto">
                    Gerencie todas as necessidades de TI da sua empresa com uma plataforma completa e integrada.
                </p>
            </div>

            <div class="mt-16">
                <dl class="space-y-10 md:space-y-0 md:grid md:grid-cols-2 md:gap-x-8 md:gap-y-16">
                    <div class="relative feature-card p-6 rounded-lg bg-gray-800 border border-gray-700">
                        <dt>
                            <div class="absolute flex items-center justify-center h-12 w-12 rounded-md bg-blue-500 text-white">
                                <i class="fas fa-ticket-alt"></i>
                            </div>
                            <p class="ml-16 text-lg leading-6 font-medium text-white">Gestão de Chamados</p>
                        </dt>
                        <dd class="mt-2 ml-16 text-base text-gray-300">
                            Acompanhe todos os chamados em tempo real, defina prioridades e garanta que nenhuma solicitação fique sem resposta.
                        </dd>
                    </div>

                    <div class="relative feature-card p-6 rounded-lg bg-gray-800 border border-gray-700">
                        <dt>
                            <div class="absolute flex items-center justify-center h-12 w-12 rounded-md bg-blue-500 text-white">
                                <i class="fas fa-box"></i>
                            </div>
                            <p class="ml-16 text-lg leading-6 font-medium text-white">Controle de Estoque</p>
                        </dt>
                        <dd class="mt-2 ml-16 text-base text-gray-300">
                            Gerencie todo o estoque de equipamentos, peças e suprimentos de TI, com alertas automáticos para reposição.
                        </dd>
                    </div>

                    <div class="relative feature-card p-6 rounded-lg bg-gray-800 border border-gray-700">
                        <dt>
                            <div class="absolute flex items-center justify-center h-12 w-12 rounded-md bg-blue-500 text-white">
                                <i class="fas fa-chart-line"></i>
                            </div>
                            <p class="ml-16 text-lg leading-6 font-medium text-white">Relatórios e Dashboards</p>
                        </dt>
                        <dd class="mt-2 ml-16 text-base text-gray-300">
                            Visualize métricas importantes e tome decisões baseadas em dados reais e atualizados.
                        </dd>
                    </div>

                    <div class="relative feature-card p-6 rounded-lg bg-gray-800 border border-gray-700">
                        <dt>
                            <div class="absolute flex items-center justify-center h-12 w-12 rounded-md bg-blue-500 text-white">
                                <i class="fas fa-users"></i>
                            </div>
                            <p class="ml-16 text-lg leading-6 font-medium text-white">Gestão de Equipes</p>
                        </dt>
                        <dd class="mt-2 ml-16 text-base text-gray-300">
                            Distribua tarefas de forma eficiente e acompanhe o desempenho da sua equipe de suporte.
                        </dd>
                    </div>
                </dl>
            </div>
        </div>
    </div>

    <!-- Screenshots Section -->
    <div class="bg-gray-900 py-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <h2 class="text-3xl font-extrabold text-white text-center">Conheça nossa plataforma</h2>
            <p class="mt-4 max-w-2xl text-xl text-gray-300 mx-auto text-center">
                Uma interface moderna e intuitiva para facilitar o dia a dia da sua equipe de TI.
            </p>
            <div class="mt-12 grid gap-8 grid-cols-1 md:grid-cols-2 lg:grid-cols-3">
                <div class="bg-gray-800 rounded-lg shadow-lg overflow-hidden border border-gray-700 feature-card">
                    <div class="h-48 flex items-center justify-center bg-gray-700">
                        <i class="fas fa-chart-pie text-blue-400 text-5xl"></i>
                    </div>
                    <div class="p-6">
                        <h3 class="text-lg font-medium text-white">Dashboard Intuitivo</h3>
                        <p class="mt-2 text-gray-300">Visualize todas as informações importantes em um só lugar, com gráficos dinâmicos e atualizados em tempo real.</p>
                    </div>
                </div>
                <div class="bg-gray-800 rounded-lg shadow-lg overflow-hidden border border-gray-700 feature-card">
                    <div class="h-48 flex items-center justify-center bg-gray-700">
                        <i class="fas fa-tasks text-blue-400 text-5xl"></i>
                    </div>
                    <div class="p-6">
                        <h3 class="text-lg font-medium text-white">Gestão de Chamados</h3>
                        <p class="mt-2 text-gray-300">Acompanhe o status de cada solicitação em tempo real, com sistema de priorização inteligente.</p>
                    </div>
                </div>
                <div class="bg-gray-800 rounded-lg shadow-lg overflow-hidden border border-gray-700 feature-card">
                    <div class="h-48 flex items-center justify-center bg-gray-700">
                        <i class="fas fa-warehouse text-blue-400 text-5xl"></i>
                    </div>
                    <div class="p-6">
                        <h3 class="text-lg font-medium text-white">Controle de Estoque</h3>
                        <p class="mt-2 text-gray-300">Gerencie equipamentos e suprimentos com facilidade, com alertas de baixo estoque e reposição automática.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Benefits Section -->
    <div id="benefits" class="py-16 bg-blue-900 bg-opacity-30">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <h2 class="text-3xl font-extrabold text-white text-center">Benefícios para o seu negócio</h2>
            <div class="mt-12 grid gap-8 grid-cols-1 md:grid-cols-3">
                <div class="bg-gray-800 rounded-lg shadow-lg p-6 border border-gray-700 feature-card">
                    <div class="text-center">
                        <div class="inline-flex items-center justify-center h-16 w-16 rounded-full bg-blue-900 text-blue-400 mb-4">
                            <i class="fas fa-tachometer-alt text-2xl"></i>
                        </div>
                        <h3 class="text-xl font-medium text-white">Aumento de Produtividade</h3>
                        <p class="mt-4 text-gray-300">Reduza o tempo de resolução de problemas e aumente a eficiência operacional.</p>
                    </div>
                </div>
                <div class="bg-gray-800 rounded-lg shadow-lg p-6 border border-gray-700 feature-card">
                    <div class="text-center">
                        <div class="inline-flex items-center justify-center h-16 w-16 rounded-full bg-blue-900 text-blue-400 mb-4">
                            <i class="fas fa-dollar-sign text-2xl"></i>
                        </div>
                        <h3 class="text-xl font-medium text-white">Redução de Custos</h3>
                        <p class="mt-4 text-gray-300">Otimize seus recursos e reduza gastos desnecessários com gestão eficiente.</p>
                    </div>
                </div>
                <div class="bg-gray-800 rounded-lg shadow-lg p-6 border border-gray-700 feature-card">
                    <div class="text-center">
                        <div class="inline-flex items-center justify-center h-16 w-16 rounded-full bg-blue-900 text-blue-400 mb-4">
                            <i class="fas fa-smile text-2xl"></i>
                        </div>
                        <h3 class="text-xl font-medium text-white">Satisfação do Usuário</h3>
                        <p class="mt-4 text-gray-300">Melhore a experiência dos seus colaboradores com atendimento rápido e eficaz.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- CTA Section -->
    <div id="demo" class="bg-gray-800">
        <div class="max-w-7xl mx-auto py-12 px-4 sm:px-6 lg:py-16 lg:px-8 lg:flex lg:items-center lg:justify-between">
            <h2 class="text-3xl font-extrabold tracking-tight text-white sm:text-4xl">
                <span class="block">Pronto para otimizar sua gestão de TI?</span>
                <span class="block text-blue-400">Solicite uma demonstração gratuita hoje mesmo.</span>
            </h2>
            <div class="mt-8 flex lg:mt-0 lg:flex-shrink-0">
                <div class="inline-flex rounded-md shadow">
                    <a href="/login" class="inline-flex items-center justify-center px-5 py-3 border border-transparent text-base font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700 transition duration-300">
                        Acessar Plataforma
                    </a>
                </div>
                <div class="ml-3 inline-flex rounded-md shadow">
                    <a href="#contact" class="inline-flex items-center justify-center px-5 py-3 border border-transparent text-base font-medium rounded-md text-blue-400 bg-gray-700 hover:bg-gray-600 transition duration-300 scroll-link">
                        Solicitar Demo
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Contact Section -->
    <div id="contact" class="bg-gray-900 py-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="max-w-lg mx-auto md:max-w-none md:grid md:grid-cols-2 md:gap-8">
                <div>
                    <h2 class="text-2xl font-extrabold text-white sm:text-3xl">
                        Entre em contato
                    </h2>
                    <div class="mt-3">
                        <p class="text-lg text-gray-300">
                            Estamos prontos para ajudar sua empresa a otimizar a gestão de TI. Preencha o formulário e entraremos em contato.
                        </p>
                    </div>
                    <div class="mt-8">
                        <div class="flex">
                            <div class="flex-shrink-0">
                                <i class="fas fa-map-marker-alt text-blue-400"></i>
                            </div>
                            <div class="ml-3 text-base text-gray-300">
                                <p>R. 88, 25 - St. Sul</p>
                                <p class="mt-1">Goiânia, GO</p>
                            </div>
                        </div>
                        <div class="mt-4 flex">
                            <div class="flex-shrink-0">
                                <i class="fas fa-phone text-blue-400"></i>
                            </div>
                            <div class="ml-3 text-base text-gray-300">
                                <p>(62) 9999-9999</p>
                            </div>
                        </div>
                        <div class="mt-4 flex">
                            <div class="flex-shrink-0">
                                <i class="fas fa-envelope text-blue-400"></i>
                            </div>
                            <div class="ml-3 text-base text-gray-300">
                                <p>contato@helprocket.com.br</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="mt-12 md:mt-0">
                    <form action="#" method="POST" class="grid grid-cols-1 gap-y-6">
                        <div>
                            <label for="name" class="block text-sm font-medium text-gray-300">Nome</label>
                            <div class="mt-1">
                                <input type="text" name="name" id="name" autocomplete="name" class="py-3 px-4 block w-full bg-gray-700 border-gray-600 focus:ring-blue-500 focus:border-blue-500 shadow-sm rounded-md text-white transition duration-300">
                            </div>
                        </div>
                        <div>
                            <label for="email" class="block text-sm font-medium text-gray-300">Email</label>
                            <div class="mt-1">
                                <input type="email" name="email" id="email" autocomplete="email" class="py-3 px-4 block w-full bg-gray-700 border-gray-600 focus:ring-blue-500 focus:border-blue-500 shadow-sm rounded-md text-white transition duration-300">
                            </div>
                        </div>
                        <div>
                            <label for="phone" class="block text-sm font-medium text-gray-300">Telefone</label>
                            <div class="mt-1">
                                <input type="text" name="phone" id="phone" autocomplete="tel" class="py-3 px-4 block w-full bg-gray-700 border-gray-600 focus:ring-blue-500 focus:border-blue-500 shadow-sm rounded-md text-white transition duration-300">
                            </div>
                        </div>
                        <div>
                            <label for="message" class="block text-sm font-medium text-gray-300">Mensagem</label>
                            <div class="mt-1">
                                <textarea id="message" name="message" rows="4" class="py-3 px-4 block w-full bg-gray-700 border-gray-600 focus:ring-blue-500 focus:border-blue-500 shadow-sm rounded-md text-white transition duration-300"></textarea>
                            </div>
                        </div>
                        <div>
                            <button type="submit" class="w-full inline-flex items-center justify-center px-6 py-3 border border-transparent rounded-md shadow-sm text-base font-medium text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition duration-300">
                                Enviar
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <footer class="bg-gray-800">
        <div class="max-w-7xl mx-auto py-12 px-4 sm:px-6 lg:py-16 lg:px-8">
            <div class="xl:grid xl:grid-cols-3 xl:gap-8">
                <div class="space-y-8 xl:col-span-1">
                    <div class="flex items-center">
                        <span class="text-white text-2xl font-bold">HelpRocket</span>
                        <i class="fas fa-rocket text-blue-400 ml-2"></i>
                    </div>
                    <p class="text-gray-300 text-base">
                        Transformando a gestão de TI em uma experiência simples e eficiente para empresas de todos os tamanhos.
                    </p>
                    <div class="flex space-x-6">
                        <a href="#" class="text-gray-400 hover:text-blue-400 transition duration-300">
                            <i class="fab fa-facebook-f"></i>
                        </a>
                        <a href="#" class="text-gray-400 hover:text-blue-400 transition duration-300">
                            <i class="fab fa-instagram"></i>
                        </a>
                        <a href="#" class="text-gray-400 hover:text-blue-400 transition duration-300">
                            <i class="fab fa-twitter"></i>
                        </a>
                        <a href="#" class="text-gray-400 hover:text-blue-400 transition duration-300">
                            <i class="fab fa-linkedin-in"></i>
                        </a>
                    </div>
                </div>
                <div class="mt-12 grid grid-cols-2 gap-8 xl:mt-0 xl:col-span-2">
                    <div class="md:grid md:grid-cols-2 md:gap-8">
                        <div>
                            <h3 class="text-sm font-semibold text-gray-400 tracking-wider uppercase">
                                Soluções
                            </h3>
                            <ul class="mt-4 space-y-4">
                                <li>
                                    <a href="#" class="text-base text-gray-300 hover:text-blue-400 transition duration-300">
                                        Gestão de Chamados
                                    </a>
                                </li>
                                <li>
                                    <a href="#" class="text-base text-gray-300 hover:text-blue-400 transition duration-300">
                                        Controle de Estoque
                                    </a>
                                </li>
                                <li>
                                    <a href="#" class="text-base text-gray-300 hover:text-blue-400 transition duration-300">
                                        Relatórios
                                    </a>
                                </li>
                                <li>
                                    <a href="#" class="text-base text-gray-300 hover:text-blue-400 transition duration-300">
                                        Dashboards
                                    </a>
                                </li>
                            </ul>
                        </div>
                        <div class="mt-12 md:mt-0">
                            <h3 class="text-sm font-semibold text-gray-400 tracking-wider uppercase">
                                Suporte
                            </h3>
                            <ul class="mt-4 space-y-4">