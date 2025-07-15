<x-app-layout>
    <div class="col-12">
        <ul class="mb-4 rounded d-flex align-items-center flex-row">
            <li class="nav-item me-3">
                <a href="javascript:void(0)" class="btn btn-outline-dark d-flex align-items-center gap-6" id="add-notes">
                    <i class="fa-solid fa-city"></i>
                    <span class="d-none d-md-block fw-medium fs-3">@lang('Properties')</span>
                </a>
            </li>
            <li class="nav-item me-3">
                <a href="javascript:void(0)" class="btn btn-outline-dark d-flex align-items-center gap-6" id="add-notes">
                    <i class="fa-solid fa-network-wired"></i>
                    <span class="d-none d-md-block fw-medium fs-3">@lang('Integrations')</span>
                </a>
            </li>
            <li class="nav-item me-3">
                <a href="javascript:void(0)" class="btn btn-outline-dark d-flex align-items-center gap-6" id="add-notes">
                    <i class="fa-solid fa-user"></i>
                    <span class="d-none d-md-block fw-medium fs-3">@lang('Users')</span>
                </a>
            </li>
            <li class="nav-item me-3">
                <a href="javascript:void(0)" class="btn btn-outline-dark d-flex align-items-center gap-6" id="add-notes">
                    <i class="fas fa-chart-bar"></i>
                    <span class="d-none d-md-block fw-medium fs-3">@lang('Competitors')</span>
                </a>
            </li>
            <li class="nav-item me-3">
                <a href="javascript:void(0)" class="btn btn-outline-dark d-flex align-items-center gap-6" id="add-notes">
                    <i class="far fa-keyboard"></i>
                    <span class="d-none d-md-block fw-medium fs-3">@lang('Subcriptions')</span>
                </a>
            </li>
            <li class="nav-item me-3">
                <a href="javascript:void(0)" class="btn btn-outline-dark d-flex align-items-center gap-6" id="add-notes">
                    <i class="ti ti-file-description fs-4"></i>
                    <span class="d-none d-md-block fw-medium fs-3">@lang('Account AI')</span>
                </a>
            </li>
            <li class="nav-item me-3">
                <a href="javascript:void(0)" class="btn btn-outline-dark d-flex align-items-center gap-6" id="add-notes">
                    <i class="fas fa-chart-pie"></i>
                    <span class="d-none d-md-block fw-medium fs-3">@lang('Usage')</span>
                </a>
            </li>
            <li class="nav-item me-3">
                <a href="{{ route('profile.edit') }}" class="btn btn-outline-dark d-flex align-items-center gap-6 {{ showActive('profile.edit') }}" id="add-notes">
                    <i class="fas fa-user-edit"></i>
                    <span class="d-none d-md-block fw-medium fs-3">@lang('Personal Setting')</span>
                </a>
            </li>
        </ul>
    </div>
    <div class="row">
        <div class="col-md-6 col-12">
            @include('profile.partials.update-profile-information-form')
        </div>
        <div class="col-md-6 col-12">
            @include('profile.partials.update-password-form')
        </div>
    </div>
</x-app-layout>