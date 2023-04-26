<x-app-layout>
    @include('article.navigation')
    <div class="py-12">
        <div class="mx-auto max-w-7xl space-y-6 sm:px-6 lg:px-8">
            @foreach ($articles as $article)
                <div class="bg-white p-4 shadow sm:rounded-lg sm:p-8">
                    <p>{{ $article->title }} </p>
                    <p>{{ $article->content }} </p>
                    @if ($article->cover == null)
                        <img src='{{ asset('storage/placeholder/ftv.svg') }}' width='200' height='200'>
                    @else
                        <img src='{{ asset('storage/' . $article->cover) }}' width='200' height='200'>
                    @endif
                    <a href="{{ route('article.edit', $article) }}">{{ __('Edit') }}</a>
                    <p>{{ $article }} </p>
                </div>
            @endforeach
        </div>
    </div>
</x-app-layout>
