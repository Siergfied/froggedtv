<x-app-layout>
    @include('layouts.navigation.user_team')

    <div class="py-12">
        <div class="mx-auto max-w-7xl space-y-6 sm:px-6 lg:px-8">

            @if (!empty(Auth::user()->team->toolmixTeam))
                <div class="bg-white p-4 shadow sm:rounded-lg sm:p-8">
                    <p>La recherche de joueurs de mon équipe</p>
                    <p>{{ Auth::user()->team->toolmixTeam }}</p>
                    <p>{{ Auth::user()->team->user->where('id', Auth::user()->team->captain_id)->first() }}</p>
                </div>
            @endif

            @if (Auth::user()->team->captain_id == Auth::user()->id)
                @if (!empty(Auth::user()->team->toolmixTeam))
                    <div class='flex space-x-6'>
                        <x-button-link :href="route('toolmixTeam.edit')">
                            {{ 'Mettre à jour ma recherche de joueurs' }}
                        </x-button-link>

                        <x-danger-button x-data=""
                            x-on:click.prevent="$dispatch('open-modal', 'confirm-delete-toolmixTeam')">
                            {{ 'Supprimer ma recherche de joueurs' }}</x-danger-button>

                        <x-modal name="confirm-delete-toolmixTeam" focusable>
                            <form method="POST" action="{{ route('toolmixTeam.destroy') }}" class="p-6">
                                @csrf
                                @method('delete')

                                <h2 class="text-lg font-medium text-gray-900">
                                    {{ 'Etes vous sur de vouloir supprimer votre recherche de joueurs ?' }}
                                </h2>

                                <div class="mt-6 flex justify-end">
                                    <x-secondary-button x-on:click="$dispatch('close')">
                                        {{ __('Annuler') }}
                                    </x-secondary-button>

                                    <x-danger-button class="ml-3">
                                        {{ __('Supprimer') }}
                                    </x-danger-button>
                                </div>
                            </form>
                        </x-modal>
                    </div>
                @else
                    <x-button-link :href="route('toolmixTeam.create')">
                        {{ 'Créer ma recherche de joueurs' }}
                    </x-button-link>
                @endif
            @endif

            @foreach ($teams as $team)
                <div class="bg-white p-4 shadow sm:rounded-lg sm:p-8">
                    <p>{{ $team }} </p>
                    <p>{{ $team->team->user->where('id', Auth::user()->team->captain_id)->first() }} </p>
                </div>
            @endforeach

        </div>
    </div>

</x-app-layout>
