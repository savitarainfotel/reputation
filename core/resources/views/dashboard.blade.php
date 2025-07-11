<x-app-layout>
    <x-slot name="header">
        <h2 class="mt-2 ms-1">
            @lang('Dashboard')
        </h2>
    </x-slot>

    <div class="card text-white bg-secondary mb-3">
        <div class="card-header">@lang('Hi ') {{ Auth::user()->name }}</div>
        <div class="card-body">
            <h4 class="card-title">{{ __("You're logged in!") }}</h4>
            <p class="card-text">{{ Auth::user()->email }}</p>
            <p class="card-text">{{ Auth::user()->mobile }}</p>
        </div>
    </div>
</x-app-layout>