<!-- Sidebar Start -->
<aside class="left-sidebar with-vertical">
    <div>
        <div class="brand-logo d-flex align-items-center justify-content-between">
            <a href="{{ route('dashboard') }}" class="text-nowrap logo-img">
                <img src="{{ asset('assets/images/logo.svg') }}" class="dark-logo" alt="Logo-Dark" />
                <img src="{{ asset('assets/images/logo.svg') }}" class="light-logo" alt="Logo-light" />
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
            </ul>
        </nav>

        <div class="fixed-profile p-3 mx-4 mb-2 bg-secondary-subtle rounded mt-3">
            <div class="hstack gap-3">
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button class="border-0 bg-transparent text-primary ms-auto" onclick="event.preventDefault(); this.closest('form').submit();" tabindex="0" type="button" aria-label="logout" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="logout">
                        <i class="ti ti-power fs-7"></i>
                    </button>
                </form>
                <a class="border-0 bg-transparent text-primary ms-auto" href="{{ route('profile.edit') }}" tabindex="0" type="button" aria-label="profile" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="profile">
                    <i class="icon ti ti-settings fs-7"></i>
                </a>
            </div>
        </div>
    </div>
</aside>
<!--  Sidebar End -->