<div class="row ms-1">
    <div class="card border">
        <div class="card-header d-flex align-items-center justify-content-between bg-transparent">
            <div class="d-flex align-items-center">
                {!! $review->property->getImage('rounded me-2', 50, 50) !!}
                <h5 class="card-title mb-0 fs-3 fw-bold">
                    <span>{{ $review->property->name }}</span> <br>
                    <span>
                        {!! $review->starImages !!}
                    </span>
                </h5>
            </div>
            <div class="d-flex align-items-center">
                {!! getUserImageOrAlpha($review) !!}
                <img src="{{ gs('admin-url') }}uploads/platforms-logos/{{ $review->rating_platform->platform->logo }}" alt="" class="logo-on-review-user bg-white" width="20" height="20" />
                <h5 class="ms-2 card-title mb-0 fs-3 fw-bold">
                    {{ $review->reviewer }} <br>
                    <span class="fs-2">{{ \Carbon\Carbon::parse($review->datetime)->format('M d, Y') }}</span>
                </h5>
            </div>
            <div class="d-flex">
                <div class="form-check form-switch py-2 me-3">
                    <input class="form-check-input" type="checkbox" id="translation-to" name="translation_to" value="1" />
                    <label class="form-check-label" for="translation-to">@lang('Show Translation to')</label>
                </div>
                <select class="template-with-flag-icons">
                    @forelse ($languages as $language)
                        <option value="{{ $language->language }}" data-flag="{{ $language->country_code }}">{{ $language->language }}</option>
                    @empty
                    @endforelse
                </select>
            </div>
        </div>
        <div class="card-body collapse show pt-0">
            <p class="card-text fs-3">
                {{ $review->title }}
            </p>
        </div>
    </div>
    <div class="card border mt-3">
        <div class="card-header d-flex align-items-center justify-content-between bg-transparent">
            <div class="d-flex align-items-center">
                <img src="{{ asset('assets/images/svg/share.svg') }}" alt="review" class="rounded me-2">
                <h5 class="card-title mb-0 fs-4 fw-bold">@lang('Reply')</h5>
                <i class="fas fa-info-circle ms-2 fa-lg"></i>
            </div>
            <div class="d-flex">
                @if ($review->is_answered == $status::NO)
                    <a href="javascript:;" data-target-element="#generated-reply" class="copy-text-of-textarea p-1 border rounded me-2"><img src="{{ asset('assets/images/copy.png') }}" height="25" width="25" alt="file" srcset=""></a>
                    <select class="template-with-flag-icons">
                        @forelse ($languages as $language)
                            <option value="{{ $language->language }}" data-flag="{{ $language->country_code }}">{{ $language->language }}</option>
                        @empty
                        @endforelse
                    </select>
                @else
                    <span class="text-primary"><i class="fa fa-check"></i> <span>@lang('Marked as answered')</span></span>
                @endif
            </div>
        </div>
        <div class="card-body pt-0">
            <textarea name="generated-reply" id="generated-reply" class="w-100 no-border hide-overflow" class="fw-bold text-dark mb-0" placeholder="@lang('Type your reply manually here or use the \'Generate Reply\' button for an AI generated reply.')" {{ $review->is_answered == $status::YES ? 'readonly' : ''}}>{{ $review->is_reply_given == $status::YES ? $review->reply->comment : request()->reply }}</textarea>
        </div>
    </div>
    {{-- @if ($review->is_answered == $status::NO)
        <div class="card border mt-3">
            <div class="card-header d-flex align-items-center justify-content-between bg-transparent">
                <div class="d-flex align-items-center">
                    <img src="{{ asset('assets/images/svg/translation.svg'.$status::ASSET_VERSION) }}" alt="review" class="rounded me-2">
                    <h5 class="card-title mb-0 fs-4 fw-bold">@lang('Translation')</h5>
                    <i class="fas fa-info-circle ms-2 fa-lg"></i>
                </div>
                <div class="d-flex">
                    <a href="javascript:;" data-target-element="#translated-reply" class="copy-text-of-textarea p-1 border rounded me-2"><img src="{{ asset('assets/images/copy.png') }}" height="25" width="25" alt="file" srcset=""></a>
                    <select class="template-with-flag-icons">
                        @forelse ($languages as $language)
                            <option value="{{ $language->language }}" data-flag="{{ $language->country_code }}">{{ $language->language }}</option>
                        @empty
                        @endforelse
                    </select>
                </div>
            </div>
            <div class="card-body collapse show pt-0">
                <textarea name="translated-reply" id="translated-reply" class="w-100 no-border hide-overflow" class="fw-bold text-dark mb-0" placeholder="@lang('Type your reply manually here or use the \'Generate Reply\' button for an AI generated reply.')"></textarea>
            </div>
        </div>
    @endif --}}
    <div class="d-flex justify-content-between align-items-center flex-wrap g-3">
        <div class="d-flex flex-wrap g-3">
            @if ($review->is_answered == $status::NO)
                <a href="javascript:;" data-target-element="#generated-reply" data-redirect="{!! $review->url !!}" class="copy-text-of-textarea btn btn-secondary border text-primary d-inline-flex align-items-center">@lang('Copy & Open')</a>
            @endif

            @if ($review->is_reply_given == $status::NO)
                <a href="{{ route('reviews.mark-answered-unanswered', $review) }}" class="btn btn-outline-secondary border text-primary d-inline-flex align-items-center {{ $review->is_answered == $status::NO ? 'ms-2' : 'p-3' }} generate-reply">{{ $review->answeredText }}</a>
            @endif

            @if ($review->is_answered == $status::NO)
                <nav class="position-lg-absolute  bottom-0 end-0">
                    <ul class="pagination align-items-center justify-content-end mb-2 ">
                        <li class="page-item p-1">
                            <a class="page-link border-0 rounded text-dark fs-6 round-32 d-flex align-items-center justify-content-center" href="javascript:void(0)">
                                <i class="ti ti-arrow-left"></i>
                            </a>
                        </li>
                        <span class="fw-bold border-bottom border-3 border-info">1/3 @lang('Generated Replys')</span>
                        <li class="page-item p-1">
                            <a class="page-link border-0 rounded text-dark fs-6 round-32 d-flex align-items-center justify-content-center" href="javascript:void(0)">
                                <i class="ti ti-arrow-right"></i>
                            </a>
                        </li>
                    </ul>
                </nav>
            @endif
        </div>
        <div class="float-end">
            @if ($review->is_reply_given == $status::NO)
                <a href="{{ route('reviews.generate-reply', $review) }}" class="btn border text-primary fw-bold fs-4 me-2 d-inline-flex align-items-center {{ $review->is_answered == $status::YES ? 'disabled' : 'generate-reply' }}">
                    <img src="{{ asset('assets/images/svg/geminy.svg') }}" alt="" class="me-1" />
                    @lang('Generate Reply')
                </a>
            @else
                <a href="{{ route('reviews.unpublish-reply', $review) }}" data-target-element="#generated-reply" class="btn border text-primary fw-bold fs-4 me-2 d-inline-flex align-items-center send-reply">
                    @lang('Unpublish')
                </a>
            @endif
            @if ($review->is_answered == $status::NO)
                @php
                    $integration = $property->google();
                    $integrated  = $integration && $integration->access_token;
                @endphp

                <a href="{{ $integrated ? route('reviews.reply', $review) : route('integrations.index') }}" data-target-element="#generated-reply" class="btn btn-secondary me-2 {{ $integrated ? 'send-reply' : '' }}">
                    <i class="fab fa-telegram-plane text-white me-2 fa-lg"></i>
                    <span class="rounded-circlre" width="32"  height="32">
                        <img src="{{ gs('admin-url') }}uploads/platforms-logos/{{ $review->rating_platform->platform->logo }}" alt="" height="18" width="18">
                    </span>
                </a>
            @endif
        </div>
    </div>
</div>
<style>
    .select2-container{
        width: 110px !important;
    }
    .logo-on-review-user{
        position: absolute;
        left: 400px;
        z-index: 2;
        top: 38px;
        border-radius: 50%;
    }
    .hide-overflow {
        overflow: hidden;
        resize: none;
        box-sizing: border-box;
    }
</style>
<script>
    "use strict";

    @if (request()->reply && request()->type)
        typeWriterEffect(`{!! request()->reply !!}`, '#generated-reply');
    @else
        updateRows($('#generated-reply'));
    @endif
</script>