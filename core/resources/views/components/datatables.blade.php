@push('style')

    <link rel="stylesheet" href="{{ asset('assets/admin-new/libs/datatables.net-bs5/css/dataTables.bootstrap5.min.css') }}" />
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.4.2/css/buttons.dataTables.min.css" />
@endpush
@push('script')
    <input type="hidden" name="status" value="{{ $status ?? '' }}" />
    <script src="https://cdn.jsdelivr.net/npm/iconify-icon@1.0.8/dist/iconify-icon.min.js"></script>
    <script src="{{ asset('assets/admin-new/libs/datatables.net/js/jquery.dataTables.min.js') }}"></script>
    {{-- <script src="https://cdn.datatables.net/buttons/2.4.2/js/dataTables.buttons.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.2/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.2/js/buttons.print.min.js"></script> --}}
    <script>
        
        "use strict";

        const $tables = [];

        if ($('.datatable').length > 0) {
            $('.datatable').each(function() {
                
                const table = $(this).DataTable({
                    "lengthMenu": [
                        [5, 10, 20, 30, 40, 100, -1],
                        [5, 10, 20, 30, 40, 100, "All"]
                    ],
                    "pageLength": $(this).data('page-length') ?? 20,
                    "processing": true,
                    "serverSide": true,
                    "order": [],
                    "ajax": {
                        url: $(this).data('link') ?? $("input[name='dataTableUrl']").val(),
                        type: "GET",
                        data: function(data) {
                            data.status = $("input[name='status']").val();
                            data.date_from = $("input[name='date-from']").val();
                            data.date_to = $("input[name='date-to']").val();
                            data.unsettled = $(`input[name="unsettled-only"]`).prop('checked');
                        },
                        complete: function(response) {
                            if ($('.bs-tooltip').length) {
                                $('.bs-tooltip').tooltip();
                            }

                            let allStatusCounts = 0;

                            if (response.responseJSON && response.responseJSON.allStatuseCount) {
                                Object.entries(response.responseJSON.allStatuseCount).forEach(([index,
                                    status
                                ]) => {
                                    $(`#${status.status}-counts`).text(status.counts);
                                    allStatusCounts += status.counts;
                                });
                            }

                            if (response.responseJSON && response.responseJSON.allOccupancyCount) {
                                Object.entries(response.responseJSON.allOccupancyCount).forEach(([index,
                                    status
                                ]) => {
                                    $(`#${status.status}-counts`).text(status.counts);
                                });
                            }

                            if ($("#all-status-counts").length) {
                                $("#all-status-counts").text(allStatusCounts);
                            }

                            if ($('.check-all-checkbox').length) {
                                $('.check-all-checkbox').prop('checked', false).trigger('change');
                            }

                            if (response.responseJSON?.totalAmount) {
                                $("#total-amount").text(response.responseJSON?.totalAmount);
                            }

                            if (response.responseJSON?.totalBalance) {
                                $("#total-balance").text(response.responseJSON?.totalBalance);
                            }
                        },
                    },
                    rowCallback: function(row, data) {
                        if (data.some(cell => typeof cell === 'string' && cell.includes(
                            'table-danger'))) {
                            $(row).addClass('table-danger');
                        }
                    },
                    "columnDefs": [{
                            "targets": "no-content",
                            "orderable": false,
                        },
                        {
                            "targets": "html-content",
                            "render": function(data, type, row) {
                                return type === 'display' ? htmlspecialcharsDecode(data) : data;
                            }
                        },
                        {
                            "targets": "editable",
                            "createdCell": function(td, cellData, rowData, row, col) {
                                $(td).attr('contenteditable', 'true');
                                $(td).attr('data-action', $(td).find('span').data('action'));
                                $(td).attr('data-name', $(td).find('span').data('name'));
                                $(td).attr('data-method', $(td).find('span').data('method'));
                            }
                        }
                    ]
                });

                $(this).on("focusin", "td[contenteditable='true']", function() {
                    $(this).data("original-value", $(this).text().trim());
                });

                $(this).on("blur", "td[contenteditable='true']", function() {
                    const action = $(this).data('action');
                    const method = $(this).data('method');
                    const newValue = $(this).text().trim();
                    const originalValue = $(this).data("original-value").trim();

                    if (newValue !== originalValue) {
                        const action = $(this).data('action');
                        const method = $(this).data('method');
                        const name = $(this).data('name');
                        const form = createForm(action, method, {
                            [name]: newValue
                        });

                        submitForm(form, true);
                    }
                });

                $tables.push(table);

                $(document).on('click', '.quick-links', function() {
                    $(".quick-links").removeClass("active");
                    $(this).addClass("active");
                    if (typeof table !== 'undefined') {
                        const status = $(this).data('status') ?? '';
                        $("input[name='status']").val(status);
                        table.ajax.reload();
                    }
                });

                $(document).on('click', '.delete-archive-item', function(e) {
                    e.preventDefault();
                    const form = this.parentNode;
                    Swal.fire({
                        title: 'Are you sure?',
                        text: "You won't be able to undo this!",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#3085D6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Yes, do it!'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            submitForm(form).done(function(response) {
                                if (response.error === false) {
                                    table.ajax.reload();
                                }
                            });
                        }
                    });
                });

                $(document).on('click', '.reload-ajax', function(e) {
                    if (typeof table !== 'undefined') {
                        const status = $(this).data('status') ?? 0;
                        $("input[name='status']").val(status);
                        table.ajax.reload();
                    }
                });

                /* if(typeof table !== 'undefined'){
                    multiCheck(table);
                } */
            });
        }

        const reloadTable = reloadTable => {
            $.each($tables, function(key, table) {
                const tableElement = table.table().node();
                const tableId = $(tableElement).attr('id');

                if (tableId === reloadTable) {
                    table.ajax.reload(null, false);
                }
            });
        }

        if ($('.datatable-simple').length > 0) {
            $('.datatable-simple').DataTable({
                "lengthMenu": [
                    [5, 10, 20, 30, 40, 100, -1],
                    [5, 10, 20, 30, 40, 100, "All"]
                ],
                "pageLength": 5
            });
        }
    </script>
@endpush
