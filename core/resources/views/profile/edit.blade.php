<x-app-layout>
    <div class="row">
        <div class="col-md-6 col-12">
            @include('profile.partials.update-profile-information-form')
        </div>
        <div class="col-md-6 col-12">
            @include('profile.partials.update-password-form')
        </div>
    </div>
</x-app-layout>