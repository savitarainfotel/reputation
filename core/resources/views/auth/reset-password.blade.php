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
                                    
                                    <div class="card-body">
                                        <!-- Session Status -->
                                        <h2 class="mb-4 fs-7 fw-bolder">@lang('Reset Password')</h2>
                                        <x-auth-session-status :status="session('status')" />

                                        <form method="POST" action="{{ route('password.store') }}">
                                            @csrf

                                            <!-- Password Reset Token -->
                                            <input type="hidden" name="token" value="{{ $request->route('token') }}">

                                            <!-- Email Address -->
                                            {{-- <div>
                                                <x-input-label for="email" :value="__('Email')" />
                                                <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email', $request->email)" required autofocus autocomplete="username" />
                                                <x-input-error :messages="$errors->get('email')" class="mt-2" />
                                            </div> --}}

                                            <!-- Password -->
                                            <div>
                                                <x-input-label for="password" :value="__('Password')" />
                                                <div class="input-group">
                                                    <x-text-input id="password" class="block w-full" type="password" name="password" required autocomplete="new-password" />
                                                </div>
                                                <x-input-error :messages="$errors->get('password')" class="mt-2" />
                                            </div>

                                            <!-- Confirm Password -->
                                            <div>
                                                <x-input-label for="password_confirmation" :value="__('Confirm Password')" />
                                                <div class="input-group">
                                                    <x-text-input id="password_confirmation" class="block w-full" type="password" name="password_confirmation" required autocomplete="new-password" />
                                                </div>
                                                <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                                            </div>

                                            <div class="flex items-center justify-end mt-4">
                                                <x-secondary-button class="w-100 py-8 mb-4 rounded-2">
                                                    {{ __('Reset Password') }}
                                                </x-secondary-button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                                <div>
                                    <ul id="password-rules">
                                        <li id="length-rule"><i class="fa-regular fa-circle-xmark me-2 fs-5 text-danger"></i>@lang('Password has more than 8 characters.')</li>
                                        <li id="special-rule"><i class="fa-regular fa-circle-xmark me-2 fs-5 text-danger"></i>@lang('Password has a special character.')</li>
                                        <li id="number-rule"><i class="fa-regular fa-circle-xmark me-2 fs-5 text-danger"></i>@lang('Password has a number.')</li>
                                        <li id="uppercase-rule"><i class="fa-regular fa-circle-xmark me-2 fs-5 text-danger"></i>@lang('Password has a capital letter.')</li>
                                        <li id="match-rule"><i class="fa-regular fa-circle-xmark me-2 fs-5 text-danger"></i>@lang('Passwords match.')</li>
                                        <li id="lowercase-rule"><i class="fa-regular fa-circle-xmark me-2 fs-5 text-danger"></i>@lang('Password has a lowercase letter.')</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-guest-layout>