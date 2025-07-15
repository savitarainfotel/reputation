<x-guest-layout>
    <div id="main-wrapper" class="auth-customizer-none">
        <div class="position-relative overflow-hidden radial-gradient min-vh-100 w-100">
            <div class="position-relative z-index-5">
                <div class="row">
                    <div class="col-lg-6 col-xxl-6 left-panel d-lg-flex d-none">
                        <x-auth-side :title="__('Welcome Back!')" :sub-title="__(
                            'Thousand of professionals Using the #1 AI CRM to monitor, manage and grow online trust.',
                        )" />
                    </div>
                    <div class="col-lg-6 col-xxl-6">
                        <div class="authentication-login min-vh-100 bg-body row justify-content-center align-items-center p-4">
                            <div class="auth-max-width col-sm-8 col-md-6 col-xl-7 px-4">
                                <div class="card p-3 border shadow-none">
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
                                </div>

                                <div class="text-justify mt-4">
                                    <p class="text-justify">
                                        @lang('Hotelxplore’s services are exclusively intended for companies and entrepreneurs (Unternehmer) as defined in § 14 of the German Civil Code (Bürgerliches Gesetzbuch, BGB)—that is, natural or legal persons or partnerships with legal capacity who are acting in the course of their commercial or independent professional activities. This offering is not directed at consumers (Verbraucher) as defined in § 13 BGB.')
                                    </p>
                                    <p class="text-justify">
                                        @lang('By creating an account, the user confirms that they have read and agree to')
                                        <a href="javascript:;" class="text-blue-dark">@lang('Hotelxplore’s General Terms')</a>
                                        @lang('and the') <a href="javascript:;" class="text-blue-dark">
                                            @lang('Data Processing Agreement')</a>.
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