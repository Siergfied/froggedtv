<x-app-layout>
    @include('user_and_team.navigation')
    <div class="py-12">
        <div class="mx-auto max-w-7xl space-y-6 sm:px-6 lg:px-8">
            <div class="bg-white p-4 shadow sm:rounded-lg sm:p-8">
                <form method="POST" action="{{ route('team.store') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="mt-4">
                        <x-input-label for='name' :value="__('Name')" />
                        <x-text-input id='name' class="mt-1 block w-full" type='text' name='name' :value="old('name')" />
                        <x-input-error :messages="$errors->get('name')" class="mt-2" />
                    </div>

                    <div class="mt-4">
                        <x-input-label for='tag' :value="__('Tag')" />
                        <x-text-input id='tag' class="mt-1 block w-full" type='text' name='tag' :value="old('tag')" />
                        <x-input-error :messages="$errors->get('tag')" class="mt-2" />
                    </div>

                    <!-- Password -->
                    <div class="mt-4">
                        <x-input-label for="password" :value="__('Password')" />

                        <x-text-input id="password" class="mt-1 block w-full" type="password" name="password" required autocomplete="new-password" />

                        <x-input-error :messages="$errors->get('password')" class="mt-2" />
                    </div>

                    <!-- Confirm Password -->
                    <div class="mt-4">
                        <x-input-label for="password_confirmation" :value="__('Confirm Password')" />

                        <x-text-input id="password_confirmation" class="mt-1 block w-full" type="password" name="password_confirmation" required
                            autocomplete="new-password" />

                        <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                    </div>

                    <x-primary-button class="mt-4">{{ __('Créer') }}</x-primary-button>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
