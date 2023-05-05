<x-app-layout>
    @include('layouts.navigation.league')
    <div class="py-12">
        <div class="mx-auto max-w-7xl space-y-6 sm:px-6 lg:px-8">
            <div class="bg-white p-4 shadow sm:rounded-lg sm:p-8">
                <form method="POST" action="{{ route('league.store') }}" enctype="multipart/form-data">
                    @csrf

                    <div class="mt-4">
                        <x-input-label for='name' :value="__('Nom')" />
                        <x-text-input id='name' class="mt-1 block w-full" type='text' name='name'
                            :value="old('name')" />
                        <x-input-error :messages="$errors->get('name')" class="mt-2" />
                    </div>

                    <div class="mt-4">
                        <x-input-label for='date' :value="__('Date et heure de début des inscriptions')" />
                        <x-text-input id='date' class="mt-1 block w-full" type='datetime-local' name='date'
                            :value="old('date')" />
                        <x-input-error :messages="$errors->get('date')" class="mt-2" />
                    </div>

                    <div class="mt-4">
                        <x-input-label for='date' :value="__('Date et heure de fin des inscriptions')" />
                        <x-text-input id='date' class="mt-1 block w-full" type='datetime-local' name='date'
                            :value="old('date')" />
                        <x-input-error :messages="$errors->get('date')" class="mt-2" />
                    </div>

                    <div class="mt-4">
                        <x-input-label for='date' :value="__('Date de début des matchs')" />
                        <x-text-input id='date' class="mt-1 block w-full" type='date' name='date'
                            :value="old('date')" />
                        <x-input-error :messages="$errors->get('date')" class="mt-2" />
                    </div>

                    <x-primary-button class="mt-4">{{ __('Créer') }}</x-primary-button>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
