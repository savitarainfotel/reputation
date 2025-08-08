<x-app-layout>
    <div class="col-md-12 border-bottom py-2">       
        <div class="row">
            <div class="d-flex justify-content-between align-items-center flex-wrap">
                <div class="d-flex align-items-center flex-wrap gap-2">
                    <strong class="me-3">@lang('Review Inbox')</strong>
                    <button class="btn border d-flex align-items-center" data-bs-toggle="offcanvas" data-bs-target="#filterSidebar">
                        <i class="fas fa-filter me-2"></i> @lang('Filter Reviews')
                    </button>

                    <select class="select-2 p-2 rounded border">
                        <lable class="sort-label">@lang('Sort by'):</lable>
                        <option value="@lang('Most recent')" selected>@lang('Most recent')</option>
                    </select>

                    <button class="btn border text-secondary ms-2">
                        <i class="fas fa-forward me-2"></i> @lang('Configure automation')
                    </button>
                </div>

                <div class="d-flex align-items-center flex-wrap gap-3 mt-2 mt-lg-0 float-end">
                    <div class="me-3 text-end response-rate">
                        <div class="title"></div>
                        <div class="progress bg-light">
                            <div class="progress-bar bg-success" style="width: 0%" role="progressbar"></div>
                        </div>
                    </div>

                    <button class="btn border d-flex align-items-center">
                        <img src="{{ asset('assets/images/svg/mail-setting.svg') }}" class="me-2"> @lang('Reply settings')
                    </button>
                </div>
            </div>
        </div>
    </div>
    <div class="row widget-app-columns mt-4">
        <div class="col-lg-6 scrollable mh-n130 border-end" data-simplebar="" id="reviews-list"></div>
        <div class="col-lg-6 scrollable mh-n130" data-simplebar="" id="review-detail">
            <div class="d-flex align-items-center vh-75 justify-content-center">
                <div>
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 139 91" fill="none"><circle cx="70.8337" cy="48.8396" r="41.4646" fill="#3662E3" fill-opacity="0.1"></circle><path d="M131.491 1H54.6299C51.1645 1 48.3525 3.81201 48.3525 7.27731V39.9705C48.3525 43.4358 51.1645 46.2478 54.6299 46.2478H84.1985L89.4817 51.5309L94.7933 46.2478H131.491C134.957 46.2478 137.769 43.4358 137.769 39.9705V7.27731C137.769 3.81201 134.957 1 131.491 1Z" fill="white" stroke="#3662E3" stroke-opacity="0.4" stroke-width="0.5" stroke-miterlimit="10"></path><path d="M65.2707 20.2017C68.6104 18.7954 70.1776 14.948 68.7712 11.6083C67.3648 8.26868 63.5174 6.70146 60.1778 8.10784C56.8382 9.51421 55.2709 13.3616 56.6773 16.7012C58.0837 20.0409 61.9311 21.6081 65.2707 20.2017Z" fill="#3662E3" fill-opacity="0.2"></path><path d="M61.6196 23.6387H55.8252V25.2009H61.6196V23.6387Z" fill="#D7E0F9"></path><path d="M71.7317 23.6387H63.04V25.2009H71.7317V23.6387Z" fill="#D7E0F9"></path><path d="M68.323 28.2422H55.8252V29.8044H68.323V28.2422Z" fill="#3662E3" fill-opacity="0.15"></path><path d="M102.663 28.2422H73.4072V29.8044H102.663V28.2422Z" fill="#3662E3" fill-opacity="0.15"></path><path d="M130.3 28.2422H107.775V29.8044H130.3V28.2422Z" fill="#3662E3" fill-opacity="0.15"></path><path d="M83.8033 33.1836H55.8252V34.7458H83.8033V33.1836Z" fill="#3662E3" fill-opacity="0.15"></path><path d="M130.301 33.1836H116.326V34.7458H130.301V33.1836Z" fill="#3662E3" fill-opacity="0.15"></path><path d="M113.06 33.1836H88.5469V34.7458H113.06V33.1836Z" fill="#3662E3" fill-opacity="0.15"></path><path d="M91.5292 38.125H55.8252V39.6872H91.5292V38.125Z" fill="#3662E3" fill-opacity="0.15"></path><path d="M80.6443 55.4512H7.22463C3.89563 55.4512 1.23242 58.1144 1.23242 61.4434V76.1515C1.23242 79.4805 3.89563 82.1437 7.22463 82.1437H80.5838C83.9128 82.1437 86.576 79.4805 86.576 76.1515V61.4434C86.6365 58.1144 83.9733 55.4512 80.6443 55.4512Z" fill="white" stroke="#3662E3" stroke-opacity="0.4" stroke-width="0.5" stroke-miterlimit="10"></path><path d="M29.4985 64.2285L30.6485 67.6786H34.2801L31.3143 69.8576L32.4643 73.3076L29.4985 71.1892L26.5931 73.3076L27.6826 69.8576L24.7168 67.7391H28.3484L29.4985 64.2285Z" fill="#9EB3F0"></path><path d="M41.059 64.2285L42.209 67.6786H45.8407L42.9354 69.8576L44.0854 73.3076L41.1195 71.1892L38.2142 73.3076L39.3037 69.8576L36.3379 67.7391H39.9695L41.059 64.2285Z" fill="#9EB3F0"></path><path d="M52.6196 64.2285L53.7696 67.6786H57.4618L54.4959 69.8576L55.6459 73.3076L52.6801 71.1892L49.7748 73.3076L50.8643 69.8576L47.8984 67.7391H51.5301L52.6196 64.2285Z" fill="#9EB3F0"></path><path d="M64.2416 64.2285L65.3917 67.6786H69.0233L66.118 69.8576L67.268 73.3076L64.3022 71.1892L61.3363 73.3076L62.4864 69.8576L59.5205 67.7391H63.1521L64.2416 64.2285Z" fill="#9EB3F0"></path><path d="M75.8032 64.2285L76.9532 67.6786H80.6454L77.6795 69.8576L78.8295 73.3076L75.8637 71.1892L72.9584 73.3076L74.0479 69.8576L71.082 67.7391H74.7137L75.8032 64.2285Z" fill="#D7E0F9"></path><path d="M19.7692 68.4883C20.246 65.5854 18.2793 62.8456 15.3765 62.3688C12.4736 61.8919 9.73381 63.8586 9.25697 66.7615C8.78012 69.6643 10.7468 72.4041 13.6497 72.881C16.5525 73.3578 19.2923 71.3912 19.7692 68.4883Z" fill="#DAE0FF"></path><path d="M12.7914 74.0938H8.07031V75.3648H12.7914V74.0938Z" fill="#D7E0F9"></path><path d="M21.0231 74.0938H13.9414V75.3648H21.0231V74.0938Z" fill="#D7E0F9"></path></svg>
                    <h6 class="mt-3"><strong>@lang('Your replies will be displayed here')</strong></h6>
                </div>
            </div>
        </div>
    </div>

    <div class="offcanvas offcanvas-end" tabindex="-1" id="filterSidebar">
        <div class="offcanvas-header border-bottom">
            <h5 class="offcanvas-title">@lang('Filter reviews')</h5>
            <div>
                <a href="javascript:;" class="me-3 text-decoration-none text-primary clear-all">@lang('Clear all')</a>
                <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
            </div>
        </div>
        <div class="offcanvas-body">
            <form method="get" class="filter-reviews-form">
                <div class="mb-3 d-flex justify-content-between align-items-center">
                    <x-input-label class="mb-0" for="lastThreeMonths" :value="__('Last three months only')" />
                    <div class="form-check form-switch m-0">
                        <x-text-input class="form-check-input" id="lastThreeMonths" name="last_three_months" type="checkbox" value="1" />
                    </div>
                </div>

                <div class="mb-3">
                    <x-input-label class="mb-0" for="select-with-logo" :value="__('Property')" />
                    <select class="form-control" id="select-with-logo" required name="property_id">
                        @foreach ($properties as $property)
                            <option value="{{ $property->encId }}" data-logo="{{ $property->getImageLink() }}" data-platforms="{{ $property->platforms->map(fn($p) => ['id' => $p->encId, 'name' => $p->platform->platform]) }}">
                                {{ __($property->name) }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-3">
                    <x-input-label class="mb-0" for="review-published" :value="__('Review published')" />
                    <x-text-input class="shawCalRanges" id="review-published" name="review_published" type="text" :placeholder="__('MM/DD/YYYY ~ MM/DD/YYYY')" readonly="" />
                </div>

                <div class="mb-3">
                    <x-input-label class="mb-0" for="review-platform" :value="__('Review Sources')" />
                    <select class="form-select" id="review-platform" name="review_sources" data-first-option='<option value="" selected>@lang('Choose below')</option>'></select>
                </div>

                <div class="mb-3">
                    <x-input-label class="mb-0" for="reply-status" :value="__('Reply status')" />
                    <div class="form-check">
                        <x-text-input class="form-check-input" type="checkbox" id="notDone" name="is_answered" value="{{ $status::YES }}" />
                        <label class="form-check-label" for="notDone">{{ __('Not Done') }}</label>
                    </div>
                    <div class="form-check">
                        <x-text-input class="form-check-input" type="checkbox" id="notPublished" name="is_reply_given" value="{{ $status::YES }}" />
                        <label class="form-check-label" for="notPublished">{{ __('Not Published') }}</label>
                    </div>
                </div>

                <div class="mb-3">
                    <x-input-label for="ratingRange" :value="__('Rating')" />
                    <div id="slider-handles" class="mt-3 mb-3"></div>
                    <div class="d-flex justify-content-between px-1 text-muted small">
                        <span>0</span><span>1</span><span>2</span><span>3</span><span>4</span><span>5</span>
                    </div>
                </div>

                <div class="mb-3">
                    <x-input-label for="reviewType" :value="__('Review type')" />
                    <select class="form-select" id="reviewType" name="review_type">
                        <option value="@lang($status::ALL_REVIEWS_TXT)">@lang($status::ALL_REVIEWS_TXT)</option>
                        <option value="@lang($status::REVIEWS_WITH_TXT)">@lang($status::REVIEWS_WITH_TXT)</option>
                        <option value="@lang($status::REVIEWS_WITHOUT_TXT)">@lang($status::REVIEWS_WITHOUT_TXT)</option>
                    </select>
                </div>

                <div class="mb-3">
                    <x-input-label for="searchText" :value="__('Search text')" />
                    <x-text-input type="search" id="searchText" name="search_text" :placeholder="__('Text to search for')" />
                </div>

                <x-secondary-button class="w-30">@lang('Apply')</x-secondary-button>
            </form>
        </div>
    </div>

    @push('style')
        <link rel="stylesheet" href="{{ asset('assets/libs/select2/dist/css/select2.min.css') }}" />
        <link rel="stylesheet" href="{{ asset('assets/libs/daterangepicker/daterangepicker.css') }}" />
        <link rel="stylesheet" href="{{ asset('assets/libs/nouislider-orxe/distribute/nouislider.min.css') }}" />
    @endpush

    @push('script')
        <script src="{{ asset('assets/libs/select2/dist/js/select2.full.min.js') }}"></script>
        <script src="{{ asset('assets/libs/select2/dist/js/select2.min.js') }}"></script>
        <script src="{{ asset('assets/js/extra-libs/moment/moment.min.js') }}"></script>
        <script src="{{ asset('assets/libs/daterangepicker/daterangepicker.js') }}"></script>
        <script src="{{ asset('assets/js/forms/daterangepicker-init.js') }}"></script>
        <script src="{{ asset('assets/libs/wnumb/wNumb.min.js') }}"></script>
        <script src="{{ asset('assets/libs/nouislider-orxe/distribute/nouislider.min.js') }}"></script>

        <script>
            "use strict";

            const handlesSlider = document.getElementById("slider-handles");

            noUiSlider.create(handlesSlider, {
                start: [0, 5],
                step: 1,
                range: {
                    min: [0],
                    max: [5],
                },
            });

            $('.clear-all').click(function() {
                handlesSlider.noUiSlider.set([0, 5]);
                $('.filter-reviews-form')[0].reset();
            });

            const getReviews = (href) => {
                $('.filter-reviews-form').attr('action', href);
                const responseRate = $('.response-rate');

                responseRate.find('.title').html(`0% @lang('Response Rate')`);
                responseRate.find('.progress-bar').css('width', '0%');

                if(href) {
                    const formData = $('.filter-reviews-form').serializeArray()
                                        .filter(field => !['property_id'].includes(field.name))
                                        .reduce((acc, field) => {
                                            acc[field.name] = field.value;
                                            return acc;
                                        }, {});

                    formData.minRating = parseInt($(handlesSlider).find('.noUi-handle-lower').attr('aria-valuenow'));
                    formData.maxRating = parseInt($(handlesSlider).find('.noUi-handle-upper').attr('aria-valuenow'));

                    const form = createForm(href, "GET", formData);

                    $('#reviews-list').html(`<div class="col-xl-12 col-lg-12 col-md-12 col-12">
                                                <div class="card border cursor-pointer review-card">
                                                    <div class="card-header">
                                                        <div class="text-center">
                                                            <h5 class="card-title mb-0 fs-3 fw-bold">
                                                                @lang('No reviews available')
                                                            </h5>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>`);

                    $('#review-detail').html(`<div class="d-flex align-items-center vh-75 justify-content-center">
                                                <div>
                                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 139 91" fill="none"><circle cx="70.8337" cy="48.8396" r="41.4646" fill="#3662E3" fill-opacity="0.1"></circle><path d="M131.491 1H54.6299C51.1645 1 48.3525 3.81201 48.3525 7.27731V39.9705C48.3525 43.4358 51.1645 46.2478 54.6299 46.2478H84.1985L89.4817 51.5309L94.7933 46.2478H131.491C134.957 46.2478 137.769 43.4358 137.769 39.9705V7.27731C137.769 3.81201 134.957 1 131.491 1Z" fill="white" stroke="#3662E3" stroke-opacity="0.4" stroke-width="0.5" stroke-miterlimit="10"></path><path d="M65.2707 20.2017C68.6104 18.7954 70.1776 14.948 68.7712 11.6083C67.3648 8.26868 63.5174 6.70146 60.1778 8.10784C56.8382 9.51421 55.2709 13.3616 56.6773 16.7012C58.0837 20.0409 61.9311 21.6081 65.2707 20.2017Z" fill="#3662E3" fill-opacity="0.2"></path><path d="M61.6196 23.6387H55.8252V25.2009H61.6196V23.6387Z" fill="#D7E0F9"></path><path d="M71.7317 23.6387H63.04V25.2009H71.7317V23.6387Z" fill="#D7E0F9"></path><path d="M68.323 28.2422H55.8252V29.8044H68.323V28.2422Z" fill="#3662E3" fill-opacity="0.15"></path><path d="M102.663 28.2422H73.4072V29.8044H102.663V28.2422Z" fill="#3662E3" fill-opacity="0.15"></path><path d="M130.3 28.2422H107.775V29.8044H130.3V28.2422Z" fill="#3662E3" fill-opacity="0.15"></path><path d="M83.8033 33.1836H55.8252V34.7458H83.8033V33.1836Z" fill="#3662E3" fill-opacity="0.15"></path><path d="M130.301 33.1836H116.326V34.7458H130.301V33.1836Z" fill="#3662E3" fill-opacity="0.15"></path><path d="M113.06 33.1836H88.5469V34.7458H113.06V33.1836Z" fill="#3662E3" fill-opacity="0.15"></path><path d="M91.5292 38.125H55.8252V39.6872H91.5292V38.125Z" fill="#3662E3" fill-opacity="0.15"></path><path d="M80.6443 55.4512H7.22463C3.89563 55.4512 1.23242 58.1144 1.23242 61.4434V76.1515C1.23242 79.4805 3.89563 82.1437 7.22463 82.1437H80.5838C83.9128 82.1437 86.576 79.4805 86.576 76.1515V61.4434C86.6365 58.1144 83.9733 55.4512 80.6443 55.4512Z" fill="white" stroke="#3662E3" stroke-opacity="0.4" stroke-width="0.5" stroke-miterlimit="10"></path><path d="M29.4985 64.2285L30.6485 67.6786H34.2801L31.3143 69.8576L32.4643 73.3076L29.4985 71.1892L26.5931 73.3076L27.6826 69.8576L24.7168 67.7391H28.3484L29.4985 64.2285Z" fill="#9EB3F0"></path><path d="M41.059 64.2285L42.209 67.6786H45.8407L42.9354 69.8576L44.0854 73.3076L41.1195 71.1892L38.2142 73.3076L39.3037 69.8576L36.3379 67.7391H39.9695L41.059 64.2285Z" fill="#9EB3F0"></path><path d="M52.6196 64.2285L53.7696 67.6786H57.4618L54.4959 69.8576L55.6459 73.3076L52.6801 71.1892L49.7748 73.3076L50.8643 69.8576L47.8984 67.7391H51.5301L52.6196 64.2285Z" fill="#9EB3F0"></path><path d="M64.2416 64.2285L65.3917 67.6786H69.0233L66.118 69.8576L67.268 73.3076L64.3022 71.1892L61.3363 73.3076L62.4864 69.8576L59.5205 67.7391H63.1521L64.2416 64.2285Z" fill="#9EB3F0"></path><path d="M75.8032 64.2285L76.9532 67.6786H80.6454L77.6795 69.8576L78.8295 73.3076L75.8637 71.1892L72.9584 73.3076L74.0479 69.8576L71.082 67.7391H74.7137L75.8032 64.2285Z" fill="#D7E0F9"></path><path d="M19.7692 68.4883C20.246 65.5854 18.2793 62.8456 15.3765 62.3688C12.4736 61.8919 9.73381 63.8586 9.25697 66.7615C8.78012 69.6643 10.7468 72.4041 13.6497 72.881C16.5525 73.3578 19.2923 71.3912 19.7692 68.4883Z" fill="#DAE0FF"></path><path d="M12.7914 74.0938H8.07031V75.3648H12.7914V74.0938Z" fill="#D7E0F9"></path><path d="M21.0231 74.0938H13.9414V75.3648H21.0231V74.0938Z" fill="#D7E0F9"></path></svg>
                                                    <h6 class="mt-3"><strong>@lang('Your replies will be displayed here')</strong></h6>
                                                </div>
                                            </div>`);

                    submitForm(form).done(function(response){
                        $('#reviews-list').html(response.html);

                        responseRate.find('.title').html(`${response.responseRate}% @lang('Response Rate')`);
                        responseRate.find('.progress-bar').css('width', `${response.responseRate}%`);

                        const el = document.getElementById('reviews-list');

                        if (SimpleBar.instances.has(el)) {
                            SimpleBar.instances.get(el).unMount();
                        }

                        new SimpleBar(el);

                        $('#reviews-list').find(".review-card").first().trigger('click');
                    });
                }
            }

            initSelectWithLogo("#select-with-logo");

            $("#select-with-logo").change(function() {
                getReviews(`{{ route('reviews.index') }}/${$(this).val()}`);
            });

            $("#select-with-logo").trigger('change');

            $(document).on('click', '.reviews-pagination .page-item', function(e) {
                e.preventDefault();
                getReviews($(this).find('a').attr('href'));
            });

            $(document).on('submit', '.filter-reviews-form', function(e) {
                e.preventDefault();
                getReviews($(this).attr('action').split('?')[0]);
            });

            $(document).on('click', ".review-card", function() {
                $(".review-card.active").removeClass("active");
                $(this).addClass("active");
                const action = $(this).data("action");

                if(action) {
                    const form = createForm(action, "GET", {});
                    $('#review-detail').html(`<div class="d-flex align-items-center vh-75 justify-content-center">
                                                <div>
                                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 139 91" fill="none"><circle cx="70.8337" cy="48.8396" r="41.4646" fill="#3662E3" fill-opacity="0.1"></circle><path d="M131.491 1H54.6299C51.1645 1 48.3525 3.81201 48.3525 7.27731V39.9705C48.3525 43.4358 51.1645 46.2478 54.6299 46.2478H84.1985L89.4817 51.5309L94.7933 46.2478H131.491C134.957 46.2478 137.769 43.4358 137.769 39.9705V7.27731C137.769 3.81201 134.957 1 131.491 1Z" fill="white" stroke="#3662E3" stroke-opacity="0.4" stroke-width="0.5" stroke-miterlimit="10"></path><path d="M65.2707 20.2017C68.6104 18.7954 70.1776 14.948 68.7712 11.6083C67.3648 8.26868 63.5174 6.70146 60.1778 8.10784C56.8382 9.51421 55.2709 13.3616 56.6773 16.7012C58.0837 20.0409 61.9311 21.6081 65.2707 20.2017Z" fill="#3662E3" fill-opacity="0.2"></path><path d="M61.6196 23.6387H55.8252V25.2009H61.6196V23.6387Z" fill="#D7E0F9"></path><path d="M71.7317 23.6387H63.04V25.2009H71.7317V23.6387Z" fill="#D7E0F9"></path><path d="M68.323 28.2422H55.8252V29.8044H68.323V28.2422Z" fill="#3662E3" fill-opacity="0.15"></path><path d="M102.663 28.2422H73.4072V29.8044H102.663V28.2422Z" fill="#3662E3" fill-opacity="0.15"></path><path d="M130.3 28.2422H107.775V29.8044H130.3V28.2422Z" fill="#3662E3" fill-opacity="0.15"></path><path d="M83.8033 33.1836H55.8252V34.7458H83.8033V33.1836Z" fill="#3662E3" fill-opacity="0.15"></path><path d="M130.301 33.1836H116.326V34.7458H130.301V33.1836Z" fill="#3662E3" fill-opacity="0.15"></path><path d="M113.06 33.1836H88.5469V34.7458H113.06V33.1836Z" fill="#3662E3" fill-opacity="0.15"></path><path d="M91.5292 38.125H55.8252V39.6872H91.5292V38.125Z" fill="#3662E3" fill-opacity="0.15"></path><path d="M80.6443 55.4512H7.22463C3.89563 55.4512 1.23242 58.1144 1.23242 61.4434V76.1515C1.23242 79.4805 3.89563 82.1437 7.22463 82.1437H80.5838C83.9128 82.1437 86.576 79.4805 86.576 76.1515V61.4434C86.6365 58.1144 83.9733 55.4512 80.6443 55.4512Z" fill="white" stroke="#3662E3" stroke-opacity="0.4" stroke-width="0.5" stroke-miterlimit="10"></path><path d="M29.4985 64.2285L30.6485 67.6786H34.2801L31.3143 69.8576L32.4643 73.3076L29.4985 71.1892L26.5931 73.3076L27.6826 69.8576L24.7168 67.7391H28.3484L29.4985 64.2285Z" fill="#9EB3F0"></path><path d="M41.059 64.2285L42.209 67.6786H45.8407L42.9354 69.8576L44.0854 73.3076L41.1195 71.1892L38.2142 73.3076L39.3037 69.8576L36.3379 67.7391H39.9695L41.059 64.2285Z" fill="#9EB3F0"></path><path d="M52.6196 64.2285L53.7696 67.6786H57.4618L54.4959 69.8576L55.6459 73.3076L52.6801 71.1892L49.7748 73.3076L50.8643 69.8576L47.8984 67.7391H51.5301L52.6196 64.2285Z" fill="#9EB3F0"></path><path d="M64.2416 64.2285L65.3917 67.6786H69.0233L66.118 69.8576L67.268 73.3076L64.3022 71.1892L61.3363 73.3076L62.4864 69.8576L59.5205 67.7391H63.1521L64.2416 64.2285Z" fill="#9EB3F0"></path><path d="M75.8032 64.2285L76.9532 67.6786H80.6454L77.6795 69.8576L78.8295 73.3076L75.8637 71.1892L72.9584 73.3076L74.0479 69.8576L71.082 67.7391H74.7137L75.8032 64.2285Z" fill="#D7E0F9"></path><path d="M19.7692 68.4883C20.246 65.5854 18.2793 62.8456 15.3765 62.3688C12.4736 61.8919 9.73381 63.8586 9.25697 66.7615C8.78012 69.6643 10.7468 72.4041 13.6497 72.881C16.5525 73.3578 19.2923 71.3912 19.7692 68.4883Z" fill="#DAE0FF"></path><path d="M12.7914 74.0938H8.07031V75.3648H12.7914V74.0938Z" fill="#D7E0F9"></path><path d="M21.0231 74.0938H13.9414V75.3648H21.0231V74.0938Z" fill="#D7E0F9"></path></svg>
                                                    <h6 class="mt-3"><strong>@lang('Your replies will be displayed here')</strong></h6>
                                                </div>
                                            </div>`);

                    submitForm(form).done(function(response){
                        $('#review-detail').html(response.html);

                        const el = document.getElementById('review-detail');

                        if (SimpleBar.instances.has(el)) {
                            SimpleBar.instances.get(el).unMount();
                        }

                        new SimpleBar(el);

                        initSelectWithFlag(".template-with-flag-icons");

                        const responseRate = $('.response-rate');
                        responseRate.find('.title').html(`${response.responseRate}% @lang('Response Rate')`);
                        responseRate.find('.progress-bar').css('width', `${response.responseRate}%`);
                    });
                }
            });

            $(document).on('click', '.generate-reply', function(e) {
                e.preventDefault();
                const href = $(this).attr('href');

                if(href) {
                    const form = createForm(href, "POST", {});

                    submitForm(form, true).done(function(response){
                        $('#review-detail').html(response.html);

                        const el = document.getElementById('review-detail');

                        if (SimpleBar.instances.has(el)) {
                            SimpleBar.instances.get(el).unMount();
                        }

                        new SimpleBar(el);

                        initSelectWithFlag(".template-with-flag-icons");

                        const responseRate = $('.response-rate');
                        responseRate.find('.title').html(`${response.responseRate}% @lang('Response Rate')`);
                        responseRate.find('.progress-bar').css('width', `${response.responseRate}%`);
                    });
                }
            });

            $(document).on('click', '.send-reply', function(e){
                e.preventDefault();
                const target = $(this).data('target-element');
                const reply = $(target).val();

                if(reply) {
                    const href = $(this).attr('href');
                    const form = createForm(href, "POST", {reply: reply});

                    submitForm(form, true).done(function(response){
                        $('#review-detail').html(response.html);

                        const el = document.getElementById('review-detail');

                        if (SimpleBar.instances.has(el)) {
                            SimpleBar.instances.get(el).unMount();
                        }

                        new SimpleBar(el);

                        initSelectWithFlag(".template-with-flag-icons");

                        const responseRate = $('.response-rate');
                        responseRate.find('.title').html(`${response.responseRate}% @lang('Response Rate')`);
                        responseRate.find('.progress-bar').css('width', `${response.responseRate}%`);
                    });
                } else {
                    notify('Generate the reply first!');
                }
            });
        </script>
    @endpush
</x-app-layout>