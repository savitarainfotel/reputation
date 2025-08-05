<x-guest-layout>
    <h2 class="mb-4 fs-7 fw-bolder">@lang('Sign Up')</h2>
    <!-- Session Status -->
    <x-auth-session-status :status="session('status')" />

    <form method="POST" action="{{ route('register') }}">
        @csrf
        <div class="row">
            <!-- First Name -->
            <div class="col-md-6 ">
                <x-input-label for="first_name" :value="__('First Name')" />
                <div class="input-group">
                    <x-text-input id="first_name" type="text" name="first_name" placeholder="First Name"
                        :value="old('first_name')" required autofocus
                        autocomplete="first_name" />
                    <x-input-error :messages="$errors->get('first_name')" class="mt-2" />
                </div>
            </div>

            <!-- Last Name -->
            <div class="col-md-6">
                <x-input-label for="last_name" :value="__('Last Name')" />
                <div class="input-group">
                    <x-text-input id="last_name" type="text" name="last_name" placeholder="Last Name"
                        :value="old('last_name')" required autofocus
                        autocomplete="last_name" />
                    <x-input-error :messages="$errors->get('last_name')" class="mt-2" />
                </div>

            </div>
        </div>

        <!-- Email Address -->
        <div class="mb-3">
            <x-input-label for="email" :value="__('Email Address')" />
            <div class="input-group">
                <span class="input-group-text  border-end-0">
                    <img src="{{ asset('assets/images/svg/email.svg') }}"
                        class="icon">
                </span>
                <x-text-input id="email" class="border-start-0 text-dark"
                    type="email" name="email" :value="old('email')" placeholder="abc@gmail.com" required autofocus
                    autocomplete="username" />
            </div>
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <div class="row mb-3">
            <div class="col-md-6">
                <x-input-label for="password" :value="__('Password')" />
                <div class="input-group">
                    <span class="input-group-text border-end-0">
                        <img src="{{ asset('assets/images/svg/lock.svg') }}"
                            class="icon">
                    </span>
                    <x-text-input id="password" class="border-start-0 text-dark"
                        type="password" name="password" placeholder="********" required
                        autocomplete="password" />
                </div>
                <x-input-error :messages="$errors->get('password')" class="mt-2" />
            </div>
            <div class="col-md-6">
                <x-input-label for="password_confirmation" :value="__('Confirm Password')" />
                <div class="input-group">
                    <span class="input-group-text border-end-0">
                        <img src="{{ asset('assets/images/svg/lock.svg') }}" class="icon" />
                    </span>
                    <x-text-input id="password_confirmation"
                        class="border-start-0 text-dark" type="password"
                        name="password_confirmation" placeholder="********" required
                        autocomplete="password_confirmation" />
                </div>
                <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
            </div>
        </div>

        <x-secondary-button class="w-100 py-8 mt-3 rounded-2">
            {{ __('Try For Free') }}
        </x-secondary-button>

        <div class="d-flex align-items-center justify-content-center mt-2">
            <p class="fs-4 mb-0 fw-medium">@lang('If you already have an account,')</p>
            <a class="text-blue-dark fw-medium ms-2"
                href="{{ route('login') }}">@lang('log in instead')</a>
        </div>
    </form>
</x-guest-layout>