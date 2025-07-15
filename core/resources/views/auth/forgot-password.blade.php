<x-guest-layout>
    <div id="main-wrapper" class="auth-customizer-none">
        <div class="position-relative overflow-hidden radial-gradient min-vh-100 w-100">
            <div class="position-relative z-index-5">
                <div class="row">
                    <div class="col-xl-6 col-xxl-6 left-panel">
                        <x-auth-side :title="__('Welcome Back!')" :sub-title="__(
                            'Thousand of professionals Using the #1 AI CRM to monitor, manage and grow online trust.',
                        )" />
                    </div>
                    <div class="col-xl-6 col-xxl-6">
                        <div
                            class="authentication-login min-vh-100 bg-body row justify-content-center align-items-center p-4">
                            <div class="auth-max-width col-sm-8 col-md-6 col-xl-7 ">
                                <div class="card p-3 border shadow-none">
                                    <h2 class="mb-4 fs-7 fw-bolder text-center">@lang('Reset your password')</h2>
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
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-guest-layout>