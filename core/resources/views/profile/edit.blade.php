<x-app-layout>
    <x-slot name="header">
        <h2 class="mt-2 ms-1">
            {{ __('Profile') }}
        </h2>
    </x-slot>

    <div class="row">
        <div class="col-md-6">
            @include('profile.partials.update-profile-information-form')
        </div>
        <div class="col-md-6">
            @include('profile.partials.update-password-form')
        </div>
    </div>
</x-app-layout>