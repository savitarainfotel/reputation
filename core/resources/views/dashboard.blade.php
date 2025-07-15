<x-app-layout>
    {{-- header section starts here --}}
    <ul class="p-3 mb-3 rounded d-flex align-items-center flex-row">
        <li class="nav-item me-3">
            <a href="javascript:void(0)" class="btn btn-outline-dark d-flex align-items-center gap-6" id="add-notes">
                <i class="fa-solid fa-city"></i>
                <span class="d-none d-md-block fw-medium fs-3">Properties</span>
            </a>
        </li>
        <li class="nav-item me-3">
            <a href="javascript:void(0)" class="btn btn-outline-dark d-flex align-items-center gap-6" id="add-notes">
                <i class="fa-solid fa-network-wired"></i>
                <span class="d-none d-md-block fw-medium fs-3">Integrations</span>
            </a>
        </li>
        <li class="nav-item me-3">
            <a href="javascript:void(0)" class="btn btn-outline-dark d-flex align-items-center gap-6" id="add-notes">
                <i class="fa-solid fa-user"></i>
                <span class="d-none d-md-block fw-medium fs-3">Users</span>
            </a>
        </li>
        <li class="nav-item me-3">
            <a href="javascript:void(0)" class="btn btn-outline-dark d-flex align-items-center gap-6" id="add-notes">
                <i class="fas fa-chart-bar"></i>
                <span class="d-none d-md-block fw-medium fs-3">Competitors</span>
            </a>
        </li>
        <li class="nav-item me-3">
            <a href="javascript:void(0)" class="btn btn-outline-dark d-flex align-items-center gap-6" id="add-notes">
                <i class="far fa-keyboard"></i>
                <span class="d-none d-md-block fw-medium fs-3">Subcriptions</span>
            </a>
        </li>
        <li class="nav-item me-3">
            <a href="javascript:void(0)" class="btn btn-outline-dark d-flex align-items-center gap-6" id="add-notes">
                <i class="ti ti-file-description fs-4"></i>
                <span class="d-none d-md-block fw-medium fs-3">Account AI</span>
            </a>
        </li>
        <li class="nav-item me-3">
            <a href="javascript:void(0)" class="btn btn-outline-dark d-flex align-items-center gap-6" id="add-notes">
                <i class="fas fa-chart-pie"></i>
                <span class="d-none d-md-block fw-medium fs-3">Usage</span>
            </a>
        </li>
        <li class="nav-item me-3">
            <a href="javascript:void(0)" class="btn btn-outline-dark d-flex align-items-center gap-6" id="add-notes">
                <i class="fas fa-user-edit"></i>
                <span class="d-none d-md-block fw-medium fs-3">Personal Setting</span>
            </a>
        </li>
    </ul>
    {{-- main page section starts here --}}
    <div class="container-fluid d-flex justify-content-center align-items-center half-height-section mt-4">
        <div class="text-center">
            <!-- SVG Icon -->
            <img src="{{ asset('assets/images/svg/home.svg') }}" alt="Icon" width="800" height="400" class="mb-3">
            <h4 class="mb-4">To add a property click button below</h4>
            <a href="#" class="btn btn-info m-2"><i class="far fa-plus"></i> Add New Property</a>
        </div>
    </div>
</x-app-layout>
