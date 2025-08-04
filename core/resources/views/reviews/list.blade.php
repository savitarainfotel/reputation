<x-app-layout>
    <div class="col-md-12 border-bottom py-2">       
        <div class="row">
            <div class="d-flex justify-content-between align-items-center flex-wrap">
                <div class="d-flex align-items-center flex-wrap gap-2">
                    <strong class="me-3">Review Inbox</strong>

                    <button class="btn border d-flex align-items-center" data-bs-toggle="offcanvas" data-bs-target="#filterSidebar">
                    <i class="fas fa-filter me-2"></i> Filter Reviews
                    </button>
                    <div class="offcanvas offcanvas-end" tabindex="-1" id="filterSidebar">
                        <div class="offcanvas-header border-bottom">
                            <h5 class="offcanvas-title">Filter reviews</h5>
                            <div>
                            <a href="#" class="me-3 text-decoration-none text-primary">Clear all</a>
                            <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                            </div>
                        </div>
                        <div class="offcanvas-body">

                            <div class="mb-3 d-flex justify-content-between align-items-center">
                            <label class="form-label mb-0">Last three months only</label>
                            <div class="form-check form-switch m-0">
                                <input class="form-check-input" type="checkbox" id="lastThreeMonths" checked>
                            </div>
                            </div>

                            <div class="mb-3">
                            <label class="form-label">Property</label>
                            <input type="text" class="form-control" placeholder="Choose below">
                            </div>

                            <div class="mb-3">
                            <label class="form-label">Review published</label>
                            <input type="text" class="form-control" placeholder="YYYY-MM-DD ~ YYYY-MM-DD">
                            </div>

                            <div class="mb-3">
                            <label class="form-label">Review Sources</label>
                            <select class="form-select">
                                <option>Choose below</option>
                            </select>
                            </div>

                            <div class="mb-3">
                            <label class="form-label">Reply status</label>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="notDone">
                                <label class="form-check-label" for="notDone">Not Done</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="notPublished">
                                <label class="form-check-label" for="notPublished">Not Published</label>
                            </div>
                            </div>

                            <div class="mb-3">
                            <label class="form-label">Rating</label>
                            <input type="range" class="form-range" min="0" max="5" step="1" id="ratingRange">
                            <div class="d-flex justify-content-between px-1 text-muted small">
                                <span>0</span><span>1</span><span>2</span><span>3</span><span>4</span><span>5</span>
                            </div>
                            </div>

                            <div class="mb-3">
                            <label class="form-label">Review type</label>
                            <select class="form-select">
                                <option>All Reviews</option>
                            </select>
                            </div>

                            <div class="mb-3">
                            <label class="form-label">Search text</label>
                            <input type="text" class="form-control" placeholder="Text to search for">
                            </div>

                            <button class="btn btn-secondary apply-btn">Apply</button>
                        </div>
                    </div>
                    {{-- <div class="d-flex align-items-center border rounded px-2 py-1"> --}}
                    <select class=" select-2 p-2 rounded border">
                        <lable class="sort-label">Sort by:</lable>
                        <option selected>Most recent</option>
                    </select>
                    {{-- </div> --}}

                    <button class="btn border text-secondary ms-2">
                    <i class="fas fa-forward me-2"></i> Configure automation
                    </button>
                </div>

                <div class="d-flex align-items-center flex-wrap gap-3 mt-2 mt-lg-0 float-end">
                    <div class="me-3 text-end">
                    <div class="response-rate">40% Response Rate</div>
                    <div class="progress bg-light">
                        <div class="progress-bar bg-success w-40" ></div>
                    </div>
                    </div>

                    <button class="btn border d-flex align-items-center">
                        <img src="{{ asset('assets/images/svg/mail-setting.svg') }}" class="me-2"> Reply settings
                    </button>
                </div>
                </div>
            </div>
        </div>
    <div class="row widget-app-columns mt-5">
        <div class="col-lg-6 scrollable mh-n205 border-end" data-simplebar="">
            <div class="row">
                @foreach ($reviews as $review)
                    <div class="col-xl-6 col-lg-6 col-md-6 col-12">
                        <div class="card border h-95 cursor-pointer review-card {{ $loop->first ? 'active' : '' }}" data-index="{{ $review->id }}" onclick="showReview({{ $review->id }})">
                            <div class="card-header d-flex align-items-center justify-content-between bg-transparent">
                                <div class="d-flex align-items-center">
                                    {!! $review->property->getImage('rounded me-2', 50, 50) !!}
                                    <h5 class="card-title mb-0 fs-3 fw-bold">
                                        <span>{{ $review->property->name }}</span> <br>
                                        <span>
                                            {!! $review->starImages !!}
                                        </span>
                                    </h5>
                                </div>
                            </div>
                            <div class="card-header d-flex align-items-center justify-content-between bg-transparent pt-1">
                                <div class="d-flex align-items-center">
                                    {!! getUserImageOrAlpha($review) !!}
                                    <img src="{{ gs('admin-url') }}uploads/platforms-logos/{{ $review->rating_platform->platform->logo }}" alt="" class="logo-on-user bg-white" width="20" height="20" />
                                    <h5 class="ms-2 card-title mb-0 fs-3 fw-bold">
                                        {{ $review->reviewer }} <br>
                                        <span class="fs-2">{{ \Carbon\Carbon::parse($review->datetime)->format('M d, Y') }}</span>
                                    </h5>
                                </div>
                            </div>
                            <div class="card-body collapse show pt-0">
                                <p class="card-text fs-3">
                                    {{ \Illuminate\Support\Str::limit($review->title, 130) }}
                                </p>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
        @php
            $review = $reviews->first();
        @endphp
        <div class="col-lg-6 scrollable mh-n205" data-simplebar="">
            <div class="row ms-1">
                 @foreach ($reviews as $review)
                <div class="card border review-detail-item {{ $loop->first ? 'active' : 'd-none' }}" data-index="{{ $review->id }}">
                    <div class="card-header d-flex align-items-center justify-content-between bg-transparent">
                        <div class="d-flex align-items-center">
                            {!! $review->property->getImage('rounded me-2', 50, 50) !!}
                            <h5 class="card-title mb-0 fs-3 fw-bold">
                                <span>{{ $review->property->name }}</span> <br>
                                <span>
                                    {!! $review->starImages !!}
                                </span>
                            </h5>
                            <div class="d-flex align-items-center ms-3">
                                {!! getUserImageOrAlpha($review) !!}
                                <h5 class="card-title mb-0 fs-3 fw-bold">
                                    {{ $review->reviewer }} <br>
                                    <span class="fs-2">{{ \Carbon\Carbon::parse($review->datetime)->format('M d, Y') }}</span>
                                </h5>
                            </div>
                        </div>
                    </div>
                    <div class="card-body collapse show pt-0">
                        <p class="fw-bold fs-4 text-dark">{{ $review->title }}</p>
                    </div>
                </div>
                @endforeach
                {{-- <div class="text-end">
                    <a href="#" class="btn border text-primary fw-bold fs-4 mt-2 d-inline-flex align-items-center"><img src="{{ asset('assets/images/svg/reply.svg') }}" alt="reply" srcset="" class="me-2">Generate Reply</a>
                </div> --}}
                <div class="card border mt-3">
                    <div class="card-header d-flex align-items-center justify-content-between bg-transparent">
                        <div class="d-flex align-items-center">
                            <h5 class="card-title mb-0 fs-4 fw-bold">Reply</h5>
                            <img src="{{ asset('assets/images/svg/thumbstar.svg') }}" alt="review" class="rounded me-2">
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
                <div class="card border mt-3">
                    <div class="card-header d-flex align-items-center justify-content-between bg-transparent">
                        <div class="d-flex align-items-center">
                            <img src="{{ asset('assets/images/svg/translation.svg') }}" alt="review" class="rounded me-2">
                            <h5 class="card-title mb-0 fs-4 fw-bold">Translation</h5>
                        </div>
                        <div class="d-flex">
                            <span class="p-1 border rounded me-2"><img src="{{ asset('assets/images/svg/.svg') }}"
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
                <div class="d-flex justify-content-between align-items-center flex-wrap g-3">
                    <div class="d-flex flex-wrap g-3">
                        <a href="" class="btn btn-secondary">Copy & Open</a>
                        <a href="" class="btn btn-outline-secondary ms-2 ">Mark as Answered</a>
                        <nav aria-label="..." class="position-lg-absolute  bottom-0 end-0">
                            <ul class="pagination align-items-center justify-content-end mb-2 ">
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
                    <div class="float-end">
                        <a href="#" class="btn border text-primary fw-bold fs-4 mt-2 d-inline-flex align-items-center"><img src="{{ asset('assets/images/svg/reply.svg') }}" alt="reply" srcset="" class="me-2">Generate Reply</a>
                        <a href="" class="btn btn-secondary me-2"><i class="fab fa-telegram-plane text-white"></i><span class="rounded-circlre" width="32"  height="32"><img src="{{ asset('assets/images/svg/logo.svg') }}" alt="" srcset=""></span></a>
                    </div>
                </div>
                
            </div>
        </div>
    </div>

    @push('style')
    <style>
        .review-card.active{
            border-width: 3px !important;
            border-style: solid !important;
            border-image: linear-gradient(
                180deg,
                rgba(24, 119, 242, 1) 0%,
                rgba(21, 44, 86, 1) 100%
                ) !important;
            border-radius: 7px !important;
            border-image-slice: 1 !important;       
        }
    </style>
    
    <link rel="stylesheet" href="{{ asset('assets/libs/select2/dist/css/select2.min.css') }}" />
    @endpush
    @push('script')
        <script src="{{ asset('assets/libs/select2/dist/js/select2.full.min.js') }}"></script>
        <script src="{{ asset('assets/libs/select2/dist/js/select2.min.js') }}"></script>
        <script>
            initSelectWithLogo("#select-with-logo");

            // $("#select-with-logo").change(function() {
            //     const selected = $(this).val();
            //     const maxCompetitors = `{{ gs('max-competitors') }}`;

            //     const reviewsDiv = $("#reviews");
            //     const counts = $("#counts");
            //     reviewsDiv.html('');
            //     counts.find('span').text(`0/${maxCompetitors}`);
            //     counts.find('.progress-bar').css('width', '0%');
            //     $('#add-competitor-link').attr('href', 'javascript:;');

            //     const form = createForm(`{{ route('competitors.index') }}/${selected}`, "GET", {});

            //     submitForm(form).done(function(response){
            //         reviewsDiv.html(response.html);
            //         counts.find('span').text(`${response.count}/${maxCompetitors}`);
            //         counts.find('.progress-bar').css('width', `${response.progress}%`);
            //         $('#add-competitor-link').attr('href', response.href);
            //     });
            // });

            // $("#select-with-logo").trigger('change');
        </script>
        <script>
            function showReview(index) {
                // Remove active class from all review cards
                document.querySelectorAll(".review-card").forEach(card => {
                    card.classList.remove("active");
                });

                // Add active to clicked card
                const clickedCard = document.querySelector(`.review-card[data-index="${index}"]`);
                clickedCard.classList.add("active");

                // Hide all review detail sections
                document.querySelectorAll(".review-detail-item").forEach(detail => {
                    detail.classList.add("d-none");
                    detail.classList.remove("active");
                });

                // Show selected review detail
                const selectedDetail = document.querySelector(`.review-detail-item[data-index="${index}"]`);
                selectedDetail.classList.remove("d-none");
                selectedDetail.classList.add("active");
                
            }
            window.addEventListener('DOMContentLoaded', function () {
                const firstCard = document.querySelector(".review-card");
                if (firstCard) {
                    const index = firstCard.getAttribute("data-index");
                    showReview(index);
                }
            });
        </script>
       

   


    @endpush
</x-app-layout>