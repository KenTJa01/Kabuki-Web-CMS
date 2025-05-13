@extends("inventory.layouts.main")
@section("container")

    <div class="content">

        {{-- TITLE & BUTTON EXPORT --}}
        <div class="title_n_button justify-content-between">

            <div class="d-flex">
                <h4 class="title" style="margin-left: 0px">LIST OF TRANSFER</h4>

                <div class="user_guide active text-center">
                    <font class="text_tooltip">i</font>
                    <span class="user_guide_tooltip">You can see the list of Transfer here.</span>
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
                        <th class="top_left_tableData">Transfer No.</th>
                        <th>Transfer Date</th>
                        <th>From Store</th>
                        <th>To Store</th>
                        <th>Status</th>
                        <th style="width: 120px" class="top_right_tableData">Action</th>
                    </tr>
                </thead>
                <tbody></tbody>
                <tfoot>
                    <tr>
                        <th class="bottom_left_tableData">Transfer No.</th>
                        <th>Transfer Date</th>
                        <th>From Store</th>
                        <th>To Store</th>
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

            dataTable();

        });

        function dataTable() {

            $('#tableData tfoot th').each(function (i) {
                var header_name = $('#tableData thead th').eq($(this).index()).text();
                var title = header_name.toLowerCase().replace(/\s+/g, "_").replace(/[^\w\s]/g, '');
                if ( i != 4 && i != 5 ) {
                    $(this).html(
                        '<input class="input_filter_tableData" type="text" id="' + title + '_filter" placeholder="' + header_name + '" data-index="' + i + '" style="width: 100%"/>'
                    );
                }

                // if ( i == 4 ) {
                //     $(this).html(
                //         '<select class="input_filter_tableData" id="' + title + '_filter" data-index="' + i + '" style="width: 100%"></select>'
                //     );
                // }

            });

            // ==================== DATATABLES ====================
            var tableData = $("#tableData").DataTable({
                serverSide: true,
                processing: true,
                paginate: true,
                autoWidth: true,
                searchable: false,
                orderCellsTop: true,
                dom: 'lBrtip',
                bRetrieve: true,
                scrollY: "535px",
                scrollCollapse: true,
                orderCellsTop: true,
                ajax: {
                    type: 'GET',
                    url: `{{ route("/get-transfer-list-datatable") }}`,
                    data: {
                    },
                },
                columns: [
                    {
                        data: 'trf_no',
                        name: 'trf_no',
                    },
                    {
                        data: 'trf_date',
                        name: 'trf_date',
                    },
                    {
                        data: 'from_store_name',
                        name: 'from_store_name',
                    },
                    {
                        data: 'to_store_name',
                        name: 'to_store_name',
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
                    { className: "dt-center", targets: [0, 1, 2, 3, 4] }
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

            // getStatusTransfer();

        }

        // function getStatusTransfer() {
        //     $.ajax({
        //         type: 'GET',
        //         url: "{{ url('/get-list-status-transfer') }}",
        //         dataType: 'json',
        //         data: {
        //         },
        //         success: function(response) {
        //             var data = response;

        //             $('#status_filter').find('option').remove().end().append();
        //             if (data.length != 1) {
        //                 $('#status_filter').append('<option value="" selected>Select store</option>');
        //             }
        //             for (var i = 0; i < data.length; i++) {
        //                 text = data[i].flag_desc;
        //                 value = data[i].site_id;
        //                 $('#status_filter').append($("<option></option>").attr("value", value).text(text));
        //             }

        //             $('#status_filter').prop('disabled', false);
        //         },
        //         error: function(error) {
        //             console.log(error.responseJSON);
        //             Swal.fire({
        //                 icon: 'error',
        //                 title: "Error",
        //                 text: error.responseJSON.message ?? 'Failed get list status transfer',
        //             });
        //         },
        //     });
        // }

        $('#buttonExport').on('click', function() {

            var trf_no = $('#transfer_no_filter').val();
            var trf_date = $('#transfer_date_filter').val();
            var from_site = $('#from_store_filter').val();
            var to_site = $('#to_store_filter').val();
            // var status = $('#status_filter').val();

            // Create a form and submit it to download the file
            var form = $('<form>', {
                'action': "{{ url('/export-excel-list-transfer') }}",
                'method': 'GET',
            });

            // Add CSRF Token
            var csrfToken = $('meta[name="csrf-token"]').attr('content');
            form.append($('<input>', { 'type': 'hidden', 'name': '_token', 'value': csrfToken }));

            // Append the data
            form.append($('<input>', { 'type': 'hidden', 'name': 'trf_no', 'value': trf_no }));
            form.append($('<input>', { 'type': 'hidden', 'name': 'trf_date', 'value': trf_date }));
            form.append($('<input>', { 'type': 'hidden', 'name': 'from_site', 'value': from_site }));
            form.append($('<input>', { 'type': 'hidden', 'name': 'to_site', 'value': to_site }));
            // form.append($('<input>', { 'type': 'hidden', 'name': 'status', 'value': status }));

            // Append the form to the body and submit
            $('body').append(form);
            form.submit();
            form.remove();

        });

    </script>


@endsection
