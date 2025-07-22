<x-app-layout>
    <x-properties-top-nav />

    <div class="col-12 mt-5">
        <div class="text-center">
            <img src="{{ asset('assets/images/svg/home.svg') }}" alt="icon" class="mb-3">
            <h4 class="mb-4">@lang('To add a property click button below')</h4>
            <a href="{{ route('properties.create') }}" class="btn btn-info m-2"><i class="far fa-plus"></i> @lang('Add New Property')</a>
        </div>
    </div>
</x-app-layout>