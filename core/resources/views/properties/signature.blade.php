<x-app-layout>
    <x-add-property-top-nav />

    <form action="{{ route('properties.add.signature', $property) }}" method="post" class="ajax-form">
        <div class="row">
            <div class="col-lg-6 offset-lg-3 col-12">
                <span>@lang('Welcome to RMS! Set up your account in four easy steps.')</span>
                <h6 class="mt-3 mb-3">@lang('Step ') <span class="text-secondary">4/4</span></h6>
                <h4 class="mt-3 mb-3">@lang('Add Your Signature For More Personal Review Replies')</h4>
                <p>
                    @lang('Can be changed later.')
                </p>
                <div class="form-group mb-3">
                    <x-text-area id="signature" type="text" name="signature" maxlength="255" :value="$property->signature" :property-name="$property->name" required />
                </div>
                <div class="row mt-3">
                    <div class="col-12">
                        <x-secondary-button type="submit" class="float-end py-8 mt-2 rounded-2 ms-3">
                            {{ __('Confirm') }}
                        </x-secondary-button>
                    </div>
                </div>
            </div>
        </div>
    </form>
</x-app-layout>