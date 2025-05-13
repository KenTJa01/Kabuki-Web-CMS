@extends("inventory.layouts.main")
@section("container")

    <style>
        #profile_code::placeholder, #profile_name::placeholder {
            color: rgb(173, 173, 173);
            font-weight: 300;
        }

        table thead th, td {
            padding: 0;
        }
    </style>

    <div class="content">

        {{-- TITLE & BUTTON NEW --}}
        <div class="title_n_button">
            <h4 class="title" style="margin-left: 0px">FORM OF PROFILES</h4>
        </div>

        <hr>

        <div style="margin-top: 20px; padding: 0px 10px">
            <table style="width: 100%;">
                <tr>
                    {{-- PROFILE CODE --}}
                    <td class="label_form">Profile Code</td>
                    <td class="container_input_form" style="margin: 0; padding: 0;">
                        <input type="text" class="form-control input_form" id="profile_code"
                            @if($lastData == null)
                                placeholder="Enter code"
                            @else
                                placeholder="Latest code {{ $lastData->profile_code }}"
                            @endif
                        >
                    </td>

                    {{-- VERTICAL LINE --}}
                    <td style="width: 4%" rowspan="2">
                        <hr class="vertical_line_two_row">
                    </td>

                    {{-- PROFILE NAME --}}
                    <td class="label_form">Profile Name</td>
                    <td class="container_input_form" style="margin: 0; padding: 0;">
                        <input type="text" class="form-control input_form" id="profile_name" placeholder="Enter name">
                    </td>
                </tr>
                <tr>
                    {{-- STATUS --}}
                    <td class="label_form" for="status">Status</td>
                    <td class="container_input_form" style="margin: 0; padding: 0;">
                        <div style="width: 75px;">
                            <div class="container_toggle">
                                <input type="checkbox" class="checkbox" id="status" value="1" checked>
                                <label class="switch" for="status">
                                    <span class="slider"></span>
                                </label>
                            </div>
                        </div>
                    </td>
                    <td></td>
                    <td class="container_input_form" style="margin: 0; padding: 0;">
                        <button class="button_submit_form_profile" id="button_submit" style="border-radius:7px">Submit</button>
                    </td>
                </tr>
            </table>

            {{-- <hr> --}}

            <div class="row input_modal" style="margin-top: 50px">

                <div class="container card d-flex justify-content-center" style="border: 0px">

                    <style>
                        /* Warna untuk tab yang aktif */
                        .nav-underline .nav-link.active {
                            color: #c6a86e;  /* Biru */
                            background-color: transparent;  /* Menghilangkan background yang default */
                            font-weight: 500;
                        }

                        /* Warna untuk tab yang tidak aktif */
                        .nav-underline .nav-link {
                            color: #868686;  /* Abu-abu */
                        }

                        /* Menambahkan hover effect untuk tab yang tidak aktif */
                        .nav-underline .nav-link:hover {
                            color: #c6a86e;  /* Biru saat hover */
                        }

                        .nav-item {
                            margin-right: 20px;
                        }

                        .nav-underline .nav-link.active {
                            border-bottom: 3px solid #c6a86e; /* Ukuran dan warna underline */
                        }

                        /* Anda juga bisa mengubah efek hover atau state lainnya */
                        .nav-underline .nav-link {
                            border-bottom: 3px solid transparent; /* Garis bawah default yang transparan */
                        }

                        .nav-underline .nav-link:hover {
                            border-bottom: 3px solid #c6a86e; /* Warna underline saat hover */
                        }

                    </style>

                    <!-- nav options -->
                    <ul class="nav nav-underline" id="tabs-tab" role="tablist">
                        {{-- isinya di javascript --}}
                    </ul>

                    <hr style="margin-top: 0px; color: rgb(189, 189, 189);">

                    <!-- content -->
                    <div class="tab-content" id="tabs-tabContent" style="padding: 5px 10px;">
                        {{-- isinya di javascript --}}
                    </div>

                </div>

            </div>
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

            getMenu();

        });

        function getMenu() {
            $.ajax({
                type: 'GET',
                url: "{{ url('/get-all-data-menu') }}",
                dataType: 'json',
                data: {},
                success: function(response) {

                    $.each(response,function(key, value)
                    {
                        var formattedMenuName = value.menu_name.toLowerCase().replace(/\s+/g, '-');

                        if ( key == 0 ) {
                            $("#tabs-tab").append('<li class="nav-item"><a class="nav-link active" id="tabs-'+ formattedMenuName +'-tab" data-toggle="pill" href="#tabs-'+ formattedMenuName +'" role="tab" aria-controls="tabs-'+ value.menu_name +'" aria-selected="true">' + value.menu_name + '</a></li>');

                            var tabContent = document.createElement('div');
                            tabContent.setAttribute('class', 'tab-pane show active');
                            tabContent.setAttribute('id', 'tabs-' + formattedMenuName);
                            tabContent.setAttribute('role', 'tabpanel');
                            tabContent.setAttribute('aria-labelledby', 'tabs-' + formattedMenuName + '-tab');
                            $("#tabs-tabContent").append(tabContent);

                            getSubmenuOnlyMasterDataChild();

                        } else {
                            $("#tabs-tab").append('<li class="nav-item"><a class="nav-link" id="tabs-'+ formattedMenuName +'-tab" data-toggle="pill" href="#tabs-'+ formattedMenuName +'" role="tab" aria-controls="tabs-'+ value.menu_name +'" aria-selected="true">' + value.menu_name + '</a></li>');

                            var tabContent = document.createElement('div');
                            tabContent.setAttribute('class', 'tab-pane show');
                            tabContent.setAttribute('id', 'tabs-' + formattedMenuName);
                            tabContent.setAttribute('role', 'tabpanel');
                            tabContent.setAttribute('aria-labelledby', 'tabs-' + formattedMenuName + '-tab');
                            $("#tabs-tabContent").append(tabContent);

                            getSubmenuExceptMasterDataChild(value);
                        }
                    });

                },
                error: function(error) {
                    console.log(error.responseJSON);
                    Swal.fire({
                        icon: 'error',
                        title: "Error",
                        text: error.responseJSON.message ?? 'Failed get list of menu',
                    });
                },
            });
        }

        function getSubmenuOnlyMasterDataChild() {

            $.ajax({
                type: 'GET',
                url: "{{ url('/get-submenu-only-master-data-child') }}",
                dataType: 'json',
                data: {},
                success: function(response) {

                    $.each(response,function(key, value)
                    {

                        var formattedSubMenuName = value.submenu_name.toLowerCase().replace(/\s+/g, '-');

                        $("#tabs-master-data").append(`
                            <div class="row mb-2">
                                <div style="border: 1px solid rgb(234, 234, 234); border-radius: 7px; padding: 15px 20px">

                                    <div class="d-flex justify-content-between">
                                        <h5>Master ` + value.submenu_name + `</h5>
                                        <div class="toggle_enable_all d-flex">
                                            <div class="container_toggle_permission">
                                                <input type="checkbox" class="checkbox_permission master_checkbox" id="enable_all_` + formattedSubMenuName + `" value="1" >
                                                <label class="switch_permission" for="enable_all_` + formattedSubMenuName + `">
                                                    <span class="slider_permission"></span>
                                                </label>
                                            </div>
                                            <label style="margin: 1px 0px 0px 10px; font-size: 14px; color:rgb(138, 138, 138)">enable all</label>
                                        </div>
                                    </div>

                                    <div class="row mt-3">
                                        <div class="col">
                                            <ul id="left_side_checkbox_` + value.id + `" style="list-style-type: none; padding: 0px;">

                                            </ul>
                                        </div>
                                        <div class="col">
                                            <ul id="right_side_checkbox_` + value.id + `" style="list-style-type: none; padding: 0px">

                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        `);

                        getPermissionsOnlyMasterDataChild(value.id);

                    });


                },
                error: function(error) {
                    console.log(error.responseJSON);
                    Swal.fire({
                        icon: 'error',
                        title: "Error",
                        text: error.responseJSON.message ?? 'Failed get list of menu',
                    });
                },
                async: false,
            });

        }

        function getPermissionsOnlyMasterDataChild(data) {

            $.ajax({
                type: 'GET',
                url: "{{ url('/get-permissions-only-master-data-child') }}",
                dataType: 'json',
                data: {
                    submenu_id: data,
                },
                success: function(response) {

                    $.each(response,function(key, value)
                    {

                        var formattedSubMenuName = value.submenu_name.toLowerCase().replace(/\s+/g, '-');

                        var parts = value.key.split('_');
                        var lastPart = parts[parts.length - 1];

                        if ( lastPart == "list" ) {
                            $("#left_side_checkbox_" + data).append(`
                                <li style="margin-bottom: 15px">
                                    <div class="checkbox-wrapper-13 d-flex align-items-center">
                                        <input type="checkbox" class="checkbox_masterdata" id="` + value.key + `" value="1" >
                                        <div style="margin-left: 15px">
                                            <label for="` + value.key + `">View ` + value.submenu_name + `</label><br>
                                            <label for="` + value.key + `" style="color: rgb(173, 173, 173);">This allows access just to view the list of ` + formattedSubMenuName + `'s data.</label>
                                        </div>
                                    </div>
                                </li>
                                <li>
                                    <hr style="color: rgb(177, 177, 177)">
                                </li>
                            `);
                        } else if ( lastPart == "create" ) {
                            $("#left_side_checkbox_" + data).append(`
                                <li style="margin-bottom: 15px">
                                    <div class="checkbox-wrapper-13 d-flex align-items-center">
                                        <input type="checkbox" class="checkbox_masterdata" id="` + value.key + `" value="1" >
                                        <div style="margin-left: 15px">
                                            <label for="` + value.key + `">Create ` + value.submenu_name + `</label><br>
                                            <label for="` + value.key + `" style="color: rgb(173, 173, 173);">This allows access to create new data of ` + formattedSubMenuName + `.</label>
                                        </div>
                                    </div>
                                </li>
                                <li>
                                    <hr style="color: rgb(177, 177, 177)">
                                </li>
                            `);
                        } else if ( lastPart == "reset" ) {
                            $("#left_side_checkbox_" + data).append(`
                                <li style="margin-bottom: 15px">
                                    <div class="checkbox-wrapper-13 d-flex align-items-center">
                                        <input type="checkbox" class="checkbox_masterdata" id="` + value.key + `" >
                                        <div style="margin-left: 15px">
                                            <label for="` + value.key + `">Reset Password</label><br>
                                            <label for="` + value.key + `" style="color: rgb(173, 173, 173);">This allows access to reset the ` + formattedSubMenuName + `'s password.</label>
                                        </div>
                                    </div>
                                </li>
                                <li>
                                    <hr style="color: rgb(177, 177, 177)">
                                </li>
                            `);
                        } else if ( lastPart == "edit" ) {
                            $("#right_side_checkbox_" + data).append(`
                                <li style="margin-bottom: 15px">
                                    <div class="checkbox-wrapper-13 d-flex align-items-center">
                                        <input type="checkbox" class="checkbox_masterdata" id="` + value.key + `" value="1" >
                                        <div style="margin-left: 15px">
                                            <label for="` + value.key + `">Edit ` + value.submenu_name + `</label><br>
                                            <label for="` + value.key + `" style="color: rgb(173, 173, 173);">This allows access to edit the old data of ` + formattedSubMenuName + `.</label>
                                        </div>
                                    </div>
                                </li>
                                <li>
                                    <hr style="color: rgb(177, 177, 177)">
                                </li>
                            `);
                        } else if ( lastPart == "export" ) {
                            $("#right_side_checkbox_" + data).append(`
                                <li style="margin-bottom: 15px">
                                    <div class="checkbox-wrapper-13 d-flex align-items-center">
                                        <input type="checkbox" class="checkbox_masterdata" id="` + value.key + `" >
                                        <div style="margin-left: 15px">
                                            <label for="` + value.key + `">Export Data</label><br>
                                            <label for="` + value.key + `" style="color: rgb(173, 173, 173);">This allows access to reset the ` + formattedSubMenuName + `'s password.</label>
                                        </div>
                                    </div>
                                </li>
                                <li>
                                    <hr style="color: rgb(177, 177, 177)">
                                </li>
                            `);
                        }

                    });

                },
                error: function(error) {
                    console.log(error.responseJSON);
                    Swal.fire({
                        icon: 'error',
                        title: "Error",
                        text: error.responseJSON.message ?? 'Failed get list of menu',
                    });
                },
                async: false,
            });

        }

        function getSubmenuExceptMasterDataChild(data) {

            $.ajax({
                type: 'GET',
                url: "{{ url('/get-submenu-by-id') }}",
                dataType: 'json',
                data: {
                    id: data.id,
                },
                success: function(response) {

                    var formattedMenuName = data.menu_name.toLowerCase().replace(/\s+/g, '-');

                    $("#tabs-" + formattedMenuName).append(`
                        <div class="row">
                            <div style="border: 1px solid rgb(234, 234, 234); border-radius: 7px; padding: 15px 20px">

                                <div class="d-flex justify-content-between" id="header_permission_`+ formattedMenuName +`">
                                    <h5>` + data.menu_name + `</h5>

                                </div>

                                <div class="row row-cols-2 mt-3" id="list_checkbox_` + formattedMenuName + `">


                                </div>

                            </div>
                        </div>
                    `);

                    if ( data.menu_name != "Stock" ) {

                        $('#header_permission_' + formattedMenuName).append(`
                            <div class="toggle_enable_all d-flex">
                                <div class="container_toggle_permission">
                                    <input type="checkbox" class="checkbox_permission not_master_checkbox" id="enable_all_`+formattedMenuName+`" value=1 >
                                    <label class="switch_permission" for="enable_all_`+formattedMenuName+`">
                                        <span class="slider_permission"></span>
                                    </label>
                                </div>
                                <label style="margin: 1px 0px 0px 10px; font-size: 14px; color:rgb(138, 138, 138)">enable all</label>
                            </div>
                        `);

                    }

                    $.each(response,function(key, value)
                    {

                        var formattedSubMenuName = value.submenu_name.toLowerCase().replace(/\s+/g, '-');

                        var parts = value.key.split('_');
                        var lastPart = parts[parts.length - 1];
                        var formattedLastPart = lastPart.charAt(0).toUpperCase() + lastPart.slice(1);

                        if ( value.menu_name == "Stock" ) {

                            if ( formattedSubMenuName == "list" ) {
                                $("#list_checkbox_" + formattedMenuName).append(`
                                    <div class="col">
                                        <ul style="list-style-type: none; padding: 0px;">
                                            <li style="margin-bottom: 15px">
                                                <div class="checkbox-wrapper-13 d-flex align-items-center">
                                                    <input type="checkbox" class="checkbox_not_master" id="` + value.key + `" >
                                                    <div style="margin-left: 15px">
                                                        <label for="` + value.key + `">`+ formattedLastPart + ` ` + `Stock</label><br>
                                                        <label for="` + value.key + `" style="color: rgb(173, 173, 173);">This allows access just to view the list of ` + formattedMenuName + `'s data.</label>
                                                    </div>
                                                </div>
                                            </li>
                                            <li>
                                                <hr style="color: rgb(177, 177, 177)">
                                            </li>
                                        </ul>
                                    </div>
                                `);
                            } else if ( formattedSubMenuName == "movement" ) {
                                $("#list_checkbox_" + formattedMenuName).append(`
                                    <div class="col">
                                        <ul style="list-style-type: none; padding: 0px;">
                                            <li style="margin-bottom: 15px">
                                                <div class="checkbox-wrapper-13 d-flex align-items-center">
                                                    <input type="checkbox" class="checkbox_not_master" id="` + value.key + `" >
                                                    <div style="margin-left: 15px">
                                                        <label for="` + value.key + `">`+ formattedLastPart + ` ` + `Stock Movement</label><br>
                                                        <label for="` + value.key + `" style="color: rgb(173, 173, 173);">This allows access just to view the list of ` + formattedMenuName + `'s data.</label>
                                                    </div>
                                                </div>
                                            </li>
                                            <li>
                                                <hr style="color: rgb(177, 177, 177)">
                                            </li>
                                        </ul>
                                    </div>
                                `);
                            }


                        } else {

                            $("#list_checkbox_" + formattedMenuName).append(`
                                <div class="col">
                                    <ul style="list-style-type: none; padding: 0px;">
                                        <li style="margin-bottom: 15px">
                                            <div class="checkbox-wrapper-13 d-flex align-items-center">
                                                <input type="checkbox" class="checkbox_not_master" id="` + value.key + `" >
                                                <div style="margin-left: 15px">
                                                    <label for="` + value.key + `">`+ formattedLastPart + ` ` + value.menu_name + `</label><br>
                                                    <label for="` + value.key + `" style="color: rgb(173, 173, 173);">This allows access just to view the list of ` + formattedMenuName + `'s data.</label>
                                                </div>
                                            </div>
                                        </li>
                                        <li>
                                            <hr style="color: rgb(177, 177, 177)">
                                        </li>
                                    </ul>
                                </div>
                            `);

                        }

                    });
                },
                error: function(error) {
                    console.log(error.responseJSON);
                    Swal.fire({
                        icon: 'error',
                        title: "Error",
                        text: error.responseJSON.message ?? 'Failed get list of menu',
                    });
                },
            });
        }

        // ========================= ENABLE ALL ONLY MASTER DATA =========================
        $(document).on('change', '.master_checkbox', function(event) {

            var menuName = $(this).attr('id').split('_')[2];
            var status = document.getElementById('enable_all_'+ menuName).checked;

            if ( status == 1 ) {
                var flag = 1;
            } else {
                var flag = 0;
            }


            if ( status == 1 ) {
                document.getElementById('master_' + menuName + '_list').checked = true;
                document.getElementById('master_' + menuName + '_create').checked = true;
                document.getElementById('master_' + menuName + '_edit').checked = true;
                if ( menuName == 'user' ) {
                    document.getElementById('master_' + menuName + '_reset').checked = true;
                }
                if ( menuName != 'profile' ) {
                    document.getElementById('master_' + menuName + '_export').checked = true;
                }
            } else {
                document.getElementById('master_' + menuName + '_list').checked = false;
                document.getElementById('master_' + menuName + '_create').checked = false;
                document.getElementById('master_' + menuName + '_edit').checked = false;
                if ( menuName == 'user' ) {
                    document.getElementById('master_' + menuName + '_reset').checked = false;
                }
                if ( menuName != 'profile' ) {
                    document.getElementById('master_' + menuName + '_export').checked = false;
                }
            }
        });

        // ========================= ENABLE ALL EXCEPT MASTER =========================
        $(document).on('change', '.not_master_checkbox', function(event) {

            var menuName = $(this).attr('id').split('_')[2];
            var status = document.getElementById('enable_all_'+ menuName).checked;

            if ( status == 1 ) {
                var flag = 1;
            } else {
                var flag = 0;
            }

            if ( menuName == "stock-opname" ) {
                menuName = menuName.replace("-", "");
            }


            if ( status == 1 ) {
                if ( menuName != "stock" ) {
                    document.getElementById(menuName + '_list').checked = true;
                    document.getElementById(menuName + '_create').checked = true;
                    document.getElementById(menuName + '_export').checked = true;
                } else {
                    document.getElementById(menuName + '_list').checked = true;
                    document.getElementById(menuName + '_export').checked = true;
                }
            } else {
                if ( menuName != "stock" ) {
                    document.getElementById(menuName + '_list').checked = false;
                    document.getElementById(menuName + '_create').checked = false;
                    document.getElementById(menuName + '_export').checked = false;
                } else {
                    document.getElementById(menuName + '_list').checked = false;
                    document.getElementById(menuName + '_export').checked = false;
                }
            }
        });

        $(document).on('click', '#button_submit', function(event) {

            var profileCode = $("#profile_code").val();
            var profileName = $("#profile_name").val();
            var status = document.getElementById('status').checked;

            const checkboxesMaster = document.querySelectorAll('.checkbox_masterdata[type="checkbox"]:checked');
            const dataPermissions = [];

            checkboxesMaster.forEach(function(checkbox) {
                dataPermissions.push(checkbox.id);
            });

            const checkboxesNotMaster = document.querySelectorAll('.checkbox_not_master[type="checkbox"]:checked');

            checkboxesNotMaster.forEach(function(checkbox) {
                dataPermissions.push(checkbox.id);
            });

            // console.log("Checked Checkbox IDs: ", checkedValuesMaster);

            if ( status == 1 ) {
                var flag = 1;
            } else {
                var flag = 0;
            }

            $.ajax({
                type: 'POST',
                url: "{{ url('/post-new-profile') }}",
                dataType: 'json',
                data: {
                    code: profileCode,
                    name: profileName,
                    dataPermissions: dataPermissions,
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
                        text: error.responseJSON.message ?? 'Failed submit profile request',
                        target: document.getElementById('editModal'),
                    });
                    $("#button_submit").prop('disabled', false);
                },
            });

        });

    </script>


@endsection
