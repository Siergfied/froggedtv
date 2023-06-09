<x-app-layout>
    @include('layouts.navigation.user_team')

    <div class="py-12">
        <div class="mx-auto max-w-7xl space-y-6 sm:px-6 lg:px-8">
            <div class="bg-white p-4 shadow sm:rounded-lg sm:p-8">
                <form method="POST" action="{{ route('toolmixPlayer.store') }}">
                    @csrf

                    <fieldset>
                        <legend class='block text-sm font-medium text-gray-700'>Quels sont les rôles que vous pouvez
                            jouer ?</legend>

                        <input id="safe_lane" type="checkbox"
                            class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500"
                            name="role[safe_lane]">
                        <label for="safe_lane" class="inline-flex items-center">Safelane
                        </label>

                        <input id="mid_lane" type="checkbox"
                            class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500"
                            name="role[mid_lane]">
                        <label for="mid_lane" class="inline-flex items-center">Midlane
                        </label>

                        <input id="off_lane" type="checkbox"
                            class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500"
                            name="role[off_lane]">
                        <label for="off_lane" class="inline-flex items-center">Offlane
                        </label>

                        <input id="soft_support" type="checkbox"
                            class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500"
                            name="role[soft_support]">
                        <label for="soft_support" class="inline-flex items-center">Soft Support
                        </label>

                        <input id="hard_support" type="checkbox"
                            class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500"
                            name="role[hard_support]">
                        <label for="hard_support" class="inline-flex items-center">Hard Support
                        </label>

                    </fieldset>

                    <div>
                        <x-input-label for="commentaire" :value="__('Commentaire')" />
                        <textarea id="commentaire" name="commentaire"
                            class="mt-2 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">{{ old('commentaire') }}</textarea>
                        <x-input-error class="mt-2" :messages="$errors->get('commentaire')" />
                    </div>

                    <x-primary-button class="mt-4">{{ __('Créer') }}
                    </x-primary-button>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
