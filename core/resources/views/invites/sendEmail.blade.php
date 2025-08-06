<x-app-layout>    
    <div class="row">
        <h5>@lang('Sent Email List')</h5>   
        <div class="col-md-2">
           
            <button type="button" class="btn btn-light dropdown-toggle text-dark border" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="ti ti-adjustments-horizontal fs-4 me-1"></i>Filter</button>
            <ul class="dropdown-menu animated rubberBand">
                <li><a class="dropdown-item" href="javascript:void(0)">All</a></li>
                <li>
                    <a class="dropdown-item" href="javascript:void(0)">selected</a>
                </li>                                          
            </ul>
       
        </div>     
        <div class="col-lg-12 mt-4">
            <div class="my-3 ">
                <div class=" table-responsive">
                    <table class="table datatable table-striped border " id="email-table" >
                        <thead>
                            <tr>
                                <th>@lang('#')</th>
                                <th>@lang('Name')</th>
                                <th>@lang('Property')</th>
                                <th>@lang('Rating')</th>
                                <th>@lang('Platform')</th>
                                <th>@lang('Comment')</th>
                                <th>@lang('Created On')</th>
                                <th>@lang('Status')</th>
                                <th>@lang('Resend')</th>
                               
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>1</td>
                                <td>Devang Mandaviya</td>
                                <td>Savitara Infotel Pvt. Ltd.</td>
                                <td>2 Star</td>
                                <td>Google</td>
                                <td>Poor Management</td>
                                <td>25-06-2025</td>
                                <td class="text-success">Email Sent</td>
                                <td><button type="button" class="btn btn-danger">@lang('Resend Email')</button></td>
                            </tr>
                            <tr>
                                <td>1</td>
                                <td>Devang Mandaviya</td>
                                <td>Savitara Infotel Pvt. Ltd.</td>
                                <td>2 Star</td>
                                <td>Google</td>
                                <td>Poor Management</td>
                                <td>25-06-2025</td>
                                <td class="text-secondary">Email Sent</td>
                                <td></td>
                            </tr>
                            <tr>
                                <td>1</td>
                                <td>Devang Mandaviya</td>
                                <td>Savitara Infotel Pvt. Ltd.</td>
                                <td>2 Star</td>
                                <td>Google</td>
                                <td>Poor Management</td>
                                <td>25-06-2025</td>
                                <td class="text-danger">Email Sent</td>
                                <td><button type="button" class="btn btn-danger">@lang('Resend Email')</button></td>
                            </tr>
                            <tr>
                                <td>1</td>
                                <td>Devang Mandaviya</td>
                                <td>Savitara Infotel Pvt. Ltd.</td>
                                <td>2 Star</td>
                                <td>Google</td>
                                <td>Poor Management</td>
                                <td>25-06-2025</td>
                                <td class="text-success">Email Sent</td>
                                <td><button type="button" class="btn btn-danger">@lang('Resend Email')</button></td>
                            </tr>
                            <tr>
                                <td>1</td>
                                <td>Devang Mandaviya</td>
                                <td>Savitara Infotel Pvt. Ltd.</td>
                                <td>2 Star</td>
                                <td>Google</td>
                                <td>Poor Management</td>
                                <td>25-06-2025</td>
                                <td class="text-success">Email Sent</td>
                                <td><button type="button" class="btn btn-danger">@lang('Resend Email')</button></td>
                            </tr>
                            <tr>
                                <td>1</td>
                                <td>Devang Mandaviya</td>
                                <td>Savitara Infotel Pvt. Ltd.</td>
                                <td>2 Star</td>
                                <td>Google</td>
                                <td>Poor Management</td>
                                <td>25-06-2025</td>
                                <td class="text-success">Email Sent</td>
                                <td><button type="button" class="btn btn-danger">@lang('Resend Email')</button></td>
                            </tr>
                        </tbody>                
                    </table>    
                </div>
            </div>           
        </div>
    </div>
@push('script')
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
<script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script>
  $(document).ready(function () {
    $('#email-table').DataTable({
      paging: true,      // enables pagination (default: true)
      pageLength: 10,     // number of records per page
      search:false,
    });
  });
</script>
@endpush   
</x-app-layout>
