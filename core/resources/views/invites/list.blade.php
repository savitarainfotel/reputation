<x-app-layout>
    <style>

        .invite-table-card {
           border: 1px solid #dee2e6;
           border-radius: 0.375rem; 
        }

        
    </style>
    <div class="row">
        <h5>@lang('Invites')</h5>
        <div class="col-lg-7"></div>
        <div class="col-lg-5">
            <div class="d-flex">
                <a href="javascript:;" type="button" class="btn btn-secondary ms-auto" id="add-survey-link">
                    <i class="fa-solid fa-qrcode me-2"></i></i>@lang('Share QR Code')
                </a>
                <a href="javascript:;" type="button" class="btn btn-secondary ms-auto" id="add-survey-link">
                    <i class="fa-solid fa-upload me-2"></i>@lang('Bulk upload')
                </a>
                <a href="javascript:;" type="button" class="btn btn-secondary ms-auto" id="add-survey-link">
                    <i class="fa-solid fa-download me-2"></i>@lang('Sample Excel')
                </a>
                <a href="javascript:;" type="button" class="btn btn-secondary ms-auto general-modal-button" data-action="{{ route('invites.store') }}">
                    <i class="fas fa-plus text-white me-2"></i>@lang('Add Invites')
                </a>
            </div>
        </div>
        <div class="col-lg-12 mt-4">
            <div class="card invite-table-card shadow">
                <div class="card-body">
                    <table class="table datatable table-striped " id="invites-table" data-link="{{ request()->url() }}">
                        <thead>
                            <tr>
                                <th>@lang('#')</th>
                                <th>@lang('Name')</th>
                                <th>@lang('Email')</th>
                                <th>@lang('Phone')</th>
                                <th></th>
                            </tr>
                        </thead>                
                    </table>    
                </div>
            </div>


            <div class="row">
                <div class="col-lg-8">

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
        <script src="{{ asset('assets/libs/select2/dist/js/select2.min.js') }}"></script>
        
        <script src="{{ asset('assets/libs/datatables.net/js/jquery.dataTables.min.js') }}"></script>
        <script>
            initSelectWithLogo("#select-with-logo");

            $("#select-with-logo").change(function() {
                const selected = $(this).val();
                const surveyDiv = $("#survey");
                surveyDiv.html('');
                $('#add-survey-link').attr('href', 'javascript:;');

                const form = createForm(`{{ route('survey.index') }}/${selected}`, "GET", {});

                submitForm(form).done(function(response){
                    surveyDiv.html(response.html);
                    $('#add-survey-link').attr('href', response.href);
                });
            });

            $("#select-with-logo").trigger('change');
        </script>
    @endpush
    <x-datatables />
    <x-confirmation-modal />
</x-app-layout>