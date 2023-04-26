<x-primary-button x-data="" x-on:click.prevent="$dispatch('open-modal', 'confirm-update-captain')">
    {{ __('Nommer capitaine') }}</x-primary-button>

<x-modal name="confirm-update-captain" focusable>
    <form method="post" action="{{ route('team.updateCaptain', $user) }}" class="p-6">
        @csrf
        @method('patch')

        <h2 class="text-lg font-medium text-gray-900">
            {{ __('Etes vous sur de vouloir transmettre le capitanat à ') . $user->pseudo . ' ?' }}
        </h2>

        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" />
            <x-text-input id="password" class="mt-1 block w-full" type="password" name="password" required autocomplete="current-password" />
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <div class="mt-6 flex justify-end">
            <x-secondary-button x-on:click="$dispatch('close')">
                {{ __('Annuler') }}
            </x-secondary-button>

            <x-primary-button class="ml-3">
                {{ __('Nommer capitaine') }}
            </x-primary-button>
        </div>
    </form>
</x-modal>
