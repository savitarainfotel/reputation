<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <meta name="csrf-token" content="{{ csrf_token() }}" />

        <title>{{ config('app.name', 'Laravel') }}</title>

        <link rel="icon" href="{{ asset('assets/images/favicon.png') }}" type="image/png" />
        <link rel="apple-touch-icon" href="{{ asset('assets/images/favicon.png') }}" type="image/png" />

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net" />
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
        <link rel="stylesheet" href="{{ asset('assets/css/styles.css').$status::ASSET_VERSION }}" />
        <link rel="stylesheet" href="{{ asset('assets/css/style.css').$status::ASSET_VERSION }}" />
    </head>
    <body>
        <!-- Preloader -->
        <div class="preloader">
            <div class="preloader-bg"></div>
            <div class="preloader-box">
                <div class="loader-container">
                    <div class="loader-ring"></div>
                    <div class="loader-center">
                        <img src="{{ asset('assets/images/favicon.png') }}" alt="Logo" />
                    </div>
                </div>
            </div>
        </div>
        <div id="main-wrapper" class="auth-customizer-none">
            <div class="position-relative overflow-hidden radial-gradient min-vh-100 w-100 d-flex align-items-center justify-content-center">
                <div class="d-flex align-items-center justify-content-center w-100">
                    <div class="row justify-content-center w-100">
                        <div class="col-md-8 col-lg-6 col-xxl-3 auth-card">
                            <div class="card mb-0">
                                <div class="card-body">
                                    <a href="{{ route('home') }}" class="text-nowrap logo-img d-block px-4 py-9 w-100 text-center">
                                        <img src="{{ asset('assets/images/logo.png') }}" class="dark-logo" alt="Logo-Dark" />
                                        <img src="{{ asset('assets/images/logo.png') }}" class="light-logo" alt="Logo-light" />
                                        <div class="mt-3 text-dark">@lang('The Best Reputation Management Software')</div>
                                    </a>
                                    {{ $slot }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="dark-transparent sidebartoggler"></div>
        <!-- Import Js Files -->
        <script src="{{ asset('assets/js/vendor.min.js') }}"></script>
        <script src="{{ asset('assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js') }}"></script>
        <script src="{{ asset('assets/libs/simplebar/dist/simplebar.min.js') }}"></script>
        <script src="{{ asset('assets/js/theme/app.init.js') }}"></script>
        <script src="{{ asset('assets/js/theme/theme.js') }}"></script>
        <script src="{{ asset('assets/js/theme/app.min.js') }}"></script>
        <script src="{{ asset('assets/libs/block-ui/jquery.blockUI.js') }}"></script>
        <script src="{{ asset('assets/js/custom.js').$status::ASSET_VERSION }}"></script>

        <!-- solar icons -->
        <script src="https://cdn.jsdelivr.net/npm/iconify-icon@1.0.8/dist/iconify-icon.min.js"></script>
    </body>
</html>