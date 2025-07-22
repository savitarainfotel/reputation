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

        .img1 { transform: translateX(-120px); z-index: 1; }
        .img2 { transform: translateX(-60px); z-index: 2; }
        .img3 { transform: translateX(0px); z-index: 3; }
        .img4 { transform: translateX(60px); z-index: 4; }
    </style>
    <x-properties-top-nav />
    <div class="row mt-3">
        <div class="col-xxl-3 col-xl-3 col-lg-3 col-md-4 col-sm-6 mb-4">
            <a href="#" class="card style-2 mb-md-0 mb-4 p-4">
                <div class="card-body px-0 pb-0">
                    <img src="http://localhost/rms_ci/rms-new/uploads/properties/the-capital-hotel-resort-bali.jpg" class="property-img" />
                    <h5 class="card-title mb-3">The Capital Hotel &amp; Resort Bali</h5>
                    <div class="media mt-4 mb-0 pt-1">
                        <div class="media-body">
                            <div class="row">
                                <div class="col-6">
                                    <h4 class="media-heading mb-1 text-dark font-weight-bold">11</h4>
                                    <h4 class="media-heading mb-1 text-dark">Reviews</h4>
                                </div>
                                <div class="col-6">
                                    <div class="hstack p-3 mb-3 mb-md-0">
                                        <img src="{{asset('assets/images/google-logo.png')}}" class="rounded-circle border border-2 border-white" width="30" height="30" alt="modernize-img">
                                        <img src="{{asset('assets/images/booking-logo.png')}}" class="rounded-circle border border-2 border-white" width="30" height="30" alt="modernize-img">
                                        <img src="{{asset('assets/images/expedia-logo.png')}}" class="rounded-circle border border-2 border-white" width="30" height="30" alt="modernize-img">
                                        <img src="{{asset('assets/images/airbnb-logo.png')}}" class="rounded-circle border border-2 border-white" width="30" height="30" alt="modernize-img">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </a>
        </div>
        <div class="col-xxl-3 col-xl-3 col-lg-3 col-md-4 col-sm-6 mb-4">
            <a href="#" class="card style-2 mb-md-0 mb-4 p-4">
                <div class="card-body px-0 pb-0">
                    <img src="http://localhost/rms_ci/rms-new/uploads/properties/savitara-infotel-private-limited.jpg" class="property-img" />
                    <h5 class="card-title mb-3">SAVITARA INFOTEL PRIVATE LIMITED</h5>
                    <div class="media mt-4 mb-0 pt-1">
                        <div class="media-body">
                            <div class="row">
                                <div class="col-6">
                                    <h4 class="media-heading mb-1 text-dark font-weight-bold">11</h4>
                                    <h4 class="media-heading mb-1 text-dark">Reviews</h4>
                                </div>
                                <div class="col-6">
                                    <div class="hstack p-3 mb-3 mb-md-0">
                                        <img src="{{asset('assets/images/google-logo.png')}}" class="rounded-circle border border-2 border-white" width="30" height="30" alt="modernize-img">
                                        <img src="{{asset('assets/images/booking-logo.png')}}" class="rounded-circle border border-2 border-white" width="30" height="30" alt="modernize-img">
                                        <img src="{{asset('assets/images/expedia-logo.png')}}" class="rounded-circle border border-2 border-white" width="30" height="30" alt="modernize-img">
                                        <img src="{{asset('assets/images/airbnb-logo.png')}}" class="rounded-circle border border-2 border-white" width="30" height="30" alt="modernize-img">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </a>
        </div>
        <div class="col-xxl-3 col-xl-3 col-lg-3 col-md-4 col-sm-6 mb-4">
            <a href="#" class="card style-2 mb-md-0 mb-4 p-4">
                <div class="card-body px-0 pb-0">
                    <img src="http://localhost/rms_ci/rms-new/uploads/properties/savitara-infotel-private-limited.jpg" class="property-img" />
                    <h5 class="card-title mb-3">SAVITARA INFOTEL PRIVATE LIMITED</h5>
                    <div class="media mt-4 mb-0 pt-1">
                        <div class="media-body">
                            <div class="row">
                                <div class="col-6">
                                    <h4 class="media-heading mb-1 text-dark font-weight-bold">11</h4>
                                    <h4 class="media-heading mb-1 text-dark">Reviews</h4>
                                </div>
                                <div class="col-6">
                                    <div class="hstack p-3 mb-3 mb-md-0">
                                        <img src="{{asset('assets/images/google-logo.png')}}" class="rounded-circle border border-2 border-white" width="30" height="30" alt="modernize-img">
                                        <img src="{{asset('assets/images/booking-logo.png')}}" class="rounded-circle border border-2 border-white" width="30" height="30" alt="modernize-img">
                                        <img src="{{asset('assets/images/expedia-logo.png')}}" class="rounded-circle border border-2 border-white" width="30" height="30" alt="modernize-img">
                                        <img src="{{asset('assets/images/airbnb-logo.png')}}" class="rounded-circle border border-2 border-white" width="30" height="30" alt="modernize-img">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </a>
        </div>
        <div class="col-xxl-3 col-xl-3 col-lg-3 col-md-4 col-sm-6 mb-4">
            <a href="#" class="card style-2 mb-md-0 mb-4 p-4">
                <div class="card-body px-0 pb-0">
                    <img src="http://localhost/rms_ci/rms-new/uploads/properties/oberoi-mall.jpg" class="property-img" />
                    <h5 class="card-title mb-3">Oberoi Mall</h5>
                    <div class="media mt-4 mb-0 pt-1">
                        <div class="media-body">
                            <div class="row">
                                <div class="col-6">
                                    <h4 class="media-heading mb-1 text-dark font-weight-bold">11</h4>
                                    <h4 class="media-heading mb-1 text-dark">Reviews</h4>
                                </div>
                                <div class="col-6">
                                    <div class="hstack p-3 mb-3 mb-md-0">
                                        <img src="{{asset('assets/images/google-logo.png')}}" class="rounded-circle border border-2 border-white" width="30" height="30" alt="modernize-img">
                                        <img src="{{asset('assets/images/booking-logo.png')}}" class="rounded-circle border border-2 border-white" width="30" height="30" alt="modernize-img">
                                        <img src="{{asset('assets/images/expedia-logo.png')}}" class="rounded-circle border border-2 border-white" width="30" height="30" alt="modernize-img">
                                        <img src="{{asset('assets/images/airbnb-logo.png')}}" class="rounded-circle border border-2 border-white" width="30" height="30" alt="modernize-img">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </a>
        </div>
    </div>

</x-app-layout>