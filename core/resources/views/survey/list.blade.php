<x-app-layout>
    <div class="row">
        <h5>@lang('Survey')</h5>
        <div class="col-lg-12">
            <div class="d-flex align-item-center jusifi-content-between">
                <div class="dropdown w-30">
                    <select class="form-control " id="select-with-logo" required name="property_id">
                        @foreach ($properties as $property)
                            <option value="{{ $property->encId }}" data-logo="{{ $property->getImageLink() }}">
                                {{ __($property->name) }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <a href="javascript:;" type="button" class="btn btn-secondary ms-auto">
                    <i class="fas fa-plus text-white me-2"></i>@lang('Create New Survey')
                </a>
            </div>
        </div>
        <div class="col-lg-4 mt-4">
            <div class="card border">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-start mb-3">
                        <div>
                            <div class="fw-bold  text-primary fs-4">Guest Experience Survey Savitara Infotel</div>
                        </div>
                        <div class="form-check form-switch status-switch">
                            <input class="form-check-input" type="checkbox" role="switch" id="statusSwitch" >
                            <label class="form-check-label" for="statusSwitch">Active</label>
                        </div>
                    </div>

                    <div class="d-flex align-items-center mb-4">
                        <img src="{{ asset('assets/images/logo.svg') }}"
                            alt="Logo" class="me-3 rounded-circle" width="40" height="40">
                        <h4 class="mb-0 text-primary fs-4">Savitara Infotel Pvt. Ltd.</h4>
                        <div class="ms-auto">
                            <a class=" me-2">
                                <i class="fas fa-pencil-square fs-5"></i>
                            </a>
                            <a class="">
                                <i class="fas fa-trash fs-5"></i>
                            </a>
                        </div>
                    </div>

                    <div class="row  mb-4">
                        <div class="col-md-4">
                            <div class="border p-2 rounded h-100">
                                <div class="text-primary fw-bold mb-2">Total Response</div>
                                <div class="text-secondary fs-6 fw-bolder">100</div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="border p-2 rounded h-100">
                                <div class="text-primary fw-bold mb-2">Platform Review</div>
                                <img src="{{ asset('assets/images/svg/google.svg') }}" width="32" alt="Google">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="border p-2 rounded h-100">
                                <div class="text-primary fw-bold mb-2">Survey Type</div>
                                <img src="{{ asset('assets/images/svg/star.svg') }}" width="28" alt="Star">
                            </div>
                        </div>
                    </div>

                    <div class="d-flex justify-content-between">
                        <button type="button" class="w-50 btn border border-2 border-secondary text-dark" data-action="">
                            <i class="fas fa-share  me-2"></i>@lang('Share')
                        </button>
                       
                        <x-secondary-button type="button" class="ms-2 w-50" data-action="">
                            <i class="fas fa-download text-white me-2"></i>@lang('Export Result')
                        </x-secondary-button>
                    </div>
                </div>
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

            $("#select-with-logo").change(function() {
                /* const selected = $(this).val();
                const maxCompetitors = `{{ gs('max-competitors') }}`;

                const competetersDiv = $("#competeters");
                const counts = $("#counts");
                competetersDiv.html('');
                counts.find('span').text(`0/${maxCompetitors}`);
                counts.find('.progress-bar').css('width', '0%');
                $('#add-competitor-link').attr('href', 'javascript:;');

                const form = createForm(`{{ route('competitors.index') }}/${selected}`, "GET", {});

                submitForm(form).done(function(response){
                    competetersDiv.html(response.html);
                    counts.find('span').text(`${response.count}/${maxCompetitors}`);
                    counts.find('.progress-bar').css('width', `${response.progress}%`);
                    $('#add-competitor-link').attr('href', response.href);
                }); */
            });

            $("#select-with-logo").trigger('change');
        </script>
    @endpush
</x-app-layout>