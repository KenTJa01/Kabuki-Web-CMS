@extends("inventory.layouts.main")
@section("container")

    <div class="content">

        {{-- TITLE & BUTTON NEW --}}
        <div class="title_n_button">

            <h4 class="title" style="margin-left:0px">LIST OF SITES</h4>

            <div class="user_guide active text-center">
                <font class="text_tooltip">i</font>
                <span class="user_guide_tooltip">You can see the master data of Yogya's Store here.</span>
            </div>
        </div>

        <hr>

        <div class="container_table">
            <table id="tableData" class="table table-striped table-bordered tableData dataTables_scrollBody">
                <thead>
                    <tr>
                        <th style="width: 50px" class="top_left_tableData">No.</th>
                        <th style="width: 120px">Site Code</th>
                        <th style="width: 170px">Store Code</th>
                        <th>Site Description</th>
                        <th style="width: 120px" class="top_right_tableData">Status</th>
                    </tr>
                </thead>
                <tbody></tbody>
                <tfoot>
                    <tr>
                        <th style="width: 50px" class="bottom_left_tableData"></th>
                        <th style="width: 120px">Site Code</th>
                        <th style="width: 170px">Store Code</th>
                        <th>Site Description</th>
                        <th style="width: 120px" class="bottom_right_tableData">Status</th>
                    </tr>
                </tfoot>
            </table>
        </div>

    </div>
    <div class="bottom_space"></div>

    <script>

        // ========================= GLOBAL SETUP CSRF =========================
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN' : $('meta[name="csrf-token"]').attr('content')
            }
        });

        // ========================= DATATABLE =========================
        $(document).ready(function(){

            $('#tableData tfoot th').each(function (i) {
                var title = $('#tableData thead th').eq($(this).index()).text();
                if ( i != 0 && i != 5) {
                    $(this).html(
                        '<input type="text" class="input_filter_tableData" placeholder="' + title + '" data-index="' + i + '" style="width: 100%"/>'
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
                    url: `{{ route("get-site-list-datatable") }}`,
                    data: {
                    },
                },
                columns: [
                    {
                        data:'DT_RowIndex',
                        name:'DT_RowIndex',
                        orderable:false,
                        searchable:false
                    },
                    {
                        data: 'site_code_string',
                        name: 'site_code_string',
                    },
                    {
                        data: 'store_code',
                        name: 'store_code',
                    },
                    {
                        data: 'site_description',
                        name: 'site_description',
                    },
                    {
                        data: 'status',
                        name: 'status',
                    },
                ],
                order: [[0, 'asc']],
                columnDefs: [
                    { className: "dt-center", targets: [0,1,2,4] }
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
