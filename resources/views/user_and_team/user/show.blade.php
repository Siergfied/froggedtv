<x-app-layout>
    @include('user_and_team.navigation')
    <div class="py-12">
        <div class="mx-auto max-w-7xl space-y-6 sm:px-6 lg:px-8">
            <div class="bg-white shadow sm:rounded-lg sm:p-8">
                <p>Pseudo : {{ $user->pseudo }} </p>
                <p>Date : Inscrit depuis le {{ \Carbon\Carbon::parse($user->created_at)->format('d/m/Y') }} </p>
                <p>Description : {{ $user->description }} </p>
                <p>Steam : <a href='{{ $user->steam }}'>Lien</a></p>
                <p>Discord :{{ $user->discord }} </p>
                <p>Twitter : {{ $user->twitter }} </p>
                <p>MMR : {{ $user->mmr }} </p>
            </div>

            @if (Auth::user()->id == $user->id)
                <x-button-link :href="route('user.edit', $user)">
                    {{ 'Editer mon profil' }}
                </x-button-link>
            @endif
        </div>

        @push('script')
            <script>
                console.log('test');
            </script>
        @endpush
</x-app-layout>
