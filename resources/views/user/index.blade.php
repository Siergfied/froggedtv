<x-app-layout>
    @include('layouts.navigation.user_team')
    <div class="py-12">
        <div class="mx-auto max-w-7xl space-y-6 sm:px-6 lg:px-8">
            @foreach ($users as $user)
                <div class="bg-white shadow sm:rounded-lg sm:p-4">
                    @if (file_exists(public_path() . '/storage/user/avatar/user_' . $user->id . '.webp'))
                        <a href='{{ asset('storage/user/full/user_' . $user->id . '.webp') }}' target='_blank'>
                            <img src='{{ asset('storage/user/avatar/user_' . $user->id . '.webp') }}' width='50' height='50'>
                        </a>
                    @else
                        <p>AVATAR PLACEHOLDER</p>
                    @endif

                    <a href="{{ route('user.show', $user->id) }}">{{ $user->pseudo }}</a>
                    <a href="{{ $user->steam }}" target="_blank">Steam</a>
                    <p>{{ $user->team->name ?? '' }} </p>
                </div>
            @endforeach
        </div>
</x-app-layout>
