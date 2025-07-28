<div class="stepper">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="d-flex justify-content-between align-items-start overflow-auto">
                    <div class="stepper-item {{ showActive('competitors.create') }} {{ showActive('competitors.add.platforms') }} {{ showActive('competitors.infos') }}">
                        <div class="stepper-circle">
                            <i class="fas fa-search"></i>
                        </div>
                        <div class="stepper-label">@lang('Find Your Business')</div>
                    </div>
                    <div class="stepper-item {{ showActive('competitors.add.platforms') }} {{ showActive('competitors.infos') }}">
                        <div class="stepper-circle">
                            <i class="fas fa-filter"></i>
                        </div>
                        <div class="stepper-label">@lang('Add More Platforms')</div>
                    </div>
                    <div class="stepper-item {{ showActive('competitors.infos') }}">
                        <div class="stepper-circle">
                            <i class="fas fa-list"></i>
                        </div>
                        <div class="stepper-label">@lang('Check Business Infos')</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>