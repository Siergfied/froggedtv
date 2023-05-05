<nav x-data="{ open: false }" class="sticky top-0 z-50 border-b border-gray-400 bg-white">
    <!-- Primary Navigation Menu -->
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
        <div class="flex h-16 justify-between">
            <div class="flex">
                <!-- Logo -->
                <div class="flex shrink-0 items-center">
                    <a href="/">
                        <x-application-logo class="block h-9 w-auto fill-current text-gray-800" />
                    </a>
                </div>

                <!-- Navigation Links -->
                <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
                    <x-nav-link :href="route('article.index')" :active="request()->routeIs('article.*')">
                        {{ __('Articles') }}
                    </x-nav-link>
                    <x-nav-link :href="route('category.create')" :active="request()->routeIs('category.*')">
                        {{ __('Category') }}
                    </x-nav-link>
                    <x-nav-link :href="route('calendrier.index')" :active="request()->routeIs('calendrier.*')">
                        {{ __('Calendrier') }}
                    </x-nav-link>
                    <x-nav-link :href="route('league.index')" :active="request()->routeIs('league.*')">
                        {{ __('League') }}
                    </x-nav-link>
                    <x-nav-link :href="route('user.index')" :active="request()->routeIs('user.*') ||
                        request()->routeIs('team.*') ||
                        request()->routeIs('toolmixPlayer.*')">
                        {{ __('Joueurs & Équipes') }}
                    </x-nav-link>
                    <x-nav-link :href="route('category.create')" :active="request()->routeIs('category.*')">
                        {{ __('Staff') }}
                    </x-nav-link>
                </div>
            </div>

            <!-- Settings Dropdown -->
            <div class="hidden sm:ml-6 sm:flex sm:items-center">
                @if (Route::has('login'))
                    <div>
                        @auth
                            <x-dropdown align="right" width="48">
                                <x-slot name="trigger">
                                    <button
                                        class="inline-flex items-center rounded-md border border-transparent bg-white px-3 py-2 text-sm font-medium leading-4 text-gray-500 transition duration-150 ease-in-out hover:text-gray-700 focus:outline-none">
                                        <div>{{ Auth::user()->pseudo }}</div>

                                        <div class="ml-1">
                                            <svg class="h-4 w-4 fill-current" xmlns="http://www.w3.org/2000/svg"
                                                viewBox="0 0 20 20">
                                                <path fill-rule="evenodd"
                                                    d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                                    clip-rule="evenodd" />
                                            </svg>
                                        </div>
                                    </button>
                                </x-slot>

                                <x-slot name="content">
                                    <x-dropdown-link :href="route('user.show', Auth::user()->id)">
                                        {{ __('Mon profil') }}
                                    </x-dropdown-link>
                                    <x-dropdown-link :href="route('user.show', Auth::user()->id)">
                                        {{ __('Mon équipe') }}
                                    </x-dropdown-link>
                                    <x-dropdown-link :href="route('user.show', Auth::user()->id)">
                                        {{ __('Mes matches') }}
                                    </x-dropdown-link>
                                    <x-dropdown-link :href="route('user.show', Auth::user()->id)">
                                        {{ __('Mes articles') }}
                                    </x-dropdown-link>

                                    <!-- Authentication -->
                                    <form method="POST" action="{{ route('logout') }}">
                                        @csrf

                                        <x-dropdown-link :href="route('logout')"
                                            onclick="event.preventDefault();
                                                        this.closest('form').submit();">
                                            {{ __('Deconnexion') }}
                                        </x-dropdown-link>
                                    </form>
                                </x-slot>
                            </x-dropdown>
                        @else
                            <a href="{{ route('login') }}"
                                class="inline-flex items-center rounded-md border border-transparent bg-white px-3 py-2 text-sm font-medium leading-4 text-gray-500 transition duration-150 ease-in-out hover:text-gray-700 focus:outline-none">Connexion</a>
                        @endauth
                    </div>
                @endif
            </div>

        </div>
</nav>
