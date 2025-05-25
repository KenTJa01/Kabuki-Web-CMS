@extends("layouts.main")
@section("container")

<style>

    table thead th, td {
        padding: 4px 0px;
    }

</style>

<div class="content">

    {{-- TITLE --}}
    <div class="title_n_button justify-content-between">

        <div class="d-flex">
            <h4 class="title" style="margin-left: 0px">LIST OF MOVEMENT STOCK</h4>

            <div class="user_guide active text-center">
                <font class="text_tooltip">i</font>
                <span class="user_guide_tooltip">You can view the stock movement data that occurs in each Yogya store.</span>
            </div>
        </div>

        {{-- @if ( $permission_export != null )
            <button class="button_export" id="buttonExport">Export</button>
        @endif --}}

    </div>

    <hr>

    <div style="margin-top: 0px; padding: 0px 10px">
        <table style="width: 100%;">
            <tr>
                {{-- FROM DATE --}}
                <td class="label_form">From Date</td>
                <td class="container_input_form" style="margin: 0; padding: 0;">
                    <input type="date" class="form-control" name="" id="from_date">
                </td>

                {{-- VERTICAL LINE --}}
                <td style="width: 4%" rowspan="2">
                    <hr class="vertical_line_two_row">
                </td>

                {{-- TO DATE --}}
                <td class="label_form">To Date</td>
                <td class="container_input_form" style="margin: 0; padding: 0;">
                    <input type="date" class="form-control" name="" id="to_date" disabled>
                </td>
            </tr>
            <tr>
                {{-- ITEM --}}
                <td class="label_form">Item</td>
                <td class="container_input_form" style="margin: 0; padding: 0;">
                    <select name="select_item" id="select_item" class="input_form" style="width: 100%">
                        <option value="" readonly>Select item</option>
                    </select>
                </td>

                {{-- MOVEMENT TYPE --}}
                <td class="label_form">Movement Type</td>
                <td class="container_input_form" style="margin: 0; padding: 0;">
                    <select name="select_mov_type" id="select_mov_type" class="input_form" style="width: 100%">
                        <option value="">Select movement type</option>
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
                    <th style="width: 50px">Seq ID</th>
                    <th class="text-center" style="width: 120px">Item</th>
                    <th class="text-center" style="width: 120px">Mov Date</th>
                    <th class="text-center" style="width: 120px">Mov Type</th>
                    <th class="text-center" style="width: 120px">Qty</th>
                    <th style="width: 120px">Ref No.</th>
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

        var today = new Date();
        var yyyy = today.getFullYear();
        var mm = today.getMonth() + 1;
        var dd = today.getDate();

        if (mm < 10) mm = '0' + mm;
        if (dd < 10) dd = '0' + dd;

        var currentDate = yyyy + '-' + mm + '-' + dd;

        document.getElementById("from_date").max = currentDate;
        document.getElementById("to_date").max = currentDate;

        $('#select_item').select2({
            placeholder: {
                id: '-1',
                textw: 'Select an option'
            },
            multiple: false,
        });

        $('#select_mov_type').select2({
            placeholder: {
                id: '-1',
                textw: 'Select an option'
            },
            multiple: false,
        });

        getAllDataItem();
        getAllDataMovementType();

        // dataTable();

    });

    $('#from_date').on('change', function() {

        $('#to_date').prop('disabled', false);

        var fromDate = document.getElementById("from_date").value;
        var toDateInput = document.getElementById("to_date");

        if (fromDate) {
            // Set the 'min' attribute of the 'To Date' input to the selected 'From Date'
            toDateInput.min = fromDate;
        }

    });

    $('#from_date, #to_date, #select_item, #select_mov_type').on('change', function() {

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
                url: `{{ route("/get-movement-stock-list-datatable") }}`,
                data: function(d) {
                    d.fromDate = $('#from_date').val();
                    d.toDate = $('#to_date').val();
                    d.item = $('#select_item').val();
                    d.mov_type = $('#select_mov_type').val();
                },
            },
            columns: [
                {
                    data: 'id', name: 'id'
                },
                {
                    data: 'item_name', name: 'item_name'
                },
                {
                    data: 'mov_date', name: 'mov_date'
                },
                {
                    data: 'mov_code', name: 'mov_code'
                },
                {
                    data: 'quantity', name: 'quantity'
                },
                {
                    data: 'ref_no', name: 'ref_no'
                },
            ],
            order: [[0, 'desc']],
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
                    text: error.responseJSON.message ?? 'Failed get list site from',
                });
            },
        });

    }

    function getAllDataMovementType() {

        $.ajax({
            type: 'GET',
            url: "{{ url('/get-all-data-movement-type') }}",
            dataType: 'json',
            data: {},
            success: function(response) {

                var data = response;

                if (data.length != 1) {
                    $('#select_mov_type').append('<option value="">ALL MOVEMENT TYPE</option>');
                }
                for (var i = 0; i < data.length; i++) {
                    text = data[i].mov_code+' - '+data[i].mov_name;
                    value = data[i].id;
                    $('#select_mov_type').append($("<option></option>").attr("value", value).text(text));
                }

            },
            error: function(error) {
                console.log(error.responseJSON);
                Swal.fire({
                    icon: 'error',
                    title: "Error",
                    text: error.responseJSON.message ?? 'Failed get list movement type',
                });
            },
        });

    }

    $('#buttonExport').on('click', function() {
            var from_date = $('#from_date').val();
            var to_date = $('#to_date').val();
            var item_id = $('#select_item').val();
            var site_id = $('#select_site').val();
            var mov_id = $('#select_mov_type').val();
            // var status = $('#status').val();

            // Create a form and submit it to download the file
            var form = $('<form>', {
                'action': "{{ url('/export-excel-movement-stock') }}",
                'method': 'GET',
            });

            // Add CSRF Token
            var csrfToken = $('meta[name="csrf-token"]').attr('content');
            form.append($('<input>', { 'type': 'hidden', 'name': '_token', 'value': csrfToken }));

            // Append the data
            form.append($('<input>', { 'type': 'hidden', 'name': 'from_date', 'value': from_date }));
            form.append($('<input>', { 'type': 'hidden', 'name': 'to_date', 'value': to_date }));
            form.append($('<input>', { 'type': 'hidden', 'name': 'item_id', 'value': item_id }));
            form.append($('<input>', { 'type': 'hidden', 'name': 'site_id', 'value': site_id }));
            form.append($('<input>', { 'type': 'hidden', 'name': 'mov_id', 'value': mov_id }));
            // form.append($('<input>', { 'type': 'hidden', 'name': 'status', 'value': status }));

            // Append the form to the body and submit
            $('body').append(form);
            form.submit();
            form.remove();

        });

</script>

@endsection
