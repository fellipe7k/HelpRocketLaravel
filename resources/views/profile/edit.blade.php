<x-app-layout>
    <div class="container mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <!-- Cabeçalho da página -->
        <div class="flex justify-between items-center mb-8">
            <h1 class="text-2xl font-bold text-white">Perfil do Usuário</h1>
        </div>

        <div class="space-y-8">
            <!-- Seção de Informações do Perfil -->
            <div class="bg-gray-800 border border-gray-700 p-6 rounded-lg dashboard-card">
                <div class="max-w-xl">
                    @include('profile.partials.update-profile-information-form')
                </div>
            </div>

            <!-- Seção de Atualização de Senha -->
            <div class="bg-gray-800 border border-gray-700 p-6 rounded-lg dashboard-card">
                <div class="max-w-xl">
                    @include('profile.partials.update-password-form')
                </div>
            </div>

            <!-- Seção de Exclusão de Conta -->
            <div class="bg-gray-800 border border-gray-700 p-6 rounded-lg dashboard-card">
                <div class="max-w-xl">
                    @include('profile.partials.delete-user-form')
                </div>
            </div>
        </div>
    </div>
</x-app-layout>