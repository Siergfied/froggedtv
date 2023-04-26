<x-app-layout>
    @include('user_and_team.navigation')
    <div class="py-12">
        <div class="mx-auto max-w-7xl space-y-6 sm:px-6 lg:px-8">
            @foreach ($teams as $team)
                <a href="{{ route('team.show', $team->id) }}" class='bg-white shadow sm:rounded-lg sm:p-4'>{{ $team->name }}</a>
            @endforeach
        </div>
</x-app-layout>
