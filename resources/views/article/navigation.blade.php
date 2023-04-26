<x-slot name="header">
    <nav class="text-xl font-semibold leading-tight text-gray-800">
        <x-nav-link :href="route('article.index')" :active="request()->routeIs('article.index')">
            {{ __('Tous les articles') }}
        </x-nav-link>
        <x-nav-link :href="route('article.user')" :active="request()->routeIs('article.user')">
            {{ __('Mes articles') }}
        </x-nav-link>
        <x-nav-link :href="route('article.create')" :active="request()->routeIs('article.create')">
            {{ __('Proposer un article') }}
        </x-nav-link>
    </nav>
</x-slot>
