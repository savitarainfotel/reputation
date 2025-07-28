<div class="col-md-12">
    <select class="form-control" id="select-with-logo" required name="platform_id">
        <option value="">@lang('Select listing')</option>
        @foreach ($platforms as $platformToSelect)
            <option value="{{ $platformToSelect->encId }}" data-logo="{{ gs('admin-url') }}uploads/platforms-logos/{{ $platformToSelect->logo }}">
                <img src="{{ gs('admin-url') }}uploads/platforms-logos/{{ $platformToSelect->logo }}" alt="icon" class="round-32" />
                {{ __($platformToSelect->platform) }}
            </option>
        @endforeach
    </select>
    <input type="hidden" name="name" /> 
    <input type="hidden" name="address" />
    <input type="hidden" name="picture" />
    <input type="hidden" name="platform_url" />
</div>
@foreach ($platforms as $platformToSelect)
    <div class="col-md-12 hide-all" id="show-{{ $platformToSelect->encId }}">
        <div class="row">
            <div class="col-md-3 col-12 mt-5">
                <span class="border border-dark rounded me-2 py-3 px-2 ">
                    <img src="{{ gs('admin-url') }}uploads/platforms-logos/{{ $platformToSelect->logo }}" alt="icon" class="round-32" />
                </span>
                <x-input-label for="autocomplete" :value="__($platformToSelect->platform)" />
            </div>
            <div class="col-md-9 col-12 mt-5">
                <div class="input-group border rounded-1">
                    <x-text-input data-action="{{ route('platforms.search', [$property, $platformToSelect]) }}" data-method="get" name="platform[{{ $platformToSelect->encId }}]" type="text" class="border-0 focus-in-field" placeholder="Your property URL" maxlength="255" required data-skeleton="skeleton" />
                    <a href="{{ $platformToSelect->platform_url }}" class="input-group-text bg-transparent border-0 text-danger px-6" target="_blank">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true" data-slot="icon" class="round-20"><path stroke-linecap="round" stroke-linejoin="round" d="M13.5 6H5.25A2.25 2.25 0 0 0 3 8.25v10.5A2.25 2.25 0 0 0 5.25 21h10.5A2.25 2.25 0 0 0 18 18.75V10.5m-10.5 6L21 3m0 0h-5.25M21 3v5.25"></path></svg>
                    </a>
                </div>
            </div>
        </div>
    </div>
@endforeach
<div class="loading-skeleton mt-4" id="skeleton">
    <div class="col-md-6">
        <div class="card">
            {!! $property->getImageLink('card-img-top', '200') !!}
            <div class="card-body">
                <h5 class="card-title">Card title</h5>
                <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
            </div>
        </div>
    </div>
</div>
<script>
    "use strict";

    initSelectWithLogo("#select-with-logo");
    initFocusInFields('.focus-in-field');

    $("#select-with-logo").change(function() {
        $('.hide-all').hide();
        $('#skeleton').hide();

        const selected = $(this).val();

        if(selected) {
            $(`#show-${selected}`).show();
        }

        $(`input[name=name]`).val('');
        $(`input[name=picture]`).val('');
        $(`input[name=address]`).val('');
        $(`input[name=platform_url]`).val('');
    });

    $("#select-with-logo").trigger('change');
</script>