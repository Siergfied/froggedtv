<x-app-layout>
    <div class="py-12">
        <div class="mx-auto max-w-7xl space-y-6 sm:px-6 lg:px-8">
            <p>Categories</p>
            <form method="POST" action="{{ route('category.store') }}" enctype="multipart/form-data">
                @csrf
                <div>
                    <x-input-label for='title' :value="__('Title')" />
                    <x-text-input id='title' class="mt-1 block w-full" type='text' name='title'
                        :value="old('title')" />
                    <x-input-error :messages="$errors->get('title')" class="mt-2" />
                </div>
                <div>
                    <x-input-label for='icon' :value="__('Icon')" />
                    <x-text-input id='icon' class="mt-1 block w-full" type='text' name='icon'
                        :value="old('icon')" />
                    <x-input-error :messages="$errors->get('icon')" class="mt-2" />
                </div>
                <div>
                    <x-input-label for='description' :value="__('Description')" />
                    <textarea name="description" placeholder="{{ __('What\'s on your mind?') }}"
                        class="block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">{{ old('description') }}</textarea>
                    <x-input-error :messages="$errors->get('description')" class="mt-2" />
                </div>

                <x-primary-button class="mt-4">{{ __('Soumettre') }}</x-primary-button>
            </form>
        </div>
    </div>
</x-app-layout>
