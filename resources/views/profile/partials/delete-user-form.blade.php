<section class="bg-gray-800 border border-gray-700 p-6 rounded-lg dashboard-card space-y-6">
    <header>
        <h2 class="text-xl font-semibold text-white">
            {{ __('Excluir Conta') }}
        </h2>

        <p class="mt-2 text-gray-300">
            {{ __('Uma vez que sua conta é excluída, todos os seus recursos e dados serão excluídos permanentemente. Antes de excluir sua conta, faça o download de quaisquer dados ou informações que você deseja reter.') }}
        </p>
    </header>

    <button
        x-data=""
        x-on:click.prevent="$dispatch('open-modal', 'confirm-user-deletion')"
        class="px-4 py-2 bg-red-600 hover:bg-red-500 text-white rounded-md flex items-center transition-all"
    >
        <i class="fas fa-trash-alt mr-2"></i> {{ __('Excluir Conta') }}
    </button>

    <x-modal name="confirm-user-deletion" :show="$errors->userDeletion->isNotEmpty()" focusable>
        <form method="post" action="{{ route('profile.destroy') }}" class="bg-gray-800 p-6 rounded-lg text-gray-100">
            @csrf
            @method('delete')

            <h2 class="text-xl font-semibold text-white">
                {{ __('Tem certeza que deseja excluir sua conta?') }}
            </h2>

            <p class="mt-2 text-gray-300">
                {{ __('Uma vez que sua conta é excluída, todos os seus recursos e dados serão excluídos permanentemente. Por favor, digite sua senha para confirmar que você deseja excluir permanentemente sua conta.') }}
            </p>

            <div class="mt-6">
                <label for="password" class="sr-only">{{ __('Senha') }}</label>

                <input
                    id="password"
                    name="password"
                    type="password"
                    class="px-4 py-2 rounded-md bg-gray-700 border border-gray-600 text-white focus:outline-none focus:border-blue-500 w-3/4"
                    placeholder="{{ __('Senha') }}"
                />

                <x-input-error :messages="$errors->userDeletion->get('password')" class="mt-2 text-red-400" />
            </div>

            <div class="mt-6 flex justify-end">
                <button type="button" x-on:click="$dispatch('close')" class="px-4 py-2 bg-gray-700 hover:bg-gray-600 text-white rounded-md transition-all">
                    {{ __('Cancelar') }}
                </button>

                <button type="submit" class="ms-3 px-4 py-2 bg-red-600 hover:bg-red-500 text-white rounded-md transition-all">
                    <i class="fas fa-trash-alt mr-2"></i> {{ __('Excluir Conta') }}
                </button>
            </div>
        </form>
    </x-modal>
</section>