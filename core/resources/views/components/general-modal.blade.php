<div class="modal fade" id="general-modal" role="dialog" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="" method="post" class="general-modal-form" id="general-modal-form">
                @csrf
                <div class="modal-body"></div>
                <div class="modal-footer">
                    <x-light-button type="button" class="btn-light btn-lg" data-bs-dismiss="modal">@lang('Cancel')</x-light-button>
                    <x-secondary-button class="btn-lg" type="submit">@lang('Save')</x-secondary-button>
                </div>
            </form>
        </div>
    </div>
</div>