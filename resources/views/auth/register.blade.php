<x-app-layout>

    <div class="mx-auto mt-8 max-w-2xl bg-white p-4 sm:p-6 lg:p-10">
        <!-- Session Status -->
        <x-auth-session-status class="mb-4" :status="session('status')" />

        <div>
            <x-nav-link :href="route('login')" :active="request()->routeIs('login')">
                {{ __('Connexion') }}
            </x-nav-link>

            <x-nav-link :href="route('register')" :active="request()->routeIs('register')">
                {{ __("S'inscrire") }}
            </x-nav-link>
        </div>

        <form method="POST" action="{{ route('register') }}">
            @csrf

            <!-- Pseudo -->
            <div>
                <x-input-label for="pseudo" :value="__('Pseudo')" />
                <x-text-input id="pseudo" class="mt-1 block w-full" type="text" name="pseudo" :value="old('pseudo')" required autofocus autocomplete="pseudo" />
                <x-input-error :messages="$errors->get('pseudo')" class="mt-2" />
            </div>

            <!-- Email Address -->
            <div class="mt-4">
                <x-input-label for="email" :value="__('Email')" />
                <x-text-input id="email" class="mt-1 block w-full" type="email" name="email" :value="old('email')" required autocomplete="username" />
                <x-input-error :messages="$errors->get('email')" class="mt-2" />
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

            <div class="mt-4 flex items-center justify-end">
                <a class="rounded-md text-sm text-gray-600 underline hover:text-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2"
                    href="{{ route('login') }}">
                    {{ __('Already registered?') }}
                </a>

                <x-primary-button class="ml-4">
                    {{ __('Register') }}
                </x-primary-button>
            </div>
        </form>
    </div>
</x-app-layout>
