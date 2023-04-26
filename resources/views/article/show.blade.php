<x-app-layout>
    @include('article.navigation')
    <div class="py-12">
        <div class="mx-auto max-w-7xl space-y-6 sm:px-6 lg:px-8">
            <div class="bg-white p-4 shadow sm:rounded-lg sm:p-8">
                <p>title : {{ $article->title }} </p>
                <p>hook : {{ $article->hook }} </p>
                @if ($article->cover == null)
                    <img src='{{ asset('storage/placeholder/ftv.svg') }}' width='200' height='200'>
                @else
                    <img src='{{ asset('storage/' . $article->cover) }}' width='200' height='200'>
                @endif
                <p>user : {{ $article->user->pseudo }}</p>
            </div>
        </div>
    </div>
</x-app-layout>
