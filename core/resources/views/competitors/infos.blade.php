<x-app-layout>
    <x-add-competitor-top-nav />

    <form action="{{ route('competitors.infos', $competitor) }}" method="post" class="ajax-form">
        <div class="row">
            <div class="col-md-6 offset-md-3 col-12">
                <h6 class="mt-3 mb-3">@lang('Step ') <span class="text-secondary">3/3</span></h6>
                <h4 class="mt-3 mb-3">@lang('What is the name of your Hotel?')</h4>
                <p>
                    @lang('Can be changed later.')
                </p>
                <div class="form-group">
                    <x-text-input id="autocomplete" type="text" value="{{ $competitor->name }}" name="name" maxlength="255" required />
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