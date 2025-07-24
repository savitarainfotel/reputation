<x-app-layout>
    <x-add-property-top-nav />

    <form action="{{ route('properties.create') }}" method="post" class="ajax-form">
        <div class="row">
            <div class="col-md-6 offset-md-3 col-12">
                <small>@lang('Welcome to RMS! Set up your account in four easy steps.')</small>
                <h4 class="mt-3 mb-3">@lang('Find Your Business')</h4>
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
                        {{-- <x-light-button type="button" class="float-end py-8 mt-2 rounded-2">
                            {{ __('Skip') }}
                        </x-light-button> --}}
                    </div>
                </div>
            </div>
        </div>
    </form>
</x-app-layout><x-app-layout>
    <x-add-property-top-nav />

    <form action="{{ route('properties.create') }}" method="post" class="ajax-form">
        <div class="row">
            <div class="col-md-6 offset-md-3 col-12">
                <small>@lang('Welcome to RMS! Set up your account in four easy steps.')</small>
                <h4 class="mt-3 mb-3">Step 3/4</h4>
                <h4 class="mt-3 mb-3">@lang('Is This Your Business Type?')</h4>
                <p>
                    @lang('Can be changed later.')
                </p>
                <div class="button-group">
                    <button type="button" class="btn btn-outline-dark">
                        @lang('Hotel')
                    </button>
                    <button type="button" class="btn btn-outline-dark">
                        @lang('Restaurant')
                    </button>
                    <button type="button" class="btn btn-outline-dark">
                        @lang('App')
                    </button>
                    <button type="button" class="btn btn-outline-dark">
                        @lang('Webshop')
                    </button>
                    <button type="button" class="btn btn-outline-dark">
                        @lang('Other')
                    </button>
                </div> 
                <small>@lang('What Is The Name Of You?')</small>
                <h4 class="mt-3 mb-3">@lang('What Is The Name Of You?')</h4>
                <p>
                    @lang('Can be changed later.')
                </p>               
                <div class="row">
                    <div class="col-md-6 col-12">
                        <img id="location-image" src="" alt="" />
                    </div>
                    <div class="col-md-6 col-12">
                        <div id="map"></div>
                    </div>
                </div>
                <div class="row">
                    <x-text-input id="autocomplete" type="text" placeholder="Name" maxlength="255" required />
                </div>
                <div class="row mt-3">
                    <div class="col-12">
                        <x-secondary-button type="submit" class="float-end py-8 mt-2 rounded-2 ms-3">
                            {{ __('Confirm') }}
                        </x-secondary-button>
                        {{-- <x-light-button type="button" class="float-end py-8 mt-2 rounded-2">
                            {{ __('Skip') }}
                        </x-light-button> --}}
                    </div>
                </div>
            </div>
        </div>
    </form>
</x-app-layout>