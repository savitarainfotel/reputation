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

    @push('script')
        <script src="https://maps.googleapis.com/maps/api/js?key={{ gs('maps-api') }}&libraries=places" defer></script>
        <script>
            let map;
            let marker;

            $(document).ready(function(){
                $("map").hide();
    
                if (typeof google == "undefined") {
                    notify(`@lang("Maps error to find the property")`);
                }

                const $input = $('#autocomplete');
                const $img = $('#location-image');
                const $saveBtn = $('#save-btn').hide();
                $img.hide();
    
                const autocomplete = new google.maps.places.Autocomplete($input[0]);
    
                map = new google.maps.Map($('#map')[0], {
                    center: { lat: 20.5937, lng: 78.9629 },
                    zoom: 5,
                    mapTypeControl: false
                });
    
                autocomplete.addListener('place_changed', () => {
                    const place = autocomplete.getPlace();

                    if (!place.geometry) {
                        notify(`@lang("No property found")`);
                        return;
                    }

                    $('#map').show();
                    map.setCenter(place.geometry.location);
                    map.setZoom(16);
                    marker = marker || new google.maps.Marker({ map, draggable: false });
                    marker.setPosition(place.geometry.location);
    
                    if (place.photos?.length) {
                        const imageUrl = place.photos[0].getUrl({ maxWidth: 600 });
                        $img.attr('src', imageUrl).show();
                        $('#image_url').val(imageUrl);
                    }

                    $saveBtn.show();

                    const addressComponents = place.address_components;
                    let city, state, country;

                    for (const component of addressComponents) {
                        if (component.types.includes("locality")) {
                            $('#city').val(component.long_name);
                        }

                        if (component.types.includes("administrative_area_level_1")) {
                            $('#state').val(component.long_name);
                        }

                        if (component.types.includes("country")) {
                            $('#country').val(component.long_name);
                        }
                    }

                    $('#name').val(place.name);
                    $('#address').val(place.formatted_address);
                    $('#latitude').val(place.geometry.location.lat());
                    $('#longitude').val(place.geometry.location.lng());
                    $('#place_id').val(place.place_id);
                });
            });
        </script>
    @endpush
</x-app-layout>