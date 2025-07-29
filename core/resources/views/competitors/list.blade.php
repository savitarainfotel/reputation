<x-app-layout>
    <x-properties-top-nav />

    <div class="row">
        <div class="col-12 d-flex align-items-center">
            <h6>@lang('Competitors of Property')</h6>
            <div class="mx-3 w-30">
                <select class="form-control " id="select-with-logo" required name="property_id">
                    @foreach ($properties as $property)
                        <option value="{{ $property->encId }}" data-logo="{{ $property->getImageLink() }}">
                            {{ __($property->name) }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="col-4 d-flex mt-2 gap-2" id="counts">
                <span></span>
                <div class="progress w-25 mt-2">
                    <div class="progress-bar text-bg-info" style="width: 0%; height: 6px" role="progressbar"></div>
                </div>
            </div>
        </div>
        <div class="col-12 text-end">
            <a href="javascript:;" class="btn btn-info mb-3" id="add-competitor-link"><i class="far fa-plus"></i> @lang('Add New Competitor')</a>
        </div>
    </div>

    <div id="competeters" class="row"></div>

    @push('style')
        <link rel="stylesheet" href="{{ asset('assets/libs/select2/dist/css/select2.min.css') }}" />
    @endpush
    @push('script')
        <script src="{{ asset('assets/libs/select2/dist/js/select2.full.min.js') }}"></script>
        <script src="{{ asset('assets/libs/select2/dist/js/select2.min.js') }}"></script>
        <script>
            initSelectWithLogo("#select-with-logo");

            $("#select-with-logo").change(function() {
                const selected = $(this).val();
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
                });
            });

            $("#select-with-logo").trigger('change');
        </script>
    @endpush
</x-app-layout>