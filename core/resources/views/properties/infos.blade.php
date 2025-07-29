<x-app-layout>
    <x-add-property-top-nav />

    <form action="{{ route('properties.infos', $property) }}" method="post" class="ajax-form">
        <div class="row">
            <div class="col-lg-6 offset-lg-3 col-12">
                <span>@lang('Welcome to RMS! Set up your account in four easy steps.')</span>
                <h6 class="mt-3 mb-3">@lang('Step ') <span class="text-secondary">3/4</span></h6>
                <h4 class="mt-3 mb-3">@lang('Is This Your Business Type?')</h4>
                <p>
                    @lang('Can be changed later.')
                </p>
                <div class="form-group mb-3">
                    <input type="radio" class="btn-check" name="business_type" id="hotel" autocomplete="off" checked value="Hotel" />
                    <label class="btn btn-outline-dark me-2" for="hotel">@lang('Hotel')</label>
                    <input type="radio" class="btn-check" name="business_type" id="restaurant" autocomplete="off" {{ $property->business_type === "Restaurant" ? 'checked' : ''; }} value="Restaurant" />
                    <label class="btn btn-outline-dark me-2" for="restaurant">@lang('Restaurant')</label>
                    <input type="radio" class="btn-check" name="business_type" id="app" autocomplete="off" {{ $property->business_type === "App" ? 'checked' : ''; }} value="App" />
                    <label class="btn btn-outline-dark me-2" for="app">@lang('App')</label>
                    <input type="radio" class="btn-check" name="business_type" id="webshop" autocomplete="off" {{ $property->business_type === "Webshop" ? 'checked' : ''; }} value="Webshop" />
                    <label class="btn btn-outline-dark me-2" for="webshop">@lang('Webshop')</label>
                    <input type="radio" class="btn-check" name="business_type" id="other" autocomplete="off" {{ $property->business_type === "Other" ? 'checked' : ''; }} />
                    <label class="btn btn-outline-dark" for="other">@lang('Other')</label>
                </div>
                <div class="form-group mb-3">
                    <x-input-label for="autocomplete" :value="__('What Is The Name Of Your Business?')" />
                    <p>
                        @lang('Can be changed later.')
                    </p>
                    <x-text-input id="autocomplete" type="text" value="{{ $property->name }}" name="name" maxlength="255" required />
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
</x-app-layout>