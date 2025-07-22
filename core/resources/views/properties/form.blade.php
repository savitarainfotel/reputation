<div class="row">
    <div class="col-lg-6">
        <h6>@lang('Welcome to RMS! Set up your account in four easy steps.')</h6>
        <h6>@lang('Find Your Business')</h6>
        <p>
            @lang('Simply search your location on Google Maps. Your business is not listed on Google? Hit \'skip\' to use our copy-paste generator without Review Inbox or Analytics.')
        </p>
        <div class="form-group mb-3">
            <x-input-label for="autocomplete" :value="__('Property Name')" />
            <x-text-input id="autocomplete" type="text" value="{{ $property->name }}" maxlength="255" required />
            <x-text-input id="name" name="name" type="text" value="{{ $property->name }}" hidden />
            <input id="address" name="address" type="address" hidden />
            <input id="latitude" name="latitude" type="latitude" hidden />
            <input id="longitude" name="longitude" type="longitude" hidden />
            <input id="place_id" name="place_id" type="text" hidden />
            <input id="image_url" name="image_url" type="text" hidden />
            <input id="city" name="city" type="text" hidden />
            <input id="state" name="state" type="text" hidden />
            <input id="country" name="country" type="text" hidden />
        </div>
        <div id="map"></div>
    </div>
    <div class="col-lg-6">
        <img id="location-image" src="" alt="" />
    </div>
</div>