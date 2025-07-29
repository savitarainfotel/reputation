<x-app-layout>
    <div class="col-md-12 border-bottom pb-3">
        <div class="row">
            <div class="col-md-2">
                <h6>@lang('Review Inbox')</h6>
            </div>
            <div class="col-md-3">
                <select class="form-control " id="select-with-logo" required name="property_id">
                    @foreach ($properties as $property)
                        <option value="{{ $property->encId }}" data-logo="{{ $property->getImageLink() }}">
                            {{ __($property->name) }}
                        </option>
                    @endforeach
                </select>
            </div>
        </div>
    </div>
    <div class="row widget-app-columns mt-5">
        <div class="col-md-6 scrollable mh-n100 border-end" data-simplebar="">
            <div class="row">
                @foreach ($reviews as $review)
                    <div class="col-xl-6 col-lg-12 col-md-6">
                        <div class="card border h-95 cursor-pointer">
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
        <div class="col-md-6 scrollable mh-n100" data-simplebar="">
            <div class="row ms-1">
                <div class="card border">
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
                <div class="text-end">
                    <a href="#" class="btn border text-primary fw-bold fs-4 mt-2 d-inline-flex align-items-center"><img src="{{ asset('assets/images/svg/reply.svg') }}" alt="reply" srcset="" class="me-2">Generate Reply</a>
                </div>
                <div class="card border mt-3">
                    <div class="card-header d-flex align-items-center justify-content-between bg-transparent">
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
        </div>
    </div>

    @push('style')
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
    @endpush
</x-app-layout>