<x-app-layout>
    <div class="row">
        <div class="col-lg-5 scrollable mh-n100 vh-100" data-simplebar="">
            <form action="{{ request()->url() }}" method="post" class="ajax-form">
                <x-text-input type="hidden" name="picture" id="picture" />
                <div class="row">
                    <div class="col-lg-12">
                        <div class="d-flex">
                            <h5>@lang('Create New Survey')</h5>
                            <a href="javascript:void(0)" class="btn btn-secondary ms-auto">
                                @lang('Load Template')
                            </a>
                        </div>
                        <div class="dropdown w-100 mt-3">
                            <select class="form-control" id="select-with-logo" required name="property_id">
                                @foreach ($properties as $property)
                                    <option value="{{ $property->encId }}" 
                                        data-logo="{{ $property->getImageLink() }}" 
                                        data-platforms="{{ $property->platforms->map(fn($p) => ['id' => $p->encId, 'name' => $p->platform->platform]) }}">
                                        {{ __($property->name) }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-lg-12 mt-2">
                        <a class="fs-6 fw-bold text-primary mb-3" type="button" data-bs-toggle="collapse" data-bs-target="#collapseSurveyHeader" aria-expanded="false" aria-controls="collapseSurveyHeader">
                            <i class="fas fa-chevron-down me-2"></i> @lang('Survey Header')
                        </a>
                        <div class="custom-collapse collapse show" id="collapseSurveyHeader">
                            <div class="text-center mb-3">
                                <img src="" class="mb-3 rounded-circle round-200 logo-preview" alt="" />
                                <div class="d-flex justify-content-center gap-2">
                                    <label for="item-img" class="btn btn-secondary logo-buttons">
                                        <i class="me-2 fas fa-edit"></i> @lang('Change Image')
                                    </label>
                                    <a class="btn btn-outline-secondary logo-buttons delete-image">
                                        <i class="me-2 fas fa-trash-alt"></i> @lang('Delete Image')
                                    </a>
                                    <label for="item-img" class="cursor-pointer p-3 w-100 drag-label">
                                        <x-text-input type="file" class="d-none w-100 item-img" id="item-img" accept="image/jpeg,image/png,image/jpg" />
                                        <span>
                                            <svg class="round-20" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true" data-slot="icon" class="w-5 h-5 "><path d="M19.5 21a3 3 0 0 0 3-3v-4.5a3 3 0 0 0-3-3h-15a3 3 0 0 0-3 3V18a3 3 0 0 0 3 3h15ZM1.5 10.146V6a3 3 0 0 1 3-3h5.379a2.25 2.25 0 0 1 1.59.659l2.122 2.121c.14.141.331.22.53.22H19.5a3 3 0 0 1 3 3v1.146A4.483 4.483 0 0 0 19.5 9h-15a4.483 4.483 0 0 0-3 1.146Z"></path></svg>
                                            @lang('Drag your files here or') <strong>@lang('choose file')</strong>
                                        </span>
                                    </label>
                                </div>
                            </div>

                            <!-- Title -->
                            <div class="mb-3">
                                <x-input-label class="fw-semibold fs-5" for="title" :value="__('Title')" />
                                <x-text-input type="text" class="change-title-text" name="title" id="title" :placeholder="__('Your survey name')" :value="__('Guest Experience Survey')" required />
                            </div>

                            <!-- Description -->
                            <div class="mb-3">
                                <x-input-label class="fw-semibold fs-5" for="description" :value="__('Description')" />
                                <x-text-area class="change-title-text" name="description" id="description" rows="2" :placeholder="__('We hope you enjoyed your stay')" :value="__('We hope you enjoyed your stay with us. Please let us know how we did.')" required />
                            </div>

                            <!-- Accent Color -->
                            <div class="mb-3">
                                <span class="form-label fw-semibold d-block">@lang('Accent Color')</span>
                                <div class="row">
                                    <div class="d-flex mb-2 col-lg-3 align-items-center">
                                        <x-text-input type="radio" class="circle" name="color" id="color-1" value="#f87171" />
                                        <label class="circle-label" for="color-1"><span style="background-color: #f87171;"></span></label>

                                        <x-text-input type="radio" class="circle" name="color" id="color-2" value="#60a5fa" />
                                        <label class="circle-label" for="color-2"><span style="background-color: #60a5fa;"></span></label>

                                        <x-text-input type="radio" class="circle" name="color" id="color-3" value="#34d399" />
                                        <label class="circle-label" for="color-3"><span style="background-color: #34d399;"></span></label>

                                        <x-text-input type="radio" class="circle" name="color" id="color-4" value="#fbbf24" />
                                        <label class="circle-label" for="color-4"><span style="background-color: #fbbf24;"></span></label>

                                        <x-text-input type="radio" class="circle" name="color" id="color-5" value="#a78bfa" />
                                        <label class="circle-label" for="color-5"><span style="background-color: #a78bfa;"></span></label>
                                    </div>

                                    <div class="col-lg-9">
                                        <x-text-input type="text" id="selected-color" name="selected_color" data-position="bottom right" value="#1877F2" readonly required />
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-12 mt-2">
                        <a class="fs-6 fw-bold text-primary mb-3" type="button" data-bs-toggle="collapse" data-bs-target="#collapseQuestionRatingScale" aria-expanded="false" aria-controls="collapseQuestionRatingScale">
                            <i class="fas fa-chevron-down me-2"></i> @lang('Question & Rating Scale')
                        </a>
                        <div class="custom-collapse collapse show" id="collapseQuestionRatingScale">
                            <div>
                                <x-input-label class="fw-semibold fs-5" for="rating-scale" :value="__('Rating Scale')" /> <i class="fas fa-info-circle ms-2 fa-lg"></i>
                                <select class="form-control form-select" id="rating-scale" required name="rating_scale">
                                    <option value="{{ $status::NPS }}">@lang('NPS (0-10)')</option>
                                    <option value="{{ $status::STAR }}" selected>@lang('Star (1 - 5)')</option>
                                </select>
                            </div>
                            <div class="mt-3 question-list">
                                <x-input-label class="fw-semibold fs-5" for="question-1" :value="__('Question 1')" /> <i class="fas fa-info-circle ms-2 fa-lg"></i>
                                <x-text-input name="questions[]" id="question-1" :placeholder="__('How would you rate your overall experience with us?')" required />
                                <a href="javascript:;" id="add-question" class="text-end d-block mt-2"><i class="fas fa-plus-circle me-1"></i> @lang('Add More Question')</a>
                            </div>
                            <div>
                                <x-input-label class="fw-semibold fs-5" for="comment" :value="__('Comment')" /> <i class="fas fa-info-circle ms-2 fa-lg"></i>
                                <x-text-area class="change-title-text" id="comment" name="comment" rows="1" placeholder="comment" :value="__('Comment')" required />
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-12 mt-2">
                        <a class="fs-6 fw-bold text-primary mb-3" type="button" data-bs-toggle="collapse" data-bs-target="#collapsePublicReviewGeneration" aria-expanded="false" aria-controls="collapsePublicReviewGeneration">
                            <i class="fas fa-chevron-down me-2"></i> @lang('Public Review Generation')
                        </a>
                        <div class="custom-collapse collapse show" id="collapsePublicReviewGeneration">
                            <p>
                                @lang('To motivate satisfied guests to write public reviews, MARA utilizes their feedback from this survey and automatically generates a draft review that guests can easily copy and post on selected platform.')
                            </p>
                            <div class="mt-3">
                                <x-input-label class="fw-semibold fs-5" for="review-platform" :value="__('Review Platform')" /> <i class="fas fa-info-circle ms-2 fa-lg"></i>
                                <select class="form-control form-select" id="review-platform" required name="review_platform_id" required></select>
                            </div>
                            <div class="row">
                                <div class="col-md-6 mt-3">
                                    <x-input-label class="fw-semibold fs-5" for="min_rating" :value="__('Ask for a public review if the rating is ≥')" /> <i class="fas fa-info-circle ms-2 fa-lg"></i>
                                    <x-text-input type="number" name="min_rating" id="min_rating" value="4" required max="5" min="0" />
                                </div>
                                <div class="col-md-6 mt-3">
                                    <x-input-label class="fw-semibold fs-5" for="average_review" :value="__('Ask for contact details if the rating is <')" /> <i class="fas fa-info-circle ms-2 fa-lg"></i>
                                    <x-text-input type="number" name="average_review" id="average_review" value="4" required max="5" min="0" />
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-12 mt-2">
                        <div class="d-flex justify-content-end gap-2 my-3">
                            <x-secondary-button type="submit" class="btn-lg">
                                {{ __('Save & Exit') }}
                            </x-secondary-button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
        <div class="col-lg-7 scrollable mh-n100 bg-blue vh-100" data-simplebar="">
            <div class="col-lg-12 p-5 bg-bluelight change-bg-color">
                @if ($survey->exists)
                    <div class="col-12 text-end mb-2">
                        <a href="javascript:;" class=" btn bg-white text-secondary py-2 px-3 rounded"><i class="fas fa-expand me-2"></i> @lang('Full Screen Preview')</a>
                    </div>
                @endif
                <div class="row mb-3 pb-5">
                    <div class="col-md-7 d-grid align-items-center">
                        <h4 class="text-white change-title"></h4>
                    </div>
                    <div class="col-md-5">
                        <img src="" class="rounded-circle round-200 float-end logo-preview" alt="" />
                    </div>
                </div>
            </div>
            <div class="col-12">
                <div class="card question-wrapper p-4" id="questions">
                    <div class="question add-question">
                        <h6 class="fs-4 fw-semibold mb-0">Q <span>1</span>.</h6>
                        <div class="rating-group">
                            <div class="rating"></div>
                        </div>
                    </div>
                    <div class="mt-3">
                        <x-input-label class="form-label fw-semibold fs-5" for="comment_label" id="comment-label" />
                        <x-text-area name="comment_label" id="comment_label" rows="2" placeholder="Please let us know what led to this rating. What did you like and what did you not like?" />
                    </div>
                </div>
                <button class="btn btn-lg change-bg-color text-white question-wrapper mt-4 w-30">
                    @lang('Next')
                </button>
            </div>
            <div class="text-center mt-4">
                <img src="{{ asset('assets/images/logo.svg') }}" alt="logo" />
                <p class="mb-0 fs-4 fw-medium text-dark">@lang('Powered by') </p>
                <a href="{{ route('home') }}" class="fs-4 fw-medium">{{ env('APP_NAME') }}</a>
            </div>
        </div>
    </div>

    @push('style')
        <link rel="stylesheet" href="{{ asset('assets/libs/select2/dist/css/select2.min.css') }}" />
        <link rel="stylesheet" href="{{ asset('assets/libs/@claviska/jquery-minicolors/jquery.minicolors.css') }}" />
    @endpush

    @push('script')
        <script src="{{ asset('assets/libs/select2/dist/js/select2.full.min.js') }}"></script>
        <script src="{{ asset('assets/libs/select2/dist/js/select2.min.js') }}"></script>
        <script src="{{ asset('assets/libs/jquery-asColor/dist/jquery-asColor.min.js') }}"></script>
        <script src="{{ asset('assets/libs/jquery-asGradient/dist/jquery-asGradient.min.js') }}"></script>
        <script src="{{ asset('assets/libs/jquery-asColorPicker/dist/jquery-asColorPicker.min.js') }}"></script>
        <script src="{{ asset('assets/libs/@claviska/jquery-minicolors/jquery.minicolors.min.js') }}"></script>

        <script>
            initSelectWithLogo("#select-with-logo");
            initMinicolors("#selected-color");
            $('.logo-preview').addClass("d-none");
            $('.logo-buttons').addClass("d-none");
            $('.minicolors-swatch').addClass("d-none");
            $("#select-with-logo").trigger('change');
            $("#selected-color").trigger('change');

            initRatings();

            $(document).on('click', '#add-question', function(){
                const questionList = $(".question-list");
                const id = generateRandomString();
                const questionNo = questionList.length + 1;

                const questioninput = `<div class="question-list remove-question-${id}">
                                        <x-input-label class="fw-semibold fs-5" for="question-${id}" :value="__('Question ${questionNo}')" /> <i class="fas fa-info-circle ms-2 fa-lg"></i>
                                        <x-text-input name="questions[]" id="question-${id}" :placeholder="__('How would you rate your overall experience with us?')" required />
                                        <a href="javascript:;" class="text-end d-block mt-2 remove-question" id="remove-question-${id}"><i class="fas fa-minus-circle me-1"></i> @lang('Remove Question')</a>
                                    </div>`;

                questionList.last().after(questioninput);

                addQuestion(id, questionNo);
            });

            const resetQuestionNumbers = () => {
                $(".question-list").each(function(index, element) {
                    const questionNo = index + 1;
                    const className = $(element).find("a").attr('id');
                    const question  = $("#questions").find(`.${className}`);

                    $(element).find("label").text(`@lang('Question ${questionNo}')`);
                    $(question).find("h6").find('span').text(questionNo);
                    $(question).find("input[type=radio]").attr('name', `rate[${questionNo}]`);
                });
            }

            $(document).on('input', ".change-title-text", function() {
                $(".change-title").html(`${$("#title").val().trim()} <p class="text-white fs-4 mt-3">${$("#description").val().trim()}</p>`);
                $('#comment-label').text($("#comment").val().trim());
            });

            $(".change-title-text").trigger('input');

            const getQuestions = (questionNo, ratingScale = 5) => {
                const id1 = generateRandomString();
                const id2 = generateRandomString();
                const id3 = generateRandomString();
                const id4 = generateRandomString();
                const id5 = generateRandomString();

                if(ratingScale === 10) {
                    const id6 = generateRandomString();
                    const id7 = generateRandomString();
                    const id8 = generateRandomString();
                    const id9 = generateRandomString();
                    const id10 = generateRandomString();

                    return `<div class="rating-radio rating-circles my-4">
                                <x-text-input type='radio' hidden name="rate[${questionNo}]" id='rating-opt-${id1}' data-idx='1' value="1" />
                                <label for="rating-opt-${id1}" class="rating-circle">1</label>
                                <x-text-input type='radio' hidden name="rate[${questionNo}]" id='rating-opt-${id2}' data-idx='2' value="2" />
                                <label for="rating-opt-${id2}" class="rating-circle">2</label>
                                <x-text-input type='radio' hidden name="rate[${questionNo}]" id='rating-opt-${id3}' data-idx='3' value="3" />
                                <label for="rating-opt-${id3}" class="rating-circle">3</label>
                                <x-text-input type='radio' hidden name="rate[${questionNo}]" id='rating-opt-${id4}' data-idx='4' value="4" />
                                <label for="rating-opt-${id4}" class="rating-circle">4</label>
                                <x-text-input type='radio' hidden name="rate[${questionNo}]" id='rating-opt-${id5}' data-idx='5' value="5" />
                                <label for="rating-opt-${id5}" class="rating-circle">5</label>
                                <x-text-input type='radio' hidden name="rate[${questionNo}]" id='rating-opt-${id6}' data-idx='6' value="6" />
                                <label for="rating-opt-${id6}" class="rating-circle">6</label>
                                <x-text-input type='radio' hidden name="rate[${questionNo}]" id='rating-opt-${id7}' data-idx='7' value="7" />
                                <label for="rating-opt-${id7}" class="rating-circle">7</label>
                                <x-text-input type='radio' hidden name="rate[${questionNo}]" id='rating-opt-${id8}' data-idx='8' value="8" />
                                <label for="rating-opt-${id8}" class="rating-circle">8</label>
                                <x-text-input type='radio' hidden name="rate[${questionNo}]" id='rating-opt-${id9}' data-idx='9' value="9" />
                                <label for="rating-opt-${id9}" class="rating-circle">9</label>
                                <x-text-input type='radio' hidden name="rate[${questionNo}]" id='rating-opt-${id10}' data-idx='10' value="10" />
                                <label for="rating-opt-${id10}" class="rating-circle">10</label>
                            </div>`;
                } else {
                    return `<div class="rating rating-radio">
                                <x-text-input type='radio' hidden name='rate[${questionNo}]' id='rating-opt-${id1}' data-idx='0' value="5" />
                                <label for='rating-opt-${id1}'></label>

                                <x-text-input type='radio' hidden name='rate[${questionNo}]' id='rating-opt-${id2}' data-idx='1' value="4" />
                                <label for='rating-opt-${id2}'></label>

                                <x-text-input type='radio' hidden name='rate[${questionNo}]' id='rating-opt-${id3}' data-idx='2' value="3" />
                                <label for='rating-opt-${id3}'></label>

                                <x-text-input type='radio' hidden name='rate[${questionNo}]' id='rating-opt-${id4}' data-idx='3' value="2" />
                                <label for='rating-opt-${id4}'></label>

                                <x-text-input type='radio' hidden name='rate[${questionNo}]' id='rating-opt-${id5}' data-idx='4' value="1" />
                                <label for='rating-opt-${id5}'></label>
                            </div>`;
                }
            }

            const addQuestion = (id, questionNo) => {
                const ratingScale = $("#rating-scale").val() === `{{ $status::NPS }}` ? 10 : 5;
                const questionDiv = `<div class="question remove-question-${id}">
                                        <h6 class="fs-4 fw-semibold mb-0">Q <span>${questionNo}</span>.</h6>
                                        <div class="rating-group">
                                            ${getQuestions(questionNo, ratingScale)}
                                        </div>
                                    </div>`;

                $("#questions").find('.question').last().after(questionDiv);
                initRatings();
            }

            $(document).on('change', "#rating-scale", function() {
                const ratingScale  = $(this).val() === `{{ $status::NPS }}` ? 10 : 5;
                const ratingGroups = $('.rating-group');

                if(ratingGroups.length) {
                    ratingGroups.each(function(index) {
                        const questionNo = index + 1;
                        const questionDiv = getQuestions(questionNo, ratingScale);
                        $(this).html(questionDiv);
                        initRatings();
                    });
                }
            });

            $("#rating-scale").trigger('change');
        </script>
    @endpush

    <x-image-cropper />
</x-app-layout>