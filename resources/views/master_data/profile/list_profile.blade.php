@extends("inventory.layouts.main")
@section("container")

    <div class="content">

        {{-- TITLE & BUTTON NEW --}}
        <div class="title_n_button">
            <div style="display: flex">
                @if ( $permission_create != null )
                    <a href="/master_data/profile/form">
                        <button class="button_new" id="button_new">
                            <svg xmlns="http://www.w3.org/2000/svg" style="margin-top: -3px" width="20" viewBox="0 0 24 24" stroke-width="3.5" stroke-linejoin="round" stroke-linecap="round" stroke="currentColor" height="20" fill="none" class="svg"><line y2="19" y1="5" x2="12" x1="12"></line><line y2="12" y1="12" x2="19" x1="5"></line></svg>
                            New
                        </button>
                    </a>
                @endif
                <h4 class="title">LIST OF PROFILES</h4>
                <div class="user_guide active text-center">
                    <font class="text_tooltip">i</font>
                    <span class="user_guide_tooltip">You can set access rights for each menu when creating a new profile.</span>
                </div>
            </div>
        </div>

        <hr>

        <div class="container_table">
            <table id="tableData" class="table table-striped table-bordered tableData dataTables_scrollBody">
                <thead>
                    <tr>
                        <th style="width: 50px" class="top_left_tableData">No.</th>
                        <th style="width: 120px">Profile Code</th>
                        <th>Profile Name</th>
                        <th style="width: 120px">Status</th>
                        <th style="width: 120px" class="top_right_tableData">Action</th>
                    </tr>
                </thead>
                <tbody></tbody>
                <tfoot>
                    <tr>
                        <th style="width: 50px" class="bottom_left_tableData"></th>
                        <th style="width: 120px">Profile Code</th>
                        <th>Profile Name</th>
                        <th style="width: 120px">Status</th>
                        <th style="width: 120px" class="bottom_right_tableData"></th>
                    </tr>
                </tfoot>
            </table>
        </div>

    </div>
    <div class="bottom_space"></div>

    {{-- MODAL NEW CREATION --}}
    <div class="modal fade" id="newCreationModal" tabindex="-1" aria-labelledby="newCreationModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content" style="border: 0px;">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="newCreationModalLabel">CREATE NEW PROFILE</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row input_modal">
                        <label for="profile_code" class="col-sm-4 col-form-label">Profile Code</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" id="profile_code">
                        </div>
                    </div>
                    <div class="row input_modal">
                        <label for="profile_name" class="col-sm-4 col-form-label">Profile Name</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" id="profile_name">
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
                    <div class="row input_modal">

                        <div class="container card d-flex justify-content-center" style="border: 0px">

                            <style>
                                /* Warna untuk tab yang aktif */
                                .nav-tabs .nav-link.active {
                                    color: #c6a86e;  /* Biru */
                                    background-color: transparent;  /* Menghilangkan background yang default */
                                    font-weight: 500;
                                }

                                /* Warna untuk tab yang tidak aktif */
                                .nav-tabs .nav-link {
                                    color: #868686;  /* Abu-abu */
                                }

                                /* Menambahkan hover effect untuk tab yang tidak aktif */
                                .nav-tabs .nav-link:hover {
                                    color: #c6a86e;  /* Biru saat hover */
                                }
                            </style>

                            <!-- nav options -->
                            <ul class="nav nav-tabs mb-3" id="tabs-tab" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" id="tabs-home-tab" data-toggle="pill" href="#tabs-home" role="tab" aria-controls="tabs-home" aria-selected="true">Master Data</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="tabs-profile-tab" data-toggle="pill" href="#tabs-profile" role="tab" aria-controls="tabs-profile" aria-selected="false">Receiving</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="tabs-contact-tab" data-toggle="pill" href="#tabs-contact" role="tab" aria-controls="tabs-contact" aria-selected="false">Redeem</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="tabs-contact-tab" data-toggle="pill" href="#tabs-contact" role="tab" aria-controls="tabs-contact" aria-selected="false">Transfer</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="tabs-contact-tab" data-toggle="pill" href="#tabs-contact" role="tab" aria-controls="tabs-contact" aria-selected="false">Stock</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="tabs-contact-tab" data-toggle="pill" href="#tabs-contact" role="tab" aria-controls="tabs-contact" aria-selected="false">Stock Opname</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="tabs-contact-tab" data-toggle="pill" href="#tabs-contact" role="tab" aria-controls="tabs-contact" aria-selected="false">Adjustment</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="tabs-contact-tab" data-toggle="pill" href="#tabs-contact" role="tab" aria-controls="tabs-contact" aria-selected="false">Return</a>
                                </li>
                            </ul>

                            <!-- content -->
                            <div class="tab-content" id="tabs-tabContent p-3">

                                <!-- 1st card -->
                                <div class="tab-pane fade show active" style="margin-left: 10px" id="tabs-home" role="tabpanel" aria-labelledby="tabs-home-tab">

                                    <strong>Master User</strong><br>
                                    <input type="checkbox" name="" id="view_user" style="margin-right: 5px"><label for="view_user">View List of User</label><br>
                                    <input type="checkbox" name="" id="create_user" style="margin-right: 5px"><label for="create_user">Create New User</label><br>
                                    <input type="checkbox" name="" id="edit_user" style="margin-right: 5px"><label for="edit_user">Edit Old User</label><br>
                                    <input type="checkbox" name="" id="reset_pw" style="margin-right: 5px"><label for="reset_pw">Reset Password</label><br><br>

                                    <strong>Master Profile</strong><br>
                                    <input type="checkbox" name="" id="" style="margin-right: 5px">View List of Profile <br>
                                    <input type="checkbox" name="" id="" style="margin-right: 5px">Create New Profile <br>
                                    <input type="checkbox" name="" id="" style="margin-right: 5px">Edit Old Profile <br>

                                </div>

                                <!-- 2nd card -->
                                <div class="tab-pane fade" id="tabs-profile" role="tabpanel" aria-labelledby="tabs-profile-tab">
                                    <div class="form-group addinfo">
                                    <label for="exampleFormControlTextarea1">Write additional info.</label>
                                    <textarea class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
                                    </div>
                                </div>

                                <!-- 3nd card -->
                                <div class="tab-pane fade third" id="tabs-contact" role="tabpanel" aria-labelledby="tabs-contact-tab">
                                    <div class="form">
                                    <div class="form-group">
                                        <label for="exampleFormControlSelect1">Value Type<span>i</span></label>
                                        <select class="form-control round" id="exampleFormControlSelect1">
                                        <option class="">United States Dollar</option>
                                        <option class="amount">Indian Rupees</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label>amount</label>
                                        <input class="form-control amount" placeholder="1500" />
                                    </div>
                                    <button class="btn btn-success">Insert</button>
                                    </div>
                                </div>

                            </div>

                        </div>

                        {{-- <label for="status_edit" class="col-sm-4 col-form-label">Category</label>
                        <div class="col-sm-8">
                            <div style="width: 75px;">
                                <div class="row">
                                    <div class="col-md-4">
                                        <ul id="tree3">
                                            <li>TECH
                                                <ul>
                                                    <li>Company Maintenance</li>
                                                    <li>Employees
                                                        <ul>
                                                            <li>Reports
                                                                <ul>
                                                                    <li>Report1</li>
                                                                    <li>Report2</li>
                                                                    <li>Report3</li>
                                                                </ul>
                                                            </li>
                                                            <li>Employee Maint.</li>
                                                        </ul>
                                                    </li>
                                                    <li>Human Resources</li>
                                                </ul>
                                            </li>
                                            <li>XRP
                                                <ul>
                                                    <li>Company Maintenance</li>
                                                    <li>Employees
                                                        <ul>
                                                            <li>Reports
                                                                <ul>
                                                                    <li> <input type="radio" name="" id="report"> Report1</li>
                                                                    <li> <input type="radio" name="" id="report"> Report2</li>
                                                                    <li> <input type="radio" name="" id="report"> Report3</li>
                                                                </ul>
                                                            </li>
                                                            <li>Employee Maint.</li>
                                                        </ul>
                                                    </li>
                                                    <li>Human Resources</li>
                                                </ul>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div> --}}
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
                    <h1 class="modal-title fs-5" id="editModalLabel">EDIT PROFILE</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row input_modal">
                        <label for="profile_code_edit" class="col-sm-4 col-form-label">Profile Code</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" id="profile_code_edit">
                        </div>
                    </div>
                    <div class="row input_modal">
                        <label for="profile_name_edit" class="col-sm-4 col-form-label">Profile Name</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" id="profile_name_edit">
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

        // ==================== GLOBAL SETUP CSRF ====================
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
                var title = $('#tableData thead th').eq($(this).index()).text();
                if ( i != 0 && i != 4) {
                    $(this).html(
                        '<input type="text" class="input_filter_tableData" placeholder="' + title + '" data-index="' + i + '" style="width: 100%"/>'
                    );
                }

            });

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
                    url: `{{ route("get-profile-list-datatable") }}`,
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
                        data: 'profile_code',
                        name: 'profile_code',
                    },
                    {
                        data: 'profile_name',
                        name: 'profile_name',
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
                    { className: "dt-center", targets: [0,1,3] }
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

            $("#profile_code").val("");
            $("#profile_name").val("");

            document.getElementById('status').checked = true;

        });

        // ========================= CLEAR INPUT MODAL =========================
        $(document).on('click', '#button_clear_modal', function(event) {

            $("#profile_code").val("");
            $("#profile_name").val("");

            document.getElementById('status').checked = true;

        });


    </script>


@endsection
