<x-guest-layout>
    <h2 class="mb-4 fs-7 fw-bolder">@lang('Reset your password')</h2>
    <!-- Session Status -->
    <x-auth-session-status :status="session('status')" />

    <form method="POST" action="{{ route('password.email') }}">
        @csrf

        <!-- Email Address -->
        <div class="mb-3">
            <x-input-label for="email" :value="__('Email Address')" />
            <div class="input-group">
                <span class="input-group-text  border-end-0">
                    <img src="{{ asset('assets/images/svg/email.svg') }}" class="icon">
                </span>
                <x-text-input id="email" class="border-start-0 text-dark" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
            </div>
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <x-secondary-button class="w-100 py-8 mt-2 rounded-2">
            {{ __('Send Verification Code') }}
        </x-secondary-button>
    </form>
</x-guest-layout>