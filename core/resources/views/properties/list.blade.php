<x-app-layout>
    <x-properties-top-nav />

    @if ($properties->count())
        <div class="row">
            <div class="col-12">
                <a href="{{ route('properties.create') }}" class="btn btn-info mb-3 float-end"><i class="far fa-plus"></i> @lang('Add New Property')</a>
            </div>
            @foreach ($properties as $property)
                <div class="col-3">
                    <div class="card">
                        <div class="position-relative px-2 pt-2">
                            <a href="javascript:void(0)">
                                {!! $property->getImageLink('card-img-top', '200') !!}
                            </a>
                        </div>
                        <div class="card-body p-4">
                            <a class="d-block fs-3 text-dark fw-semibold link-primary mb-2" href="javascript:void(0)">{{ $property->name }} <i class="fa fa-info-circle text-dark fs-5"></i></a>
                            <p class="text-justify border-bottom pb-3">
                                @lang('Last data collection on ') {{ \Carbon\Carbon::parse($property->updated_at)->format('M d, Y') }}
                            </p>
                            <div class="d-flex justify-content-between text-dark">
                                <div>
                                    <strong class="fs-5">{{ $property->reviews }}</strong> <br>
                                    <span class="fs-4">@lang('Reviews')</span>
                                </div>
                                <div class="user-pair">
                                    @foreach ($property->platforms as $platform)
                                        <div class="avtar">
                                            <img src="{{ gs('admin-url') }}uploads/platforms-logos/{{ $platform->platform->logo }}" alt="modernize-img" class="shared-user-badge img-fluid rounded-circle bg-white p-1" width="40" height="40" />
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @else
        <div class="col-12 mt-5">
            <div class="text-center">
                <img src="{{ asset('assets/images/svg/home.svg') }}" alt="icon" class="mb-3">
                <h4 class="mb-4">@lang('To add a property click button below')</h4>
                <a href="{{ route('properties.create') }}" class="btn btn-info m-2"><i class="far fa-plus"></i> @lang('Add New Property')</a>
            </div>
        </div>
    @endif
</x-app-layout>