<x-app-layout>
    <div class="py-12">
        <div class="mx-auto max-w-7xl space-y-6 sm:px-6 lg:px-8">
            <div class="bg-white p-4 shadow sm:rounded-lg sm:p-8">
                <div class="max-w-xl">
                    @include('user.partials.update-profile-information-form')
                </div>
            </div>

            <div class="bg-white p-4 shadow sm:rounded-lg sm:p-8">
                <div class="max-w-xl">
                    @include('user.partials.update-password-form')
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
