<x-slot name="header">
    <nav class="flex font-semibold leading-tight text-gray-800">
        <div>
            <x-nav-link :href="route('user.show', Auth::user()->id)" :active="request()->is('user/' . Auth::user()->id)">
                {{ __('Mon profil') }}
            </x-nav-link>
            <x-nav-link :href="route('user.index')" :active="request()->routeIs('user.index')">
                {{ __('Liste des joueurs') }}
            </x-nav-link>
            <x-nav-link :href="route('toolmixPlayer.index')" :active="request()->routeIs('toolmixPlayer.*')">
                {{ __('Toolmix des joueurs') }}
            </x-nav-link>
        </div>

        <div>
            <p>|</p>
        </div>

        <div>
            @if (Auth::user()->team == null)
                <x-nav-link :href="route('team.create')" :active="request()->routeIs('team.create')">
                    {{ __('Créer une équipe') }}
                </x-nav-link>
            @else
                <x-nav-link :href="route('team.show', Auth::user()->team)" :active="request()->is('team/' . Auth::user()->team_id)">
                    {{ __('Mon équipe') }}
                </x-nav-link>
            @endif
            <x-nav-link :href="route('team.index')" :active="request()->routeIs('team.index')">
                {{ __('Liste des équipes') }}
            </x-nav-link>
            <x-nav-link :href="route('toolmixTeam.index')" :active="request()->routeIs('toolmixTeam.*')">
                {{ __('Toolmix des équipes') }}
            </x-nav-link>
        </div>

    </nav>
</x-slot>
