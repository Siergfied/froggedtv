<x-app-layout>
    @include('article.navigation')

    <div class="py-12">
        <div class="mx-auto max-w-7xl space-y-6 sm:px-6 lg:px-8">
            <div class="bg-white p-4 shadow sm:rounded-lg sm:p-8">
                <form method="POST" action="{{ route('article.store') }}" enctype="multipart/form-data">
                    @csrf
                    <div>
                        <x-input-label for='title' :value="__('Title')" />
                        <x-text-input id='title' class="mt-1 block w-full" type='text' name='title'
                            :value="old('title')" />
                        <x-input-error :messages="$errors->get('title')" class="mt-2" />
                    </div>
                    <div>
                        <x-input-label for='category' :value="__('Category')" />
                        <select multiple class="mt-1 block w-full" name='category[]' id='category'>
                            @foreach ($categories as $category)
                                <option value='{{ $category->id }}' @selected(in_array($category->id, old('category') ?: []))>
                                    {{ $category->title }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <x-input-label for='cover' :value="__('Cover')" />
                        <input type='file' name='cover'>
                        <x-input-error :messages="$errors->get('cover')" class="mt-2" />
                    </div>
                    <div>
                        <x-input-label for='hook' :value="__('Hook')" />
                        <textarea name="hook" placeholder="{{ __('What\'s on your mind?') }}"
                            class="block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">{{ old('hook') }}</textarea>
                        <x-input-error :messages="$errors->get('hook')" class="mt-2" />
                    </div>
                    <div>
                        <x-input-label for='content' :value="__('Content')" />
                        <textarea name="content" placeholder="{{ __('What\'s on your mind?') }}"
                            class="block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">{{ old('content') }}</textarea>
                        <x-input-error :messages="$errors->get('message')" class="mt-2" />
                    </div>

                    <x-primary-button class="mt-4">{{ __('Soumettre') }}</x-primary-button>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
