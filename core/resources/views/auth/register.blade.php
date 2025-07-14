<x-guest-layout>
    <div id="main-wrapper" class="auth-customizer-none">
        <div class="position-relative overflow-hidden radial-gradient min-vh-100 w-100">
            <div class="position-relative z-index-5">
                <div class="row">
                    <div class="col-xl-6 col-xxl-6 left-panel">
                        <x-auth-side :title="__('Welcome Back!')" :sub-title="__('Join the #1 CRM designed to boost your brand\'s credibility and visibility.')" />
                    </div>
                    <div class="col-xl-6 col-xxl-6">
                        <div class="authentication-login min-vh-100 bg-body row justify-content-center align-items-center p-4">
                            <div class="auth-max-width col-sm-8 col-md-6 col-xl-7 px-4">
                                <h2 class="mb-4 fs-7 fw-bolder">@lang('Sign Up')</h2>
                                <!-- Session Status -->
                                <x-auth-session-status :status="session('status')" />

                                <form method="POST" action="{{ route('register') }}">
                                    @csrf

                                    <div class="row">
                                        <!-- First Name -->
                                        <div class="col-md-6">
                                            <x-input-label for="first_name" :value="__('First Name')" />
                                            <x-text-input id="first_name" type="text" name="first_name" :value="old('first_name')" required autofocus autocomplete="first_name" />
                                            <x-input-error :messages="$errors->get('first_name')" class="mt-2" />
                                        </div>

                                        <!-- Last Name -->
                                        <div class="col-md-6">
                                            <x-input-label for="last_name" :value="__('Last Name')" />
                                            <x-text-input id="last_name" type="text" name="last_name" :value="old('last_name')" required autofocus autocomplete="last_name" />
                                            <x-input-error :messages="$errors->get('last_name')" class="mt-2" />
                                        </div>
                                    </div>

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

                                    <div class="row mb-3">
                                        <!-- First Name -->
                                        <div class="col-md-6">
                                            <x-input-label for="password" :value="__('Password')" />
                                            <div class="input-group">
                                                <span class="input-group-text border-end-0">
                                                    <img src="{{ asset('assets/images/svg/lock.svg') }}" class="icon">
                                                </span>
                                                <x-text-input id="password" class="border-start-0 text-dark" type="password" name="password" placeholder="********" required autocomplete="password" />
                                            </div>
                                            <x-input-error :messages="$errors->get('password')" class="mt-2" />
                                        </div>

                                        <!-- Last Name -->
                                        <div class="col-md-6">
                                            <x-input-label for="password_confirmation" :value="__('Confirm Password')" />
                                            <div class="input-group">
                                                <span class="input-group-text border-end-0">
                                                    <img src="{{ asset('assets/images/svg/lock.svg') }}" class="icon">
                                                </span>
                                                <x-text-input id="password_confirmation" class="border-start-0 text-dark" type="password" name="password_confirmation" placeholder="********" required autocomplete="password_confirmation" />
                                            </div>
                                            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                                        </div>
                                    </div>

                                    <x-primary-button class="w-100 py-8 mt-3 rounded-2">
                                        {{ __('Try For Free') }}
                                    </x-primary-button>

                                    <div class="d-flex align-items-center justify-content-center mt-2">
                                        <p class="fs-4 mb-0 fw-medium">@lang('If you already have an account,')</p>
                                        <a class="text-blue-dark fw-medium ms-2" href="{{ route('login') }}">@lang('log in instead')</a>.
                                    </div>
                                </form>
                                <div class="text-justify mt-4">
                                    <p class="text-justify">
                                        @lang('Hotelxplore’s services are exclusively intended for companies and entrepreneurs (Unternehmer) as defined in § 14 of the German Civil Code (Bürgerliches Gesetzbuch, BGB)—that is, natural or legal persons or partnerships with legal capacity who are acting in the course of their commercial or independent professional activities. This offering is not directed at consumers (Verbraucher) as defined in § 13 BGB.')
                                    </p>
                                    <p class="text-justify">
                                        @lang('By creating an account, the user confirms that they have read and agree to')
                                        <a href="javascript:;" class="text-blue-dark">@lang('Hotelxplore’s General Terms')</a> @lang('and the') <a href="javascript:;" class="text-blue-dark"> @lang('Data Processing Agreement')</a>.
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-guest-layout>