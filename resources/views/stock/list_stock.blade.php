@extends("layouts.main")
@section("container")

<div class="content">

    {{-- TITLE --}}
    <div class="title_n_button justify-content-between">

        <div class="d-flex">
            <h4 class="title" style="margin-left: 0px">LIST OF STOCK</h4>

            <div class="user_guide active text-center">
                <font class="text_tooltip">i</font>
                <span class="user_guide_tooltip">You can view the stock data available in each Yogya store.</span>
            </div>
        </div>

        {{-- @if ( $permission_export != null )
            <button class="button_export" id="buttonExport">Export</button>
        @endif --}}

    </div>

    <hr>

    <div class="form_header" style="padding: 0px 5px">
        <table style="width: 50%;">
            <tr>
                {{-- ITEM --}}
                <td class="label_form">Item</td>
                <td class="container_input_form">
                    <select name="select_item" id="select_item" class="input_form">
                        <option value="" readonly disabled selected>Select item</option>
                    </select>
                </td>
            </tr>
        </table>
    </div>

    <div class="container_table mt-3">
        <table id="tableData" class="table table-striped table-bordered tableData dataTables_scrollBody">
            <thead>
                <tr>
                    <th style="width: 120px">Item</th>
                    <th style="width: 50px">Stock</th>
                </tr>
            </thead>
            <tbody></tbody>
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

    $(document).ready(function(){

        $('#select_item').select2({
            placeholder: {
                id: '-1',
                textw: 'Select an option'
            },
            multiple: false,
        });

        getAllDataItem();

    });

    // ========================= GET ALL DATA ITEM =========================
    function getAllDataItem() {

        $.ajax({
            type: 'GET',
            url: "{{ url('/get-all-data-item') }}",
            dataType: 'json',
            data: {},
            success: function(response) {

                var data = response;

                // $('#select_item').find('option').remove().end().append();
                if (data.length != 1) {
                    $('#select_item').append('<option value="">ALL ITEM</option>');
                }
                for (var i = 0; i < data.length; i++) {
                    text = data[i].item_name;
                    value = data[i].id;
                    $('#select_item').append($("<option></option>").attr("value", value).text(text));
                }

            },
            error: function(error) {
                console.log(error.responseJSON);
                Swal.fire({
                    icon: 'error',
                    title: "Error",
                    text: error.responseJSON.message ?? 'Failed get list of item',
                });
            },
        });

    }

    $('#select_item').on('change', function() {
        dataTable();
    });

    // ========================= DATATABLE =========================
    function dataTable() {

        var tableData = $("#tableData").DataTable({
            serverSide: true,
            processing: true,
            paginate: true,
            autoWidth: true,
            searchable: false,
            orderCellsTop: true,
            dom: 'rtip',
            // bRetrieve: true,
            scrollY: "535px",
            scrollCollapse: true,
            orderCellsTop: true,
            destroy: true,
            ajax: {
                type: 'POST',
                url: `{{ route("get-stock-list-datatable") }}`,
                data: function(d) {
                    d.item = $('#select_item').val();
                },
            },
            columns: [
                {
                    data: null,
                    render: function(data, type, row) {
                        return row.item_name + ' - ' + row.item_description;
                    }
                },
                {
                    data: 'quantity',
                    name: 'quantity',
                },
            ],
            order: [[0, 'asc']],
            columnDefs: [
                { className: "dt-center", targets: [0,1] }
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

</script>

@endsection
