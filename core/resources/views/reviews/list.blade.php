<x-app-layout>
    <div class="col-md-12 border-bottom py-2">       
        <div class="row">
            <div class="d-flex justify-content-between align-items-center flex-wrap">
                <div class="d-flex align-items-center flex-wrap gap-2">
                    <strong class="me-3">@lang('Review Inbox')</strong>
                    <button class="btn border d-flex align-items-center" data-bs-toggle="offcanvas" data-bs-target="#filterSidebar">
                        <i class="fas fa-filter me-2"></i> @lang('Filter Reviews')
                    </button>
                    <div class="offcanvas offcanvas-end" tabindex="-1" id="filterSidebar">
                        <div class="offcanvas-header border-bottom">
                            <h5 class="offcanvas-title">@lang('Filter reviews')</h5>
                            <div>
                                <a href="javascript:;" class="me-3 text-decoration-none text-primary">@lang('Clear all')</a>
                                <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                            </div>
                        </div>
                        <div class="offcanvas-body">

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
                                        <option value="{{ $property->encId }}" data-logo="{{ $property->getImageLink() }}">
                                            {{ __($property->name) }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="mb-3">
                                <x-input-label class="mb-0" for="review-published" :value="__('Review published')" />
                                <x-text-input id="review-published" name="review_published" type="text" :placeholder="__('YYYY-MM-DD ~ YYYY-MM-DD')" />
                            </div>

                            <div class="mb-3">
                                <x-input-label class="mb-0" for="review-sources" :value="__('Review Sources')" />
                                <select class="form-select" id="review-sources" name="review_sources">
                                    <option>@lang('Choose below')</option>
                                </select>
                            </div>

                            <div class="mb-3">
                                <x-input-label class="mb-0" for="reply-status" :value="__('Reply status')" />
                                <div class="form-check">
                                    <x-text-input class="form-check-input" type="checkbox" id="notDone" name="reply_status" />
                                    <label class="form-check-label" for="notDone">{{ __('Not Done') }}</label>
                                </div>
                                <div class="form-check">
                                    <x-text-input class="form-check-input" type="checkbox" id="notPublished" name="reply_status" />
                                    <label class="form-check-label" for="notPublished">{{ __('Not Published') }}</label>
                                </div>
                            </div>

                            <div class="mb-3">
                                <x-input-label for="ratingRange" :value="__('Rating')" />
                                <input class="form-range" min="0" max="5" type="range" id="ratingRange" name="rating_range" />
                                <div class="d-flex justify-content-between px-1 text-muted small">
                                    <span>0</span><span>1</span><span>2</span><span>3</span><span>4</span><span>5</span>
                                </div>
                            </div>

                            <div class="mb-3">
                                <x-input-label for="reviewType" :value="__('Review type')" />
                                <select class="form-select" id="reviewType" name="review_type">
                                    <option>@lang('All Reviews')</option>
                                </select>
                            </div>

                            <div class="mb-3">
                                <x-input-label for="searchText" :value="__('Search text')" />
                                <x-text-input type="search" id="searchText" name="search_text" :placeholder="__('Text to search for')" />
                            </div>

                            <button class="btn btn-secondary apply-btn">@lang('Apply')</button>
                        </div>
                    </div>

                    <select class="select-2 p-2 rounded border">
                        <lable class="sort-label">@lang('Sort by'):</lable>
                        <option value="@lang('Most recent')" selected>@lang('Most recent')</option>
                    </select>

                    <button class="btn border text-secondary ms-2">
                        <i class="fas fa-forward me-2"></i> @lang('Configure automation')
                    </button>
                </div>

                <div class="d-flex align-items-center flex-wrap gap-3 mt-2 mt-lg-0 float-end">
                    <div class="me-3 text-end">
                        <div class="response-rate">40% @lang('Response Rate')</div>
                        <div class="progress bg-light">
                            <div class="progress-bar bg-success w-40" ></div>
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
        <div class="col-lg-6 scrollable mh-n130" data-simplebar=""></div>
    </div>

    @push('style')
        <link rel="stylesheet" href="{{ asset('assets/libs/select2/dist/css/select2.min.css') }}" />
    @endpush

    @push('script')
        <script src="{{ asset('assets/libs/select2/dist/js/select2.full.min.js') }}"></script>
        <script src="{{ asset('assets/libs/select2/dist/js/select2.min.js') }}"></script>
        <script>
            "use strict";

            const getReviews = href => {
                if(href) {
                    const form = createForm(href, "GET", {});
                    $('#reviews-list').html('');

                    submitForm(form).done(function(response){
                        $('#reviews-list').html(response.html);

                        const el = document.getElementById('reviews-list');

                        if (SimpleBar.instances.has(el)) {
                            SimpleBar.instances.get(el).unMount();
                        }

                        new SimpleBar(el);
                    });
                }
            }

            initSelectWithLogo("#select-with-logo");

            $("#select-with-logo").change(function() {
                getReviews(`{{ route('reviews.index') }}/${$(this).val()}`);
            });

            $("#select-with-logo").trigger('change');

            $(document).on('click', '.pagination > .page-item', function(e) {
                e.preventDefault();
                getReviews($(this).find('a').attr('href'));
            });

            $(document).on('click', ".review-card", function() {
                $(".review-card.active").removeClass("active");
                $(this).addClass("active");
            });
        </script>
    @endpush
</x-app-layout>