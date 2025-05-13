@extends("inventory.layouts.main")
@section("container")

    <div class="content">

        {{-- TITLE --}}
        <div class="title_n_button">
            <h4 class="title" style="margin-left: 0px">FORM OF STOCK OPNAME</h4>
        </div>

        <hr>

        <div class="form_header" style="padding: 0px 5px">
            <table style="width: 100%;">
                <tr>
                    {{-- TRANSFER NO --}}
                    <td class="label_form">Transfer No.</td>
                    <td class="container_input_form">
                        <input type="text" class="form-control input_form" id="transfer_no" value="{{ $so_header_data?->so_no }}" readonly disabled>
                    </td>

                    {{-- VERTICAL LINE --}}
                    <td style="width: 4%" rowspan="2">
                        <hr class="vertical_line" style="height: 100px">
                    </td>

                    {{-- SITE --}}
                    <td class="label_form">Site</td>
                    <td class="container_input_form">
                        <input type="text" class="form-control input_form" id="site" value="{{ $so_header_data?->store_code.' - '.$so_header_data?->site_description }}" readonly disabled>
                    </td>
                </tr>
                <tr>
                    {{-- SO DATE --}}
                    <td class="label_form">SO Date</td>
                    <td class="container_input_form">
                        <input type="text" class="form-control input_form" id="stock_opname_date" value="{{ date_format(new DateTime($so_header_data?->so_date), 'd/m/Y') }}" readonly disabled>
                    </td>
                </tr>
            </table>
        </div>
    </div>

    {{-- TABLE LIST ITEMS --}}
    <div class="content  mt-2" id="content_table_form">

        <div style="height: 290px;" id="container_table_form">

            {{-- TITLE --}}
            <div class="title_n_button">
                <h4 class="title" style="margin-left: 0px">LIST OF ITEMS</h4>
            </div>

            <hr>

            {{-- TABLE ITEM --}}
            <div class="table_scroll">
                <table class="table tableData table-bordered table-striped align-middle table_form" id="table_form" style="width:100%;">
                    <thead class="thead">
                        <tr class="text-center" style="width: 100%;">
                            <th class="text-center">Items</th>
                            <th class="text-center">Before Qty.</th>
                            <th class="text-center">After Qty.</th>
                            <th class="text-center">Var Qty.</th>
                        </tr>
                    </thead>
                    <tbody style="background-color: white">
                        <tr>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                        </tr>
                    </tbody>
                    <tfoot>
                        <tr>
                            <td class="font-weight-bold"><strong>Total</strong></td>
                            <td></td>
                            <td></td>
                            <td></td>
                        </tr>
                    </tfoot>
                </table>
            </div>

        </div>

    </div>

    <div class="bottom_space"></div>

    <script>

        var tableData = $("#table_form").DataTable({
            data: {!! json_encode($so_detail_data) !!},
            processing: true,
            paginate: false,
            ordering: false,
            autoWidth: true,
            scrollCollapse: true,
            dom: 't',
            columns: [
                {
                    data: null,
                    render: function(data, type, row) {
                        return row.item_code+' - '+row.item_desc;
                    }
                },
                { data: 'before_quantity', name: 'before_quantity', },
                { data: 'after_quantity', name: 'after_quantity', },
                { data: 'variance_qty', name: 'variance_qty', },
            ],
            columnDefs: [
                { className: "dt-center", targets: [0,1,2,3] },
                { render: $.fn.dataTable.render.number(',', '.', 0, ''), targets: [1,2,3] },
            ],
            footerCallback: function (row, data, start, end, display) {
                var api = this.api();
                var numFormat = $.fn.dataTable.render.number( ',', '.', 0, '' ).display;

                var i = 1;
                var columnNum = 3;
                while (i <= columnNum) {
                    var totalRow = api.column(i, {page: 'current'}).data().reduce(function (a,b) {
                        return Number(a) + Number(b);
                    }, 0);

                    $(api.column(i).footer()).html(numFormat(totalRow));
                    i++;
                }
            },
            language: {
                loadingRecords: '&nbsp;',
                processing: '<div class="spinner" style="z-index: 1;"></div>',
                zeroRecords: "No data found",
            },
        });

    </script>

@endsection
