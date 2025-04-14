<section class="space-y-6">
    <header>
        <h2 class="text-xl font-semibold text-white">
            {{ __('Atualizar Senha') }}
        </h2>

        <p class="mt-2 text-gray-300">
            {{ __('Certifique-se de que sua conta esteja usando uma senha longa e aleatória para se manter segura.') }}
        </p>
    </header>

    <form method="post" action="{{ route('password.update') }}" class="mt-6 space-y-6">
        @csrf
        @method('put')

        <div>
            <label for="update_password_current_password" class="block text-sm font-medium text-gray-300 mb-1">{{ __('Senha Atual') }}</label>
            <input 
                id="update_password_current_password" 
                name="current_password" 
                type="password" 
                class="px-4 py-2 rounded-md bg-gray-700 border border-gray-600 text-white focus:outline-none focus:border-blue-500 w-full" 
                autocomplete="current-password" 
            />
            <x-input-error :messages="$errors->updatePassword->get('current_password')" class="mt-2 text-red-400" />
        </div>

        <div>
            <label for="update_password_password" class="block text-sm font-medium text-gray-300 mb-1">{{ __('Nova Senha') }}</label>
            <input 
                id="update_password_password" 
                name="password" 
                type="password" 
                class="px-4 py-2 rounded-md bg-gray-700 border border-gray-600 text-white focus:outline-none focus:border-blue-500 w-full" 
                autocomplete="new-password" 
            />
            <x-input-error :messages="$errors->updatePassword->get('password')" class="mt-2 text-red-400" />
        </div>

        <div>
            <label for="update_password_password_confirmation" class="block text-sm font-medium text-gray-300 mb-1">{{ __('Confirmar Senha') }}</label>
            <input 
                id="update_password_password_confirmation" 
                name="password_confirmation" 
                type="password" 
                class="px-4 py-2 rounded-md bg-gray-700 border border-gray-600 text-white focus:outline-none focus:border-blue-500 w-full" 
                autocomplete="new-password" 
            />
            <x-input-error :messages="$errors->updatePassword->get('password_confirmation')" class="mt-2 text-red-400" />
        </div>

        <div class="flex items-center gap-4">
            <button type="submit" class="px-4 py-2 bg-blue-600 hover:bg-blue-500 text-white rounded-md flex items-center transition-all">
                <i class="fas fa-save mr-2"></i> {{ __('Salvar') }}
            </button>

            @if (session('status') === 'password-updated')
                <p
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => show = false, 2000)"
                    class="text-sm text-green-400 flex items-center"
                >
                    <i class="fas fa-check mr-1"></i> {{ __('Salvo.') }}
                </p>
            @endif
        </div>
    </form>
</section>