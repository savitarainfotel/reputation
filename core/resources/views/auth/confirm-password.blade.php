<x-guest-layout>
    <div class="row justify-content-center">
        <div class="col-12 col-md-4">
            <div class="card text-white bg-secondary mb-3 mt-4">
                <div class="card-header">@lang('Confirm Password') </div>
                <div class="card-body">
                    <p>
                        {{ __('This is a secure area of the application. Please confirm your password before continuing.') }}
                    </p>
                    <!-- Session Status -->
                    <x-auth-session-status :status="session('status')" />

                    <form method="POST" action="{{ route('password.confirm') }}">
                        @csrf

                        <!-- Password -->
                        <div>
                            <x-input-label for="password" :value="__('Password')" />

                            <x-text-input id="password" class="block mt-1 w-full"
                                            type="password"
                                            name="password"
                                            required autocomplete="current-password" />

                            <x-input-error :messages="$errors->get('password')" class="mt-2" />
                        </div>

                        <div class="flex items-center justify-end mt-2">
                            <x-secondary-button>
                                {{ __('Confirm') }}
                            </x-secondary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-guest-layout>