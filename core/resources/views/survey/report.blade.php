<x-app-layout>
    <div class="row">
        <h5 class="mb-4 fw-semibold">Survey Report</h5>
        <div class="col-md-6">
            <div class="d-flex align-items-center">
                <label class="form-label fw-bold">Property Name</label>
                <select class="form-select w-70 ms-2">
                    <option>Savitara Infotel Pvt Ltd.</option>
                </select>
            </div>            
        </div>
        <div class="col-md-6">
            <div class="d-flex align-items-center justify-content-end">
                <label class="form-label fw-bold">Survey Name</label>
                <select class="form-select w-70 ms-1">
                    <option>Guest Experience Survey Savitara Infotel Pvt. Ltd.</option>
                </select>
            </div>
        </div>
        <div class="col-md-3 ms-auto mt-3">
            <div class="d-flex align-items-center justify-content-end">
                <label class="form-label fw-bold">Ticket Types</label>
                <select class="form-select w-60 ms-1">
                    <option>All</option>
                </select>
            </div>

        </div>
        <div class="col-md-3 mt-3">
            <div class="d-flex align-items-center justify-content-end">
                <label class="form-label fw-bold">Reviews Types</label>
                <select class="form-select w-60 ms-1">
                    <option>Poor</option>
                </select>
            </div>

        </div>
    </div>
    <div class="row">
        <div class="table-responsive">
                  <table id="default_order" class="table table-striped display text-nowrap">
                    <thead>
                      <!-- start row -->
                      <tr>
                        <th>Date & Time</th>
                        <th>Property Name</th>
                        <th>Survey URL</th>
                        <th>Survey Name</th>
                        <th>Comment</th>
                        <th>Rating / NPS</th>
                        <th>Reviewer's Name</th>
                        <th>Reviewer's Email</th>
                        <th>Reviewer's Number</th>
                        <th></th>
                      </tr>
                      <!-- end row -->
                    </thead>
                    <tbody>
                      <!-- start row -->
                      <tr>
                        <td>2025-07-11, 15:28:31</td>
                        <td>Savitara Infotel Pvt. Ltd</td>
                        <td>app.mara-solutions.com/surveys/15dc19bc-4c84-46cf-86bd-a59a444058bd</td>
                        <td>Guest Experience Survey Budget Inn</td>
                        <td>Best services</td>
                        <td>2 Star</td>
                        <td>Devang Mandaviya</td>
                        <td>devangmandaviya24@gmail.com</td>
                        <td>0000000000</td>
                        <td><button class="btn btn-sm btn-primary">View</button></td>
                      </tr>
                      <!-- end row -->
                     
                    </tbody>
                    
                  </table>
                </div>
    </div>
</x-app-layout>
