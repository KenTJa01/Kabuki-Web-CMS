@extends(" layouts.main")
@section("container")

    <style>
        .select2-container .select2-selection {
            height: 147px;
            border: 1px solid #DEE2E6;
            border-radius: 0.375rem;
        }

        #select_category {
            overflow: hidden;
        }

        #select_supplier {
            border: 1px solid #DEE2E6;
            border-radius: 0.375rem;
        }

        #select_supplier + .select2-container .select2-selection {
            overflow-y: auto !important;
        }

        #select_supplier_edit {
            border: 1px solid #DEE2E6;
            border-radius: 0.375rem;
        }

        #select_supplier_edit + .select2-container .select2-selection {
            overflow-y: auto !important;
        }

    </style>

    <div class="content">

        {{-- TITLE & BUTTON NEW --}}
        <div class="title_n_button justify-content-between">
            <div style="display: flex">
                {{-- @if ( $permission_create != null ) --}}
                    <button class="button_new" id="button_new" data-bs-toggle="modal" data-bs-target="#newCreationModal">
                        <svg xmlns="http://www.w3.org/2000/svg" style="margin-top: -3px" width="20" viewBox="0 0 24 24" stroke-width="3.5" stroke-linejoin="round" stroke-linecap="round" stroke="currentColor" height="20" fill="none" class="svg"><line y2="19" y1="5" x2="12" x1="12"></line><line y2="12" y1="12" x2="19" x1="5"></line></svg>
                        New
                    </button>
                {{-- @endif --}}

                <h4 class="title">LIST OF PAKET PROMO</h4>

                <div class="user_guide active text-center">
                    <font class="text_tooltip">i</font>
                    <span class="user_guide_tooltip">You can manage the master data of DGM's gift items here.</span>
                </div>
            </div>
            <div>
                {{-- @if ( $permission_export != null ) --}}
                {{-- <button class="button_export" id="buttonExport">Export</button> --}}
                {{-- @endif --}}
            </div>
        </div>

        <hr>

        <div class="container_table">
            <table id="tableData" class="table table-striped table-bordered tableData dataTables_scrollBody">
                <thead>
                    <tr>
                        <th style="width: 50px" class="top_left_tableData">No.</th>
                        <th style="width: 120px">Promo Code</th>
                        <th>Promo Name</th>
                        <th>Promo Description</th>
                        <th>Price</th>
                        <th style="width: 120px">Status</th>
                        <th style="width: 120px" class="top_right_tableData">Action</th>
                    </tr>
                </thead>
                <tbody></tbody>
                <tfoot>
                    <tr>
                        <th style="width: 50px" class="bottom_left_tableData"></th>
                        <th style="width: 120px">Item Code</th>
                        <th>Item Name</th>
                        <th>Item Description</th>
                        <th>Price</th>
                        <th style="width: 120px"></th>
                        <th style="width: 120px" class="bottom_right_tableData"></th>
                    </tr>
                </tfoot>
            </table>
        </div>

    </div>
    <div class="bottom_space"></div>

    {{-- MODAL NEW CREATION --}}
    <div class="modal fade" id="newCreationModal" tabindex="-1" aria-labelledby="newCreationModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content" style="border: 0px;">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="newCreationModalLabel">CREATE NEW PROMO</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">

                    <div class="row input_modal">
                        <label for="promo_name" class="col-sm-4 col-form-label">Promo Name</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" id="promo_name" placeholder="Enter name">
                        </div>
                    </div>
                    <div class="row input_modal">
                        <label for="promo_description" class="col-sm-4 col-form-label">Description</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" id="promo_description" placeholder="Enter description">
                        </div>
                    </div>
                    <div class="row input_modal">
                        <label for="price" class="col-sm-4 col-form-label">Price</label>
                        <div class="col-sm-8">
                            <input type="number" class="form-control" id="price" placeholder="Enter price">
                        </div>
                    </div>
                    <div class="row input_modal">
                        <label for="status" class="col-sm-4 col-form-label">Status</label>
                        <div class="col-sm-8">
                            <div style="width: 75px;">
                                <div class="container_toggle">
                                    <input type="checkbox" class="checkbox" id="status" value="1" checked>
                                    <label class="switch" for="status">
                                        <span class="slider"></span>
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>

                    <hr>

                    <div class="mt-4" style="max-height: 206px;">
                        <table class="table tableData table-striped table-bordered align-middle" id="table_item" style="width:100%;">
                            <thead>
                                <tr>
                                    <th></th>
                                    <th>Item Code</th>
                                    <th>Item Name</th>
                                </tr>
                            </thead>
                            <tbody></tbody>
                        </table>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="button_clear_modal" id="button_clear_modal">Clear</button>
                    <button type="button" class="button_submit_modal" id="button_submit_modal">Submit</button>
                </div>
            </div>
        </div>
    </div>

    {{-- MODAL EDIT --}}
    <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content" style="border: 0px;">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="editModalLabel">EDIT PROMO</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">

                    <input type="hidden" name="id" id="promo_id_edit">
                    <div class="row input_modal">
                        <label for="promo_code_edit" class="col-sm-4 col-form-label">Promo Code</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" id="promo_code_edit" disabled placeholder="Enter code">
                        </div>
                    </div>
                    <div class="row input_modal">
                        <label for="promo_name_edit" class="col-sm-4 col-form-label">Promo Name</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" id="promo_name_edit" placeholder="Enter name">
                        </div>
                    </div>
                    <div class="row input_modal">
                        <label for="promo_description_edit" class="col-sm-4 col-form-label">Description</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" id="promo_description_edit" placeholder="Enter description">
                        </div>
                    </div>
                    <div class="row input_modal">
                        <label for="price_edit" class="col-sm-4 col-form-label">Price</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" id="price_edit" placeholder="Enter price">
                        </div>
                    </div>
                    <div class="row input_modal">
                        <label for="status_edit" class="col-sm-4 col-form-label">Status</label>
                        <div class="col-sm-8">
                            <div style="width: 75px;">
                                <div class="container_toggle">
                                    <input type="checkbox" class="checkbox" id="status_edit" value="1" checked>
                                    <label class="switch" for="status_edit">
                                        <span class="slider"></span>
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>

                    <hr>

                    <div class="mt-4" style="max-height: 206px;">
                        <table class="table tableData table-bordered align-middle table_form" id="table_item_edit" style="width:100%;">
                            <thead>
                                <tr>
                                    <th></th>
                                    <th>Item Code</th>
                                    <th>Item Name</th>
                                </tr>
                            </thead>
                            <tbody></tbody>
                        </table>
                    </div>

                </div>
                <div class="modal-footer">
                    {{-- <button type="button" class="button_clear_modal" id="button_clear_modal_edit">Clear</button> --}}
                    <button type="button" class="button_submit_modal" id="button_submit_modal_edit">Submit</button>
                </div>
            </div>
        </div>
    </div>

    <script>

        // ========================= GLOBAL SETUP CSRF =========================
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN' : $('meta[name="csrf-token"]').attr('content')
            }
        });

        $(document).ready(function(){

            dataTable();

        });

        // ========================= DATATABLE =========================
        function dataTable() {

            $('#tableData tfoot th').each(function (i) {
                var header_name = $('#tableData thead th').eq($(this).index()).text();
                var title = header_name.toLowerCase().replace(/\s+/g, "_");
                if ( i != 0 && i != 6 && i != 7) {
                    $(this).html(
                        '<input type="text" class="input_filter_tableData" id="' + title + '_filter" placeholder="' + header_name + '" data-index="' + i + '" style="width: 100%"/>'
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
                    url: `{{ route("get-promo-list-datatable") }}`,
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
                        data: 'promo_code',
                        name: 'promo_code',
                    },
                    {
                        data: 'promo_name',
                        name: 'promo_name',
                    },
                    {
                        data: 'promo_desc',
                        name: 'promo_desc',
                    },
                    {
                        data: 'price',
                        name: 'price',
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
                order: [[0, 'asc']],
                columnDefs: [
                    { className: "dt-center", targets: [0,1,6] }
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

        // ========================= CLICK NEW =========================
        $(document).on('click', '#button_new', function(event) {

            $("#promo_name").val("");
            $("#promo_description").val("");
            $("#price").val("");

            document.getElementById('status').checked = true;

            $(".form-check-input").prop("checked", false);

            if ($.fn.dataTable.isDataTable('#table_item')) {
                $('#table_item').DataTable().destroy();
            }

            dataTableCreate();

        });

        // ========================= CLEAR INPUT MODAL =========================
        $(document).on('click', '#button_clear_modal', function(event) {

            $("#promo_name").val("");
            $("#promo_description").val("");
            $("#price").val("");

            document.getElementById('status').checked = true;

            $(".form-check-input").prop("checked", false);

            if ($.fn.dataTable.isDataTable('#table_item')) {
                $('#table_item').DataTable().destroy();
            }

            dataTableCreate();

        });

        function dataTableCreate() {

            // ==================== DATATABLES ====================
            var tableData = $("#table_item").DataTable({
                serverSide: false,
                processing: true,
                paginate: true,
                autoWidth: true,
                dom: 'frtip',
                scrollCollapse: true,
                ajax: {
                    type: 'GET',
                    url: `{{ route("get-all-data-item-in-promo") }}`,
                    data: {
                    },
                },
                columns: [
                    {
                        data: null,
                        name: 'checkbox',
                        orderable: false,
                        searchable: false,
                        render: function(data, type, row, meta) {
                            return `<input type="checkbox" class="form-check-input checkbox_item" id="checkbox_${row.id}" value="${row.id}" />`;
                        }
                    },
                    {
                        data: 'item_code',
                        name: 'item_code',
                    },
                    {
                        data: 'item_name',
                        name: 'item_name',
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


        }

        // ========================= SUBMIT NEW DATA =========================
        $(document).on('click', '#button_submit_modal', function(event) {

            var promoName = $("#promo_name").val();
            var promoDesc = $("#promo_description").val();
            var price = $("#price").val();
            var status = $("#status:checked").val();

            if ( status == 1 ) {
                var flag = 1;
            } else {
                var flag = 0;
            }

            const dataItem = [];

            $("#table_item").DataTable().$('input.checkbox_item:checked').each(function() {
                dataItem.push($(this).val());
            });

            $.ajax({
                type: 'POST',
                url: "{{ url('/post-new-promo') }}",
                dataType: 'json',
                data: {
                    promoName: promoName,
                    promoDesc: promoDesc,
                    price: price,
                    status: flag,
                    dataItem: dataItem,
                },
                success: function(response) {

                    return Swal.fire({
                        title: response.title,
                        text: response.message,
                        timer: 5000,
                        icon: "success",
                        timerProgressBar: true,
                        showConfirmButton: true,
                        confirmButtonColor: "#DFBA86",
                        customClass: {
                            confirmButton: 'custom-confirm-button-swal'
                        },
                        willClose: () => {
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
                        text: error.responseJSON.message ?? 'Failed submit promo request',
                        target: document.getElementById('newCreationModal'),
                    });
                    $("#button_submit").prop('disabled', false);
                },
            });

        });

        // ========================= CLICK BUTTON EDIT =========================
        $(document).on('click', '#button_edit_modal', function(event){

            const data_id = $(this).data('id');

            $.ajax({
                type: 'GET',
                url: "{{ url('/get-old-data-of-promo') }}",
                dataType: 'json',
                data: {
                    promo_id: data_id,
                },
                success: function(response) {

                    $("#promo_id_edit").val(response.promo_data.id);
                    $("#promo_code_edit").val(response.promo_data.promo_code);
                    $("#promo_name_edit").val(response.promo_data.promo_name);
                    $("#promo_description_edit").val(response.promo_data.promo_desc);
                    $("#price_edit").val(response.promo_data.price);

                    if ( response.promo_data.flag == 1 ) {
                        $("#status_edit").attr('checked', true);
                    } else if ( response.promo_data.flag == 0 ) {
                        $("#status_edit").attr('checked', false);
                    }

                    if ($.fn.dataTable.isDataTable('#table_item_edit')) {
                        $('#table_item_edit').DataTable().destroy();
                    }

                    dataTableEdit();
                    getItemByPromoId(response.promo_item_data);

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

        });

        function dataTableEdit() {

            // ==================== DATATABLES ====================
            var tableData = $("#table_item_edit").DataTable({
                serverSide: false,
                processing: true,
                paginate: true,
                autoWidth: true,
                dom: 'frtip',
                scrollCollapse: true,
                ajax: {
                    type: 'GET',
                    url: `{{ route("get-all-data-item-in-promo") }}`,
                    data: {
                    },
                },
                columns: [
                    {
                        data: null,
                        name: 'checkbox',
                        orderable: false,
                        searchable: false,
                        render: function(data, type, row, meta) {
                            return `<input type="checkbox" class="form-check-input checkbox_item_edit" id="checkbox_${row.id}_edit" value="${row.id}" />`;
                        }
                    },
                    {
                        data: 'item_code',
                        name: 'item_code',
                    },
                    {
                        data: 'item_name',
                        name: 'item_name',
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


        }

        function getItemByPromoId(data) {

            $.ajax({
                type: 'GET',
                url: "{{ url('/get-all-data-item') }}",
                dataType: 'json',
                data: {},
                success: function(response) {

                    $.each(response,function(key, value)
                    {
                        if (data.includes(value.id)) {
                            $("#checkbox_"+value.id+"_edit").attr("checked", true);
                        }
                    });

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

            for (var i = 0; i < data.length; i++) {
                var check = $('#'+data[i]+'_edit');
                check.prop('checked', true);
            }

        }

        // ========================= SUBMIT EDIT DATA =========================
        $(document).on('click', '#button_submit_modal_edit', function() {

            var id = $("#promo_id_edit").val();
            var promoCode = $("#promo_code_edit").val();
            var promoName = $("#promo_name_edit").val();
            var promoDesc = $("#promo_description_edit").val();
            var price = $("#price_edit").val();
            var status = document.getElementById('status_edit').checked;

            if ( status == 1 ) {
                var flag = 1;
            } else {
                var flag = 0;
            }

            const dataItem = [];

            $("#table_item_edit").DataTable().$('input.checkbox_item_edit:checked').each(function() {
                dataItem.push($(this).val());
            });

            $.ajax({
                type: 'POST',
                url: "{{ url('/post-edit-promo') }}",
                dataType: 'json',
                data: {
                    id_promo: id,
                    promo_code: promoCode,
                    promo_name: promoName,
                    promo_desc: promoDesc,
                    price: price,
                    status: flag,
                    dataItem: dataItem,
                },
                success: function(response) {

                    return Swal.fire({
                        title: response.title,
                        text: response.message,
                        timer: 5000,
                        icon: "success",
                        timerProgressBar: true,
                        showConfirmButton: true,
                        confirmButtonColor: "#DFBA86",
                        customClass: {
                            confirmButton: 'custom-confirm-button-swal'
                        },
                        willClose: () => {
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
                        text: error.responseJSON.message ?? 'Failed submit promo request',
                        target: document.getElementById('editModal'),
                    });
                    $("#button_submit_modal_edit").prop('disabled', false);
                },
            });

        });

    </script>

@endsection
