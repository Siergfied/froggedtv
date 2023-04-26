<x-app-layout>
    @include('article.navigation')
    <div class="py-12">
        <div class="mx-auto max-w-7xl space-y-6 sm:px-6 lg:px-8">
            @include('category.index')
            @foreach ($articles as $article)
                <a href="{{ route('article.show', $article->slug) }}" class='p-4'>
                    <div class="bg-white shadow sm:rounded-lg sm:p-8">
                        <p>{{ $article }} </p>
                        @if ($article->cover == null)
                            <img src='{{ asset('storage/placeholder/ftv.svg') }}' width='200' height='200'>
                        @else
                            <img src='{{ asset('storage/' . $article->cover) }}' width='200' height='200'>
                        @endif
                        <div>
                            <p>title : {{ $article->title }} </p>
                            <p>hook : {{ $article->hook }} </p>
                            <p>user : {{ $article->user->pseudo }}</p>
                            @foreach ($article->category as $category)
                                <p>{{ $category }} </p>
                            @endforeach
                        </div>

                    </div>
                </a>
            @endforeach
        </div>
    </div>
</x-app-layout>
