<div class="col-lg-4 mt-4">
    <div class="card border">
        <div class="card-body">
            <div class="d-flex justify-content-between align-items-start mb-3">
                <div>
                    <div class="fw-bold  text-primary fs-4">Guest Experience Survey Savitara Infotel</div>
                </div>
                <div class="form-check form-switch status-switch">
                    <input class="form-check-input" type="checkbox" role="switch" id="statusSwitch" >
                    <label class="form-check-label" for="statusSwitch">Active</label>
                </div>
            </div>

            <div class="d-flex align-items-center mb-4">
                <img src="{{ asset('assets/images/logo.svg') }}"
                    alt="Logo" class="me-3 rounded-circle" width="40" height="40">
                <h4 class="mb-0 text-primary fs-4">Savitara Infotel Pvt. Ltd.</h4>
                <div class="ms-auto">
                    <a class=" me-2">
                        <i class="fas fa-pencil-square fs-5"></i>
                    </a>
                    <a class="">
                        <i class="fas fa-trash fs-5"></i>
                    </a>
                </div>
            </div>

            <div class="row  mb-4">
                <div class="col-md-4">
                    <div class="border p-2 rounded h-100">
                        <div class="text-primary fw-bold mb-2">Total Response</div>
                        <div class="text-secondary fs-6 fw-bolder">100</div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="border p-2 rounded h-100">
                        <div class="text-primary fw-bold mb-2">Platform Review</div>
                        <img src="{{ asset('assets/images/svg/google.svg') }}" width="32" alt="Google">
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="border p-2 rounded h-100">
                        <div class="text-primary fw-bold mb-2">Survey Type</div>
                        <img src="{{ asset('assets/images/svg/star.svg') }}" width="28" alt="Star">
                    </div>
                </div>
            </div>

            <div class="d-flex justify-content-between">
                <button type="button" class="w-50 btn border border-2 border-secondary text-dark" data-action="">
                    <i class="fas fa-share  me-2"></i>@lang('Share')
                </button>
                
                <x-secondary-button type="button" class="ms-2 w-50" data-action="">
                    <i class="fas fa-download text-white me-2"></i>@lang('Export Result')
                </x-secondary-button>
            </div>
        </div>
    </div>
</div>