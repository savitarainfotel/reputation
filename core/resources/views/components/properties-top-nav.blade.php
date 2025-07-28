<div class="col-12">
    <ul class="mb-4 rounded d-flex align-items-center flex-row">
        <li class="nav-item me-3">
            <a href="{{ route('properties.index') }}" class="btn btn-outline-dark d-flex align-items-center gap-6 {{ showActive('properties.index') }}">
                <i class="fa-solid fa-city"></i>
                <span class="d-none d-md-block fw-medium fs-3">@lang('Properties')</span>
            </a>
        </li>
        <li class="nav-item me-3">
            <a href="{{ route('integrations.index') }}" class="btn btn-outline-dark d-flex align-items-center gap-6 {{ showActive('integrations.index') }}">
                <i class="fa-solid fa-network-wired"></i>
                <span class="d-none d-md-block fw-medium fs-3">@lang('Integrations')</span>
            </a>
        </li>
        {{-- <li class="nav-item me-3">
            <a href="javascript:void(0)" class="btn btn-outline-dark d-flex align-items-center gap-6">
                <i class="fa-solid fa-user"></i>
                <span class="d-none d-md-block fw-medium fs-3">@lang('Users')</span>
            </a>
        </li> --}}
        <li class="nav-item me-3">
            <a href="{{ route('competitors.index') }}" class="btn btn-outline-dark d-flex align-items-center gap-6 {{ showActive('competitors.index') }}">
                <i class="fas fa-chart-bar"></i>
                <span class="d-none d-md-block fw-medium fs-3">@lang('Competitors')</span>
            </a>
        </li>
        <li class="nav-item me-3">
            <a href="javascript:void(0)" class="btn btn-outline-dark d-flex align-items-center gap-6">
                <i class="far fa-keyboard"></i>
                <span class="d-none d-md-block fw-medium fs-3">@lang('Subcriptions')</span>
            </a>
        </li>
        <li class="nav-item me-3">
            <a href="javascript:void(0)" class="btn btn-outline-dark d-flex align-items-center gap-6">
                <i class="ti ti-file-description fs-4"></i>
                <span class="d-none d-md-block fw-medium fs-3">@lang('Account AI')</span>
            </a>
        </li>
        <li class="nav-item me-3">
            <a href="javascript:void(0)" class="btn btn-outline-dark d-flex align-items-center gap-6">
                <i class="fas fa-chart-pie"></i>
                <span class="d-none d-md-block fw-medium fs-3">@lang('Usage')</span>
            </a>
        </li>
        <li class="nav-item me-3">
            <a href="{{ route('profile.edit') }}" class="btn btn-outline-dark d-flex align-items-center gap-6 {{ showActive('profile.edit') }}">
                <i class="fas fa-user-edit"></i>
                <span class="d-none d-md-block fw-medium fs-3">@lang('Personal Setting')</span>
            </a>
        </li>
    </ul>
</div>