<x-app-layout>
    <style>
         .dropdown-menu{
            border: 1px solid #152C564D !important;
        }
    </style>
    <div class="row">
        <div class="col-lg-12">
            <h5 class="mb-3">Property Overview</h5>
             <div class="dropdown w-50">
                <button class="form-select text-start d-flex align-items-center" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
                    Property <img src="{{ asset('assets/images/company_Logo.png') }}" alt="logo" width="30" height="30" class="mx-2 rounded-circle"> Savitara Infotel Pvt Ltd.
                </button>
                <ul class="dropdown-menu w-100" aria-labelledby="dropdownMenuButton">
                    <li>
                    <a class="dropdown-item d-flex align-items-center" href="#">
                        Property <img src="{{ asset('assets/images/company_Logo.png') }}" alt="logo" width="30" height="30" class="mx-2 rounded-circle"> Savitara Infotel Pvt Ltd.
                    </a>
                    </li>
                    <li><a class="dropdown-item" href="#">Customer Service Enquiry</a></li>
                    <li><a class="dropdown-item" href="#">Legal Enquiry</a></li>
                    <li><a class="dropdown-item" href="#">General Enquiry</a></li>
                </ul>
            </div>
        </div>
    </div>
</x-app-layout>