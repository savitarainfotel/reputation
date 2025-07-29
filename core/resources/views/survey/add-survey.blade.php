<x-app-layout>
    <style>
        .color-dot {
        width: 20px;
        height: 20px;
        border-radius: 50%;
        border: 1px solid #ccc;
        margin-right: 10px;
        cursor: pointer;
        }
        .form-control{
            border: 1px solid #152C5680 !important;
        }
        .bg-bluelight{
            background-color: #BDE3FF !important;
            border-radius: 0 0 100px 100px;
        }
        .h-20vh{
            height: 20vh;
        }
        .bg-blue{
            background-color:#1877F2 !important;
            
        }
        .question-wrapper{
            padding:30px;
            margin:-20PX 55PX 0 55PX;
        }
    </style>
    <div class="row">
        <div class="col-lg-6">
            <div class="row">
                <div class="col-lg-12">
                    <div class="d-flex">
                        <h5>@lang('Create New Survey')</h5>
                        <a href="javascript:void(0)" class="btn btn-secondary ms-auto">
                            <i class="fa fa-plus text-white me-2"></i> @lang('Add Competitors')
                        </a>
                    </div>
                    {{-- <select class="form-control" id="select-with-logo" required name="">
                        <option value="id" data-logo="{{asset('assets/images/logo.svg')}}">
                            property
                            <img src="{{asset('assets/images/logo.svg')}}" alt="icon" class="round-32" />
                            Savitara Infotel Pvt Ltd.
                        </option>
                        
                    </select> --}}
                    <div class="dropdown w-100 mt-3">
                        <button class="btn border dropdown-toggle w-100 text-start" type="button" id="customDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                            Property <img src="{{ asset('assets/images/logo.svg') }}" alt="logo" width="24" class="me-2 rounded-circle"> Savitara Infotel Pvt Ltd.
                        </button>
                        <ul class="dropdown-menu w-100" aria-labelledby="customDropdown">
                            <li>
                                <a class="dropdown-item d-flex align-items-center" href="#">
                                    <img src="" alt="logo" width="24" class="me-2 rounded-circle">
                                    Property - Savitara Infotel Pvt Ltd.
                                </a>
                            </li>
                            <li><a class="dropdown-item" href="#">Customer Service Enquiry</a></li>
                            <li><a class="dropdown-item" href="#">Legal Enquiry</a></li>
                            <li><a class="dropdown-item" href="#">General Enquiry</a></li>
                        </ul>
                    </div>
   
                    
                </div>
                <div class="col-lg-12 mt-2">
                    <a class="fs-6 fw-bold text-primary mb-3" type="button" data-bs-toggle="collapse" data-bs-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
                        <i class="fas fa-chevron-down me-2"></i>Survey Header
                    </a>
                    <div class="collapse show" id="collapseExample">
                          <div class="text-center mb-3">                                 
                                <img src="{{ asset('assets/images/review.png') }}" class="rounded mb-3" alt="review">
                                <div class="d-flex justify-content-center gap-2">
                                    <a class="btn btn-sm btn-secondary">
                                    <i class=" me-2 fas fa-pencil"></i> Change Image
                                    </a>
                                    <a class="btn btn-sm btn-outline-secondary">
                                    <i class=" me-2 fas fa-trash"></i> Delete Image
                                    </a>
                                </div>
                                </div>

                                <!-- Title -->
                                <div class="mb-3">
                                <label class="form-label fw-semibold fs-5">Title</label>
                                <input type="text" class="form-control" placeholder="Guest Experience Survey Budget Inn">
                                </div>

                                <!-- Description -->
                                <div class="mb-3">
                                <label class="form-label fw-semibold fs-5">Description</label>
                                <textarea class="form-control" rows="2" placeholder="We hope you enjoyed your stay with us. Please let us know how we did."></textarea>
                                </div>

                                <!-- Accent Color -->
                                <div class="mb-3">
                                <label class="form-label fw-semibold d-block">Accent Color</label>
                                <div class="d-flex mb-2">
                                    <div class="color-dot" style="background-color: #f87171;"></div>
                                    <div class="color-dot" style="background-color: #60a5fa;"></div>
                                    <div class="color-dot" style="background-color: #34d399;"></div>
                                    <div class="color-dot" style="background-color: #fbbf24;"></div>
                                    <div class="color-dot" style="background-color: #a78bfa;"></div>
                                    <input type="text" class="form-control form-control-sm accent-input" value="#000000">
                                    <i class="fas fa-pen ms-2 fs-4"></i>
                                </div>
                            </div>
                    </div>
                </div>
                <div class="col-lg-12 mt-2">
                    <a class="fs-6 fw-bold text-primary mb-3" type="button" data-bs-toggle="collapse" data-bs-target="#collapseExample1" aria-expanded="false" aria-controls="collapseExample">
                        <i class="fas fa-chevron-down me-2"></i>Question & Rating Scale
                    </a>
                    <div class="collapse show" id="collapseExample1">
                        <label class="form-label fw-semibold fs-5">Rating Scale <i class="fas fa-info-circle ms-2"></i></label>
                        <select class="form-control" id="select-2" required name="">
                            <option>Star (1 - 5)</option>
                            <option>Star (2 - 5)</option>
                            <option>Star (3 - 5)</option>                            
                        </select>
                        <label class="form-label fw-semibold fs-5 mt-2">Question 1 <i class="fas fa-info-circle ms-2"></i></label>
                        <textarea class="form-control" id="new-question" rows="1" placeholder="How would you rate your overall experience staying at Savitara Infotel Pvt. Ltd."></textarea>
                        <a href="#" id="add-question-btn" class="text-end d-block"><i class="fas fa-plus me-2"></i>Add More Question <i class="fas fa-info-circle ms-2"></i></a>
                        <label class="form-label fw-semibold fs-5 mt-2">Comment <i class="fas fa-info-circle ms-2"></i></label>
                        <textarea class="form-control" rows="2" placeholder="comment"></textarea>
                    </div>
                </div>
                <div class="col-lg-12 mt-2">
                    <a class="fs-6 fw-bold text-primary mb-3" type="button" data-bs-toggle="collapse" data-bs-target="#collapseExample1" aria-expanded="false" aria-controls="collapseExample">
                        <i class="fas fa-chevron-down me-2"></i>Public Review Generation
                    </a>
                    <p>To motivate satisfied guests to write public reviews, MARA utilizes their feedback from this survey and automatically generates a draft review that guests can easily copy and post on Google or Tripadvisor.</p>
                    <div class="collapse show" id="collapseExample1">
                        <label class="form-label fw-semibold fs-5">Review Platform <i class="fas fa-info-circle ms-2"></i></label>
                        <select class="form-control" id="select-2" required name="">
                            <option>Google</option>
                            <option>Agoda</option>
                            <option>google</option>                            
                        </select>
                        <label class="form-label fw-semibold fs-5 mt-2">Ask for a public review if the rating is ≥ <i class="fas fa-info-circle ms-2"></i></label>
                        <select class="form-control" id="select-2" required name="">
                            <option>3</option>
                            <option>2</option>
                            <option>5</option>                            
                        </select>                       
                        <label class="form-label fw-semibold fs-5 mt-2">Ask for contact details if the rating is < <i class="fas fa-info-circle ms-2"></i></label>
                        <select class="form-control" id="select-2" required name="">
                            <option>2</option>
                            <option>3</option>
                            <option>5</option>                            
                        </select> 
                        <div class="d-flex justify-content-end gap-2 my-3">
                            <a class="btn  btn-outline-secondary">Save & Exit </a>
                            <a class="btn  btn-secondary">Create Survey </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-6 bg-blue px-0" >
            <div class="col-lg-12 p-3 bg-bluelight">
                <div class="row mb-3 pb-5">
                    <div class="col-12 text-end mb-2">
                        <a href="#" class=" btn bg-white text-secondary py-2 px-3 rounded"><i class="fas fa-expand me-2"></i>Full Screen Preview</a>
                    </div>
                    <div class="col-5">
                        <img src="{{ asset('assets/images/review.png') }}" alt="survey" srcset="" class="w-100 h-20vh">
                    </div>
                    <div class="col-7">
                        <h4 class="text-secondary">Guest Experience Survey Budget Inn</h4>
                        <p class="text-secondary">We hope you enjoyed your stay with us. Please let us know how we did.</p>
                    </div>
                </div>
            </div>
            <div>
                <div class="card question-wrapper">
                    <div class="question">
                        <h6 class="fs-4 fw-semibold">Q 1. How would you rate your overall experience staying at Budget Inn? *</h6>
                        <span class="ms-3">
                          <i class="far fa-star"></i>  
                          <i class="far fa-star"></i>  
                          <i class="far fa-star"></i>  
                          <i class="far fa-star"></i>  
                          <i class="far fa-star"></i>  
                        </span>
                        <div class="ms-3"><span>poor</span><span class="ms-5">great</span></div>
                    </div>
                    <div class="question">
                        <h6 class="fs-4 fw-semibold">Q 2. How would you rate your overall experience staying at Budget Inn? *</h6>
                        <span class="ms-3">
                          <i class="far fa-star"></i>  
                          <i class="far fa-star"></i>  
                          <i class="far fa-star"></i>  
                          <i class="far fa-star"></i>  
                          <i class="far fa-star"></i>  
                        </span>
                    </div>
                    <div class="question">
                        <h6 class="fs-4 fw-semibold">Q 3. How would you rate your overall experience staying at Budget Inn? *</h6>
                        <span class="ms-3">
                          <i class="far fa-star"></i>  
                          <i class="far fa-star"></i>  
                          <i class="far fa-star"></i>  
                          <i class="far fa-star"></i>  
                          <i class="far fa-star"></i>  
                        </span>
                    </div>
                    <div class="question">
                        <h6 class="fs-4 fw-semibold">Q 4. How would you rate your overall experience staying at Budget Inn? *</h6>
                        <span class="ms-3">
                          <i class="far fa-star"></i>  
                          <i class="far fa-star"></i>  
                          <i class="far fa-star"></i>  
                          <i class="far fa-star"></i>  
                          <i class="far fa-star"></i>  
                        </span>
                    </div>
                    <div class="mt-3 ">
                        <label class="form-label fw-semibold fs-5">Description <i class="fas fa-info-circle ms-2"></i></label>
                        <textarea class="form-control" rows="2" placeholder="Description"></textarea>
                    </div>
                </div>
            </div>
            <div class="text-center mt-4">
                <img src="{{ asset('assets/images/logo.svg') }}" alt="logo" srcset="">
                <p class="text-white mb-0 fs-4 fw-medium">@lang('Powered by') </p>
                <a href="#" class="text-white">Hotelxplore</a>
            </div>
        </div>
    </div>
    
</x-app-layout>
<script>
        $(document).ready(function () {
            let questionCount = $('.question-wrapper .question').length;

            $('#add-question-btn').click(function (e) {
                // e.preventDefault();

                let questionText = $('#new-question').val().trim();
                if (questionText === '') return;

                questionCount++;

                let newQuestion = `
                    <div class="question mt-3">
                        <h6 class="fs-4 fw-semibold">Q ${questionCount}. ${questionText} *</h6>
                        <span class="ms-3">
                            <i class="far fa-star"></i>  
                            <i class="far fa-star"></i>  
                            <i class="far fa-star"></i>  
                            <i class="far fa-star"></i>  
                            <i class="far fa-star"></i>  
                        </span>
                    </div>
                `;

                $('.question-wrapper').append(newQuestion);
                $('#new-question').val('');
            });
        });
    </script>
