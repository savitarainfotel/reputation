<x-app-layout>
    <x-add-property-top-nav />

    <form action="{{ route('properties.add.platforms', $property) }}" method="post" class="ajax-form">
        <div class="row">
            <div class="col-md-6 offset-md-3 col-12">
                <small>@lang('Welcome to RMS! Set up your account in four easy steps.')</small>
                <h4 class="mt-3 mb-3">@lang('Confirm Your Listings')</h4>
                <p>
                    @lang('We\'ve added the following profiles for the different platforms. Confirm the selection or add/change a listing if needed.')
                </p>
                <div class="col-12 mt-4">
                    <div class="row">
                        <div class="col-lg-4">
                            <div class="card overflow-hidden hover-img">
                                <div class="position-relative">
                                <a href="javascript:void(0)">
                                    <img src="../assets/images/blog/blog-img1.jpg" class="card-img-top" alt="modernize-img">
                                </a>
                                <span class="badge text-bg-light text-dark fs-2 lh-sm mb-9 me-9 py-1 px-2 fw-semibold position-absolute bottom-0 end-0">2
                                    min Read</span>
                                <img src="../assets/images/profile/user-3.jpg" alt="modernize-img" class="img-fluid rounded-circle position-absolute bottom-0 start-0 mb-n9 ms-9" width="40" height="40" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Georgeanna Ramero">
                                </div>
                                <div class="card-body p-4">
                                <span class="badge text-bg-light fs-2 py-1 px-2 lh-sm  mt-3">Social</span>
                                <a class="d-block my-4 fs-5 text-dark fw-semibold link-primary" href="javascript:void(0)">As yen tumbles, gadget-loving Japan goes
                                    for secondhand iPhones</a>
                                <div class="d-flex align-items-center gap-4">
                                    <div class="d-flex align-items-center gap-2">
                                    <i class="ti ti-eye text-dark fs-5"></i>9,125
                                    </div>
                                    <div class="d-flex align-items-center gap-2">
                                    <i class="ti ti-message-2 text-dark fs-5"></i>3
                                    </div>
                                    <div class="d-flex align-items-center fs-2 ms-auto">
                                    <i class="ti ti-point text-dark"></i>Mon, Dec 19
                                    </div>
                                </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row mt-3">
                    <div class="col-12">
                        <a href="{{ route('properties.infos', $property) }}" class="btn btn-secondary float-end py-8 mt-2 rounded-2 ms-3">
                            {{ __('Continue') }}
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </form>
</x-app-layout>