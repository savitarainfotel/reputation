<x-app-layout>
    <x-add-property-top-nav />
    <form action="{{ route('properties.create') }}" method="post" class="ajax-form">
        <div class="row">
            <div class="col-md-6 offset-md-3 col-12">
                <span>@lang('Welcome to RMS! Set up your account in four easy steps.')</span>
                <h6 class="mt-3 mb-3">@lang('Step ') <span class="text-secondary">1/4</span></h6>
                <h4 class="mt-3 mb-3">@lang('Find Your Business')</h4>
                <p>
                    @lang('Simply search your location on Google Maps. Your business is not listed on Google? Hit \'skip\' to use our copy-paste generator without Review Inbox or Analytics.')
                </p>
                <div class="form-group mb-3">
                    <div class="input-group border rounded-1">
                        <span class="input-group-text bg-transparent px-6 border-0" id="basic-addon1">
                            <i class="fa-solid fa-magnifying-glass"></i>
                        </span>
                        <x-text-input id="autocomplete" type="text" class="border-0" value="{{ $property->name }}" maxlength="255" required placeholder="Search your business on Google Maps" />
                        <x-text-input id="name" name="name" type="text" value="{{ $property->name }}" hidden />
                    </div>
                    <input id="address" name="address" type="address" hidden />
                    <input id="latitude" name="latitude" type="latitude" hidden />
                    <input id="longitude" name="longitude" type="longitude" hidden />
                    <input id="place_id" name="place_id" type="text" hidden />
                    <input id="url" name="url" type="text" hidden />
                    <input id="image_url" name="image_url" type="text" hidden />
                    <input id="city" name="city" type="text" hidden />
                    <input id="state" name="state" type="text" hidden />
                    <input id="country" name="country" type="text" hidden />
                </div>
                <div class="row">
                    <div class="col-md-6 col-12">
                        <img id="location-image" src="" alt="" />
                    </div>
                    <div class="col-md-6 col-12">
                        <div id="map"></div>
                    </div>
                </div>
                <div class="row mt-3">
                    <div class="col-12">
                        <x-secondary-button type="submit" class="float-end py-8 mt-2 rounded-2 ms-3">
                            {{ __('Continue') }}
                        </x-secondary-button>
                    </div>
                </div>
            </div>
        </div>
    </form>
    <x-google-autocomplete />
</x-app-layout>