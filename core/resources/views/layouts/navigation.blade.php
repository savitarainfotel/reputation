<!-- Sidebar Start -->
<aside class="left-sidebar with-vertical">
    <div class="position-relative">
        <img src="{{ asset('assets/images/sidebar_background.png') }}" alt="" srcset="" class="position-absolute background-image">
        <div class="brand-logo d-flex align-items-center justify-content-center">
            <a href="{{ route('dashboard') }}" class="text-nowrap logo-img">
                <img src="{{ asset('assets/images/logo.svg') }}" class="dark-logo" alt="Logo-Dark" height="50" />
                <img src="{{ asset('assets/images/logo.svg') }}" class="light-logo" alt="Logo-light" height="50" />
            </a>
            <a href="javascript:void(0)" class="sidebartoggler ms-auto text-decoration-none fs-5 d-block d-xl-none">
                <i class="ti ti-x"></i>
            </a>
        </div>

        <nav class="sidebar-nav scroll-sidebar" data-simplebar>
            <ul id="sidebarnav">
                <li class="sidebar-item">
                    <a class="sidebar-link has-arrow" href="javascript:void(0)" aria-expanded="false">
                        <span class="d-flex">
                            <img src="{{ asset('assets/images/svg/answer.svg') }}" alt="answer" srcset="">
                        </span>
                        <span class="hide-menu">@lang('Answer Feedback')</span>
                    </a>
                    <ul aria-expanded="false" class="collapse first-level">
                        <li class="sidebar-item">
                            <a href="{{ route('reviews.index') }}" class="sidebar-link">
                                <span class="hide-menu">@lang('Review inbox')</span>
                            </a>
                        </li>
                        <li class="sidebar-item">
                            <a href="javascript:void(0)" class="sidebar-link">
                                <span class="hide-menu">@lang('Automation')</span>
                            </a>
                        </li>
                        <li class="sidebar-item">
                            <a href="javascript:void(0)" class="sidebar-link">
                                <span class="hide-menu">@lang('Review Reply Generator')</span>
                            </a>
                        </li>
                        <li class="sidebar-item">
                            <a href="javascript:void(0)" class="sidebar-link">
                                <span class="hide-menu">@lang('Rating Reply Generator')</span>
                            </a>
                        </li>

                    </ul>
                </li>
                <li class="sidebar-item">
                    <a class="sidebar-link has-arrow " href="javascript:void(0)" aria-expanded="false">
                        <span class="d-flex">
                            <img src="{{ asset('assets/images/svg/property.svg') }}" alt="property" srcset="">
                        </span>
                        <span class="hide-menu">@lang('Property Overview')</span>
                    </a>
                    <ul aria-expanded="false" class="collapse first-level">
                        <li class="sidebar-item">
                            <a href="javascript:void(0)" class="sidebar-link">
                                <span class="hide-menu">@lang('Group Overview')</span>
                            </a>
                        </li>
                        <li class="sidebar-item">
                            <a href="javascript:void(0)" class="sidebar-link">
                                <span class="hide-menu">@lang('Review Insight')</span>
                            </a>
                        </li>
                        <li class="sidebar-item">
                            <a href="javascript:void(0)" class="sidebar-link">
                                <span class="hide-menu">@lang('Report')</span>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="sidebar-item">
                    <a class="sidebar-link" href="javascript:;" aria-expanded="false">
                        <span>
                            <img src="{{ asset('assets/images/svg/survey.svg') }}" alt="survey" srcset="">
                        </span>
                        <span class="hide-menu">@lang('Survey')</span>
                    </a>
                </li>
            </ul>
        </nav>
        <div class="fixed-profile mb-2 mt-3">
           <nav class="sidebar-nav scroll-sidebar"> 
            <ul id="sidebarnav">
                <li class="sidebar-item">
                    <a class="sidebar-link" href="{{ route('properties.index') }}" aria-expanded="false">
                        <span>
                            <img src="{{ asset('assets/images/svg/setting.svg') }}" alt="setting" srcset="">
                        </span>
                        <span class="hide-menu">@lang('Settings')</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a class="sidebar-link" href="javascript:;" aria-expanded="false">
                        <span>
                            <img src="{{ asset('assets/images/svg/report.svg') }}" alt="report" srcset="">
                        </span>
                        <span class="hide-menu">@lang('Report Bug')</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a class="sidebar-link" href="javascript:;" aria-expanded="false">
                        <span>
                            <img src="{{ asset('assets/images/svg/help.svg') }}" alt="help" srcset="">
                        </span>
                        <span class="hide-menu">@lang('Help')</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <a class="sidebar-link" href="javascript:;" onclick="event.preventDefault(); this.closest('form').submit();">
                            <span>
                                <img src="{{ asset('assets/images/svg/logout.svg') }}" alt="logout" srcset="">
                            </span>
                            <span class="hide-menu">@lang('Logout')</span>
                        </a>
                    </form>
                </li>
            </ul>
           </nav>
        </div>
    </div>
</aside>
<!--  Sidebar End -->