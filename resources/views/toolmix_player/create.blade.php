<x-app-layout>
    @include('layouts.navigation.user_team')

    <div class="py-12">
        <div class="mx-auto max-w-7xl space-y-6 sm:px-6 lg:px-8">
            <div class="bg-white p-4 shadow sm:rounded-lg sm:p-8">
                <form method="POST" action="{{ route('toolmixPlayer.store') }}">
                    @csrf

                    <fieldset>
                        <legend>Quels sont les rôles que vous pouvez jouer ?</legend>

                        <input id="safe_lane" type="checkbox"
                            class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500"
                            name="safe_lane" value='true'>
                        <label for="safe_lane" class="inline-flex items-center">Safelane
                        </label><br>

                        <input id="mid_lane" type="checkbox"
                            class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500"
                            name="mid_lane" value='true'>
                        <label for="mid_lane" class="inline-flex items-center">Midlane
                        </label><br>

                        <input id="off_lane" type="checkbox"
                            class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500"
                            name="off_lane" value='true'>
                        <label for="off_lane" class="inline-flex items-center">Offlane
                        </label><br>

                        <input id="soft_support" type="checkbox"
                            class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500"
                            name="soft_support" value='true'>
                        <label for="soft_support" class="inline-flex items-center">Soft Support
                        </label><br>

                        <input id="hard_support" type="checkbox"
                            class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500"
                            name="hard_support" value='true'>
                        <label for="hard_support" class="inline-flex items-center">Hard Support
                        </label><br>

                    </fieldset>

                    <x-primary-button class="mt-4">{{ __('Créer') }}
                    </x-primary-button>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
