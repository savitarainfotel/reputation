<x-app-layout>
    <x-add-property-top-nav />

    <form action="{{ route('properties.add.platforms', $property) }}" method="post" class="ajax-form">
        <div class="row">
            <div class="col-md-6 offset-md-3 col-12">
                <small>@lang('Welcome to RMS! Set up your account in four easy steps.')</small>
                <h4 class="mt-3 mb-3">@lang('Confirm Your Listings')</h4>
                <p>
                    @lang('We\'ve added the following profiles for the different platforms. Confirm the selection or add/change a listing if needed.')
                </p>
                <div class="col-12 mt-4">
                    @foreach ($platforms as $platform)
                        <div class="row">
                            <div class="col-md-3 col-12 mb-4">
                                <span class="border border-dark rounded me-2 py-3 px-2 ">
                                    <img src="{{ gs('admin-url') }}uploads/platforms-logos/{{ $platform->logo }}" alt="icon" class="round-32" />
                                </span>
                                <x-input-label for="autocomplete" :value="__($platform->platform)" />
                            </div>
                            <div class="col-md-9 col-12 mb-4">
                                <div class="row">
                                    <div class="input-group border rounded-1">
                                        <input type="text" class="form-control border-0 ps-2" id="" placeholder="@lang('Your property URL')" />
                                        <a href="{{ $platform->platform_url }}" class="input-group-text bg-transparent px-6 border-0 text-danger pe-0" target="_blank">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true" data-slot="icon" class="round-20"><path stroke-linecap="round" stroke-linejoin="round" d="M13.5 6H5.25A2.25 2.25 0 0 0 3 8.25v10.5A2.25 2.25 0 0 0 5.25 21h10.5A2.25 2.25 0 0 0 18 18.75V10.5m-10.5 6L21 3m0 0h-5.25M21 3v5.25"></path></svg>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
                <div class="row mt-3">
                    <div class="col-12">
                        <x-secondary-button type="submit" class="float-end py-8 mt-2 rounded-2 ms-3">
                            {{ __('Continue') }}
                        </x-secondary-button>
                        <a href="{{ route('properties.infos', $property) }}" class="btn btn-light float-end py-8 mt-2 rounded-2">
                            {{ __('Skip') }}
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </form>
</x-app-layout>