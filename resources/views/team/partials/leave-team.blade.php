@if (Auth::user()->team == $team)
    <x-danger-button x-data="" x-on:click.prevent="$dispatch('open-modal', 'confirm-leave-team')">
        {{ __("Quitter l'équipe") }}</x-danger-button>

    <x-modal name="confirm-leave-team" focusable>
        <form method="post" action="{{ route('team.leave', $team) }}" class="p-6">
            @csrf
            @method('post')

            <h2 class="text-lg font-medium text-gray-900">
                {{ __("Etes vous sur de vouloir quitter l'équipe ?") }}
            </h2>

            <div class="mt-6 flex justify-end">
                <x-secondary-button x-on:click="$dispatch('close')">
                    {{ __('Annuler') }}
                </x-secondary-button>

                <x-danger-button class="ml-3">
                    {{ __("Quitter l'équipe") }}
                </x-danger-button>
            </div>
        </form>
    </x-modal>
@endif
