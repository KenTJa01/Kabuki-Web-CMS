@extends("inventory.layouts.main")
@section("container")

    <div class="content">

        {{-- TITLE & BUTTON NEW --}}
        <div class="title_n_button justify-content-between">
            <div style="display: flex">
                @if ( $permission_create != null )
                    <button class="button_new" id="button_new" data-bs-toggle="modal" data-bs-target="#newCreationModal">
                        <svg xmlns="http://www.w3.org/2000/svg" style="margin-top: -3px" width="20" viewBox="0 0 24 24" stroke-width="3.5" stroke-linejoin="round" stroke-linecap="round" stroke="currentColor" height="20" fill="none" class="svg"><line y2="19" y1="5" x2="12" x1="12"></line><line y2="12" y1="12" x2="19" x1="5"></line></svg>
                        New
                    </button>
                @endif

                <h4 class="title">LIST OF CATEGORIES</h4>

                <div class="user_guide active text-center">
                    <font class="text_tooltip">i</font>
                    <span class="user_guide_tooltip">You can manage the master data of Item's Category here.</span>
                </div>
            </div>
            <div>
                @if ( $permission_export != null )
                    <button class="button_export" id="buttonExport">Export</button>
                @endif
            </div>
        </div>

        <hr>

        <div class="container_table">
            <table id="tableData" class="table table-striped table-bordered tableData dataTables_scrollBody">
                <thead>
                    <tr>
                        <th style="width: 50px" class="top_left_tableData">No.</th>
                        <th style="width: 170px">Category Code</th>
                        <th>Category Name</th>
                        <th>Detail Structure</th>
                        <th style="width: 120px">Status</th>
                        <th style="width: 120px" class="top_right_tableData">Action</th>
                    </tr>
                </thead>
                <tbody></tbody>
                <tfoot>
                    <tr class="tfoot_tableData">
                        <th style="width: 50px" class="bottom_left_tableData"></th>
                        <th style="width: 170px">Category Code</th>
                        <th>Category Name</th>
                        <th>Detail Structure</th>
                        <th style="width: 120px"></th>
                        <th style="width: 120px" class="bottom_right_tableData"></th>
                    </tr>
                </tfoot>
            </table>

            {{-- <div class="row row-cols-5">
                <div class="col mb-4">
                    <div class="card" id="card_category">
                        <div class="card-body">
                            <div class="d-flex justify-content-between">
                                <h4 class="card-title mt-1">Fashion</h4>
                                <button class="button_edit_category">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="white" class="bi bi-pencil-fill" viewBox="0 0 16 16" style="margin-top: -4px">
                                        <path d="M12.854.146a.5.5 0 0 0-.707 0L10.5 1.793 14.207 5.5l1.647-1.646a.5.5 0 0 0 0-.708zm.646 6.061L9.793 2.5 3.293 9H3.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.207zm-7.468 7.468A.5.5 0 0 1 6 13.5V13h-.5a.5.5 0 0 1-.5-.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.5-.5V10h-.5a.5.5 0 0 1-.175-.032l-.179.178a.5.5 0 0 0-.11.168l-2 5a.5.5 0 0 0 .65.65l5-2a.5.5 0 0 0 .168-.11z"/>
                                    </svg>
                                </button>
                            </div>
                            <hr style="color: rgb(153, 153, 153); margin-top: 10px">
                            <p class="card-text d-flex" style="margin: 0px">
                                <div class="tag_category">
                                    <label>Ladies Wear</label>
                                </div>
                                <div class="tag_category">
                                    <label>Baby & Kids</label>
                                </div>
                                <div class="tag_category">
                                    <label>qwertyuoipoopipoi</label>
                                </div>
                                <div class="tag_category">
                                    <label>jashdadhkj</label>
                                </div>
                                <div class="tag_category">
                                    <label>jashdadhkj</label>
                                </div>
                            </p>
                        </div>
                    </div>
                </div>
            </div> --}}
        </div>
    </div>

    <div class="bottom_space"></div>

    {{-- MODAL NEW CREATION --}}
    <div class="modal fade" id="newCreationModal" tabindex="-1" aria-labelledby="newCreationModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content" style="border: 0px;">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="newCreationModalLabel">CREATE NEW CATEGORY</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">

                    <div class="row input_modal">
                        <label for="category_code" class="col-sm-4 col-form-label">Category Type</label>
                        <div class="col-sm-8">
                            <div class="radio_inputs">
                                <label class="radio_inputs_label">
                                    <input type="radio" id="radio_parent" class="radio_category_type" name="radio_category_type" checked="" value="parent">
                                    <span class="name">Parent</span>
                                </label>
                                <label class="radio_inputs_label">
                                    <input type="radio" id="radio_child" class="radio_category_type" name="radio_category_type" value="child">
                                    <span class="name">Child</span>
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="row input_modal d-flex d-none" id="input_parent_category">
                        <label for="select_parent" class="col-sm-4 col-form-label">Parent</label>
                        <div class="col-sm-8">
                            <select name="select_parent" id="select_parent" class="form-select" style="width: 100%;">
                                <option value="" disabled>Select parent</option>
                            </select>
                        </div>
                    </div>
                    <div class="row input_modal">
                        <label for="category_code" class="col-sm-4 col-form-label">Category Code</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" id="category_code" placeholder="Enter category code">
                        </div>
                    </div>
                    <div class="row input_modal">
                        <label for="category_name" class="col-sm-4 col-form-label">Category Name</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" id="category_name" placeholder="Enter name">
                        </div>
                    </div>
                    <div class="row input_modal d-flex" id="input_max_child">
                        <label for="max_child" class="col-sm-4 col-form-label">Max Level</label>
                        <div class="col-sm-8">
                            <input type="number" class="form-control" id="max_child" placeholder="Enter max child" value="4" disabled>
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
                    <h1 class="modal-title fs-5" id="newCreationModalLabel">EDIT CATEGORY</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">

                    <input type="hidden" name="id" id="category_id_edit">
                    <input type="hidden" name="id" id="parent_category_id_edit">

                    <div class="row input_modal">
                        <label for="category_code_edit" class="col-sm-4 col-form-label">Category Code</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" id="category_code_edit">
                        </div>
                    </div>

                    <div class="row input_modal">
                        <label for="category_name_edit" class="col-sm-4 col-form-label">Category Name</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" id="category_name_edit">
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
                    <button type="button" class="button_clear_modal" id="button_clear_modal_edit">Clear</button>
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

            $('#select_parent').select2({
                dropdownParent: $("#newCreationModal"),
                placeholder: {
                    id: '-1',
                    text: 'Select an option'
                },
                multiple: false
            });

            dataTable();
            getListCategory();

        });

        // ========================= DATATABLE =========================
        function dataTable() {

            $('#tableData tfoot th').each(function (i) {
                var header_name = $('#tableData thead th').eq($(this).index()).text();
                var title = header_name.toLowerCase().replace(/\s+/g, "_");
                if ( i != 0 && i != 4 && i != 5 ) {
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
                // fixedHeader: true,
                // columnDefs: [
                //     { targets: 0, visible: true }
                // ],
                // dataSrc: 'list',
                dom: 'lBrtip',
                // deferLoading: 0,
                bRetrieve: true,
                scrollY: "535px",
                scrollCollapse: true,
                orderCellsTop: true,
                ajax: {
                    type: 'GET',
                    url: `{{ route("get-category-list-datatable") }}`,
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
                        data: 'cat_code',
                        name: 'cat_code',
                    },
                    {
                        data: 'cat_name',
                        name: 'cat_name',
                    },
                    {
                        data: 'cat_detail',
                        name: 'cat_detail',
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
                order: [[3, 'asc']],
                columnDefs: [
                    { className: "dt-center", targets: [0,1,4] }
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

        // ========================= GET PARENT CATG =========================
        function getListCategory() {

            $.ajax({
                type: 'GET',
                url: "{{ url('/get-all-data-category') }}",
                dataType: 'json',
                data: {},
                success: function(response) {
                    $.each(response,function(key, value)
                    {
                        $("#select_parent").append('<option value="' + value.id + '">' + value.cat_detail + '</option>');
                    });
                },
                error: function(error) {
                    console.log(error.responseJSON);
                    Swal.fire({
                        icon: 'error',
                        title: "Error",
                        text: error.responseJSON.message ?? 'Failed get list category',
                    });
                },
            });

        }

        $(document).on('change', '.radio_category_type', function(event) {

            var category_type = $(this).val();
            const parentCatg = document.getElementById('input_parent_category');
            const maxChild = document.getElementById('input_max_child');

            if ( category_type == "parent" ) {
                $("#category_code").prop('disabled', false);
                $("#category_code").attr("placeholder", "Enter category code");
                parentCatg.classList.add('d-none');
                maxChild.classList.remove('d-none');


            } else if ( category_type == "child" ) {
                $("#category_code").prop('disabled', true);
                $("#category_code").attr("placeholder", "");
                parentCatg.classList.remove('d-none');
                maxChild.classList.add('d-none');

            }

        });

        $(document).on('change', '#select_parent', function(event) {

            var parent_cat_id = $(this).val();

            $.ajax({
                type: 'GET',
                url: "{{ url('/get-all-data-category') }}",
                dataType: 'json',
                data: {},
                success: function(response) {
                    $.each(response,function(key, value)
                    {
                        if ( value.id == parent_cat_id ) {
                            $('#category_code').val(value.cat_code);
                            $('#category_code').prop('disabled', false);
                        }
                    });
                },
                error: function(error) {
                    console.log(error.responseJSON);
                    Swal.fire({
                        icon: 'error',
                        title: "Error",
                        text: error.responseJSON.message ?? 'Failed get list category',
                    });
                },
            });

        });

        // ========================= CLICK NEW =========================
        $(document).on('click', '#button_new', function(event) {

            $("#category_code").val("");
            $("#category_name").val("");
            $("#select_parent").val("");
            $('#select_parent').trigger("change");
            // $("#level").val("");

            document.getElementById('status').checked = true;

        });

        // ========================= CLEAR INPUT MODAL =========================
        $(document).on('click', '#button_clear_modal', function(event) {

            $("#category_code").val("");
            $("#category_name").val("");
            $("#select_parent").val("");
            $('#select_parent').trigger("change");
            // $("#level").val("");

            document.getElementById('status').checked = true;

        });

        // ========================= SUBMIT NEW DATA =========================
        $(document).on('click', '#button_submit_modal', function(event) {

            var parentType = $('input[name="radio_category_type"]:checked').val();
            var catCode = $("#category_code").val();
            var catName = $("#category_name").val();
            var parentCat = $("#select_parent").val();
            var maxChild = $("#max_child").val();
            var status = $("#status:checked").val();

            if ( parentType == "parent" ) {
                var type = 1;
            } else if ( parentType == "child" ) {
                var type = 0;
            }

            if ( status == 1 ) {
                var flag = 1;
            } else {
                var flag = 0;
            }

            $.ajax({
                type: 'POST',
                url: "{{ url('/post-new-category') }}",
                dataType: 'json',
                data: {
                    type: type,
                    catCode: catCode,
                    catName: catName,
                    parentCat: parentCat,
                    maxChild: maxChild,
                    status: flag,
                },
                success: function(response) {

                    // window.dialog_add.close();
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
                        text: error.responseJSON.message ?? 'Failed submit category request',
                        target: document.getElementById('newCreationModal'),
                    });
                    $("#button_submit").prop('disabled', false);
                },
            });

        });

        // ========================= CLICK BUTTON EDIT =========================
        $(document).on('click', '#button_edit_modal', function() {

            $('#select_parent_edit').select2({
                dropdownParent: $("#editModal"),
                placeholder: {
                    id: '-1',
                    text: 'Select an option'
                },
                multiple: false
            });

            const data_id = $(this).data('id');

            $.ajax({
                type: 'GET',
                url: "{{ url('/get-old-data-of-category') }}",
                dataType: 'json',
                data: {
                    category_id: data_id,
                },
                success: function(response) {

                    $("#category_id_edit").val(response.id);
                    $("#category_code_edit").val(response.cat_code);
                    $("#category_name_edit").val(response.cat_name);
                    // $("#max_child_edit").val(response.max_child);
                    $("#parent_category_id_edit").val(response.parent_cat_id);

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
                        text: error.responseJSON.message ?? 'Failed get list of category',
                    });
                },
            });

        });

        // ========================= SUBMIT EDIT DATA =========================
        $(document).on('click', '#button_submit_modal_edit', function(event) {

            var id = $("#category_id_edit").val();
            var catCode = $('#category_code_edit').val();
            var catName = $("#category_name_edit").val();
            var status = $("#status_edit:checked").val();

            if ( status == 1 ) {
                var flag = 1;
            } else {
                var flag = 0;
            }

            $.ajax({
                type: 'POST',
                url: "{{ url('/post-edit-category') }}",
                dataType: 'json',
                data: {
                    id_cat: id,
                    catCode: catCode,
                    catName: catName,
                    status: flag,
                },
                success: function(response) {
                    // console.log(response);
                    // return;

                    // window.dialog_add.close();
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
                        text: error.responseJSON.message ?? 'Failed submit category request',
                        target: document.getElementById('editModal'),
                    });
                    $("#button_submit_edit").prop('disabled', false);
                },
            });

        });

        $('#buttonExport').on('click', function() {
            var category_code = $('#category_code_filter').val();
            var category_name = $('#category_name_filter').val();
            var detail_structure = $('#detail_structure_filter').val();
            // var status = $('#status').val();

            // Create a form and submit it to download the file
            var form = $('<form>', {
                'action': "{{ url('/export-excel-list-category') }}",
                'method': 'GET',
            });

            // Add CSRF Token
            var csrfToken = $('meta[name="csrf-token"]').attr('content');
            form.append($('<input>', { 'type': 'hidden', 'name': '_token', 'value': csrfToken }));

            // Append the data
            form.append($('<input>', { 'type': 'hidden', 'name': 'category_code', 'value': category_code }));
            form.append($('<input>', { 'type': 'hidden', 'name': 'category_name', 'value': category_name }));
            form.append($('<input>', { 'type': 'hidden', 'name': 'detail_structure', 'value': detail_structure }));
            // form.append($('<input>', { 'type': 'hidden', 'name': 'status', 'value': status }));

            // Append the form to the body and submit
            $('body').append(form);
            form.submit();
            form.remove();

        });


    </script>


@endsection
