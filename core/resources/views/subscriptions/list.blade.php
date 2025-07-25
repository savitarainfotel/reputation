<x-app-layout>
    <style>
        .half-height-section {
            height: 50vh;
        }
        .property-img{
            border-radius: 10px;
            width: 350px;
            height: 345px;
            margin: 0 0 10px 0;
        }
        .logo-img-main-container {
            position: relative;
            height: 200px;
            width: 100%;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .logo-img-container {
            width: 30px;
            height: 30px;
            border-radius: 50%;
            object-fit: cover;
            position: absolute;
            border: 3px solid white;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        }
        .subscribe-card{
            border: 1px solid gray;
        }
        .ribbon {
            position: absolute;
            top: 0;
            right: 0;
            background: linear-gradient(45deg, #f43b47, #453a94);
            color: white;
            padding: 8px 16px;
            font-weight: bold;
            font-size: 14px;
            border-top-right-radius: 8px;
            border-bottom-left-radius: 8px;
            box-shadow: 0 2px 6px rgba(0, 0, 0, 0.2);
        }
        .ribbon2 {
            width: 60px;
            padding: 10px 0;
            position: absolute;
            top: -29px;
            left: 405px;
            text-align: center;
            border-top-left-radius: 3px;
            background: linear-gradient(180deg, #163568 0%, #186dde 100%);
        }
        .ribbon2:before {
            height: 0;
            width: 0;
            right: 60px;
            top: 1.2px;
            border-bottom: 30px solid #186dde;
            border-left: 20px solid transparent;
        }
        .ribbon2:before, .ribbon2:after {
            content: "";
            position: absolute;
        }
        .ribbon2:after {
            height: 0;
            width: 0;
            bottom: -29.5px;
            left: 0;
            border-left: 30px solid #186dde;
            border-right: 30px solid #186dde;
            border-bottom: 30px solid transparent;
        }                
        .subscribe-btn{
            background: linear-gradient(135deg, #163568 0%, #186dde 100%);
        }

        .img1 { transform: translateX(-120px); z-index: 1; }
        .img2 { transform: translateX(-60px); z-index: 2; }
        .img3 { transform: translateX(0px); z-index: 3; }
        .img4 { transform: translateX(60px); z-index: 4; }
    </style>
    {{-- <x-properties-top-nav /> --}}
    
    <div class="row">
        <div class="col-sm-6 col-lg-4">
            <div class="card subscribe-card">
                <span class="ribbon2 text-white p-3">$0 <br>/month</span>
                <div class="card-body">
                    <span class="fw-bolder text-uppercase fs-2 d-block mb-7">Silver</span>
                    <div class="my-4">
                        <img src="../assets/images/backgrounds/silver.png" alt="modernize-img" class="img-fluid" width="80" height="80" />
                    </div>
                    <h2 class="fw-bolder fs-12 mb-3">Free</h2>
                    <ul class="list-unstyled mb-7">
                        <li class="d-flex align-items-center gap-2 py-2">
                            <i class="ti ti-check text-primary fs-4"></i>
                            <span class="text-dark">3 Members</span>
                        </li>
                        <li class="d-flex align-items-center gap-2 py-2">
                            <i class="ti ti-check text-primary fs-4"></i>
                            <span class="text-dark">Single Devise</span>
                        </li>
                        <li class="d-flex align-items-center gap-2 py-2">
                            <i class="ti ti-x text-muted fs-4"></i>
                            <span class="text-muted">50GB Storage</span>
                        </li>
                        <li class="d-flex align-items-center gap-2 py-2">
                            <i class="ti ti-x text-muted fs-4"></i>
                            <span class="text-muted">Monthly Backups</span>
                        </li>
                        <li class="d-flex align-items-center gap-2 py-2">
                            <i class="ti ti-x text-muted fs-4"></i>
                            <span class="text-muted">Permissions &amp; workflows</span>
                        </li>
                    </ul>
                    <button class="btn btn-primary fw-bolder py-6 w-100 text-capitalize subscribe-btn">@lang('Save Changes')</button>
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-lg-4">
            <div class="card subscribe-card">
                <span class="ribbon2 text-white p-3">$0 <br>/month</span>
                <div class="card-body pt-6">
                    <div class="text-end">
                        <span class="badge fw-bolder py-1 bg-warning-subtle text-warning text-uppercase fs-2 rounded-3">POPULAR</span>
                    </div>
                    <span class="fw-bolder text-uppercase fs-2 d-block mb-7">bronze</span>
                    <div class="my-4">
                        <img src="../assets/images/backgrounds/bronze.png" alt="modernize-img" class="img-fluid" width="80" height="80" />
                    </div>
                    <div class="d-flex mb-3">
                        <h5 class="fw-bolder fs-6 mb-0">$</h5>
                        <h2 class="fw-bolder fs-12 ms-2 mb-0">4.99</h2>
                        <span class="ms-2 fs-4 d-flex align-items-center">/mo</span>
                    </div>
                    <ul class="list-unstyled mb-7">
                        <li class="d-flex align-items-center gap-2 py-2">
                            <i class="ti ti-check text-primary fs-4"></i>
                            <span class="text-dark">5 Members</span>
                        </li>
                        <li class="d-flex align-items-center gap-2 py-2">
                            <i class="ti ti-check text-primary fs-4"></i>
                            <span class="text-dark">Single Devise</span>
                        </li>
                        <li class="d-flex align-items-center gap-2 py-2">
                            <i class="ti ti-check text-primary fs-4"></i>
                            <span class="text-dark">80GB Storage</span>
                        </li>
                        <li class="d-flex align-items-center gap-2 py-2">
                            <i class="ti ti-x text-muted fs-4"></i>
                            <span class="text-muted">Monthly Backups</span>
                        </li>
                        <li class="d-flex align-items-center gap-2 py-2">
                            <i class="ti ti-x text-muted fs-4"></i>
                            <span class="text-muted">Permissions &amp; workflows</span>
                        </li>
                    </ul>
                    <button class="btn btn-primary fw-bolder py-6 w-100 text-capitalize subscribe-btn">@lang('Save Changes')</button>
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-lg-4">
            <div class="card subscribe-card">
                <span class="ribbon2 text-white p-3">$0 <br>/month</span>
                <div class="card-body">
                    <span class="fw-bolder text-uppercase fs-2 d-block mb-7">gold</span>
                    <div class="my-4">
                        <img src="../assets/images/backgrounds/gold.png" alt="modernize-img" class="img-fluid" width="80" height="80" />
                    </div>
                    <div class="d-flex mb-3">
                        <h5 class="fw-bolder fs-6 mb-0">$</h5>
                        <h2 class="fw-bolder fs-12 ms-2 mb-0">9.99</h2>
                        <span class="ms-2 fs-4 d-flex align-items-center">/mo</span>
                    </div>
                    <ul class="list-unstyled mb-7">
                        <li class="d-flex align-items-center gap-2 py-2">
                            <i class="ti ti-check text-primary fs-4"></i>
                            <span class="text-dark">5 Members</span>
                        </li>
                        <li class="d-flex align-items-center gap-2 py-2">
                            <i class="ti ti-check text-primary fs-4"></i>
                            <span class="text-dark">Single Devise</span>
                        </li>
                        <li class="d-flex align-items-center gap-2 py-2">
                            <i class="ti ti-check text-primary fs-4"></i>
                            <span class="text-dark">120GB Storage</span>
                        </li>
                        <li class="d-flex align-items-center gap-2 py-2">
                            <i class="ti ti-check text-primary fs-4"></i>
                            <span class="text-dark">Monthly Backups</span>
                        </li>
                        <li class="d-flex align-items-center gap-2 py-2">
                            <i class="ti ti-check text-primary fs-4"></i>
                            <span class="text-dark">Permissions &amp; workflows</span>
                        </li>
                    </ul>
                    <button class="btn btn-primary fw-bolder py-6 w-100 text-capitalize subscribe-btn">@lang('Save Changes')</button>
                </div>
            </div>
        </div>
    </div>

</x-app-layout>