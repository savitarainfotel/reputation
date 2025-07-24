<x-app-layout>
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