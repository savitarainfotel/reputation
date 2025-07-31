<div id="confirmationModal" class="modal fade" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">@lang('Confirmation Alert!')</h4>
                <button type="button" class="close border border-dark rounded" data-bs-dismiss="modal" aria-label="Close">
                    <i class="las la-times"></i>
                </button>
            </div>
            <form action="" method="POST" id="confirmation-form" class="ajax-form">
                @csrf
                <div class="modal-body">
                    <h6 class="question"></h6>
                </div>
                <div class="modal-footer">
                    {{-- <button type="button" class="btn btn-dark btn-lg " data-bs-dismiss="modal">@lang('No')</button>
                    <button type="submit" class="btn btn-primary btn-lg ">@lang('Yes')</button> --}}
                </div>
            </form>
        </div>
    </div>
</div>

@push('script')
    <script>
        (function($) {
            "use strict";
            $(document).on('click', '.confirmationBtn', function() {
                const modal = $('#confirmationModal');
                let data = $(this).data();
                modal.find('.question').html(`${data.question}`);
                modal.find('form').attr('action', `${data.action}`);
                modal.modal('show');
            });
        })(jQuery);
    </script>
@endpush