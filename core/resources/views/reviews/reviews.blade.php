<div class="row">
    @forelse ($reviews as $review)
        <div class="col-xl-6 col-lg-6 col-md-6 col-12">
            <div class="card border h-95 cursor-pointer review-card" data-action="{{ route('reviews.detail', $review) }}">
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
                </div>
                <div class="card-header d-flex align-items-center justify-content-between bg-transparent pt-1">
                    <div class="d-flex align-items-center">
                        {!! getUserImageOrAlpha($review) !!}
                        <img src="{{ gs('admin-url') }}uploads/platforms-logos/{{ $review->rating_platform->platform->logo }}" alt="" class="logo-on-user bg-white" width="20" height="20" />
                        <h5 class="ms-2 card-title mb-0 fs-3 fw-bold">
                            {{ $review->reviewer }} <br>
                            <span class="fs-2">{{ \Carbon\Carbon::parse($review->datetime)->format('M d, Y') }}</span>
                        </h5>
                    </div>
                </div>
                <div class="card-body collapse show pt-0">
                    <p class="card-text fs-3">
                        {{ \Illuminate\Support\Str::limit($review->title, 130) }}
                    </p>
                </div>
            </div>
        </div>
    @empty
        <div class="col-xl-12 col-lg-12 col-md-12 col-12">
            <div class="card border cursor-pointer review-card">
                <div class="card-header">
                    <div class="text-center">
                        <h5 class="card-title mb-0 fs-3 fw-bold">
                            @lang('No reviews available')
                        </h5>
                    </div>
                </div>
            </div>
        </div>
    @endforelse
    {{ $reviews->links('pagination.design') }}
</div>