<x-app-layout>
    <div class="row">
        <div class="col-lg-6">
            <div class="row">
                <div class="col-lg-12">
                    <div class="d-flex">
                        <h5>@lang('Create New Survey')</h5>
                        <a href="javascript:void(0)" class="btn btn-secondary ms-auto">
                            @lang('Load Template')
                        </a>
                    </div>
                    <div class="dropdown w-100 mt-3">
                        <select class="form-control " id="select-with-logo" required name="property_id">
                            @foreach ($properties as $property)
                            <option value="{{ $property->encId }}" data-logo="{{ $property->getImageLink() }}">
                                {{ __($property->name) }}
                            </option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-lg-12 mt-2">
                    <a class="fs-6 fw-bold text-primary mb-3" type="button" data-bs-toggle="collapse" data-bs-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
                        <i class="fas fa-chevron-down me-2"></i> @lang('Survey Header')
                    </a>
                    <div class="collapse show" id="collapseExample">
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
                            <label class="form-label fw-semibold fs-5">@lang('Title')</label>
                            <x-text-input type="text" class="form-control-border" placeholder="Your survey name" :value="__('Guest Experience Survey')" />
                        </div>

                        <!-- Description -->
                        <div class="mb-3">
                            <label class="form-label fw-semibold fs-5">@lang('Description')</label>
                            <x-text-area class="form-control-border" rows="2" placeholder="@lang('We hope you enjoyed your stay')" :value="__('We hope you enjoyed your stay with us. Please let us know how we did.')" />
                        </div>

                        <!-- Accent Color -->
                        <div class="mb-3">
                            <label class="form-label fw-semibold d-block">@lang('Accent Color')</label>
                            <div class="row">
                                <div class="d-flex mb-2 col-lg-3 align-items-center">
                                    <x-text-input type="radio" class="circle" name="color" id="color-1" value="#f87171" />
                                    <label class="circle-label" for="color-1"><span style="border-radius: 50%; background-color: #f87171;"></span></label>

                                    <x-text-input type="radio" class="circle" name="color" id="color-2" value="#60a5fa" />
                                    <label class="circle-label" for="color-2"><span style="border-radius: 50%; background-color: #60a5fa;"></span></label>

                                    <x-text-input type="radio" class="circle" name="color" id="color-3" value="#34d399" />
                                    <label class="circle-label" for="color-3"><span style="border-radius: 50%; background-color: #34d399;"></span></label>

                                    <x-text-input type="radio" class="circle" name="color" id="color-4" value="#fbbf24" />
                                    <label class="circle-label" for="color-4"><span style="border-radius: 50%; background-color: #fbbf24;"></span></label>

                                    <x-text-input type="radio" class="circle" name="color" id="color-5" value="#a78bfa" />
                                    <label class="circle-label" for="color-5"><span style="border-radius: 50%; background-color: #a78bfa;"></span></label>
                                </div>

                                <div class="col-lg-9">
                                    <x-text-input type="text" class="form-control-border" id="selected-color" name="selected_color" data-position="bottom right" value="#1877F2" readonly />
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-6 bg-blue px-0">
            <div class="col-lg-12 p-5 bg-bluelight change-bg-color">
                @if ($survey->exists)
                    <div class="col-12 text-end mb-2">
                        <a href="javascript:;" class=" btn bg-white text-secondary py-2 px-3 rounded"><i class="fas fa-expand me-2"></i> @lang('Full Screen Preview')</a>
                    </div>
                @endif
                <div class="row mb-3 pb-5">
                    <div class="col-md-7 d-grid align-items-center">
                        <h4 class="text-white">
                            @lang('Guest Experience Survey Budget Inn')
                            <p class="text-white fs-4 mt-3">
                                @lang('We hope you enjoyed your stay with us. Please let us know how we did.')
                            </p>
                        </h4>
                    </div>
                    <div class="col-md-5">
                        <img src="" class="rounded-circle round-200 float-end logo-preview" alt="" />
                    </div>
                </div>
            </div>
            <div class="col-12">
                <div class="card question-wrapper p-4">
                    <div class="question">
                        <h6 class="fs-4 fw-semibold">Q 1. How would you rate your overall experience staying at Budget Inn?*</h6>
                        <div class="rating-group">
                            <fieldset class="rating">
                                <div class="main-rating-container">
                                <input type="radio" id="rating1-star5" name="service_rating1" value="5" />
                                <label class="full" for="rating1-star5" title="Awesome - 5 stars"></label>

                                <input type="radio" id="rating1-star4" name="service_rating1" value="4" />
                                <label class="full" for="rating1-star4" title="Pretty good - 4 stars"></label>

                                <input type="radio" id="rating1-star3" name="service_rating1" value="3" />
                                <label class="full" for="rating1-star3" title="Meh - 3 stars"></label>

                                <input type="radio" id="rating1-star2" name="service_rating1" value="2" />
                                <label class="full" for="rating1-star2" title="Kinda bad - 2 stars"></label>

                                <input type="radio" id="rating1-star1" name="service_rating1" value="1" />
                                <label class="full" for="rating1-star1" title="Sucks big time - 1 star"></label>
                                </div>
                            </fieldset>
                        </div>

                        <div class="rating-group">
                            <fieldset class="rating">
                                <div class="main-rating-container">
                                <input type="radio" id="rating2-star5" name="service_rating2" value="5" />
                                <label class="full" for="rating2-star5" title="Awesome - 5 stars"></label>

                                <input type="radio" id="rating2-star4" name="service_rating2" value="4" />
                                <label class="full" for="rating2-star4" title="Pretty good - 4 stars"></label>

                                <input type="radio" id="rating2-star3" name="service_rating2" value="3" />
                                <label class="full" for="rating2-star3" title="Meh - 3 stars"></label>

                                <input type="radio" id="rating2-star2" name="service_rating2" value="2" />
                                <label class="full" for="rating2-star2" title="Kinda bad - 2 stars"></label>

                                <input type="radio" id="rating2-star1" name="service_rating2" value="1" />
                                <label class="full" for="rating2-star1" title="Sucks big time - 1 star"></label>
                                </div>
                            </fieldset>
                        </div>

                    </div>
                    <div class="mt-3">
                        <label class="form-label fw-semibold fs-5">@lang('Comment') <i class="fas fa-info-circle ms-2"></i></label>
                        <x-text-area class="form-control-border" rows="2" placeholder="Please let us know what led to this rating. What did you like and what did you not like?" />
                    </div>
                </div>
                <button class="btn btn-lg change-bg-color text-white question-wrapper mt-4 w-30">
                    @lang('Next')
                </button>
            </div>
            <div class="text-center mt-4">
                <img src="{{ asset('assets/images/logo.svg') }}" alt="logo" />
                <p class="mb-0 fs-4 fw-medium">@lang('Powered by') </p>
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

            $("#select-with-logo").change(function () {
                const logo = $(this).find(':selected').data('logo');

                fetch(logo)
                    .then(res => {
                        if (res.ok) return res.blob();
                    })
                    .then(blob => {
                        const reader = new FileReader();
                        reader.onload = () => $('.logo-preview').attr('src', reader.result);
                        reader.readAsDataURL(blob);
                        $('.logo-preview').removeClass("d-none");
                        $('.item-img').val('');
                        $('.drag-label').hide();
                        $('.logo-buttons').removeClass("d-none");
                    })
                    .catch(err => {
                        $('.logo-preview').attr('src', "");
                    });
            });

            $("#select-with-logo").trigger('change');

            $(document).on('change', 'input[name="color"]', function() {
                $("#selected-color").val(this.value).trigger('change');
            });

            $(document).on('change', "#selected-color", function() {
                const selectedColor = this.value;
                $(".change-bg-color").css('background-color', selectedColor);

                const hasMatch  = $('input[name="color"]').filter(function () {
                    return selectedColor === this.value;
                }).length > 0;

                if(!hasMatch) {
                    $('input[name="color"]').prop('checked', false);
                }
            });

            $("#selected-color").trigger('change');

            $('.main-rating-container').each(function () {
                let $lastChecked = null;

                $(this).find('input[type="radio"]').on('click', function () {
                    if ($(this).is($lastChecked)) {
                    $(this).prop('checked', false);
                    $lastChecked = null;
                    } else {
                    $lastChecked = $(this);
                    }
                });
            });
        </script>
    @endpush

    <x-image-cropper />
</x-app-layout>