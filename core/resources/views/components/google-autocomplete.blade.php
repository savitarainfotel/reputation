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
                $('#url').val(place.url);
            });
        });
    </script>
@endpush