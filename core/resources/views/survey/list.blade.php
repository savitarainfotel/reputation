<x-app-layout>
    <div class="row">
        <h5 class="my-4">@lang('Survey')</h5>
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
                <a href="{{ route('survey.create') }}" class="btn btn-secondary ms-auto">
                    <i class="fas fa-plus text-white me-2"></i>@lang('Create New Survey')
                </a>
            </div>
        </div>

        <div class="row" id="survey"></div>
    </div>

    @push('style')
        <link rel="stylesheet" href="{{ asset('assets/libs/select2/dist/css/select2.min.css') }}" />
    @endpush

    @push('script')
        <script src="{{ asset('assets/libs/select2/dist/js/select2.full.min.js') }}"></script>
        <script src="{{ asset('assets/libs/select2/dist/js/select2.min.js') }}"></script>
        <script>
            "use strict";

            initSelectWithLogo("#select-with-logo");

            $("#select-with-logo").change(function() {
                const selected = $(this).val();
                const surveyDiv = $("#survey");
                surveyDiv.html('');

                const form = createForm(`{{ route('survey.index') }}/${selected}`, "GET", {});

                submitForm(form).done(function(response){
                    surveyDiv.html(response.html);
                });
            });

            $("#select-with-logo").trigger('change');
        </script>
    @endpush
</x-app-layout>