<x-guest-layout>
    <h2 class="mb-4 fs-7 fw-bolder">@lang('Verify Email')</h2>
    <!-- Session Status -->
    @if (session('status') == 'verification-link-sent')
        <x-auth-session-status :status="__('A new verification link has been sent to the email address you provided during registration.')" />
        <hr>
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
</x-guest-layout>