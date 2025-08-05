<x-guest-layout>
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
</x-guest-layout>