<div class="col-12">
    <div class="card w-100 border position-relative overflow-hidden mb-0">
        <div class="card-body p-4">
            <h4 class="card-title">@lang('Profile Information')</h4>
            <p class="card-subtitle mb-4">{{ __("Update your account's profile information and email address.") }}</p>
            @if (session('status') === 'profile-updated')
                <x-auth-session-status :status="__('Profile information updated successfully.')" />
            @endif
            @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                <form id="send-verification" method="post" action="{{ route('verification.send') }}">
                    @csrf
                    <div>
                        <p class="text-danger mt-2">
                            <span>{{ __('Your email address is unverified.') }}</span>
                            <x-primary-button type="submit">{{ __('Click here to re-send the verification email.') }}</x-primary-button>
                        </p>

                        @if (session('status') === 'verification-link-sent')
                            <x-auth-session-status :status="__('A new verification link has been sent to your email address.')" />
                        @endif
                    </div>
                </form>
            @endif
            <form method="post" action="{{ route('profile.update') }}" class="mt-6 space-y-6">
                @csrf
                @method('patch')
                <div class="row">
                    <div class="form-group">
                        <x-input-label for="first_name" :value="__('First Name')" />
                        <x-text-input id="first_name" name="first_name" type="text" class="mt-1" :value="old('first_name', $user->first_name)" required autofocus autocomplete="first_name" />
                        <x-input-error class="mt-2" :messages="$errors->get('first_name')" />
                    </div>

                    <div class="form-group">
                        <x-input-label for="last_name" :value="__('Last Name')" />
                        <x-text-input id="last_name" name="last_name" type="text" class="mt-1 block w-full" :value="old('last_name', $user->last_name)" required autofocus autocomplete="last_name" />
                        <x-input-error class="mt-2" :messages="$errors->get('last_name')" />
                    </div>

                    <div class="form-group">
                        <x-input-label for="email" :value="__('Email')" />
                        <x-text-input id="email" name="email" type="email" class="mt-1 block w-full" :value="old('email', $user->email)" required autocomplete="username" />
                        <x-input-error class="mt-2" :messages="$errors->get('email')" />
                    </div>

                    <div class="col-12">
                        <div class="d-flex align-items-center justify-content-end mt-4 gap-6">
                            <x-secondary-button>{{ __('Save') }}</x-secondary-button>
                            <a href="{{ route('dashboard') }}" class="btn bg-danger-subtle text-danger">Cancel</a>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>