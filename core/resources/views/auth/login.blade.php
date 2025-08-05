<x-guest-layout>
    <h2 class="mb-4 fs-7 fw-bolder">@lang('Sign In')</h2>
    <!-- Session Status -->
    <x-auth-session-status :status="session('status')" />

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <!-- Email Address -->
        <div class="mb-3">
            <x-input-label for="email" :value="__('Email Address')" />
            <div class="input-group">
                <span class="input-group-text  border-end-0">
                    <img src="{{ asset('assets/images/svg/email.svg') }}"
                        class="icon">
                </span>
                <x-text-input id="email" class="border-start-0 text-dark"
                    type="email" name="email" :value="old('email')"
                    placeholder="abc@gmail.com" required autofocus
                    autocomplete="username" />
            </div>
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mb-3">
            <x-input-label for="password" :value="__('Password')" />
            <div class="input-group">
                <span class="input-group-text border-end-0">
                    <img src="{{ asset('assets/images/svg/lock.svg') }}" class="icon">
                </span>
                <x-text-input id="password" class="border-start-0 text-dark"
                    type="password" name="password" placeholder="********" required
                    autocomplete="current-password" />
            </div>
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Remember Me -->
        <div class="d-flex align-items-end justify-content-end mb-4">
            @if (Route::has('password.request'))
                <a class="fw-medium fs-3"
                    href="{{ route('password.request') }}">{{ __('Forgot your password?') }}</a>
            @endif
        </div>

        <x-secondary-button class="w-100 py-8 mb-4 rounded-2">
            {{ __('Log in') }}
        </x-secondary-button>

        <div class="d-flex align-items-center justify-content-center">
            <p class="fs-4 mb-0 fw-medium">@lang('No account yet')?</p>
            <a class="text-blue-dark fw-medium ms-2"
                href="{{ route('register') }}">@lang('Sign up instead')</a>
        </div>
    </form>
</x-guest-layout>