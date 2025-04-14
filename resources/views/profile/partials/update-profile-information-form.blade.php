<section class="space-y-6">
    <header>
        <h2 class="text-xl font-semibold text-white">
            {{ __('Informações do Perfil') }}
        </h2>

        <p class="mt-2 text-gray-300">
            {{ __("Atualize as informações de perfil e o endereço de e-mail da sua conta.") }}
        </p>
    </header>

    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <form method="post" action="{{ route('profile.update') }}" class="mt-6 space-y-6">
        @csrf
        @method('patch')

        <div>
            <label for="name" class="block text-sm font-medium text-gray-300 mb-1">{{ __('Nome') }}</label>
            <input 
                id="name" 
                name="name" 
                type="text" 
                class="px-4 py-2 rounded-md bg-gray-700 border border-gray-600 text-white focus:outline-none focus:border-blue-500 w-full" 
                value="{{ old('name', $user->name) }}"
                required 
                autofocus 
                autocomplete="name" 
            />
            <x-input-error class="mt-2 text-red-400" :messages="$errors->get('name')" />
        </div>

        <div>
            <label for="email" class="block text-sm font-medium text-gray-300 mb-1">{{ __('Email') }}</label>
            <input 
                id="email" 
                name="email" 
                type="email" 
                class="px-4 py-2 rounded-md bg-gray-700 border border-gray-600 text-white focus:outline-none focus:border-blue-500 w-full" 
                value="{{ old('email', $user->email) }}"
                required 
                autocomplete="username" 
            />
            <x-input-error class="mt-2 text-red-400" :messages="$errors->get('email')" />

            @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                <div>
                    <p class="text-sm mt-2 text-gray-300">
                        {{ __('Seu endereço de e-mail não foi verificado.') }}

                        <button form="send-verification" class="underline text-sm text-blue-400 hover:text-blue-300 rounded-md focus:outline-none">
                            {{ __('Clique aqui para reenviar o e-mail de verificação.') }}
                        </button>
                    </p>

                    @if (session('status') === 'verification-link-sent')
                        <p class="mt-2 font-medium text-sm text-green-400">
                            {{ __('Um novo link de verificação foi enviado para o seu endereço de e-mail.') }}
                        </p>
                    @endif
                </div>
            @endif
        </div>

        <div class="flex items-center gap-4">
            <button type="submit" class="px-4 py-2 bg-blue-600 hover:bg-blue-500 text-white rounded-md flex items-center transition-all">
                <i class="fas fa-save mr-2"></i> {{ __('Salvar') }}
            </button>

            @if (session('status') === 'profile-updated')
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