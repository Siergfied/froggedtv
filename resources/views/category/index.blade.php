<div class="bg-white shadow sm:rounded-lg sm:p-8">
    @foreach ($categories as $category)
        <a href="{{ route('article.category', $category->slug) }}" class='p-4'>
            <p>{{ $category->title }} </p>
            <p>{{ $category }} </p>
        </a>
    @endforeach
</div>
