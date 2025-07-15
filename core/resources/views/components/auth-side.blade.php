@props(['title', 'subTitle'])
<img src="{{ asset('assets/images/background.png') }}" alt="" srcset="" class="position-absolute background-image">
<a href="{{ route('home') }}" class="text-nowrap logo-img d-block px-4 py-9 w-100 text-center">
    <img src="{{ asset('assets/images/logo.svg') }}" class="dark-logo" alt="Logo-Dark" />
    <img src="{{ asset('assets/images/logo.svg') }}" class="light-logo" alt="Logo-light" />
    <div class="mt-3 text-white">@lang('The Best Reputation Management Software')</div>
</a>
<div class="d-flex align-items-end justify-content-center h-n80">
    <div>
        <div class="welcome">{{ $title ?? '' }}</div>
        <div class="desc">{{ $subTitle ?? '' }}</div>
        <div class="features feature-group d-none d-xl-flex">
            <div class="text-start">
                <img src="{{ asset('assets/images/svg/download.svg') }}" alt="download" class="me-2"  />
                    @lang('All-in-One Inbox')
            </div>
            <div class="text-start">
                <img src="{{ asset('assets/images/svg/multi-channel.svg') }}" class="me-2"
                    alt="multi-channel" srcset="" /> @lang('Multi-Channel Integration')
            </div>
            <div class="text-start">
                <img src="{{ asset('assets/images/svg/graph.svg') }}" alt="graph" srcset="" class="me-2" />
                @lang('Smart Insights & Competitor Tracking')
            </div>
            <div class="text-start">
                <img src="{{ asset('assets/images/svg/team.svg') }}" alt="team" srcset="" class="me-2" />
                @lang('Team Collaboration Made Easy')
            </div>
            <div class="text-start">
                <img src="{{ asset('assets/images/svg/rating.svg') }}" alt="rating" srcset="" class="me-2" />
                @lang('Automated Review Responses')
            </div>
            <div class="text-start">
                <img src="{{ asset('assets/images/svg/bell.svg') }}" alt="bell" srcset="" class="me-2" />
                @lang('Custom Alerts & Notifications')
            </div>
        </div>
    </div>
</div>