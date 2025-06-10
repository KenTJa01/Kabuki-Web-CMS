@extends("layouts.main")
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

                <h4 class="title">LIST OF EXPENSES</h4>

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
                        <th style="width: 150px">Expense No.</th>
                        <th>Date</th>
                        <th>Expense Type</th>
                        <th>Amount</th>
                        <th>Description</th>
                        <th style="width: 120px" class="top_right_tableData">Action</th>
                    </tr>
                </thead>
                <tbody></tbody>
                <tfoot>
                    <tr>
                        <th style="width: 50px" class="bottom_left_tableData"></th>
                        <th style="width: 150px">Expense No.</th>
                        <th>Date</th>
                        <th>Expense Type</th>
                        <th>Amount</th>
                        <th>Description</th>
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
                    <h1 class="modal-title fs-5" id="newCreationModalLabel">CREATE NEW EXPENSE</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row input_modal">
                        <label for="expense_date" class="col-sm-4 col-form-label">Expense Date</label>
                        <div class="col-sm-8">
                            <input type="date" class="form-control" id="expense_date">
                        </div>
                    </div>
                    <div class="row input_modal">
                        <label for="select_expense_type" class="col-sm-4 col-form-label">Expense Type</label>
                        <div class="col-sm-8">
                            <select name="select_expense_type" id="select_expense_type" class="form-select" style="width: 100%;">
                                <option value="" readonly>Select expense type</option>
                            </select>
                        </div>
                    </div>
                    <div class="row input_modal">
                        <label for="amount" class="col-sm-4 col-form-label">Amount</label>
                        <div class="col-sm-8">
                            <input type="number" class="form-control" id="amount" placeholder="Enter amount">
                        </div>
                    </div>
                    <div class="row input_modal">
                        <label for="description" class="col-sm-4 col-form-label">Description</label>
                        <div class="col-sm-8">
                            <textarea class="form-control" id="description" cols="30" rows="5" style="resize: none;"></textarea>
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
                    <h1 class="modal-title fs-5" id="editModalLabel">EDIT EXPENSE</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="id" id="expense_id_edit">
                    <div class="row input_modal">
                        <label for="expense_date_edit" class="col-sm-4 col-form-label">Expense Date</label>
                        <div class="col-sm-8">
                            <input type="date" class="form-control" id="expense_date_edit">
                        </div>
                    </div>
                    <div class="row input_modal">
                        <label for="select_expense_type_edit" class="col-sm-4 col-form-label">Expense Type</label>
                        <div class="col-sm-8">
                            <select name="select_expense_type_edit" id="select_expense_type_edit" class="form-select" style="width: 100%;">
                                <option value="" readonly>Select expense type</option>
                            </select>
                        </div>
                    </div>
                    <div class="row input_modal">
                        <label for="amount_edit" class="col-sm-4 col-form-label">Amount</label>
                        <div class="col-sm-8">
                            <input type="number" class="form-control" id="amount_edit" placeholder="Enter amount">
                        </div>
                    </div>
                    <div class="row input_modal">
                        <label for="description_edit" class="col-sm-4 col-form-label">Description</label>
                        <div class="col-sm-8">
                            <textarea class="form-control" id="description_edit" cols="30" rows="5" style="resize: none;"></textarea>
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

            $('#select_expense_type').select2({
                dropdownParent: $("#newCreationModal"),
                placeholder: {
                    id: '-1',
                    text: 'Select expense type'
                },
                multiple: false
            });

            $('#select_expense_type_edit').select2({
                dropdownParent: $("#editModal"),
                placeholder: {
                    id: '-1',
                    text: 'Select expense type'
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
                    url: `{{ route("get-expense-list-datatable") }}`,
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
                        data: 'expense_no',
                        name: 'expense_no',
                    },
                    {
                        data: 'expense_date',
                        name: 'expense_date',
                    },
                    {
                        data: 'expense_name',
                        name: 'expense_name',
                    },
                    {
                        data: 'amount',
                        name: 'amount',
                    },
                    {
                        data: 'description',
                        name: 'description',
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

            $("#expense_date").val("");
            $("#amount").val("");
            $("#description").val("");
            $("#select_expense_type").val("");
            $('#select_expense_type').trigger("change");

            getAllDataExpenseType();

        });

        // ========================= CLEAR INPUT MODAL =========================
        $(document).on('click', '#button_clear_modal', function(event) {

            $("#expense_date").val("");
            $("#amount").val("");
            $("#description").val("");
            $("#select_expense_type").val("");
            $('#select_expense_type').trigger("change");


        });

        // ========================= GET ALL DATA EXPENSE TYPE =========================
        function getAllDataExpenseType() {

            $("#select_expense_type").html('<option value="">Select expense type</option>');

            $.ajax({
                type: 'GET',
                url: "{{ url('/get-all-data-expense-type') }}",
                dataType: 'json',
                data: {},
                success: function(response) {
                    $.each(response,function(key, value)
                    {
                        $("#select_expense_type").append('<option value="' + value.id + '">' + value.expense_name + '</option>');
                    });
                },
                error: function(error) {
                    console.log(error.responseJSON);
                    Swal.fire({
                        icon: 'error',
                        title: "Error",
                        text: error.responseJSON.message ?? 'Failed get list of expense type',
                    });
                },
            });

        }

        // ========================= SUBMIT NEW DATA =========================
        $(document).on('click', '#button_submit_modal', function(event) {

            var expense_date = $("#expense_date").val();
            var amount = $("#amount").val();
            var description = $("#description").val();
            var expense_type = $("#select_expense_type").val();

            $.ajax({
                type: 'POST',
                url: "{{ url('/post-new-finance-expense') }}",
                dataType: 'json',
                data: {
                    expense_date: expense_date,
                    expense_type: expense_type,
                    amount: amount,
                    description: description,
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

                    Swal.fire({
                        icon: 'error',
                        title: "Error",
                        text: error.responseJSON.message ?? 'Failed submit user request',
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
                url: "{{ url('/get-old-data-of-expense') }}",
                dataType: 'json',
                data: {
                    expense_id: data_id,
                },
                success: function(response) {

                    $("#expense_id_edit").val(response.id);
                    $("#expense_date_edit").val(response.expense_date);
                    $("#amount_edit").val(response.amount);
                    $("#description_edit").val(response.description);

                    getExpenseTypeById(response.expense_type_id);

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

        function getExpenseTypeById(expense_type_id){

            $("#select_expense_type_edit").html('<option value="">Select expense</option>');

            $.ajax({
                type: 'GET',
                url: "{{ url('/get-all-data-expense-type') }}",
                dataType: 'json',
                data: {},
                success: function(response) {
                    $.each(response,function(key, value)
                    {
                        if ( value.id == expense_type_id ) {
                            $("#select_expense_type_edit").append('<option value="' + value.id + '" selected>' + value.expense_name + '</option>');
                        } else {
                            $("#select_expense_type_edit").append('<option value="' + value.id + '">' + value.expense_name + '</option>');
                        }
                    });
                },
                error: function(error) {
                    console.log(error.responseJSON);
                    Swal.fire({
                        icon: 'error',
                        title: "Error",
                        text: error.responseJSON.message ?? 'Failed get list of expense',
                    });
                },
            });

        }

        // ========================= SUBMIT EDIT DATA =========================
        $(document).on('click', '#button_submit_modal_edit', function() {

            var id = $("#expense_id_edit").val();
            var expense_date = $("#expense_date_edit").val();
            var amount = $("#amount_edit").val();
            var description = $("#description_edit").val();
            var expense_type = $("#select_expense_type_edit").val();

            $.ajax({
                type: 'POST',
                url: "{{ url('/post-edit-finance-expense') }}",
                dataType: 'json',
                data: {
                    id_expense: id,
                    expense_date: expense_date,
                    amount: amount,
                    description: description,
                    expense_type: expense_type
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
                        text: error.responseJSON.message ?? 'Failed submit finance expense request',
                        target: document.getElementById('editModal'),
                    });
                    $("#button_submit_modal_edit").prop('disabled', false);
                },
            });

        });

    </script>

@endsection
