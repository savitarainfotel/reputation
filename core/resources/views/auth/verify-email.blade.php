<x-guest-layout>
    <div id="main-wrapper" class="auth-customizer-none">
        <div class="position-relative overflow-hidden radial-gradient min-vh-100 w-100">
            <div class="position-relative z-index-5">
                <div class="row">
                    <div class="col-xl-6 col-xxl-6 left-panel">
                        <x-auth-side :title="__('Welcome!')" :sub-title="__('Join the #1 CRM designed to boost your brand\'s credibility and visibility.')" />
                    </div>
                    <div class="col-xl-6 col-xxl-6">
                        <div class="authentication-login min-vh-100 bg-body row justify-content-center align-items-center p-4">
                            <div class="auth-max-width col-sm-8 col-md-6 col-xl-7 ">
                                <div class="card p-3 border shadow-none">
                                    <h2 class="mb-4 fs-7 fw-bolder text-center">@lang('Verify Email')</h2>
                                    <!-- Session Status -->
                                    @if (session('status') == 'verification-link-sent')
                                        <x-auth-session-status :status="__('A new verification link has been sent to the email address you provided during registration.')" />
                                    @endif

                                    <p class="text-justify text-dark">
                                        {{ __('Thanks for signing up! Before getting started, could you verify your email address by clicking on the link we just emailed to you? If you didn\'t receive the email, we will gladly send you another.') }}
                                    </p>
                                    <div class="d-flex justify-content-between">
                                        <form method="POST" action="{{ route('verification.send') }}">
                                            @csrf

                                            <x-secondary-button>
                                                {{ __('Resend Verification Email') }}
                                            </x-secondary-button>
                                        </form>

                                        <form method="POST" action="{{ route('logout') }}">
                                            @csrf

                                            <x-secondary-button type="submit">
                                                {{ __('Log Out') }}
                                            </x-secondary-button>
                                        </form>
                                    </div>
                                </div>
                                <div class="text-justify mt-4">
                                    <p class="text-justify">
                                        @lang('Hotelxplore’s services are exclusively intended for companies and entrepreneurs (Unternehmer) as defined in § 14 of the German Civil Code (Bürgerliches Gesetzbuch, BGB)—that is, natural or legal persons or partnerships with legal capacity who are acting in the course of their commercial or independent professional activities. This offering is not directed at consumers (Verbraucher) as defined in § 13 BGB.')
                                    </p>
                                    <p class="text-justify">
                                        @lang('By creating an account, the user confirms that they have read and agree to')
                                        <a href="javascript:;" class="text-blue-dark">@lang('Hotelxplore’s General Terms')</a>
                                        @lang('and the') <a href="javascript:;" class="text-blue-dark"> @lang('Data Processing Agreement')</a>.
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