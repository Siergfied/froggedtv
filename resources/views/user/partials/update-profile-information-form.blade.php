<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900">
            {{ __('Information du profil') }}
        </h2>
    </header>

    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <form method="POST" action="{{ route('user.update', Auth::user()->id) }}" class="mt-6 space-y-6" enctype="multipart/form-data">
        @csrf
        @method('patch')

        <div>
            <x-input-label for="pseudo" :value="__('Pseudo')" />
            <x-text-input id="pseudo" name="pseudo" type="text" class="mt-1 block w-full" :value="old('pseudo', $user->pseudo)" required autofocus autocomplete="name" />
            <x-input-error class="mt-2" :messages="$errors->get('pseudo')" />
        </div>

        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" name="email" type="email" class="mt-1 block w-full" :value="old('email', $user->email)" required autocomplete="email" />
            <x-input-error class="mt-2" :messages="$errors->get('email')" />

            @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && !$user->hasVerifiedEmail())
                <div>
                    <p class="mt-2 text-sm text-gray-800">
                        {{ __('Your email address is unverified.') }}

                        <button form="send-verification"
                            class="rounded-md text-sm text-gray-600 underline hover:text-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
                            {{ __('Click here to re-send the verification email.') }}
                        </button>
                    </p>

                    @if (session('status') === 'verification-link-sent')
                        <p class="mt-2 text-sm font-medium text-green-600">
                            {{ __('A new verification link has been sent to your email address.') }}
                        </p>
                    @endif
                </div>
            @endif
        </div>

        <div>
            <x-input-label for='avatar' :value="__('Avatar')" />
            <input type='file' name='avatar'>
            <x-input-error :messages="$errors->get('avatar')" class="mt-2" />
            @if (file_exists(public_path() . '/storage/user/avatar/user_' . $user->id . '.webp'))
                <img src='{{ asset('storage/user/avatar/user_' . $user->id . '.webp') }}' width='200' height='200'>
            @else
                <p>AVATAR PLACEHOLDER</p>
            @endif
        </div>

        <div>
            <x-input-label for="description" :value="__('Description')" />
            <textarea id="description" name="description"
                class="mt-2 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">{{ old('description', $user->description) }}</textarea>
            <x-input-error class="mt-2" :messages="$errors->get('description')" />
        </div>

        <div>
            <x-input-label for="steam" :value="__('Steam')" />
            <x-text-input id="steam" name="steam" type="text" class="mt-1 block w-full" :value="old('steam', $user->steam)" autofocus autocomplete="name" />
            <x-input-error class="mt-2" :messages="$errors->get('steam')" />
        </div>

        <div>
            <x-input-label for="discord" :value="__('Discord')" />
            <x-text-input id="discord" name="discord" type="text" class="mt-1 block w-full" :value="old('discord', $user->discord)" autofocus autocomplete="name" />
            <x-input-error class="mt-2" :messages="$errors->get('discord')" />
        </div>

        <div>
            <x-input-label for="twitter" :value="__('Twitter')" />
            <x-text-input id="twitter" name="twitter" type="text" class="mt-1 block w-full" :value="old('twitter', $user->twitter)" autofocus autocomplete="name" />
            <x-input-error class="mt-2" :messages="$errors->get('twitter')" />
        </div>

        <div>
            <x-input-label for="mmr" :value="__('MMR')" />
            <x-text-input id="mmr" name="mmr" type="number" min="0" class="mt-1 block w-full" :value="old('mmr', $user->mmr)" autofocus
                autocomplete="name" />
            <x-input-error class="mt-2" :messages="$errors->get('mmr')" />
        </div>

        <div class="flex items-center gap-4">
            <x-primary-button>{{ __('Enregistrer') }}</x-primary-button>

            @if (session('status') === 'profile-updated')
                <p x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 2000)" class="text-sm text-gray-600">{{ __('Enregistré.') }}</p>
            @endif
        </div>
    </form>
</section>
