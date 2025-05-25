@extends("layouts.main")
@section("container")

    <div class="content">

        {{-- TITLE & BUTTON EXPORT --}}
        <div class="title_n_button justify-content-between">

            <div class="d-flex">
                <h4 class="title" style="margin-left: 0px">HISTORY TRANSACTION</h4>

                <div class="user_guide active text-center">
                    <font class="text_tooltip">i</font>
                    <span class="user_guide_tooltip">You can see the list of Redeem here.</span>
                </div>
            </div>

            {{-- @if ( $permission_export != null )
            <button class="button_export" id="buttonExport">Export</button>
            @endif --}}

        </div>

        <hr>

        <div class="container_table">
            <table id="tableData" class="table table-striped table-bordered tableData dataTables_scrollBody">
                <thead>
                    <tr>
                        <th class="top_left_tableData">Transaction No.</th>
                        <th>Transaction Date</th>
                        <th>Customer Name</th>
                        <th>Work Type</th>
                        <th>Order Type</th>
                        <th style="width: 120px" class="top_right_tableData">Action</th>
                    </tr>
                </thead>
                <tbody></tbody>
                <tfoot>
                    <tr>
                        <th class="bottom_left_tableData">Transaction No.</th>
                        <th>Transaction Date</th>
                        <th>Customer Name</th>
                        <th>Work Type</th>
                        <th>Order Type</th>
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
                if ( i != 5 ) {
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
                scrollY: "535px",
                scrollCollapse: true,
                orderCellsTop: true,
                ajax: {
                    type: 'GET',
                    url: `{{ route("/get-transaction-history-datatable") }}`,
                    data: {
                    },
                },
                columns: [
                    {
                        data: 'trs_no',
                        name: 'trs_no',
                    },
                    {
                        data: "trs_date",
                        render: function(data, type) {
                            return type === 'sort' ? data : new Date(data).toLocaleDateString('id-ID');
                        }
                    },
                    {
                        data: 'customer_name',
                        name: 'customer_name',
                    },
                    {
                        data: 'work_type',
                        name: 'work_type',
                    },
                    {
                        data: 'order_type',
                        name: 'order_type',
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
                    { className: "dt-center", targets: [0,1,2,3,4,5] }
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

    </script>


@endsection
