@use('App\Constants\Status')
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="csrf-token" content="{{ csrf_token() }}" />

    <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net" />
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
        <link rel="stylesheet" href="{{ asset('assets/css/styles.css').Status::ASSET_VERSION }}" />
        <link rel="stylesheet" href="{{ asset('assets/css/style.css').Status::ASSET_VERSION }}" />
        @stack('style')
    </head>
    <body class="link-sidebar">
        <!-- Preloader -->
        <div class="preloader">
            <img src="{{ asset('assets/images/logo.svg') }}" alt="loader" class="lds-ripple img-fluid" />
        </div>
        <div id="main-wrapper">
            @include('layouts.navigation')

        <div class="page-wrapper">
            <!--  Header Start -->

            <header class="topbar">
                {{-- <div class="bg-primary d-flex align-items-center justify-content-between">
                        <p class="text-white">Your free trial ended on 6/25/2025. You can upgrade<a href="javascript:void(0)">Here</a></p>

                    </div> --}}
                <div class="with-vertical">
                    <nav class="navbar navbar-expand-lg p-0 flex-nowrap">
                        <ul class="navbar-nav">
                            <li class="nav-item ms-2">
                                <a class="nav-link sidebartoggler" id="headerCollapse" href="javascript:void(0)">
                                    <i class="fas fa-chevron-right" id="sidebarToggleIcon"></i>
                                </a>
                            </li>
                        </ul>
                        <div class="text-white ms-5 ps-lg-5 fs-5">Your free trial ended on 6/25/2025. You can
                            upgrade <span class="text-primary">Here<span></div>
                        <div class="d-block d-lg-none py-4">
                            <a href="{{ route('dashboard') }}" class="text-nowrap logo-img">
                                <img src="{{ asset('assets/images/logo.svg') }}" style="height: 50px;" class="dark-logo"
                                    alt="Logo-Dark" />
                                <img src="{{ asset('assets/images/logo.svg') }}" style="height: 50px;"
                                    class="light-logo" alt="Logo-light" />
                            </a>
                        </div>
                    </nav>
                </div>
            </header>
            <!--  Header End -->
            <div class="body-wrapper">
                <div class="container-fluid">
                    {{ $slot }}
                </div>
            </div>
        </div>
    </div>
    <div class="dark-transparent sidebartoggler"></div>

        <x-general-modal />
        <!-- Import Js Files -->
        <script src="{{ asset('assets/js/vendor.min.js') }}"></script>
        <script src="{{ asset('assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js') }}"></script>
        <script src="{{ asset('assets/libs/simplebar/dist/simplebar.min.js') }}"></script>
        <script src="{{ asset('assets/js/theme/app.init.js') }}"></script>
        <script src="{{ asset('assets/js/theme/theme.js') }}"></script>
        <script src="{{ asset('assets/js/theme/app.min.js') }}"></script>
        <script src="{{ asset('assets/js/theme/sidebarmenu.js') }}"></script>
        <script src="{{ asset('assets/js/plugins/toastr-init.js') }}"></script>
        <script src="{{ asset('assets/js/custom.js').Status::ASSET_VERSION }}"></script>

    <x-jquery-validation />

    @stack('script')
    <!-- solar icons -->
    <script src="https://cdn.jsdelivr.net/npm/iconify-icon@1.0.8/dist/iconify-icon.min.js"></script>
    <script>
        $('#headerCollapse').on('click', function() {
            $('#sidebarToggleIcon').toggleClass('fa-chevron-right fa-chevron-left');
        });
    </script>
</body>

</html>
