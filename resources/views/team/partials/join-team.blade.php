@if (Auth::user()->team == null)
    <x-primary-button x-data="" x-on:click.prevent="$dispatch('open-modal', 'confirm-join-team')">
        {{ __("Rejoindre l'équipe") }}</x-primary-button>

    <x-modal name="confirm-join-team" focusable>
        <form method="post" action="{{ route('team.join', $team) }}" class="p-6">
            @csrf
            @method('post')

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
                    {{ __("Rejoindre l'équipe") }}
                </x-primary-button>
            </div>
        </form>
    </x-modal>
@endif
