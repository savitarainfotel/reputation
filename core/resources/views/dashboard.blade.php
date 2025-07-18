<x-app-layout>
    <style>
        .toolbar{
            border-bottom: 1px solid #dee2e6;
        }
        .review-card {
            border: 1px solid #e0e0e0;
            border-radius: 8px;
            padding: 25px;
            margin-bottom: 20px;
        }
        .circular-img {
            width: 40px;
            height: 40px;
            object-fit: cover;
            border-radius: 50%;
        }
        .author-img {
            width: 30px;
            height: 30px;
            object-fit: cover;
            border-radius: 50%;
        }
    </style>
    {{-- header section starts here --}}
   <div class="row toolbar align-items-center p-3">
        <div class="col-md-4">
            <div class="row">
                <div class="col-4">
                    <h5 class="mb-0 text-dark">@lang('Review Inbox')</h5>
                </div>
                <div class="col-8">
                    <div class="d-flex justify-content-end align-items-center gap-3">
                        <select id="property-select" class="form-select form-select-sm ">
                            <option value="" class="">@lang('Filter Reviews')</option>
                        </select>
                        <select class="form-select form-select-sm">
                            <option class="">@lang('Most recent')</option>
                        </select>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-8 text-end">
            <button class="btn btn-outline-dark btn-sm _effect--ripple waves-effect waves-light">
                <i class="fas fa-envelope me-2"></i>
                @lang('Reply settings')
            </button>
        </div>
    </div>
    {{-- reviews list starts here --}}
    <div class="row review-list mt-3">
        <div class="row mb-3">
            <div class="d-flex justify-content-start align-items-center">
                <input type="checkbox" class="form-check-input mt-2">
                <label class="form-check-label ms-2">@lang('Select All')</label>
            </div>
        </div>
        <div class="review-card" style="max-width: 400px;">
            <div class="card-body">
                <!-- Product Title with Circular Image -->
                <div class="d-flex align-items-center mb-2">
                    <img src="https://maps.gstatic.com/mapfiles/place_api/icons/v1/png_71/generic_business-71.png" class="circular-img me-2" alt="Property Image">
                    <div class="mb-2">
                        <h5 class="card-title mb-0">Savitara Infotel</h5>
                        <i class="fas fa-star text-warning"></i>
                        <i class="fas fa-star text-warning"></i>
                        <i class="fas fa-star text-warning"></i>
                        <i class="fas fa-star-half-alt text-warning"></i>
                        <i class="far fa-star text-warning"></i>
                        <span class="ms-1 text-muted">(4.5)</span>
                    </div>    
                </div>
                <!-- Ratings -->
                
                <!-- Author Name with Circular Image -->
                <div class="d-flex align-items-center mb-1">
                    <img src="https://lh3.googleusercontent.com/a-/ALV-UjUzMzZkSMzoW6TDdkEnQl_yJM6T5SUshrH0U67kVeponjMyeYWq=s128-c0x00000000-cc-rp-mo" class="author-img me-2" alt="Author Image">
                    <div>
                        <p class="card-text mb-0">By John Doe</p>
                        <p class="card-text text-muted small mb-2">Posted on July 15, 2025</p>
                    </div>
                </div>
                <!-- Date -->
                <!-- Comment -->
                <p class="card-text">Excellent service from Savitara Infotel! Their ....</p>
                <p class="card-text text-muted small mb-2">Lorem ipsum dolor sit amet consectetur adipisicing elit. Molestias neque perspiciatis officiis quod est voluptate consectetur sunt esse recusandae. Eaque placeat</p>
            </div>
        </div>
    </div>
    {{-- code for modal --}}
    
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <div id="bs-example-modal-md" class="modal fade show" tabindex="-1" aria-labelledby="bs-example-modal-md" aria-modal="true" role="dialog">
        <div class="modal-dialog modal-dialog-scrollable modal-xl">
            <div class="modal-content">
                <div class="modal-header d-flex align-items-center">
                    <h4 class="modal-title" id="myModalLabel">
                    </h4>
                    <button type="button" class="btn-close close-btn" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="modal-section">
                        <div class="row">
                            <div class="col-3">
                                <div class="d-flex align-items-center mb-2">
                                    <img src="https://maps.gstatic.com/mapfiles/place_api/icons/v1/png_71/generic_business-71.png" class="circular-img me-2" alt="Property Image">
                                    <div class="mb-2">
                                        <h5 class="card-title mb-0">Savitara Infotel</h5>
                                        <i class="fas fa-star text-warning"></i>
                                        <i class="fas fa-star text-warning"></i>
                                        <i class="fas fa-star text-warning"></i>
                                        <i class="fas fa-star-half-alt text-warning"></i>
                                        <i class="far fa-star text-warning"></i>
                                        <span class="ms-1 text-muted">(4.5)</span>
                                    </div>    
                                </div>
                            </div>
                            <div class="col-3">
                                <div class="d-flex align-items-center mb-1">
                                    <img src="https://lh3.googleusercontent.com/a-/ALV-UjUzMzZkSMzoW6TDdkEnQl_yJM6T5SUshrH0U67kVeponjMyeYWq=s128-c0x00000000-cc-rp-mo" class="author-img me-2" alt="Author Image">
                                    <div>
                                        <p class="card-text mb-0">By John Doe</p>
                                        <p class="card-text text-muted small mb-2">Posted on July 15, 2025</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-3">
                                <div class="form-check form-switch mb-0">
                                    <input class="form-check-input" type="checkbox" role="switch" id="flexSwitchCheckChecked" checked="">
                                </div>
                                <div>
                                    <p>Show translation to</p>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <h5 class="card-title mb-0">Reliable Servie & Exellent Support</h5>
                            <p>Excellent service from Savitara Infotel! Their team delivered a modern, responsive website on time and boosted our online presence with smart digital marketing. Highly recommended!</p>
                        </div>
                        <div class="row">
                            <div class="col-6">
                                <p>Pros:</p>
                                <ul>
                                    <li>This is sample text</li>
                                    <li>This is sample text</li>
                                </ul>
                            </div>
                            <div class="col-6">
                                <p>cons:</p>
                                <ul>
                                    <li>This is sample text</li>
                                    <li>This is sample text</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="modal-section mb-3">
                        <div class="row justify-content-between ">
                            <div class="col-3">
                                <h5>Reply</h5>
                            </div>
                            <div class="col-3 d-flex gap-3 justify-content-end">
                                <span class="border border-dark p-2"><i class="fa-solid fa-copy"></i></span>
                                <span>select</span>
                            </div>
                            <div class="mt-3">
                                <textarea name="" id="" cols="150" rows="6"></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="modal-section mb-3">
                        <div class="row justify-content-between ">
                            <div class="col-3">
                                <h5>Reply</h5>
                            </div>
                            <div class="col-3 d-flex gap-3 justify-content-end">
                                <span class="border border-dark p-2"><i class="fa-solid fa-copy"></i></span>
                                <span>select</span>
                            </div>
                            <div class="mt-3">
                                <textarea name="" id="" cols="150" rows="6"></textarea>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="mx-3 my-3">
                    <div class="row">
                        <div class="col-8">
                            <button type="button" class="btn bg-secondary text-white waves-effect" data-bs-dismiss="modal">
                                Copy & open
                            </button>
                            <button type="button" class="btn btn-outline-primary waves-effect" data-bs-dismiss="modal">
                                Mark As Unanswered
                            </button>
                        </div>
                        <div class="col-3">
                             <button type="button" class="btn btn-outline-dark waves-effect" data-bs-dismiss="modal">
                                Generate Reply
                            </button>
                             <button type="button" class="btn bg-primary text-white waves-effect" data-bs-dismiss="modal">
                                <i class="fa-solid fa-paper-plane"></i>
                            </button>
                        </div>
                    </div>

                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
        <button class="btn me-1 mb-1 bg-primary-subtle text-primary px-4 fs-4" data-bs-toggle="modal" data-bs-target="#bs-example-modal-md">
            Medium Modal
        </button>
    </div>
    {{--  --}}
    <script>
        $(document).ready(function() {
            $('.card-title').click(function() {
                $('#bs-example-modal-md').show();
            });

            $('.close-btn').click(function() {
                $('#bs-example-modal-md').hide();
            });

            $(window).click(function(event) {
                if (event.target.id === 'bs-example-modal-md') {
                    $('#bs-example-modal-md').hide();
                }
            });
        });
    </script>
</x-app-layout>
