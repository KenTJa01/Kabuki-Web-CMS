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

                <h4 class="title">LIST OF SUPPLIERS</h4>

                <div class="user_guide active text-center">
                    <font class="text_tooltip">i</font>
                    <span class="user_guide_tooltip">You can manage the master data of Supplier here.</span>
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
                        <th style="width: 170px">Supplier Code</th>
                        <th>Supplier Name</th>
                        <th>Phone Number</th>
                        <th>City</th>
                        <th style="width: 120px">Status</th>
                        <th style="width: 120px" class="top_right_tableData">Action</th>
                    </tr>
                </thead>
                <tbody></tbody>
                <tfoot>
                    <tr>
                        <th style="width: 50px" class="bottom_left_tableData"></th>
                        <th style="width: 170px">Supplier Code</th>
                        <th>Supplier Name</th>
                        <th>Phone Number</th>
                        <th>City</th>
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
                    <h1 class="modal-title fs-5" id="newCreationModalLabel">CREATE NEW SUPPLIER</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row input_modal">
                        <label for="supplier_code" class="col-sm-4 col-form-label">Supplier Code</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" id="supplier_code"
                                @if($lastData == null)
                                    placeholder="Enter code"
                                @else
                                    placeholder="Latest code {{ $lastData->supp_code }}"
                                @endif
                            >
                        </div>
                    </div>
                    <div class="row input_modal">
                        <label for="supplier_name" class="col-sm-4 col-form-label">Supplier Name</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" id="supplier_name" placeholder="Enter name">
                        </div>
                    </div>
                    <div class="row input_modal">
                        <label for="phone_number" class="col-sm-4 col-form-label">Phone Number</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" id="phone_number" placeholder="Enter phone number">
                        </div>
                    </div>
                    <div class="row input_modal">
                        <label for="address" class="col-sm-4 col-form-label">Address</label>
                        <div class="col-sm-8">
                            <textarea class="form-control" id="address" cols="20" rows="5" style="resize: none;"></textarea>
                        </div>
                    </div>
                    <div class="row input_modal">
                        <label for="select_city" class="col-sm-4 col-form-label">City</label>
                        <div class="col-sm-8">
                            {{-- <select class="form-select" id="select_city">
                                <option value="">Select city</option>
                            </select> --}}
                            @php
                                $cities = new App\Http\Controllers\DependantDropdownController;
                                $cities= $cities->cities();
                            @endphp
                            <select class="form-control" name="provinsi" id="select_city" style="width: 100%">
                                <option value="">Select city</option>
                                @foreach ($cities as $item)
                                    <option value="{{ $item->id ?? '' }}" name="{{ $item->name ?? '' }}">{{ $item->name ?? '' }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="row input_modal">
                        <label for="select_district" class="col-sm-4 col-form-label">District</label>
                        <div class="col-sm-8">
                            <select class="form-select" id="select_district" style="width: 100%" disabled>
                                <option value="">Select district</option>
                            </select>
                        </div>
                    </div>
                    <div class="row input_modal">
                        <label for="select_sub_district" class="col-sm-4 col-form-label">Sub District</label>
                        <div class="col-sm-8">
                            <select class="form-select" id="select_sub_district" style="width: 100%" disabled>
                                <option value="">Select sub district</option>
                            </select>
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
                    {{-- <hr>
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
                    </div> --}}
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
                    <h1 class="modal-title fs-5" id="editModalLabel">EDIT SUPPLIER</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="id" id="supplier_id_edit">
                    <div class="row input_modal">
                        <label for="supplier_code_edit" class="col-sm-4 col-form-label">Supplier Code</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" id="supplier_code_edit" disabled>
                        </div>
                    </div>
                    <div class="row input_modal">
                        <label for="supplier_name_edit" class="col-sm-4 col-form-label">Supplier Name</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" id="supplier_name_edit">
                        </div>
                    </div>
                    <div class="row input_modal">
                        <label for="phone_number_edit" class="col-sm-4 col-form-label">Phone Number</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" id="phone_number_edit" placeholder="Enter phone number">
                        </div>
                    </div>
                    <div class="row input_modal">
                        <label for="address_edit" class="col-sm-4 col-form-label">Address</label>
                        <div class="col-sm-8">
                            <textarea class="form-control" id="address_edit" cols="20" rows="5" style="resize: none;"></textarea>
                        </div>
                    </div>
                    <div class="row input_modal">
                        <label for="select_city_edit" class="col-sm-4 col-form-label">City</label>
                        <div class="col-sm-8">
                            {{-- <select class="form-select" id="select_city_edit">
                                <option value="">Select city</option>
                            </select> --}}
                            @php
                                $cities = new App\Http\Controllers\DependantDropdownController;
                                $cities= $cities->cities();
                            @endphp
                            <select class="form-control" name="provinsi" id="select_city_edit" style="width: 100%">
                                <option value="">Select city</option>
                                @foreach ($cities as $item)
                                    <option value="{{ $item->id ?? '' }}">{{ $item->name ?? '' }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="row input_modal">
                        <label for="select_district_edit" class="col-sm-4 col-form-label">District</label>
                        <div class="col-sm-8">
                            <select class="form-select" id="select_district_edit" style="width: 100%">
                                <option value="">Select district</option>
                            </select>
                        </div>
                    </div>
                    <div class="row input_modal">
                        <label for="select_sub_district_edit" class="col-sm-4 col-form-label">Sub District</label>
                        <div class="col-sm-8">
                            <select class="form-select" id="select_sub_district_edit" style="width: 100%">
                                <option value="">Select sub district</option>
                            </select>
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
                    {{-- <hr>
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
                    </div> --}}
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

            $('#select_city').select2({
                dropdownParent: $("#newCreationModal"),
                placeholder: {
                    id: '-1',
                    text: 'Select an option'
                },
                multiple: false
            });

            $('#select_district').select2({
                dropdownParent: $("#newCreationModal"),
                placeholder: {
                    id: '-1',
                    text: 'Select an option'
                },
                multiple: false
            });

            $('#select_sub_district').select2({
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
                if ( i != 0 && i != 5 && i != 6) {
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
                    url: `{{ route("get-supplier-list-datatable") }}`,
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
                        data: 'supp_code',
                        name: 'supp_code',
                    },
                    {
                        data: 'supp_name',
                        name: 'supp_name',
                    },
                    {
                        data: 'phone_number',
                        name: 'phone_number',
                    },
                    {
                        data: 'city',
                        name: 'city',
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
                    { className: "dt-center", targets: [0,1,2,3,4,5] }
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

        // ========================= CLICK BUTTON NEW =========================
        $(document).on('click', '#button_new', function(event) {

            $("#supplier_code").val("");
            $("#supplier_name").val("");
            $(".form-check-input").prop("checked", false);

            document.getElementById('status').checked = true;

            // if ($.fn.dataTable.isDataTable('#table_item')) {
            //     $('#table_item').DataTable().destroy();
            // }

            // dataTableCreate();

        });


        function onChangeSelect(url, id, name, placeholder) {

            $.ajax({
                url: url,
                type: 'GET',
                data: {
                id: id
                },
                success: function (data) {
                    $('#' + name).empty();
                    $('#' + name).append('<option>Select ' + placeholder + '</option>');
                    $.each(data, function (key, value) {
                        $('#' + name).append('<option value="' + key + '" name="' + value + '">' + value + '</option>');
                    });
                }
            });

        };

        var tampungCityNew = "";
        var tampungDistrictNew = "";
        var tampungSubDistrictNew = "";

        $(document).on('change', '#select_city', function(event) {
            $("#select_district").attr('disabled', false);

            var selectedCity = document.getElementById('select_city');
            var optionCity = selectedCity.options[selectedCity.selectedIndex];
            tampungCityNew = optionCity.getAttribute('name');

            onChangeSelect('{{ route("districts") }}', $(this).val(), 'select_district', 'district');
        });

        $(document).on('change', '#select_district', function(event) {
            $("#select_sub_district").attr('disabled', false);

            var selectedDistrict = document.getElementById('select_district');
            var optionDistrict = selectedDistrict.options[selectedDistrict.selectedIndex];
            tampungDistrictNew = optionDistrict.getAttribute('name');

            onChangeSelect('{{ route("villages") }}', $(this).val(), 'select_sub_district', 'sub district');
        })

        $(document).on('change', '#select_sub_district', function(event) {

            var selectedSubDistrict = document.getElementById('select_sub_district');
            var optionSubDistrict = selectedSubDistrict.options[selectedSubDistrict.selectedIndex];
            tampungSubDistrictNew = optionSubDistrict.getAttribute('name');

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
                    url: `{{ route("get-all-data-item-in-supplier") }}`,
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

        // ========================= CLICK BUTTON CLEAR =========================
        $(document).on('click', '#button_clear_modal', function(event){

            $("#supplier_code").val("");
            $("#supplier_name").val("");
            $(".form-check-input").prop("checked", false);

            document.getElementById('status').checked = true;

        });

        // ========================= SUBMIT NEW DATA =========================
        $(document).on('click', '#button_submit_modal', function(event) {

            var suppCode = $("#supplier_code").val();
            var suppName = $("#supplier_name").val();
            var phoneNumber = $("#phone_number").val();
            var address = $("#address").val();
            var city_code = $("#select_city").val();
            var city = tampungCityNew;
            var district_code = $("#select_district").val();
            var district = tampungDistrictNew;
            var subDistrict_code = $("#select_sub_district").val();
            var subDistrict = tampungSubDistrictNew;
            var status = $('#status:checked').val();

            if ( status == 1 ) {
                var flag = 1;
            } else {
                var flag = 0;
            }

            // const dataItem = [];

            // $("#table_item").DataTable().$('input.checkbox_item:checked').each(function() {
            //     dataItem.push($(this).val());
            // });

            $.ajax({
                type: 'POST',
                url: "{{ url('/post-new-supplier') }}",
                dataType: 'json',
                data: {
                    suppCode: suppCode,
                    suppName: suppName,
                    phoneNumber: phoneNumber,
                    address: address,
                    city_code: city_code,
                    city: city,
                    district_code: district_code,
                    district: district,
                    subDistrict_code: subDistrict_code,
                    subDistrict: subDistrict,
                    status: flag,
                    // dataItem: dataItem,
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
                        text: error.responseJSON.message ?? 'Failed submit supplier request',
                        target: document.getElementById('newCreationModal'),
                    });
                    $("#button_submit_modal").prop('disabled', false);
                },
            });

        });

        var tampungCityEdit = "";
        var tampungDistrictEdit = "";
        var tampungSubDistrictEdit = "";

        // ========================= CLICK BUTTON EDIT =========================
        $(document).on('click', '#button_edit_modal', function(event){

            $('#select_city_edit').select2({
                dropdownParent: $("#editModal"),
                placeholder: {
                    id: '-1',
                    text: 'Select an option'
                },
                multiple: false
            });

            $('#select_district_edit').select2({
                dropdownParent: $("#editModal"),
                placeholder: {
                    id: '-1',
                    text: 'Select an option'
                },
                multiple: false
            });

            $('#select_sub_district_edit').select2({
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
                url: "{{ url('/get-old-data-of-supplier') }}",
                dataType: 'json',
                data: {
                    supplier_id: data_id,
                },
                success: function(response) {

                    $("#supplier_id_edit").val(response.supplier_data.id);
                    $("#supplier_code_edit").val(response.supplier_data.supp_code);
                    $("#supplier_name_edit").val(response.supplier_data.supp_name);
                    $("#phone_number_edit").val(response.supplier_data.phone_number);
                    $("#address_edit").val(response.supplier_data.address);

                    if ( response.supplier_data.flag == 1 ) {
                        $("#status_edit").attr('checked', true);
                    } else if ( response.supplier_data.flag == 0 ) {
                        $("#status_edit").attr('checked', false);
                    }

                    // if ($.fn.dataTable.isDataTable('#table_item_edit')) {
                    //     $('#table_item_edit').DataTable().destroy();
                    // }

                    // dataTableEdit();

                    // getItemBySupplierId(response.supplier_item_data);

                    tampungCityEdit = response.supplier_data.city;
                    tampungDistrictEdit = response.supplier_data.district;
                    tampungSubDistrictEdit = response.supplier_data.sub_district;

                    onChangeSelectCityEdit('{{ route("cities") }}', response.supplier_data.city_code, 'select_city_edit', 'city');
                    onChangeSelectEdit('{{ route("districts") }}', response.supplier_data.city_code, response.supplier_data.district_code, 'select_district_edit', 'district');
                    onChangeSelectEdit('{{ route("villages") }}', response.supplier_data.district_code, response.supplier_data.sub_district_code, 'select_sub_district_edit', 'sub district');

                },
                error: function(error) {
                    console.log(error.responseJSON);
                    Swal.fire({
                        icon: 'error',
                        title: "Error",
                        text: error.responseJSON.message ?? 'Failed get list of supplier',
                    });
                },
            });

        });

        function onChangeSelectCityEdit(url, city_code, name, placeholder) {

            $.ajax({
                url: url,
                type: 'GET',
                data: {
                },
                success: function (data) {
                    $('#' + name).empty();
                    $('#' + name).append('<option>Select ' + placeholder + '</option>');
                    $.each(data, function (key, value) {
                        if (value.id == city_code) {
                            $('#' + name).append('<option value="' + value.id + '" name="' + value.name + '" selected>' + value.name + '</option>');
                        } else {
                            $('#' + name).append('<option value="' + value.id + '" name="' + value.name + '">' + value.name + '</option>');
                        }
                    });
                }
            });

        };

        function onChangeSelectEdit(url, id, old_id, name, placeholder) {

            $.ajax({
                url: url,
                type: 'GET',
                data: {
                id: id
                },
                success: function (data) {
                    $('#' + name).empty();
                    $('#' + name).append('<option>Select ' + placeholder + '</option>');
                    $.each(data, function (key, value) {
                        console.log(old_id);

                        if (key == old_id) {
                            $('#' + name).append('<option value="' + key + '" name="' + value + '" selected>' + value + '</option>');
                        } else {
                            $('#' + name).append('<option value="' + key + '" name="' + value + '">' + value + '</option>');
                        }
                    });
                }
            });

        };

        $(document).on('change', '#select_city_edit', function(event) {
            $("#select_district_edit").attr('disabled', false);

            var selectedCity = document.getElementById('select_city_edit');
            var optionCity = selectedCity.options[selectedCity.selectedIndex];
            tampungCityEdit = optionCity.getAttribute('name');

            onChangeSelect('{{ route("districts") }}', $(this).val(), 'select_district_edit', 'district');
        });

        $(document).on('change', '#select_district_edit', function(event) {
            $("#select_sub_district_edit").attr('disabled', false);

            var selectedDistrict = document.getElementById('select_district_edit');
            var optionDistrict = selectedDistrict.options[selectedDistrict.selectedIndex];
            tampungDistrictEdit = optionDistrict.getAttribute('name');

            onChangeSelect('{{ route("villages") }}', $(this).val(), 'select_sub_district_edit', 'sub district');
        });

        $(document).on('change', '#select_sub_district_edit', function(event) {

            var selectedSubDistrict = document.getElementById('select_sub_district_edit');
            var optionSubDistrict = selectedSubDistrict.options[selectedSubDistrict.selectedIndex];
            tampungSubDistrictEdit = optionSubDistrict.getAttribute('name');

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
                    url: `{{ route("get-all-data-item-in-supplier") }}`,
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

        function getItemBySupplierId(data) {

            $.ajax({
                type: 'GET',
                url: "{{ url('/get-all-data-item') }}",
                dataType: 'json',
                data: {
                    supplier_id: data,
                },
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
                console.log("#" + data[i] +"_edit");

                var check = $('#'+data[i]+'_edit');
                check.prop('checked', true);
            }

        }

        // ========================= SUBMIT EDIT DATA =========================
        $(document).on('click', '#button_submit_modal_edit', function(event) {

            var id = $("#supplier_id_edit").val();
            var name = $("#supplier_name_edit").val();
            var status = document.getElementById('status_edit').checked;
            var phoneNumber = $("#phone_number_edit").val();
            var address = $("#address_edit").val();
            var city_code = $("#select_city_edit").val();
            var city = tampungCityEdit;
            var district_code = $("#select_district_edit").val();
            var district = tampungDistrictEdit;
            var subDistrict_code = $("#select_sub_district_edit").val();
            var subDistrict = tampungSubDistrictEdit;

            if ( status == 1 ) {
                var flag = 1;
            } else {
                var flag = 0;
            }

            // const dataItem = [];

            // $("#table_item_edit").DataTable().$('input.checkbox_item_edit:checked').each(function() {
            //     dataItem.push($(this).val());
            // });

            $.ajax({
                type: 'POST',
                url: "{{ url('/post-edit-supplier') }}",
                dataType: 'json',
                data: {
                    id_supplier: id,
                    name: name,
                    phoneNumber: phoneNumber,
                    address: address,
                    city_code: city_code,
                    city: city,
                    district_code: district_code,
                    district: district,
                    subDistrict_code: subDistrict_code,
                    subDistrict: subDistrict,
                    status: flag,
                    // dataItem: dataItem,
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
                        text: error.responseJSON.message ?? 'Failed submit supplier request',
                        target: document.getElementById('editModal'),
                    });
                    $("#button_submit_modal_edit").prop('disabled', false);
                },
            });

        });

        $('#buttonExport').on('click', function() {

            var supplier_code = $('#supplier_code_filter').val();
            var supplier_name = $('#supplier_name_filter').val();
            // var status = $('#status').val();

            // Create a form and submit it to download the file
            var form = $('<form>', {
                'action': "{{ url('/export-excel-list-supplier') }}",
                'method': 'GET',
            });

            // Add CSRF Token
            var csrfToken = $('meta[name="csrf-token"]').attr('content');
            form.append($('<input>', { 'type': 'hidden', 'name': '_token', 'value': csrfToken }));

            // Append the data
            form.append($('<input>', { 'type': 'hidden', 'name': 'supplier_code', 'value': supplier_code }));
            form.append($('<input>', { 'type': 'hidden', 'name': 'supplier_name', 'value': supplier_name }));
            // form.append($('<input>', { 'type': 'hidden', 'name': 'status', 'value': status }));

            // Append the form to the body and submit
            $('body').append(form);
            form.submit();
            form.remove();

        });

    </script>


@endsection
