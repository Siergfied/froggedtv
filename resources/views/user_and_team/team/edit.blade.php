<x-app-layout>
    @include('user_and_team.navigation')
    <div class="py-12">
        <div class="mx-auto max-w-7xl space-y-6 sm:px-6 lg:px-8">
            <div class="bg-white p-4 shadow sm:rounded-lg sm:p-8">
                <form method="POST" action="{{ route('team.update', $team) }}" enctype="multipart/form-data">
                    @csrf
                    @method('patch')

                    <p>{{ $team }} </p>
                    
                    <div>
                        <x-input-label for='name' :value="__('Name')" />
                        <x-text-input id='name' class="mt-1 block w-full" type='text' name='name'
                            :value="old('name', $team->name)" />
                        <x-input-error :messages="$errors->get('name')" class="mt-2" />
                    </div>

                    <div>
                        <x-input-label for='tag' :value="__('Tag')" />
                        <x-text-input id='tag' class="mt-1 block w-full" type='text' name='tag'
                            :value="old('tag', $team->tag)" />
                        <x-input-error :messages="$errors->get('tag')" class="mt-2" />
                    </div>

                    <x-primary-button class="mt-4">{{ __('Modifier') }}</x-primary-button>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>