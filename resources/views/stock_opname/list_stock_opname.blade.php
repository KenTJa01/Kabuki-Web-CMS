@extends("inventory.layouts.main")
@section("container")

    <div class="content">

        {{-- TITLE & BUTTON EXPORT --}}
        <div class="title_n_button justify-content-between">

            <div class="d-flex">
                <h4 class="title" style="margin-left: 0px">LIST OF STOCK OPNAME</h4>

                <div class="user_guide active text-center">
                    <font class="text_tooltip">i</font>
                    <span class="user_guide_tooltip">You can see the list of Stock Opname here.</span>
                </div>
            </div>

            @if ( $permission_export != null )
                <button class="button_export" id="buttonExport">Export</button>
            @endif

        </div>

        <hr>

        {{-- TABLE LIST --}}
        <div class="container_table">
            <table id="tableData" class="table table-striped table-bordered tableData dataTables_scrollBody">
                <thead>
                    <tr>
                        <th class="top_left_tableData">SO No.</th>
                        <th>SO Date</th>
                        <th>Store</th>
                        <th>Status</th>
                        <th style="width: 120px" class="top_right_tableData">Action</th>
                    </tr>
                </thead>
                <tbody></tbody>
                <tfoot>
                    <tr>
                        <th class="bottom_left_tableData">SO No.</th>
                        <th>Site Code</th>
                        <th>Store Code</th>
                        <th></th>
                        <th style="width: 120px" class="bottom_right_tableData"></th>
                    </tr>
                </tfoot>
            </table>
        </div>

    </div>
    <div class="bottom_space"></div>

    <script>

        // ==================== GLOBAL SETUP CSRF ====================
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN' : $('meta[name="csrf-token"]').attr('content')
            }
        });

        $(document).ready(function(){

            $('#tableData tfoot th').each(function (i) {
                var header_name = $('#tableData thead th').eq($(this).index()).text();
                var title = header_name.toLowerCase().replace(/\s+/g, "_").replace(/[^\w\s]/g, '');
                if ( i != 3 && i != 4 ) {
                    $(this).html(
                        '<input class="input_filter_tableData" type="text" id="' + title + '_filter" placeholder="' + header_name + '" data-index="' + i + '" style="width: 100%"/>'
                    );
                }

            });

            dataTable();


        });

        function dataTable() {

            // ==================== DATATABLES ====================
            var tableData = $("#tableData").DataTable({
                serverSide: true,
                processing: true,
                paginate: true,
                autoWidth: true,
                searchable: false,
                orderCellsTop: true,
                dom: 'lBrtip',
                // deferLoading: 0,
                bRetrieve: true,
                scrollY: "535px",
                scrollCollapse: true,
                orderCellsTop: true,
                ajax: {
                    type: 'GET',
                    url: `{{ route("/get-so-list-datatable") }}`,
                    data: {
                    },
                },
                columns: [
                    {
                        data:'so_no',
                        name:'so_no',
                    },
                    {
                        data: 'so_date',
                        name: 'so_date',
                    },
                    {
                        data: 'site_description',
                        name: 'site_description',
                    },
                    {
                        data: 'status',
                        name: 'status',
                    },
                    {
                        data: 'actions',
                        name: 'actions',
                        orderable: false,
                        searchable: false,
                        className: 'text-center',
                    },
                ],
                order: [[1, 'desc'], [0, 'desc']],
                columnDefs: [
                    { className: "dt-center", targets: [0] }
                ],
                language: {
                    loadingRecords: '&nbsp;',
                    processing: '<div class="spinner" style="z-index: 1;"></div>',
                    zeroRecords: "No data found",
                },
            });

            // Filter event handler
            $(tableData.table().container()).on('keyup', 'tfoot input', function () {
                console.log(tableData.table().container());

                tableData.column($(this).data('index')).search(this.value).draw();
            });

        }

        function processData(data) {
            Swal.fire({
                icon: 'warning',
                title: "Are you sure?",
                text: "Process this transaction",
                showCancelButton: true,
                confirmButtonColor: "#DD6B55",
                confirmButtonText: "Yes",
                showLoaderOnConfirm: true,
                preConfirm: () => {
                    processDataStockOpname(data)
                }
            });
        }

        function processDataStockOpname(data) {
            $.ajax({
                type: 'POST',
                url: "{{ url('/post-stock-opname-process-data') }}",
                dataType: 'json',
                data: {
                    header_id: data,
                },
                success: function(response) {
                    return Swal.fire({
                        title: response.title,
                        text: response.message,
                        timer: 5000,
                        icon: "success",
                        timerProgressBar: true,
                        showConfirmButton: true,
                        willClose: () => {
                            // tableData.ajax.reload();
                            // dataTable();
                            if (typeof response.route !== "undefined") {
                                window.location.href = response.route;
                            }
                        },
                    });
                },
                error: function(error) {
                    console.log(error.responseJSON);
                    Swal.fire({
                        icon: 'error',
                        title: "Error",
                        text: error.responseJSON.message ?? 'Failed process stock opname data',
                    });
                },
            });
        }

        $('#buttonExport').on('click', function() {
            var so_no = $('#so_no_filter').val();
            var so_date = $('#so_date_filter').val();
            var site = $('#store_filter').val();
            // var status = $('#status').val();

            // Create a form and submit it to download the file
            var form = $('<form>', {
                'action': "{{ url('/export-excel-list-stock-opname') }}",
                'method': 'GET',
            });

            // Add CSRF Token
            var csrfToken = $('meta[name="csrf-token"]').attr('content');
            form.append($('<input>', { 'type': 'hidden', 'name': '_token', 'value': csrfToken }));

            // Append the data
            form.append($('<input>', { 'type': 'hidden', 'name': 'so_no', 'value': so_no }));
            form.append($('<input>', { 'type': 'hidden', 'name': 'so_date', 'value': so_date }));
            form.append($('<input>', { 'type': 'hidden', 'name': 'site', 'value': site }));
            // form.append($('<input>', { 'type': 'hidden', 'name': 'status', 'value': status }));

            // Append the form to the body and submit
            $('body').append(form);
            form.submit();
            form.remove();

        });

    </script>


@endsection
