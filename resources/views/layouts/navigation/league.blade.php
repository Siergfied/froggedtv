<x-slot name="header">
    <nav class="flex font-semibold leading-tight text-gray-800">
        <div>
            <x-nav-link :href="route('league.index')" :active="request()->routeIs('league.index')">
                {{ __('Leagues') }}
            </x-nav-link>
            <x-nav-link :href="route('league.create')" :active="request()->routeIs('league.create')">
                {{ __('Créer une league') }}
            </x-nav-link>
        </div>
    </nav>
</x-slot>
