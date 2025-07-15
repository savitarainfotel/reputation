<!-- Sidebar Start -->
<aside class="left-sidebar with-vertical">
    <div>
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
                    <a class="sidebar-link" href="{{ route('dashboard') }}"aria-expanded="false">
                        <span>
                            <i class="ti ti-message-dots"></i>
                        </span>
                        <span class="hide-menu">@lang('Dashboard')</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a class="sidebar-link has-arrow" href="javascript:void(0)" aria-expanded="false">
                        <span class="d-flex">
                            <i class="ti ti-layout-grid"></i>
                        </span>
                        <span class="hide-menu">@lang('Answer Feedback')</span>
                    </a>
                    <ul aria-expanded="false" class="collapse first-level">
                        <li class="sidebar-item">
                            <a href="javascript:void(0)" class="sidebar-link">
                                <div class="round-16 d-flex align-items-center justify-content-center">
                                    <i class="ti ti-circle"></i>
                                </div>
                                <span class="hide-menu">@lang('Review inbox')</span>
                            </a>
                        </li>
                        <li class="sidebar-item">
                            <a href="javascript:void(0)" class="sidebar-link">
                                <div class="round-16 d-flex align-items-center justify-content-center">
                                    <i class="ti ti-circle"></i>
                                </div>
                                <span class="hide-menu">@lang('Automation')</span>
                            </a>
                        </li>
                        <li class="sidebar-item">
                            <a href="javascript:void(0)" class="sidebar-link">
                                <div class="round-16 d-flex align-items-center justify-content-center">
                                    <i class="ti ti-circle"></i>
                                </div>
                                <span class="hide-menu">@lang('Review Reply Generator')</span>
                            </a>
                        </li>
                        <li class="sidebar-item">
                            <a href="javascript:void(0)" class="sidebar-link">
                                <div class="round-16 d-flex align-items-center justify-content-center">
                                    <i class="ti ti-circle"></i>
                                </div>
                                <span class="hide-menu">@lang('Rating Reply Generator')</span>
                            </a>
                        </li>

                    </ul>
                </li>
                <li class="sidebar-item">
                    <a class="sidebar-link has-arrow " href="javascript:void(0)" aria-expanded="false">
                        <span class="d-flex">
                            <i class="ti ti-layout-grid"></i>
                        </span>
                        <span class="hide-menu">@lang('Property Overview')</span>
                    </a>
                    <ul aria-expanded="false" class="collapse first-level">
                        <li class="sidebar-item">
                            <a href="javascript:void(0)" class="sidebar-link">
                                <div class="round-16 d-flex align-items-center justify-content-center">
                                    <i class="ti ti-circle"></i>
                                </div>
                                <span class="hide-menu">@lang('Group Overview')</span>
                            </a>
                        </li>
                        <li class="sidebar-item">
                            <a href="javascript:void(0)" class="sidebar-link">
                                <div class="round-16 d-flex align-items-center justify-content-center">
                                    <i class="ti ti-circle"></i>
                                </div>
                                <span class="hide-menu">@lang('Review Insight')</span>
                            </a>
                        </li>
                        <li class="sidebar-item">
                            <a href="javascript:void(0)" class="sidebar-link">
                                <div class="round-16 d-flex align-items-center justify-content-center">
                                    <i class="ti ti-circle"></i>
                                </div>
                                <span class="hide-menu">@lang('Report')</span>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="sidebar-item">
                    <a class="sidebar-link" href="javascript:;" aria-expanded="false">
                        <span>
                            <i class="ti ti-cpu"></i>
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
                            <i class="ti ti-settings"></i>
                        </span>
                        <span class="hide-menu">@lang('Settings')</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a class="sidebar-link" href="javascript:;" aria-expanded="false">
                        <span>
                            <i class="ti ti-bug"></i>
                        </span>
                        <span class="hide-menu">@lang('Report Bug')</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a class="sidebar-link" href="javascript:;" aria-expanded="false">
                        <span>
                            <i class="ti ti-help"></i>
                        </span>
                        <span class="hide-menu">@lang('Help')</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <a class="sidebar-link" href="javascript:;" onclick="event.preventDefault(); this.closest('form').submit();">
                            <span>
                                <i class="ti ti-power"></i>
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