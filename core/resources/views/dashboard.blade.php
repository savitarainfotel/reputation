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
</x-app-layout>
