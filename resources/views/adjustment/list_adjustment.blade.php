@extends("layouts.main")
@section("container")

    <div class="content">

        {{-- TITLE & BUTTON EXPORT --}}
        <div class="title_n_button justify-content-between">

            <div class="d-flex">
                <h4 class="title" style="margin-left: 0px">LIST OF ADJUSTMENT</h4>

                <div class="user_guide active text-center">
                    <font class="text_tooltip">i</font>
                    <span class="user_guide_tooltip">You can see the list of Adjustment here.</span>
                </div>
            </div>

            {{-- @if ( $permission_export != null )
                <button class="button_export" id="buttonExport">Export</button>
            @endif --}}

        </div>

        <hr>

        {{-- TABLE LIST --}}
        <div class="container_table">
            <table id="tableData" class="table table-striped table-bordered tableData dataTables_scrollBody">
                <thead>
                    <tr>
                        <th class="top_left_tableData">Adjustment No.</th>
                        <th>Adjustment Date</th>
                        <th>Status</th>
                        <th style="width: 120px" class="top_right_tableData">Action</th>
                    </tr>
                </thead>
                <tbody></tbody>
                <tfoot>
                    <tr>
                        <th class="bottom_left_tableData">Adjustment No.</th>
                        <th>Adjustment Date</th>
                        <th>Status</th>
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
                if ( i != 3 ) {
                    $(this).html(
                        '<input class="input_filter_tableData" type="text" id="' + title + '_filter" placeholder="' + header_name + '" data-index="' + i + '" style="width: 100%"/>'
                    );
                }

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
                scrollY: "500px",
                scrollCollapse: true,
                orderCellsTop: true,
                ajax: {
                    type: 'GET',
                    url: `{{ route("/get-adjustment-list-datatable") }}`,
                    data: {
                    },
                },
                columns: [
                    {
                        data: 'adj_no',
                        name: 'adj_no',
                    },
                    {
                        data: 'adj_date',
                        name: 'adj_date',
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
                    { className: "dt-center", targets: [0, 1, 2, 3] }
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


        });

        $('#buttonExport').on('click', function() {
            var adj_no = $('#adjustment_no_filter').val();
            var adj_date = $('#adjustment_date_filter').val();
            var site = $('#store_filter').val();

            // Create a form and submit it to download the file
            var form = $('<form>', {
                'action': "{{ url('/export-excel-list-adjustment') }}",
                'method': 'GET',
            });

            // Add CSRF Token
            var csrfToken = $('meta[name="csrf-token"]').attr('content');
            form.append($('<input>', { 'type': 'hidden', 'name': '_token', 'value': csrfToken }));

            // Append the data
            form.append($('<input>', { 'type': 'hidden', 'name': 'adj_no', 'value': adj_no }));
            form.append($('<input>', { 'type': 'hidden', 'name': 'adj_date', 'value': adj_date }));
            form.append($('<input>', { 'type': 'hidden', 'name': 'site', 'value': site }));

            // Append the form to the body and submit
            $('body').append(form);
            form.submit();
            form.remove();

        });

    </script>


@endsection
