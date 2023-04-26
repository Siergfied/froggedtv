<x-app-layout>
    @include('user_and_team.navigation')
    <div class="py-12">
        <div class="mx-auto max-w-7xl space-y-6 sm:px-6 lg:px-8">
            <div class="bg-white shadow sm:rounded-lg sm:p-8">
                <p> {{ $team }} </p>
            </div>

            @foreach ($users as $user)
                <div class="flex justify-between bg-white shadow sm:rounded-lg sm:p-8">
                    @if ($user->id == $team->captain_id)
                        <p>Captain</p>
                    @endif
                    @if ($user->id == $team->vice_captain_id)
                        <p>Vice Captain</p>
                    @endif
                    @if ($user->id == $team->coach_id)
                        <p>Coach</p>
                    @endif

                    <p> {{ $user->pseudo }} </p>

                    @if (Auth::user()->id == $team->captain_id)
                        <div>
                            @if ($user->id != $team->captain_id)
                                @include('user_and_team.team.partials.update-captain')

                                @if ($user->id == $team->vice_captain_id)
                                    <x-button-link :href="route('team.removeViceCaptain', $user)">
                                        {{ 'Limoger Vice Captain' }}
                                    </x-button-link>
                                @else
                                    <x-button-link :href="route('team.updateViceCaptain', $user)">
                                        {{ 'Nommer Vice Captain' }}
                                    </x-button-link>
                                @endif
                            @endif

                            @if ($user->id == $team->coach_id)
                                <x-button-link :href="route('team.removeCoach', $user)">
                                    {{ 'Limoger Coach' }}
                                </x-button-link>
                            @else
                                <x-button-link :href="route('team.updateCoach', $user)">
                                    {{ 'Nommer Coach' }}
                                </x-button-link>
                            @endif

                            @if ($user->id != $team->captain_id)
                                @include('user_and_team.team.partials.kick-user')
                            @endif
                        </div>
                    @endif
                </div>
            @endforeach

            @if (Auth::user()->id == $team->captain_id)
                <x-button-link :href="route('team.edit', $team)">
                    {{ "Editer l'équipe" }}
                </x-button-link>
            @endif

            @include('user_and_team.team.partials.join-team')

            @include('user_and_team.team.partials.leave-team')

            @foreach ($events as $event)
                <p>{{ $event }} </p>
            @endforeach

        </div>
</x-app-layout>
