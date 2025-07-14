<x-guest-layout>
    <style>
        .left-panel {
            background: linear-gradient(to bottom, #062B63, #3499FD);
            color: white;
            padding: 4rem 2rem;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            text-align: center;
            height: 100vh;
        }

        .left-panel .logo {
            margin-bottom: 20px;
        }

        .left-panel .welcome {
            font-size: 32px;
            font-weight: 700;
            margin-top: 40px;
        }

        .left-panel .desc {
            font-size: 20px;
            opacity: 0.9;
                    
            margin: 10px 25px 30px 25px;
        }

        .features {
            font-size: 18px;
        }

        .features i {
            margin-right: 10px;
        }

        .feature-group {
            display: flex;
            flex-wrap: wrap;
            gap: 15px 30px;
           justify-content: center;
        }

        .feature-group div {
            flex: 0 0 45%;
        }

        .right-panel {
            background-color: #fff;
            display: flex;
            flex-direction: column;
            justify-content: center;
            padding: 2rem;
            height: 100vh;
        }

        .form-control:focus {
            box-shadow: none;
        }

        .login-box {
            max-width: 500px;
            width: 100%;
            border: 1px solid #152C5680;
            padding: 2rem;
            border-radius: 5px;
        }

        .login-box h3 {
            font-weight: 700;
            font-size: 36px;

        }

        .login-footer {
            max-width: 500px;
            font-size: 12px;
            color: #666;
        }

        .login-footer p {
            font-size: 16px;
            font-weight: 400;
        }

        .login-footer a {
            text-decoration: none;
        }

        .icon {
            width: 18px;
            margin-right: 8px;
        }

        .input-group-text {
            backdrop-filter: blur(0px) !important;
        }

        .input-group {
            border: 1px solid #152C5680;
            border-radius: 5px;
        }
    </style>


    {{-- <div class="row justify-content-center">
        <div class="col-12 col-md-4">
            <div class="card mb-3 mt-4">
                <div class="card-header">@lang('Log in') </div>
                <div class="card-body">
                    <!-- Session Status -->
                    <x-auth-session-status :status="session('status')" />

                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <!-- Email Address -->
                        <div>
                            <x-input-label for="email" :value="__('Email')" />
                            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
                            <x-input-error :messages="$errors->get('email')" class="mt-2" />
                        </div>

                        <!-- Password -->
                        <div>
                            <x-input-label for="password" :value="__('Password')" />

                            <x-text-input id="password" class="block mt-1 w-full"
                                            type="password"
                                            name="password"
                                            required autocomplete="current-password" />

                            <x-input-error :messages="$errors->get('password')" class="mt-2" />
                        </div>

                        <!-- Remember Me -->
                        <div class="block mt-2">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="remember_me" name="remember">
                                <label class="form-check-label" for="remember_me">
                                    {{ __('Remember me') }}
                                </label>
                            </div>
                        </div>

                        <div class="flex items-center justify-end mt-2">
                            <x-primary-button>
                                {{ __('Log in') }}
                            </x-primary-button>

                            @if (Route::has('password.request'))
                                <a class="float-end" href="{{ route('password.request') }}">
                                    {{ __('Forgot your password?') }}
                                </a>
                            @endif
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div> --}}
    <div class="container-fluid h-100">
        <div class="row h-100">
            <!-- Left Side -->
            <div class="col-md-6 left-panel ">
                <div class="logo mb-4">
                    <img src="assets/images/logo.png" alt="HX Logo">
                    <p class="mt-2">The Best Reputation Management Software</p>
                </div>
                <div>
                    <div class="welcome">Welcome Back!</div>
                    <div class="desc">Thousand of professionals Using the #1 AI CRM to monitor, manage and grow online
                        trust.</div>

                    <div class="features feature-group ">
                        <div class="text-start"><img src="assets/images/svg/download.svg" alt="download" srcset=""> All-in-One Inbox</div>
                        <div class="text-start"><img src="assets/images/svg/multi-channel.svg" alt="multi-channel" srcset=""> Multi-Channel Integration</div>
                        <div class="text-start"><img src="assets/images/svg/graph.svg" alt="graph" srcset=""> Smart Insights & Competitor Tracking</div>
                        <div class="text-start"><img src="assets/images/svg/team.svg" alt="team" srcset=""> Team Collaboration Made Easy</div>
                        <div class="text-start"><img src="assets/images/svg/rating.svg" alt="rating" srcset=""> Automated Review Responses</div>
                        <div class="text-start"><img src="assets/images/svg/bell.svg" alt="bell" srcset=""> Custom Alerts & Notifications</div>
                    </div>
                </div>

            </div>

            <!-- Right Side -->
            <div class="col-md-6 right-panel d-flex align-items-center justify-content-center">
                <div class="login-box">

                    <h3 class="mb-3 fw-semibold">Sign In</h3>
                    <x-auth-session-status :status="session('status')" />
                    <form method="POST" action="{{ route('login') }}">
                        <div class="mb-2 ">
                            <x-input-label for="email" :value="__('Email')" />
                            <div class="input-group">
                                <span class="input-group-text  border-end-0">
                                    <img src="assets/images/svg/email.svg" class="icon">
                                </span>
                                <x-text-input id="email" class="border-start-0 text-dark" type="email"
                                    name="email" :value="old('email')" required autofocus autocomplete="username" />
                            </div>
                            <x-input-error :messages="$errors->get('email')" class="mt-2" />
                        </div>

                        <div class="mb-2">
                            <x-input-label for="password" :value="__('Password')" />
                            <div class="input-group">
                                <span class="input-group-text  border-end-0">
                                    <img src="assets/images/svg/lock.svg" class="icon">
                                </span>
                                <x-text-input type="password" class="border-start-0 text-dark" placeholder="********" />
                            </div>
                            <div class="text-end">
                                <a href="#" class="small text-dark">Forgot Password?</a>
                            </div>
                            <x-input-error :messages="$errors->get('password')" class="mt-2" />
                        </div>
                        <x-secondary-button class="w-100">
                            {{ __('Log in') }}
                        </x-secondary-button>
                        {{-- <button class="btn btn-secondary w-100 mt-2">Login</button> --}}
                        <div class="text-center mt-1">
                            <span class="small">No account yet? <a href="#" class="text-blue-dark">Sign up
                                    instead</a></span>
                        </div>
                    </form>



                </div>
                <div class="login-footer mt-4">
                    <p>
                        Hotelexplore’s services are exclusively intended for companies and entrepreneurs
                        (Unternehmer) as defined in § 14 of the German Civil Code (BGB)... not directed at consumers
                        (§ 13 BGB).
                    </p>
                    <p>
                        By creating an account, the user confirms that they have read and agree to
                        <a href="#" class="text-blue-dark">Hotelxplore’s General Terms</a> and the <a
                            href="#" class="text-blue-dark">Data Processing
                            Agreement</a>.
                    </p>
                </div>
            </div>
        </div>
    </div>

</x-guest-layout>
