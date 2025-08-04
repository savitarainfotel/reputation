<x-app-layout>
    <x-properties-top-nav />
    <div class="row">
        <div class="col-lg-12">
            <div class="d-flex align-item-center jusifi-content-between">
                <div class="dropdown w-30">
                    <select class="form-control " id="select-with-logo" required name="property_id">
                        @foreach ($properties as $property)
                            <option value="{{ $property->encId }}" data-logo="{{ $property->getImageLink() }}">
                                {{ __($property->name) }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>
    </div>
    <div class="row mt-3">
        <div class="col-4">
            <h5>@lang('Analytic Period (Last 30 Days):')</h5>
            <div class="dropdown ">
                <select class="form-control " id="select-with-logo" required name="property_id">
                    @foreach ($properties as $property)
                        <option value="{{ $property->encId }}" data-logo="{{ $property->getImageLink() }}">
                            {{ __($property->name) }}
                        </option>
                    @endforeach
                </select>
            </div>       
            <div class="graph">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Donut Pie Chart</h4>
                        <div id="chart-pie-donut" ></div>
                    </div>
                </div>                
            </div>     
        </div>
        <div class="col-4">
            <h5>@lang('Comparison Period (Same period before):')</h5>
            <div class="dropdown ">
                <select class="form-control " id="select-with-logo" required name="property_id">
                    @foreach ($properties as $property)
                        <option value="{{ $property->encId }}" data-logo="{{ $property->getImageLink() }}">
                            {{ __($property->name) }}
                        </option>
                    @endforeach
                </select>
            </div>      
            <div class="graph">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Donut Pie Chart</h4>
                        <div id="chart-pie-donut2" ></div>
                    </div>
                </div>                
            </div>                    
        </div>
        <div class="col-4">
            <h5>@lang('Included data')</h5>
            <div class="dropdown ">
                <select class="form-control " id="select-with-logo" required name="property_id">
                    @foreach ($properties as $property)
                        <option value="{{ $property->encId }}" data-logo="{{ $property->getImageLink() }}">
                            {{ __($property->name) }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="graph">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Donut Pie Chart</h4>
                        <div id="chart-pie-donut3" ></div>
                    </div>
                </div>                
            </div>                          
        </div>
    </div>    
    <div class="row">
        <x-top-bar />
    </div>
    <div class="row">
        <div class="col-lg-12 mt-4">
            <div class="card invite-table-card shadow">
                <div class="card-body">
                    <div class="col-lg-6">
                        <table class="table datatable table-striped " id="invites-table" data-link="{{ route('properties.overview') }}">
                            <thead>
                                <tr>                                                     
                                    <th>@lang('Platform')</th>
                                    <th>@lang('Hotelxplore Score')</th>
                                    <th>@lang('Response Rate')</th>
                                    <th>@lang('Platform Rating')</th>
                                    <th>@lang('New Reviews')</th>
                                </tr>
                            </thead>                
                        </table>                            
                    </div>
                    <div class="col-lg-6">
                        Review Summary
                    </div>

                </div>
            </div>
        </div>        
    </div>
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
    <script>
        var options = {
            chart: {
                type: 'donut',
                height: 350
            },
            series: [30, 40, 35, 50, 49, 60, 70, 91, 125],
            labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep'],
            title: {
                // text: 'Monthly Sales Data',
                align: 'center',
                style: {
                    fontSize: '16px',
                    fontWeight: 'bold'
                }
            },
            colors: ['#008FFB', '#00E396', '#FEB019', '#FF4560', '#775DD0', '#3F51B5', '#03A9F4', '#4CAF50', '#F9CE1D'],
            dataLabels: {
                enabled: true
            },
            legend: {
                position: 'bottom'
            }
        };

        var chart = new ApexCharts(document.querySelector("#chart-pie-donut"), options);
        var chart2 = new ApexCharts(document.querySelector("#chart-pie-donut2"), options);
        var chart3 = new ApexCharts(document.querySelector("#chart-pie-donut3"), options);
        chart.render();
        chart2.render();
        chart3.render();
    </script>     
</x-app-layout>