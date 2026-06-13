<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-dark-900 leading-tight">Profile</h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8 space-y-6">
            <div class="bg-white rounded-xl shadow-sm border border-dark-200 p-6">
                @include('profile.partials.update-profile-information-form')
            </div>

            <div class="bg-white rounded-xl shadow-sm border border-dark-200 p-6">
                @include('profile.partials.update-password-form')
            </div>

            <div class="bg-white rounded-xl shadow-sm border border-dark-200 p-6">
                @include('profile.partials.delete-user-form')
            </div>
        </div>
    </div>
</x-app-layout>
