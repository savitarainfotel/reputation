<x-app-layout>
    <x-add-competitor-top-nav />

    <div class="row">
        <div class="col-md-6 offset-md-3 col-12">
            <h6 class="mt-3 mb-3">@lang('Step ') <span class="text-secondary">2/3</span></h6>
            <h4 class="mt-3 mb-3">@lang('Find your competitors location')</h4>
            <p>
                @lang('We\'ve added the following profiles for the different platforms. Confirm the selection or add/change a listing if needed.')
            </p>
            <div class="col-12 mt-4">
                <div class="row">
                    @if ($competitor->platforms->count())
                        @foreach ($competitor->platforms as $platform)
                            <div class="col-lg-5">
                                <div class="card h-95">
                                    <div class="position-relative">
                                        <a href="javascript:void(0)">
                                            {!! $platform->picture ? $platform->getImage('card-img-top', '200') : $competitor->getImage('card-img-top', '200') !!}
                                        </a>
                                        <img src="{{ gs('admin-url') }}uploads/platforms-logos/{{ $platform->platform->logo }}" alt="modernize-img" class="img-fluid rounded-circle position-absolute bottom-0 start-0 mb-n9 ms-9 bg-white p-1" width="40" height="40">
                                    </div>
                                    <div class="card-body p-4">
                                        <a class="d-block my-4 fs-3 text-dark fw-semibold link-primary mb-2" href="javascript:void(0)">{{ $platform->name ?? $competitor->name }}</a>
                                        <p class="text-justify">
                                            {{ $platform->address ?? $competitor->address }}
                                        </p>
                                        <div class="d-flex align-items-center gap-4">
                                            <a href="javascript:void(0)" class="btn btn-light d-flex align-items-center gap-2 {{ $platform->platform->is_default == TRUE ? 'disabled' : '' }}" disabled>
                                                <i class="ti ti-trash text-dark fs-5"></i>
                                            </a>
                                            <a href="javascript:void(0)" class="btn btn-light d-flex align-items-center gap-2 {{ $platform->platform->is_default == TRUE ? 'disabled' : '' }}" disabled>
                                                <i class="ti ti-edit text-dark fs-5"></i>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @endif
                    @if ($platforms->whereNotIn('id', $competitor->platforms->pluck('rating_platform_id'))->count())
                        <div class="col-lg-5">
                            <div class="card h-95">
                                <div class="card-body d-flex justify-content-center align-items-center">
                                    <div class="row">
                                        <div class="col-12 text-center">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true" data-slot="icon" class="mb-6 round-32">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 16.875h3.375m0 0h3.375m-3.375 0V13.5m0 3.375v3.375M6 10.5h2.25a2.25 2.25 0 0 0 2.25-2.25V6a2.25 2.25 0 0 0-2.25-2.25H6A2.25 2.25 0 0 0 3.75 6v2.25A2.25 2.25 0 0 0 6 10.5Zm0 9.75h2.25A2.25 2.25 0 0 0 10.5 18v-2.25a2.25 2.25 0 0 0-2.25-2.25H6a2.25 2.25 0 0 0-2.25 2.25V18A2.25 2.25 0 0 0 6 20.25Zm9.75-9.75H18a2.25 2.25 0 0 0 2.25-2.25V6A2.25 2.25 0 0 0 18 3.75h-2.25A2.25 2.25 0 0 0 13.5 6v2.25a2.25 2.25 0 0 0 2.25 2.25Z"></path>
                                            </svg>
                                        </div>
                                        <div class="col-12 text-center">
                                            <x-secondary-button type="button" class="general-modal-button" data-action="{{ route('platforms.create.competitor', $competitor) }}">
                                                @lang('Add another listing')
                                            </x-secondary-button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
            <div class="row mt-3">
                <div class="col-12">
                    <a href="{{ route('competitors.infos', $competitor) }}" class="btn btn-secondary float-end py-8 mt-2 rounded-2 ms-3">
                        {{ __('Continue') }}
                    </a>
                </div>
            </div>
        </div>
    </div>

    @push('style')
        <link rel="stylesheet" href="{{ asset('assets/libs/select2/dist/css/select2.min.css') }}" />
    @endpush
    @push('script')
        <script src="{{ asset('assets/libs/select2/dist/js/select2.full.min.js') }}"></script>
        <script src="{{ asset('assets/libs/select2/dist/js/select2.min.js') }}"></script>
    @endpush
</x-app-layout>