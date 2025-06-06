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

                <h4 class="title">LIST OF CUSTOMERS</h4>

                <div class="user_guide active text-center">
                    <font class="text_tooltip">i</font>
                    <span class="user_guide_tooltip">You can manage the master data of Kabuki's customers here.</span>
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
                        <th style="width: 200px">Customer Code</th>
                        <th>Customer Name</th>
                        <th>Phone Number</th>
                        <th>Address</th>
                        <th style="width: 120px">Status</th>
                        <th style="width: 120px" class="top_right_tableData">Action</th>
                    </tr>
                </thead>
                <tbody></tbody>
                <tfoot>
                    <tr>
                        <th style="width: 50px" class="bottom_left_tableData"></th>
                        <th style="width: 200px">Customer Code</th>
                        <th>Customer Name</th>
                        <th>Phone Number</th>
                        <th>Address</th>
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
                    <h1 class="modal-title fs-5" id="newCreationModalLabel">CREATE NEW CUSTOMER</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row input_modal">
                        <label for="customer_name" class="col-sm-4 col-form-label">Customer Name</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" id="customer_name" placeholder="Enter name">
                        </div>
                    </div>
                    <div class="row input_modal">
                        <label for="no_telp" class="col-sm-4 col-form-label">Phone Number</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" id="no_telp" placeholder="Enter phone number">
                        </div>
                    </div>
                    <div class="row input_modal">
                        <label for="address" class="col-sm-4 col-form-label">Address</label>
                        <div class="col-sm-8">
                            <textarea class="form-control" id="address" cols="30" rows="5" style="resize: none"></textarea>
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
                    <h1 class="modal-title fs-5" id="editModalLabel">EDIT CUSTOMER</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="id" id="customer_id_edit">
                    <div class="row input_modal">
                        <label for="customer_name_edit" class="col-sm-4 col-form-label">Customer Name</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" id="customer_name_edit" placeholder="Enter name">
                        </div>
                    </div>
                    <div class="row input_modal">
                        <label for="no_telp_edit" class="col-sm-4 col-form-label">Phone Number</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" id="no_telp_edit" placeholder="Enter phone number">
                        </div>
                    </div>
                    <div class="row input_modal">
                        <label for="address_edit" class="col-sm-4 col-form-label">Address</label>
                        <div class="col-sm-8">
                            <textarea class="form-control" id="address_edit" cols="30" rows="5" style="resize: none"></textarea>
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
                    url: `{{ route("get-customer-list-datatable") }}`,
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
                        data: 'customer_code',
                        name: 'customer_code',
                    },
                    {
                        data: 'customer_name',
                        name: 'customer_name',
                    },
                    {
                        data: 'no_telp',
                        name: 'no_telp',
                    },
                    {
                        data: 'address',
                        name: 'address',
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

            $("#customer_name").val("");
            $("#no_telp").val("");
            $("#address").val("");

            document.getElementById('status').checked = true;

        });

        // ========================= CLEAR INPUT MODAL =========================
        $(document).on('click', '#button_clear_modal', function(event) {

            $("#customer_name").val("");
            $("#no_telp").val("");
            $("#address").val("");

            document.getElementById('status').checked = true;

        });

        // ========================= SUBMIT NEW DATA =========================
        $(document).on('click', '#button_submit_modal', function(event) {

            var customerName = $("#customer_name").val();
            var noTelp = $("#no_telp").val();
            var address = $("#address").val();
            var status = $("#status:checked").val();

            if ( status == 1 ) {
                var flag = 1;
            } else {
                var flag = 0;
            }

            $.ajax({
                type: 'POST',
                url: "{{ url('/post-new-customer') }}",
                dataType: 'json',
                data: {
                    customerName: customerName,
                    noTelp: noTelp,
                    address: address,
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
                        text: error.responseJSON.message ?? 'Failed submit customer request',
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
                url: "{{ url('/get-old-data-of-customer') }}",
                dataType: 'json',
                data: {
                    customer_id: data_id,
                },
                success: function(response) {

                    $("#customer_id_edit").val(response.id);
                    $("#customer_name_edit").val(response.customer_name);
                    $("#no_telp_edit").val(response.no_telp);
                    $("#address_edit").val(response.address);

                    if ( response.flag == 1 ) {
                        $("#status_edit").attr('checked', true);
                    } else if ( response.flag == 0 ) {
                        $("#status_edit").attr('checked', false);
                    }

                },
                error: function(error) {
                    console.log(error.responseJSON);
                    Swal.fire({
                        icon: 'error',
                        title: "Error",
                        text: error.responseJSON.message ?? 'Failed get list of customer',
                    });
                },
            });

        });

        // ========================= SUBMIT EDIT DATA =========================
        $(document).on('click', '#button_submit_modal_edit', function() {

            var id = $("#customer_id_edit").val();
            var customerName = $("#customer_name_edit").val();
            var noTelp = $("#no_telp_edit").val();
            var address = $("#address_edit").val();
            var status = document.getElementById('status_edit').checked;

            if ( status == 1 ) {
                var flag = 1;
            } else {
                var flag = 0;
            }

            $.ajax({
                type: 'POST',
                url: "{{ url('/post-edit-customer') }}",
                dataType: 'json',
                data: {
                    id_customer: id,
                    customer_name: customerName,
                    no_telp: noTelp,
                    address: address,
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
                        text: error.responseJSON.message ?? 'Failed submit customer request',
                        target: document.getElementById('editModal'),
                    });
                    $("#button_submit_modal_edit").prop('disabled', false);
                },
            });

        });

    </script>

@endsection
