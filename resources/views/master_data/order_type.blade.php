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

                <h4 class="title">LIST OF ORDER TYPES</h4>

                <div class="user_guide active text-center">
                    <font class="text_tooltip">i</font>
                    <span class="user_guide_tooltip">You can manage the master data of DGM's gift items here.</span>
                </div>
            </div>
            <div>
                {{-- @if ( $permission_export != null ) --}}
                <button class="button_export" id="buttonExport">Export</button>
                {{-- @endif --}}
            </div>
        </div>

        <hr>

        <div class="container_table">
            <table id="tableData" class="table table-striped table-bordered tableData dataTables_scrollBody">
                <thead>
                    <tr>
                        <th style="width: 50px" class="top_left_tableData">No.</th>
                        <th style="width: 150px">Order Type Code</th>
                        <th>Order Type Name</th>
                        <th style="width: 200px;">Order Type Description</th>
                        <th style="width: 120px;">Work Type</th>
                        <th style="width: 100px">Status</th>
                        <th style="width: 70px" class="top_right_tableData">Action</th>
                    </tr>
                </thead>
                <tbody></tbody>
                <tfoot>
                    <tr>
                        <th style="width: 50px" class="bottom_left_tableData"></th>
                        <th style="width: 150px">Order Type Code</th>
                        <th>Order Type Name</th>
                        <th style="width: 200px;">Order Type Description</th>
                        <th style="width: 120px;">Work Type</th>
                        <th style="width: 100px"></th>
                        <th style="width: 70px" class="bottom_right_tableData"></th>
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
                    <h1 class="modal-title fs-5" id="newCreationModalLabel">CREATE NEW ORDER TYPER</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row input_modal">
                        <label for="order_type_name" class="col-sm-3 col-form-label">Name</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="order_type_name" placeholder="Enter name">
                        </div>
                    </div>
                    <div class="row input_modal">
                        <label for="order_type_description" class="col-sm-3 col-form-label">Description</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="order_type_description" placeholder="Enter description">
                        </div>
                    </div>
                    <div class="row input_modal">
                        <label for="select_work_type" class="col-sm-3 col-form-label">Work Type</label>
                        <div class="col-sm-9">
                            <select name="select_work_type" id="select_work_type" class="input_form" style="width: 100%;">
                                <option value="">Select work type</option>
                            </select>
                        </div>
                    </div>
                    <div class="row input_modal">
                        <label for="status" class="col-sm-3 col-form-label">Status</label>
                        <div class="col-sm-9">
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
                    <h1 class="modal-title fs-5" id="editModalLabel">EDIT ORDER TYPE</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="id" id="order_type_id_edit">
                    <div class="row input_modal">
                        <label for="order_type_code_edit" class="col-sm-3 col-form-label">Code</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="order_type_code_edit" disabled placeholder="Enter code">
                        </div>
                    </div>
                    <div class="row input_modal">
                        <label for="order_type_name_edit" class="col-sm-3 col-form-label">Name</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="order_type_name_edit" placeholder="Enter name">
                        </div>
                    </div>
                    <div class="row input_modal">
                        <label for="order_type_description_edit" class="col-sm-3 col-form-label">Description</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="order_type_description_edit" placeholder="Enter description">
                        </div>
                    </div>
                    <div class="row input_modal">
                        <label for="select_work_type_edit" class="col-sm-3 col-form-label">Work Type</label>
                        <div class="col-sm-9">
                            <select name="select_work_type_edit" id="select_work_type_edit" class="input_form" style="width: 100%;">
                                <option value="">Select work type</option>
                            </select>
                        </div>
                    </div>
                    <div class="row input_modal">
                        <label for="status_edit" class="col-sm-3 col-form-label">Status</label>
                        <div class="col-sm-9">
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

            $('#select_work_type').select2({
                dropdownParent: $("#newCreationModal"),
                placeholder: {
                    id: '-1',
                    text: 'Select an option'
                },
                multiple: false
            });

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
                    url: `{{ route("get-order-type-list-datatable") }}`,
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
                        data: 'order_type_code',
                        name: 'order_type_code',
                    },
                    {
                        data: 'order_type_name',
                        name: 'order_type_name',
                    },
                    {
                        data: 'order_type_desc',
                        name: 'order_type_desc',
                    },
                    {
                        data: 'work_type_name',
                        name: 'work_type_name',
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
                    { className: "dt-center", targets: [0,1,5] }
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

            $("#order_type_name").val("");
            $("#order_type_description").val("");
            $("#select_work_type").val("");
            $('#select_work_type').trigger("change");

            document.getElementById('status').checked = true;

            getAllDataWorkType();

        });

        // ========================= CLEAR INPUT MODAL =========================
        $(document).on('click', '#button_clear_modal', function(event) {

            $("#order_type_name").val("");
            $("#order_type_description").val("");
            $("#select_work_type").val("");
            $('#select_work_type').trigger("change");

            document.getElementById('status').checked = true;

        });

        // ========================= GET ALL DATA WORK TYPE =========================
        function getAllDataWorkType() {

            $("#select_work_type").html('<option value="">Select work type</option>');

            $.ajax({
                type: 'GET',
                url: "{{ url('/get-all-data-work-type') }}",
                dataType: 'json',
                data: {},
                success: function(response) {
                    $.each(response,function(key, value)
                    {
                        $("#select_work_type").append('<option value="' + value.id + '">' + value.work_type_name + '</option>');
                    });
                },
                error: function(error) {
                    console.log(error.responseJSON);
                    Swal.fire({
                        icon: 'error',
                        title: "Error",
                        text: error.responseJSON.message ?? 'Failed get list of work type',
                    });
                },
            });

        }

        // ========================= SUBMIT NEW DATA =========================
        $(document).on('click', '#button_submit_modal', function(event) {

            var orderTypeName = $("#order_type_name").val();
            var orderTypeDesc = $("#order_type_description").val();
            var workType = $("#select_work_type").val();
            var status = $("#status:checked").val();

            if ( status == 1 ) {
                var flag = 1;
            } else {
                var flag = 0;
            }

            $.ajax({
                type: 'POST',
                url: "{{ url('/post-new-order-type') }}",
                dataType: 'json',
                data: {
                    orderTypeName: orderTypeName,
                    orderTypeDesc: orderTypeDesc,
                    workType: workType,
                    status: flag,
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
                        text: error.responseJSON.message ?? 'Failed submit order type request',
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
                url: "{{ url('/get-old-data-of-order-type') }}",
                dataType: 'json',
                data: {
                    order_type_id: data_id,
                },
                success: function(response) {

                    $("#order_type_id_edit").val(response.id);
                    $("#order_type_code_edit").val(response.order_type_code);
                    $("#order_type_name_edit").val(response.order_type_name);
                    $("#order_type_description_edit").val(response.order_type_desc);

                    if ( response.flag == 1 ) {
                        $("#status_edit").attr('checked', true);
                    } else if ( response.flag == 0 ) {
                        $("#status_edit").attr('checked', false);
                    }

                    $('#select_work_type_edit').select2({
                        dropdownParent: $("#editModal"),
                        placeholder: {
                            id: '-1',
                            text: 'Select an option'
                        },
                        multiple: false
                    });

                    getWorkTypeById(response.work_type_id);

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

        // ========================= GET OLD DATA WORK TYPE =========================
        function getWorkTypeById(work_type_id) {

            $("#select_work_type_edit").html('<option value="">Select work type</option>');

            $.ajax({
                type: 'GET',
                url: "{{ url('/get-all-data-work-type') }}",
                dataType: 'json',
                data: {},
                success: function(response) {
                    $.each(response,function(key, value)
                    {
                        if ( value.id == work_type_id ) {
                            $("#select_work_type_edit").append('<option value="' + value.id + '" selected>' + value.work_type_name + '</option>');
                        } else {
                            $("#select_work_type_edit").append('<option value="' + value.id + '">' + value.work_type_name + '</option>');
                        }
                    });
                },
                error: function(error) {
                    console.log(error.responseJSON);
                    Swal.fire({
                        icon: 'error',
                        title: "Error",
                        text: error.responseJSON.message ?? 'Failed get list of profile',
                    });
                },
            });

        }

        // ========================= SUBMIT EDIT DATA =========================
        $(document).on('click', '#button_submit_modal_edit', function() {

            var id = $("#order_type_id_edit").val();
            var orderTypeCode = $("#order_type_code_edit").val();
            var orderTypeName = $("#order_type_name_edit").val();
            var orderTypeDesc = $("#order_type_description_edit").val();
            var workType = $("#select_work_type_edit").val();
            var status = document.getElementById('status_edit').checked;

            if ( status == 1 ) {
                var flag = 1;
            } else {
                var flag = 0;
            }

            $.ajax({
                type: 'POST',
                url: "{{ url('/post-edit-order-type') }}",
                dataType: 'json',
                data: {
                    id_order_type: id,
                    order_type_code: orderTypeCode,
                    order_type_name: orderTypeName,
                    order_type_desc: orderTypeDesc,
                    work_type: workType,
                    status: flag,
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
                        text: error.responseJSON.message ?? 'Failed submit order type request',
                        target: document.getElementById('editModal'),
                    });
                    $("#button_submit_modal_edit").prop('disabled', false);
                },
            });

        });

    </script>

@endsection
