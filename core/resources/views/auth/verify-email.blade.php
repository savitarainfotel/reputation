<x-guest-layout>
    <div class="row justify-content-center">
        <div class="col-12 col-md-4">
            <div class="card text-white bg-secondary mb-3 mt-4">
                <div class="card-header">@lang('Log in') </div>
                <div class="card-body">
                    <p>
                        {{ __('Thanks for signing up! Before getting started, could you verify your email address by clicking on the link we just emailed to you? If you didn\'t receive the email, we will gladly send you another.') }}
                    </p>
                    <!-- Session Status -->
                    @if (session('status') == 'verification-link-sent')
                        <div class="mb-2 font-medium text-sm">
                            {{ __('A new verification link has been sent to the email address you provided during registration.') }}
                        </div>
                    @endif

                    <div class="d-flex justify-content-between">
                        <form method="POST" action="{{ route('verification.send') }}">
                            @csrf

                            <div>
                                <x-primary-button>
                                    {{ __('Resend Verification Email') }}
                                </x-primary-button>
                            </div>
                        </form>

                        <form method="POST" action="{{ route('logout') }}">
                            @csrf

                            <x-primary-button type="submit">
                                {{ __('Log Out') }}
                            </x-primary-button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-guest-layout>