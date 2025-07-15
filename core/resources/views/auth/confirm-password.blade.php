<x-guest-layout>
    <div id="main-wrapper" class="auth-customizer-none">
        <div class="position-relative overflow-hidden radial-gradient min-vh-100 w-100">
            <div class="position-relative z-index-5">
                <div class="row">
                    <div class="col-xl-6 col-xxl-6 left-panel">
                        <x-auth-side :title="__('Welcome Back!')" :sub-title="__('Thousand of professionals Using the #1 AI CRM to monitor, manage and grow online trust.')" />
                    </div>
                    <div class="col-xl-6 col-xxl-6">
                        <div
                            class="authentication-login min-vh-100 bg-body row justify-content-center align-items-center p-4">
                            <div class="auth-max-width col-sm-8 col-md-6 col-xl-7 ">
                                <div class="card p-3 border shadow-none">
                                    <h2 class="mb-4 fs-7 fw-bolder text-center">@lang('Confirm Password')</h2>
                                    <!-- Session Status -->
                                    @if(session('status'))
                                        <x-auth-session-status :status="session('status')" />
                                        <hr>
                                    @endif

                                    <p class="text-justify text-dark">
                                        {{ __('This is a secure area of the application. Please confirm your password before continuing.') }}
                                    </p>

                                    <form method="POST" action="{{ route('password.confirm') }}">
                                        @csrf

                                        <!-- Password -->
                                        <div class="mb-3">
                                            <x-input-label for="password" :value="__('Password')" />
                                            <div class="input-group">
                                                <span class="input-group-text  border-end-0">
                                                    <img src="{{ asset('assets/images/svg/lock.svg') }}" class="icon">
                                                </span>
                                                <x-text-input id="password" class="border-start-0 text-dark" type="password" name="password" required autocomplete="password" />
                                            </div>
                                            <x-input-error :messages="$errors->get('password')" class="mt-2" />
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