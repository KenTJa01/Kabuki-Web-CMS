@extends("inventory.layouts.main")
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

        @if ( $permission_export != null )
            <button class="button_export" id="buttonExport">Export</button>
        @endif

    </div>

    <hr>

    <div class="form_header" style="padding: 0px 5px">
        <table style="width: 100%;">
            <tr>
                {{-- ITEM --}}
                <td class="label_form">Item</td>
                <td class="container_input_form">
                    <select name="select_item" id="select_item" class="input_form">
                        <option value="" readonly>Select item</option>
                    </select>
                </td>

                {{-- VERTICAL LINE --}}
                <td style="width: 4%" rowspan="2">
                    <hr class="vertical_line_one_row">
                </td>

                {{-- SITE --}}
                <td class="label_form">Store</td>
                <td class="container_input_form">
                    <select name="select_site" id="select_site" class="input_form">
                        <option value="" readonly>Select store</option>
                    </select>
                </td>
            </tr>
            {{-- <tr>
                <td></td>
                <td></td>
                <td></td>
                <td>
                    <div class="d-flex justify-content-end" id="content_button_submit">
                        <button class="button_submit_form mt-2" id="button_search">Search</button>
                    </div>
                </td>
            </tr> --}}
        </table>
    </div>

    <div class="container_table mt-3">
        <table id="tableData" class="table table-striped table-bordered tableData dataTables_scrollBody">
            <thead>
                <tr>
                    <th style="width: 50px">Item</th>
                    <th style="width: 120px">Store</th>
                    <th style="width: 120px">Stock</th>
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

        $('#select_site').select2({
            placeholder: {
                id: '-1',
                textw: 'Select an option'
            },
            multiple: false,
        });

        getAllDataItem();
        getAllDataStore();

        // dataTable();

    });

    $('#select_item, #select_site').on('change', function() {
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
                url: `{{ route("/get-stock-list-datatable") }}`,
                data: function(d) {
                    d.item = $('#select_item').val();
                    d.site = $('#select_site').val();
                },
            },
            columns: [
                {
                    data: 'item_description',
                    name: 'item_description',
                },
                {
                    data: null,
                    render: function(data, type, row) {
                        return row.store_code + ' - ' + row.store_desc;
                    }
                },
                {
                    data: 'quantity',
                    name: 'quantity',
                },
            ],
            order: [[0, 'asc']],
            columnDefs: [
                { className: "dt-center", targets: [0,1,2] }
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
                    text = data[i].item_name+' - '+data[i].item_desc;
                    value = data[i].id;
                    $('#select_item').append($("<option></option>").attr("value", value).text(text));
                }

            },
            error: function(error) {
                console.log(error.responseJSON);
                Swal.fire({
                    icon: 'error',
                    title: "Error",
                    text: error.responseJSON.message ?? 'Failed get list site from',
                });
            },
        });

    }

    function getAllDataStore() {

        $.ajax({
            type: 'GET',
            url: "{{ url('/get-user-site-permission') }}",
            dataType: 'json',
            data: {},
            success: function(response) {

                var data = response;

                // $('#select_site').find('option').remove().end().append();
                if (data.length != 1) {
                    $('#select_site').append('<option value="">ALL STORE</option>');
                }
                for (var i = 0; i < data.length; i++) {
                    text = data[i].store_code+' - '+data[i].site_description;
                    value = data[i].site_id;
                    $('#select_site').append($("<option></option>").attr("value", value).text(text));
                }

            },
            error: function(error) {
                console.log(error.responseJSON);
                Swal.fire({
                    icon: 'error',
                    title: "Error",
                    text: error.responseJSON.message ?? 'Failed get list site from',
                });
            },
        });

    }

    $('#buttonExport').on('click', function() {
        var item_id = $('#select_item').val();
        var site_id = $('#select_site').val();
        // var status = $('#status').val();

        // Create a form and submit it to download the file
        var form = $('<form>', {
            'action': "{{ url('/export-excel-list-stock') }}",
            'method': 'GET',
        });

        // Add CSRF Token
        var csrfToken = $('meta[name="csrf-token"]').attr('content');
        form.append($('<input>', { 'type': 'hidden', 'name': '_token', 'value': csrfToken }));

        // Append the data
        form.append($('<input>', { 'type': 'hidden', 'name': 'item_id', 'value': item_id }));
        form.append($('<input>', { 'type': 'hidden', 'name': 'site_id', 'value': site_id }));
        // form.append($('<input>', { 'type': 'hidden', 'name': 'status', 'value': status }));

        // Append the form to the body and submit
        $('body').append(form);
        form.submit();
        form.remove();

    });

</script>

@endsection
