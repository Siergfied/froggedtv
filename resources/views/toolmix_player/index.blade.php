<x-app-layout>
    @include('layouts.navigation.user_team')

    <div class="py-12">
        <div class="mx-auto max-w-7xl space-y-6 sm:px-6 lg:px-8">
            <x-button-link :href="route('toolmixPlayer.create')">
                {{ 'Mettre à jour ma recherche' }}
            </x-button-link>

            <div class="bg-white p-4 shadow sm:rounded-lg sm:p-8">
                <p>Index</p>
            </div>
        </div>
    </div>

</x-app-layout>
