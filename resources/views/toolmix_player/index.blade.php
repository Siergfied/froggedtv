<x-app-layout>
    @include('layouts.navigation.user_team')

    <div class="py-12">
        <div class="mx-auto max-w-7xl space-y-6 sm:px-6 lg:px-8">

            @if (!empty(Auth::user()->toolmixPlayer))
                <div class="bg-white p-4 shadow sm:rounded-lg sm:p-8">
                    <p>Ma recherche d'équipe</p>
                    <p>{{ Auth::user()->toolmixPlayer }}</p>
                    <p> {{ Auth::user()->mmr }} </p>
                </div>

                <div class='flex space-x-6'>
                    <x-button-link :href="route('toolmixPlayer.edit')">
                        {{ "Mettre à jour ma recherche d'équipe" }}
                    </x-button-link>

                    <x-danger-button x-data=""
                        x-on:click.prevent="$dispatch('open-modal', 'confirm-delete-toolmixPlayer')">
                        {{ "Supprimer ma recherche d'équipe" }}</x-danger-button>

                    <x-modal name="confirm-delete-toolmixPlayer" focusable>
                        <form method="POST" action="{{ route('toolmixPlayer.destroy') }}" class="p-6">
                            @csrf
                            @method('delete')

                            <h2 class="text-lg font-medium text-gray-900">
                                {{ "Etes vous sur de vouloir supprimer votre recherche d'équipe ?" }}
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
                <x-button-link :href="route('toolmixPlayer.create')">
                    {{ "Créer ma recherche d'équipe" }}
                </x-button-link>
            @endif

            @foreach ($players as $player)
                <div class="bg-white p-4 shadow sm:rounded-lg sm:p-8">
                    <p>{{ $player }} </p>
                    <p> {{ $player->user->mmr }} </p>
                </div>
            @endforeach

        </div>
    </div>

</x-app-layout>
