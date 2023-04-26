<x-danger-button x-data="" x-on:click.prevent="$dispatch('open-modal', 'confirm-kick-user')">
    {{ __('Virer le joueur') }}</x-danger-button>

<x-modal name="confirm-kick-user" focusable>
    <form method="post" action="{{ route('team.kick', $user) }}" class="p-6">
        @csrf
        @method('post')

        <h2 class="text-lg font-medium text-gray-900">
            {{ __('Etes vous sur de vouloir virer ') . $user->pseudo . ' ?' }}
        </h2>

        <div class="mt-6 flex justify-end">
            <x-secondary-button x-on:click="$dispatch('close')">
                {{ __('Annuler') }}
            </x-secondary-button>

            <x-danger-button class="ml-3">
                {{ __('Virer le joueur') }}
            </x-danger-button>
        </div>
    </form>
</x-modal>
