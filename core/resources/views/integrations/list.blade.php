<x-app-layout>
    <x-properties-top-nav />

    <div class="col-12">
        <div class="card border p-4">
            <p class="fs-5 fw-semibold"> @lang('Direct Reply Integrations')  <a href="javascript:;" class="text-secondary ms-2">@lang('How to set up integrations')</a></p>
            <div class="table-responsive border rounded-4 ">
                <table class="table table-bordered">
                    <thead class="text-dark fs-4">
                        <tr>
                            <th class="w-40">
                                <h6 class="fs-4 fw-semibold mb-0">@lang('Property')</h6>
                            </th>
                            <th>
                                <h6 class="fs-4 fw-semibold mb-0"><img src="{{ asset('assets/images/platforms/google.png') }}" alt="modernize-img" class="img-fluid rounded-circle bg-white p-2" width="35" height="35"> @lang('Google')</h6>
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @if ($properties->count())
                            @foreach ($properties as $property)
                                <tr>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            {!! $property->getImageLink('rounded-2', '42', '42') !!}
                                            <div class="ms-3">
                                                <p class="fs-4 mb-1">{{ $property->name }}</p>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="d-flex align-items-center gap-2">
                                            @if ($property->google())
                                                @if ($property->google()->access_token)
                                                   <a href="{{ route('integrations.google.callback', "state=".$property->google()->encId) }}" class="fs-4 text-danger"><strong>@lang('Disconnect')</strong></a>
                                                @else
                                                    <a href="{{ route('integrations.google', $property->google()) }}" class="fs-4 text-secondary">@lang('Add Integration')</a>
                                                @endif
                                            @else
                                            -
                                            @endif
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        @else
                            <tr>
                                <td>
                                    <strong class="fs-4 mb-1">@lang('No Property Added')</strong>
                                </td>
                                <td>
                                    <div class="d-flex align-items-center gap-2">
                                        <a href="{{ route('properties.create') }}" class="fs-4 text-secondary">@lang('Add Property Now')</a>
                                    </div>
                                </td>
                            </tr>
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
        {{-- <div class="card border p-4">
            <p class="fs-5 fw-semibold">@lang('Pending Integrations') <a href="javascript:;" class="text-secondary ms-2">@lang('How to set up integrations')</a></p>
            <div class="table-responsive border rounded-4 ">
                <table class="table  text-nowrap mb-0 align-middle">
                    <thead class="text-dark fs-4">
                        <tr>
                            <th>
                                <h6 class="fs-4 fw-semibold mb-0">@lang('Account')</h6>
                            </th>
                            <th>
                                <h6 class="fs-4 fw-semibold mb-0">@lang('Platform')</h6>
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>
                                <div class="d-flex align-items-center">
                                    <img src="../assets/images/blog/blog-img1.jpg" class="rounded-2" width="42" height="42">
                                    <div class="ms-3">
                                        <p class="fs-3 mb-1">abcdef@gmail.com</p>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <div class="d-flex align-items-center gap-2">
                                    <p class="fs-4 ">@lang('Booking')</p>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div> --}}
    </div>
</x-app-layout>