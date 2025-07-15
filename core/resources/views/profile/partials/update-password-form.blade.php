<div class="col-12">
    <div class="card w-100 border position-relative overflow-hidden mb-0">
        <div class="card-body p-4">
            <h4 class="card-title">@lang('Update Password')</h4>
            <p class="card-subtitle mb-4">{{ __("Ensure your account is using a long, random password to stay secure.") }}</p>
            @if (session('status') === 'password-updated')
                <x-auth-session-status :status="__('Password updated successfully.')" />
            @endif
            <form method="post" action="{{ route('password.update') }}" class="mt-6 space-y-6">
                @csrf
                @method('put')
                <div class="row">
                    <div class="form-group">
                        <x-input-label for="update_password_current_password" :value="__('Current Password')" />
                        <x-text-input id="update_password_current_password" name="current_password" type="password" class="mt-1 block w-full" autocomplete="current-password" />
                        <x-input-error :messages="$errors->updatePassword->get('current_password')" class="mt-2" />
                    </div>

                    <div class="form-group">
                        <x-input-label for="update_password_password" :value="__('New Password')" />
                        <x-text-input id="update_password_password" name="password" type="password" class="mt-1 block w-full" autocomplete="new-password" />
                        <x-input-error :messages="$errors->updatePassword->get('password')" class="mt-2" />
                    </div>

                    <div class="form-group">
                        <x-input-label for="update_password_password_confirmation" :value="__('Confirm Password')" />
                        <x-text-input id="update_password_password_confirmation" name="password_confirmation" type="password" class="mt-1 block w-full" autocomplete="new-password" />
                        <x-input-error :messages="$errors->updatePassword->get('password_confirmation')" class="mt-2" />
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