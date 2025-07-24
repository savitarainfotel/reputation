<x-app-layout>
    <style>
        .position-lg-absolute {
            position: absolute !important;
        }
        .border-lg-end {
            border-right: 1px solid #152C56 !important;
        }
        .form-select{
            border: 1px solid #152C564D !important;
        }
        .dropdown-menu{
            border: 1px solid #152C564D !important;
        }
        @media (max-width: 768px) {
           .position-lg-absolute {
                position:unset !important;
            }
            .border-lg-end {
                border-right: none !important;
            }
        }
    </style>
    <div class="row ">
        <div class="col-lg-6 border-lg-end position-relative">
            <h5>Review</h5>
            <div class="dropdown ">
                <button class="form-select text-start d-flex align-items-center" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
                    Property <img src="{{ asset('assets/images/company_Logo.png') }}" alt="logo" width="30" height="30" class="mx-2 rounded-circle"> Savitara Infotel Pvt Ltd.
                </button>
                <ul class="dropdown-menu w-100" aria-labelledby="dropdownMenuButton">
                    <li>
                    <a class="dropdown-item d-flex align-items-center" href="#">
                        <img src="{{ asset('assets/images/company_Logo.png') }}" alt="logo" width="30" class="me-2 rounded-circle">
                        Property <img src="{{ asset('assets/images/company_Logo.png') }}" alt="logo" width="30" height="30" class="mx-2 rounded-circle"> Savitara Infotel Pvt Ltd.
                    </a>
                    </li>
                    <li><a class="dropdown-item" href="#">Customer Service Enquiry</a></li>
                    <li><a class="dropdown-item" href="#">Legal Enquiry</a></li>
                    <li><a class="dropdown-item" href="#">General Enquiry</a></li>
                </ul>
            </div>
           
            <div class="card border mt-3">
                <div class="card-header  d-flex align-items-center justify-content-between bg-transparent">
                    <div class="d-flex align-items-center">
                        <img src="{{ asset('assets/images/svg/review.svg') }}" alt="review" class="rounded me-2">
                        <h5 class="card-title mb-0 fs-4 fw-bold">Review</h5>
                    </div>
                   
                </div>
                <div class="card-body collapse show pt-0">
                    <p class="fw-bold fs-4 text-dark">Category Ratings</p>
                    <div class="d-flex align-items-center mb-2">
                        <input type="text" name="" class="form-control w-30" id="" placeholder="Enter Category"> 
                        <span class="ms-3">
                            <img src="{{ asset('assets/images/svg/star.svg') }}" alt="star" srcset="">
                            <img src="{{ asset('assets/images/svg/star.svg') }}" alt="star" srcset="">
                            <img src="{{ asset('assets/images/svg/star.svg') }}" alt="star" srcset="">
                            <img src="{{ asset('assets/images/svg/star.svg') }}" alt="star" srcset="">
                            <img src="{{ asset('assets/images/svg/star.svg') }}" alt="star" srcset="">
                        </span>
                        <span class="mt-1 fs-4 mx-3">5 </span>
                        <img src="{{ asset('assets/images/svg/close.svg') }}" alt="close" srcset="" class="mt-1">
                    </div>
                    <a href="#" class="text-secondary "><img src="{{ asset('assets/images/svg/addfile.svg') }}" alt="file" srcset="" class="me-2">Create first Smart Snippets</a>
                </div>
            </div>
            <div class="text-end">
                <a href="#" class="btn border text-primary fw-bold fs-4 mt-2 d-inline-flex align-items-center"><img src="{{ asset('assets/images/svg/reply.svg') }}" alt="reply" srcset="" class="me-2">Generate Reply</a>
            </div>
            <div class="card border mt-3">
                <div class="card-header  d-flex align-items-center justify-content-between bg-transparent">
                    <div class="d-flex align-items-center">
                        <img src="{{ asset('assets/images/svg/thumbstar.svg') }}" alt="review" class="rounded me-2">
                        <h5 class="card-title mb-0 fs-4 fw-bold">Generated Reply</h5>
                    </div>
                    <div class="d-flex">
                        <span class="p-1 border rounded me-2"><img src="{{ asset('assets/images/svg/file.svg') }}"
                                alt="file" srcset=""></span>
                        <div class="dropdown">
                            <button class="btn border" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="flag-icon flag-icon-in me-1" title="in" id="in"></i> INR <i class="ti ti-chevron-down ms-1"></i>
                            </button>
                            <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                                <li>
                                    <a class="dropdown-item" href="javascript:void(0)">
                                        <i class="flag-icon flag-icon-in me-1" title="in" id="in"></i> INR
                                    </a>
                                </li>
                                <li>
                                    <a class="dropdown-item" href="javascript:void(0)">
                                        <i class="flag-icon flag-icon-us me-1" title="us"></i> USD
                                    </a>
                                </li>
                                <li>
                                    <a class="dropdown-item" href="javascript:void(0)">
                                        <i class="flag-icon flag-icon-fr me-1" title="fr" id="fr"></i> FRF
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="card-body collapse show pt-0">
                    <p class="fw-bold text-dark mb-0">I’ve been using Savitara Infotel for over a year now for our hotel property's Wi-Fi and communication systems.</p>
                </div>
            </div>
            <nav aria-label="..." class="position-lg-absolute  bottom-0 end-0">
                <ul class="pagination align-items-center justify-content-end mb-2 ms-8 ms-sm-9">
                <li class="page-item p-1">
                    <a class="page-link border-0 rounded text-dark fs-6 round-32 d-flex align-items-center justify-content-center" href="javascript:void(0)">
                    <i class="ti ti-arrow-left"></i>
                    </a>
                </li>
                <span class="fw-bold border-bottom border-3 border-info">1/3 Generated Replys</span>
                <li class="page-item p-1">
                    <a class="page-link border-0 rounded text-dark fs-6 round-32 d-flex align-items-center justify-content-center" href="javascript:void(0)">
                    <i class="ti ti-arrow-right"></i>
                    </a>
                </li>
                </ul>
            </nav>
        </div>
        <div class="col-lg-6 overflow-scroll vh-90 ">
            <h5>History</h5>
            <div class="row">
                <div class="col-xl-6 col-lg-12 col-md-6">
                    <div class="card border">
                        <div class="card-header  d-flex align-items-center justify-content-between bg-transparent">
                            <div class="d-flex align-items-center">
                                <img src="{{ asset('assets/images/company_logo.png') }}" alt="user"
                                    class="rounded me-2" width="50" height="50">
                                <h5 class="card-title mb-0 fs-3 fw-bold">Savitara Infotel Pvt. Ltd.</h5>
                            </div>
                            <div class="d-flex">
                                <span class="p-2 border rounded "><img src="{{ asset('assets/images/svg/file.svg') }}"
                                        alt="file" srcset=""></span>
                                <span class="ms-2 p-2 border rounded"><img
                                        src="{{ asset('assets/images/svg/edit.svg') }}" alt="file"
                                        srcset=""></span>
                            </div>
                        </div>
                        <div class="card-body collapse show pt-0">
                            <h5 class="card-title">Category Ratings</h5>
                            <div class="d-flex align-items-center mb-2">
                                <p class="mb-0">Category Ratings</p>
                                {{-- <input type="text" name="" class="form-control w-30" id="" placeholder="Enter Category">  --}}
                                <span class="ms-2">
                                    <img src="{{ asset('assets/images/svg/star.svg') }}" alt="star" srcset="">
                                    <img src="{{ asset('assets/images/svg/star.svg') }}" alt="star" srcset="">
                                    <img src="{{ asset('assets/images/svg/star.svg') }}" alt="star" srcset="">
                                    <img src="{{ asset('assets/images/svg/star.svg') }}" alt="star" srcset="">
                                    <img src="{{ asset('assets/images/svg/star.svg') }}" alt="star" srcset="">
                                </span>
                                <span class="mt-1 fs-4 ms-2">5 </span>
                                
                            </div>
                            <h5 class="card-title">Generated Reply</h5>
                            <p class="card-text fs-2">
                                The facility as well as the staff were way above our expectations. The location of this
                                hotel is strategically located at the center of places you can visit... and if not, the
                                transportation was a few steps away.
                            </p>

                        </div>
                    </div>
                </div>
                <div class="col-xl-6 col-lg-12 col-md-6">
                    <div class="card border">
                        <div class="card-header  d-flex align-items-center justify-content-between bg-transparent">
                            <div class="d-flex align-items-center">
                                <img src="{{ asset('assets/images/company_logo.png') }}" alt="user"
                                    class="rounded me-2" width="50" height="50">
                                <h5 class="card-title mb-0 fs-3 fw-bold">Savitara Infotel Pvt. Ltd.</h5>
                            </div>
                            <div class="d-flex">
                                <span class="p-2 border rounded "><img src="{{ asset('assets/images/svg/file.svg') }}"
                                        alt="file" srcset=""></span>
                                <span class="ms-2 p-2 border rounded"><img
                                        src="{{ asset('assets/images/svg/edit.svg') }}" alt="file"
                                        srcset=""></span>
                            </div>
                        </div>
                        <div class="card-body collapse show pt-0">
                            <h5 class="card-title">Category Ratings</h5>
                            <div class="d-flex align-items-center mb-2">
                                <p class="mb-0">Category Ratings</p>
                                {{-- <input type="text" name="" class="form-control w-30" id="" placeholder="Enter Category">  --}}
                                <span class="ms-2">
                                    <img src="{{ asset('assets/images/svg/star.svg') }}" alt="star" srcset="">
                                    <img src="{{ asset('assets/images/svg/star.svg') }}" alt="star" srcset="">
                                    <img src="{{ asset('assets/images/svg/star.svg') }}" alt="star" srcset="">
                                    <img src="{{ asset('assets/images/svg/star.svg') }}" alt="star" srcset="">
                                    <img src="{{ asset('assets/images/svg/star.svg') }}" alt="star" srcset="">
                                </span>
                                <span class="mt-1 fs-4 ms-2">5 </span>
                                
                            </div>
                            <h5 class="card-title">Generated Reply</h5>
                            <p class="card-text fs-2">
                                The facility as well as the staff were way above our expectations. The location of this
                                hotel is strategically located at the center of places you can visit... and if not, the
                                transportation was a few steps away.
                            </p>

                        </div>
                    </div>
                </div>
                <div class="col-xl-6 col-lg-12 col-md-6">
                    <div class="card border">
                        <div class="card-header  d-flex align-items-center justify-content-between bg-transparent">
                            <div class="d-flex align-items-center">
                                <img src="{{ asset('assets/images/company_logo.png') }}" alt="user"
                                    class="rounded me-2" width="50" height="50">
                                <h5 class="card-title mb-0 fs-3 fw-bold">Savitara Infotel Pvt. Ltd.</h5>
                            </div>
                            <div class="d-flex">
                                <span class="p-2 border rounded "><img src="{{ asset('assets/images/svg/file.svg') }}"
                                        alt="file" srcset=""></span>
                                <span class="ms-2 p-2 border rounded"><img
                                        src="{{ asset('assets/images/svg/edit.svg') }}" alt="file"
                                        srcset=""></span>
                            </div>
                        </div>
                        <div class="card-body collapse show pt-0">
                            <h5 class="card-title">Category Ratings</h5>
                            <div class="d-flex align-items-center mb-2">
                                <p class="mb-0">Category Ratings</p>
                                {{-- <input type="text" name="" class="form-control w-30" id="" placeholder="Enter Category">  --}}
                                <span class="ms-2">
                                    <img src="{{ asset('assets/images/svg/star.svg') }}" alt="star" srcset="">
                                    <img src="{{ asset('assets/images/svg/star.svg') }}" alt="star" srcset="">
                                    <img src="{{ asset('assets/images/svg/star.svg') }}" alt="star" srcset="">
                                    <img src="{{ asset('assets/images/svg/star.svg') }}" alt="star" srcset="">
                                    <img src="{{ asset('assets/images/svg/star.svg') }}" alt="star" srcset="">
                                </span>
                                <span class="mt-1 fs-4 ms-2">5 </span>
                                
                            </div>
                            <h5 class="card-title">Generated Reply</h5>
                            <p class="card-text fs-2">
                                The facility as well as the staff were way above our expectations. The location of this
                                hotel is strategically located at the center of places you can visit... and if not, the
                                transportation was a few steps away.
                            </p>

                        </div>
                    </div>
                </div>
                <div class="col-xl-6 col-lg-12 col-md-6">
                    <div class="card border">
                        <div class="card-header  d-flex align-items-center justify-content-between bg-transparent">
                            <div class="d-flex align-items-center">
                                <img src="{{ asset('assets/images/company_logo.png') }}" alt="user"
                                    class="rounded me-2" width="50" height="50">
                                <h5 class="card-title mb-0 fs-3 fw-bold">Savitara Infotel Pvt. Ltd.</h5>
                            </div>
                            <div class="d-flex">
                                <span class="p-2 border rounded "><img src="{{ asset('assets/images/svg/file.svg') }}"
                                        alt="file" srcset=""></span>
                                <span class="ms-2 p-2 border rounded"><img
                                        src="{{ asset('assets/images/svg/edit.svg') }}" alt="file"
                                        srcset=""></span>
                            </div>
                        </div>
                        <div class="card-body collapse show pt-0">
                            <h5 class="card-title">Category Ratings</h5>
                            <div class="d-flex align-items-center mb-2">
                                <p class="mb-0">Category Ratings</p>
                                {{-- <input type="text" name="" class="form-control w-30" id="" placeholder="Enter Category">  --}}
                                <span class="ms-2">
                                    <img src="{{ asset('assets/images/svg/star.svg') }}" alt="star" srcset="">
                                    <img src="{{ asset('assets/images/svg/star.svg') }}" alt="star" srcset="">
                                    <img src="{{ asset('assets/images/svg/star.svg') }}" alt="star" srcset="">
                                    <img src="{{ asset('assets/images/svg/star.svg') }}" alt="star" srcset="">
                                    <img src="{{ asset('assets/images/svg/star.svg') }}" alt="star" srcset="">
                                </span>
                                <span class="mt-1 fs-4 ms-2">5 </span>
                                
                            </div>
                            <h5 class="card-title">Generated Reply</h5>
                            <p class="card-text fs-2">
                                The facility as well as the staff were way above our expectations. The location of this
                                hotel is strategically located at the center of places you can visit... and if not, the
                                transportation was a few steps away.
                            </p>

                        </div>
                    </div>
                </div>
                <div class="col-xl-6 col-lg-12 col-md-6">
                    <div class="card border">
                        <div class="card-header  d-flex align-items-center justify-content-between bg-transparent">
                            <div class="d-flex align-items-center">
                                <img src="{{ asset('assets/images/company_logo.png') }}" alt="user"
                                    class="rounded me-2" width="50" height="50">
                                <h5 class="card-title mb-0 fs-3 fw-bold">Savitara Infotel Pvt. Ltd.</h5>
                            </div>
                            <div class="d-flex">
                                <span class="p-2 border rounded "><img src="{{ asset('assets/images/svg/file.svg') }}"
                                        alt="file" srcset=""></span>
                                <span class="ms-2 p-2 border rounded"><img
                                        src="{{ asset('assets/images/svg/edit.svg') }}" alt="file"
                                        srcset=""></span>
                            </div>
                        </div>
                        <div class="card-body collapse show pt-0">
                            <h5 class="card-title">Category Ratings</h5>
                            <div class="d-flex align-items-center mb-2">
                                <p class="mb-0">Category Ratings</p>
                                {{-- <input type="text" name="" class="form-control w-30" id="" placeholder="Enter Category">  --}}
                                <span class="ms-2">
                                    <img src="{{ asset('assets/images/svg/star.svg') }}" alt="star" srcset="">
                                    <img src="{{ asset('assets/images/svg/star.svg') }}" alt="star" srcset="">
                                    <img src="{{ asset('assets/images/svg/star.svg') }}" alt="star" srcset="">
                                    <img src="{{ asset('assets/images/svg/star.svg') }}" alt="star" srcset="">
                                    <img src="{{ asset('assets/images/svg/star.svg') }}" alt="star" srcset="">
                                </span>
                                <span class="mt-1 fs-4 ms-2">5 </span>
                                
                            </div>
                            <h5 class="card-title">Generated Reply</h5>
                            <p class="card-text fs-2">
                                The facility as well as the staff were way above our expectations. The location of this
                                hotel is strategically located at the center of places you can visit... and if not, the
                                transportation was a few steps away.
                            </p>

                        </div>
                    </div>
                </div>
                <div class="col-xl-6 col-lg-12 col-md-6">
                    <div class="card border">
                        <div class="card-header  d-flex align-items-center justify-content-between bg-transparent">
                            <div class="d-flex align-items-center">
                                <img src="{{ asset('assets/images/company_logo.png') }}" alt="user"
                                    class="rounded me-2" width="50" height="50">
                                <h5 class="card-title mb-0 fs-3 fw-bold">Savitara Infotel Pvt. Ltd.</h5>
                            </div>
                            <div class="d-flex">
                                <span class="p-2 border rounded "><img src="{{ asset('assets/images/svg/file.svg') }}"
                                        alt="file" srcset=""></span>
                                <span class="ms-2 p-2 border rounded"><img
                                        src="{{ asset('assets/images/svg/edit.svg') }}" alt="file"
                                        srcset=""></span>
                            </div>
                        </div>
                        <div class="card-body collapse show pt-0">
                            <h5 class="card-title">Category Ratings</h5>
                            <div class="d-flex align-items-center mb-2">
                                <p class="mb-0">Category Ratings</p>
                                {{-- <input type="text" name="" class="form-control w-30" id="" placeholder="Enter Category">  --}}
                                <span class="ms-2">
                                    <img src="{{ asset('assets/images/svg/star.svg') }}" alt="star" srcset="">
                                    <img src="{{ asset('assets/images/svg/star.svg') }}" alt="star" srcset="">
                                    <img src="{{ asset('assets/images/svg/star.svg') }}" alt="star" srcset="">
                                    <img src="{{ asset('assets/images/svg/star.svg') }}" alt="star" srcset="">
                                    <img src="{{ asset('assets/images/svg/star.svg') }}" alt="star" srcset="">
                                </span>
                                <span class="mt-1 fs-4 ms-2">5 </span>
                                
                            </div>
                            <h5 class="card-title">Generated Reply</h5>
                            <p class="card-text fs-2">
                                The facility as well as the staff were way above our expectations. The location of this
                                hotel is strategically located at the center of places you can visit... and if not, the
                                transportation was a few steps away.
                            </p>

                        </div>
                    </div>
                </div>
                
            </div>
        </div>
    </div>
</x-app-layout>
