@extends("inventory.layouts.main")
@section("container")

    <style>

        table thead th, td {
            padding: 5px 0px;
        }

    </style>

    <div class="content">

        {{-- TITLE --}}
        <div class="title_n_button">
            <h4 class="title" style="margin-left: 0px">FORM OF RECEIVING</h4>

            <div class="user_guide active text-center">
                <font class="text_tooltip">i</font>
                <span class="user_guide_tooltip">You can make new Receiving here.</span>
            </div>
        </div>

        <hr>

        <div style="margin-top: 0px; padding: 0px 10px">
            <table style="width: 100%;">
                <tr>
                    {{-- RECEIVING DATE --}}
                    <td class="label_form">Receiving Date</td>
                    <td class="container_input_form" style="margin: 0; padding: 0;">
                        <input type="text" class="form-control input_form" id="receiving_date" readonly disabled>
                    </td>

                    {{-- VERTICAL LINE --}}
                    <td style="width: 4%" rowspan="2">
                        <hr class="vertical_line_two_row">
                    </td>

                    {{-- SITE --}}
                    <td class="label_form">Site</td>
                    <td class="container_input_form" style="margin: 0; padding: 0;">
                        <select name="select_site" id="select_site" class="input_form" disabled style="width: 100%">
                            <option value="">Select store</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    {{-- TYPE --}}
                    <td class="label_form">Type</td>
                    <td class="container_input_form" style="margin: 0; padding: 0;">
                        <select name="select_type" id="select_type" class="input_form" style="width: 100%">
                            <option value="">Select type</option>
                            <option value="transfer">Transfer</option>
                            <option value="supplier">Supplier</option>
                        </select>
                    </td>

                    {{-- FROM TRANSFER --}}
                    <td class="label_form trans d-none">From Transfer</td>
                    <td class="container_input_form trans d-none">
                        <select name="select_transfer" id="select_transfer" class="input_form" disabled style="width: 100%">
                            <option value="">Select transfer</option>
                        </select>
                    </td>

                    {{-- FROM SUPPLIER --}}
                    <td class="label_form supp d-none">From Supplier</td>
                    <td class="container_input_form supp d-none">
                        <select name="select_supplier" id="select_supplier" class="input_form" disabled style="width: 100%">
                            <option value="">Select supplier</option>
                        </select>
                    </td>
                </tr>
            </table>
        </div>
    </div>

    {{-- INPUT NOMOR FAKTUR --}}
    <div class="content mt-2 d-none" id="content_no_faktur">
        <table style="width: 100%;">
            <tr>
                <td class="" style="width: 13%">Delivery Number</td>
                <td class="" style="width: 87%">
                    <input type="text" class="form-control input_form" id="invoice_number" disabled>
                </td>
            </tr>
        </table>
    </div>

    {{-- TABLE LIST ITEMS --}}
    <div class="content mt-2 d-none" id="content_table_form">

        <div style="height: 290px;" id="container_table_form"></div>

        <div class="row text-left" id="addRowDiv" style="width: 300px; margin-left: 0px; margin-bottom: 5px">
            <button type="button" id="add" class="btn_add_row" style="display: none;">
                <font style="color: white">+ Add row</font>
            </button>
        </div>

    </div>

    {{-- BUTTON SUBMIT --}}
    <div class="d-flex justify-content-end d-none" id="content_button_submit">
        <button class="button_submit_form mt-2" id="button_submit">Submit</button>
    </div>

    <div class="bottom_space"></div>

    <script>

        // ==================== GLOBAL SETUP CSRF ====================
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN' : $('meta[name="csrf-token"]').attr('content')
            }
        });

        $(document).ready(function(){
            const todayDate = new Date().toLocaleDateString('id-ID');
            document.getElementById("receiving_date").value = todayDate;

            $("#select_type").select2();
            $("#select_site").select2();
            $("#select_transfer").select2();
            $("#select_supplier").select2();

            getListSite();

        });

        var indexTable = 3;
        var itemListData = [];


        $("#select_type").change(function(){

            const trans = document.getElementsByClassName("trans");
            const supp = document.getElementsByClassName("supp");

            const contentNoFaktur = document.getElementById('content_no_faktur');
            const contentTableForm = document.getElementById('content_table_form');
            const contentButtonSubmit = document.getElementById('content_button_submit');

            if ( this.value == "transfer" ) {

                trans[0].classList.remove('d-none');
                trans[1].classList.remove('d-none');
                supp[0].classList.add('d-none');
                supp[1].classList.add('d-none');
                $('#select_site').prop('disabled', false);

                contentNoFaktur.classList.add('d-none');
                $('#container_table_form').html('');
                contentTableForm.classList.add('d-none');
                contentButtonSubmit.classList.add('d-none');

                document.getElementById('add').style.display = 'none';

                var site = $("#select_site").val();
                if ( site != null ) {
                    getFromTransfer(site);
                    $('#select_transfer').prop('disabled', false);
                }

            } else if ( this.value == "supplier" ) {

                trans[0].classList.add('d-none');
                trans[1].classList.add('d-none');
                supp[0].classList.remove('d-none');
                supp[1].classList.remove('d-none');
                $('#select_site').prop('disabled', false);

                var site = $("#select_site").val();

                if ( site != null ) {
                    getListSupplier();
                    $('#select_supplier').prop('disabled', false);
                } else {
                    $('#select_supplier').prop('disabled', true);

                }

                tableSupplier();

            }

        });

        function getListSite() {

            $.ajax({
                type: 'GET',
                url: "{{ url('/get-user-site-permission') }}",
                dataType: 'json',
                data: {},
                success: function(response) {
                    var data = response;

                    /** Set dropdown list */
                    $('#select_site').find('option').remove().end().append();

                    if (data.length != 1) {
                        $('#select_site').append('<option value="" disabled selected>Select store</option>');
                    }

                    for (var i = 0; i < data.length; i++) {
                        text = data[i].store_code+' - '+data[i].site_description;
                        value = data[i].site_id;
                        $('#select_site').append($("<option></option>").attr("value", value).text(text));
                    }

                    // if (data.length == 1) {
                    //     resetTable();
                    //     getListItem();
                    // }

                },
                error: function(error) {
                    console.log(error.responseJSON);
                    Swal.fire({
                        icon: 'error',
                        title: "Error",
                        text: error.responseJSON.message ?? 'Failed get list site',
                    });
                },
            });

        }

        $(document).on('change', '#select_site', function(event){

            var type = $('#select_type').val();
            // resetTable();

            if ( type == "transfer" ) {
                getFromTransfer(this.value);
                $('#select_transfer').prop('disabled', false);

            } else if ( type == "supplier" ) {
                getListSupplier();
                $('#select_supplier').prop('disabled', false);

            }

        });

        function getFromTransfer(data) {

            var site = data;

            $.ajax({
                type: 'GET',
                url: "{{ url('/get-from-transfer') }}",
                dataType: 'json',
                data: {
                    site_id: site,
                },
                success: function(response) {
                    var data = response;

                    /** Set dropdown list */
                    $('#select_transfer').find('option').remove().end().append();
                    if (data.length != 1) {
                        $('#select_transfer').append('<option value="" disabled selected>Select transfer</option>');
                    }

                    for (var i = 0; i < data.length; i++) {
                        text = data[i].trf_no;
                        value = data[i].id;
                        $('#select_transfer').append($("<option></option>").attr("value", value).text(text));
                    }

                    if (data.length == 1) {
                        var select_transfer = $('#select_transfer').val();
                        tableTransfer(select_transfer);
                        resetTable();
                    }

                },
                error: function(error) {
                    console.log(error.responseJSON);
                    Swal.fire({
                        icon: 'error',
                        title: "Error",
                        text: error.responseJSON.message ?? 'Failed get list transer',
                    });
                },
            });

        }

        $(document).on('change', '#select_transfer', function(event){

            tableTransfer(this.value);

        });

        function tableTransfer(trf_id) {

            const contentTableForm = document.getElementById('content_table_form');
            const contentButtonSubmit = document.getElementById('content_button_submit');

            contentTableForm.classList.remove('d-none');
            contentButtonSubmit.classList.remove('d-none');

            $('#container_table_form').html(
                `<div class="title_n_button">
                    <h4 class="title" style="margin-left: 0px">LIST OF ITEMS</h4>
                </div>

                <hr>
                <div class="table_scroll">
                    <table class="table table-bordered tableData align-middle table_form" id="table_form" style="width:100%;">
                        <thead class="thead">
                            <tr class="text-center" style="width: 100%;">
                                <th class="text-center">Item Description</th>
                                <th class="text-center" style="width:200px">Quantity</th>
                            </tr>
                        </thead>
                        <tbody style="background-color: white"></tbody>
                    </table>
                </div>`
            )

            addTableRowTransfer(trf_id);

        }

        function addTableRowTransfer(trf_id) {

            $.ajax({
                type: 'GET',
                url: "{{ url('/get-transfer-detail-by-trf-id') }}",
                dataType: 'json',
                data: {
                    trf_id: trf_id,
                },
                success: function(response) {
                    var data = response;

                    if (data.length == 0) {
                        $('#table_form').append(
                            `<tr id="row" class="tableRow">
                                <td colspan=2>No Data</td>
                            </tr>`
                        )
                    }

                    for (var index = 0; index < data.length; index++) {
                        $('#table_form').append(
                            `<tr id="row_`+index+`" class="tableRow">
                                <td class="text-center">
                                <input type="hidden" name="item_`+index+`_id" id="item_`+index+`_id" value="`+data[index].item_id+`">
                                    `+ data[index].item_desc +`
                                </td>
                                <input type="hidden" name="qty_`+index+`" id="qty_`+index+`" value="`+data[index].quantity+`">
                                <td class="text-center">
                                    `+ data[index].quantity +`
                                </td>
                            </tr>`
                        )
                    }


                },
                error: function(error) {
                    console.log(error.responseJSON);
                    Swal.fire({
                        icon: 'error',
                        title: "Error",
                        text: error.responseJSON.message ?? 'Failed get list transer',
                    });
                },
            });

        }

        function getListSupplier() {

            $.ajax({
                type: 'GET',
                url: "{{ url('/get-all-data-supplier') }}",
                dataType: 'json',
                data: {},
                success: function(response) {
                    var data = response;

                    /** Set dropdown list */
                    $('#select_supplier').find('option').remove().end().append();
                    if (data.length != 1) {
                        $('#select_supplier').append('<option value="" disabled selected>Select supplier</option>');
                    }
                    for (var i = 0; i < data.length; i++) {
                        text = data[i].supp_name;
                        value = data[i].id;
                        $('#select_supplier').append($("<option></option>").attr("value", value).text(text));
                    }

                    if (data.length == 1) {
                        resetTable();
                        $('#invoice_number').prop('disabled', false);
                        getListItem($('#select_supplier').val());
                    }

                },
                error: function(error) {
                    console.log(error.responseJSON);
                    Swal.fire({
                        icon: 'error',
                        title: "Error",
                        text: error.responseJSON.message ?? 'Failed get list site',
                    });
                },
            });

        }

        $(document).on('change', '#select_supplier', function(event){
            $('#invoice_number').prop('disabled', false);
            resetTable();
            getListItem(this.value);
        });

        function getListItem(supp_id) {

            $.ajax({
                type: 'GET',
                url: "{{ url('/get-rec-supplier-item') }}",
                dataType: 'json',
                data: {
                    supp_id: supp_id,
                },
                success: function(response) {

                    itemListData = response.map(function (item) {
                        return {
                            label: item.item_code+' - '+item.item_name,
                            value: item.item_code+' - '+item.item_name,
                            key: item.item_id,
                        }
                    });

                    if (response.length > 0) {
                        enableTableRow(-1);
                    } else {
                        disableTableRow(-1);
                    }
                },
                error: function(error) {
                    console.log(error.responseJSON);
                    Swal.fire({
                        icon: 'error',
                        title: "Error",
                        text: error.responseJSON.message ?? 'Failed get list product',
                    });
                },
            });

        }

        function tableSupplier() {

            const contentNoFaktur = document.getElementById('content_no_faktur');
            const contentTableForm = document.getElementById('content_table_form');
            const contentButtonSubmit = document.getElementById('content_button_submit');

            contentNoFaktur.classList.remove('d-none');
            contentTableForm.classList.remove('d-none');
            contentButtonSubmit.classList.remove('d-none');

            $('#container_table_form').html(
                `<div class="title_n_button">
                    <h4 class="title" style="margin-left: 0px">LIST OF ITEMS</h4>
                </div>

                <hr>
                <div class="table_scroll">
                    <table class="table table-bordered align-middle table_form" id="table_form" style="width:100%;">
                        <thead class="thead">
                            <tr class="text-center" style="width: 100%;">
                                <th class="text-center">Items</th>
                                <th class="text-center" style="width:200px">Quantity</th>
                                <th class="text-center" style="width:100px">Action</th>
                            </tr>
                        </thead>
                        <tbody style="background-color: white"></tbody>
                    </table>
                </div>`
            )
            document.getElementById('add').style.display = 'block';

            for (var i = 0 ; i < indexTable ; i++) {
                addTableRow(i);
                $(".item").prop('disabled', true);
                $("#add").prop('disabled', true);
            }

            // getListItem();

        }

        function addTableRow(index) {
            $('#table_form').append(
                `<tr id="row_`+index+`" class="tableRow">
                    <td>
                        <input type="hidden" name="item_`+index+`_id" id="item_`+index+`_id">
                        <input type="text" name="item_`+index+`" id="item_`+index+`" class="form-control item" placeholder="Input item" style="width: 100%">
                        <div name="err_item_`+index+`" id="err_item_`+index+`" style="text-align: left; display: none;">
                            <p name="err_item_msg_`+index+`" id="err_item_msg_`+index+`" style="margin-bottom: 0; color: red; font-size: 12px;"></p>
                        </div>
                    </td>
                    <td>
                        <input type="number" min="1" class="form-control qty" name="qty_`+index+`" id="qty_`+index+`" style="width: 100%; text-align: right" disabled>
                        <div name="err_qty_`+index+`" id="err_qty_`+index+`" style="text-align: left; display: none;">
                            <p name="err_qty_msg_`+index+`" id="err_qty_msg_`+index+`" style="margin-bottom: 0; color: red; font-size: 12px;"></p>
                        </div>

                    </td>
                    <td class="text-center"><button type="button" name="remove" id="button_remove_`+index+`" class="btn btn-danger btn_remove">X</button></td>
                </tr>`
            )
        }

        function resetTable() {
            var table = document.getElementById("table_form");
            for (var i = 1, row ; row = table.rows[i] ; i++) {
                var tempArr = row.id.split("_");
                var index = tempArr[1];

                document.getElementById("item_"+index).value = '';
                hideItemErrorMessage(index);
                resetTableRow(index);
            }
        }

        function resetTableRow(index) {
            document.getElementById("item_"+index+"_id").value = '';
            document.getElementById("qty_"+index).value = '';

            $('#qty_'+index).prop('disabled', true);

            hideQtyErrorMessage(index);
        }

        function enableTableRow(index) {

            var table = document.getElementById("table_form");
            for (var i = 1, row ; row = table.rows[i] ; i++) {
                var tempArr = row.id.split("_");

                if (tempArr[1] != index) {
                    itemId = $('#item_'+tempArr[1]+'_id').val();
                    qty = $('#qty_'+tempArr[1]).val();

                    $('#item_'+tempArr[1]).prop('disabled', false);
                    $('#button_remove_'+tempArr[1]).prop('disabled', false);

                    if (itemId != undefined && itemId != '') {
                        $('#qty_'+tempArr[1]).prop('disabled', false);
                    }
                }
            }

            $('#add').prop('disabled', false);
            $('.btn_remove').prop('disabled', false);
            $("#button_submit").prop('disabled', false);

        }

        function disableTableRow(index) {

            var table = document.getElementById("table_form");
            for (var i = 1, row ; row = table.rows[i] ; i++) {
                var tempArr = row.id.split("_");

                if (tempArr[1] != index) {
                    /** Disabled text input */
                    $('#item_'+tempArr[1]).prop('disabled', true);
                    $('#qty_'+tempArr[1]).prop('disabled', true);
                    $('#button_remove_'+tempArr[1]).prop('disabled', true);
                }
            }

            $('#add').prop('disabled', true);
            $("#button_submit").prop('disabled', true);

        }

        function checkDuplicateItem(data) {
            var itemId = $('#item_'+data+'_id').val();

            var table = document.getElementById("table_form");
            for (var i = 1, row ; row = table.rows[i] ; i++) {
                var tempArr = row.id.split("_");

                if (itemId == $('#item_'+tempArr[1]+'_id').val() && tempArr[1] != data) {
                    showItemErrorMessage(data, 'Item already exists');
                    disableTableRow(data);
                    return true;
                } else {
                    hideItemErrorMessage(data);
                    enableTableRow(data);
                }
            }
            return false;
        }

        function showItemErrorMessage(index, message) {
            document.getElementById("err_item_msg_"+index).innerHTML = message;
            document.getElementById("err_item_"+index).style.display = 'block';
        }

        function hideItemErrorMessage(index) {
            document.getElementById("err_item_msg_"+index).innerHTML = '';
            document.getElementById("err_item_"+index).style.display = 'none';
        }

        function showQtyErrorMessage(index, message) {
            document.getElementById("err_qty_msg_"+index).innerHTML = message;
            document.getElementById("err_qty_"+index).style.display = 'block';
        }

        function hideQtyErrorMessage(index) {
            document.getElementById("err_qty_msg_"+index).innerHTML = '';
            document.getElementById("err_qty_"+index).style.display = 'none';
        }

        // ========================= ADD ROW =========================
        $('#add').click(function() {
            addTableRow(indexTable);
            indexTable++;
            showAddRowButton();
        });

        // ========================= REMOVE ROW =========================
        $(document).on('click', '.btn_remove', function() {

            if ( indexTable > 1 ) {
                var buttonId = $(this).attr("id");

                var tempArr = buttonId.split("_");
                $('#row_'+tempArr[2]).remove();

                enableTableRow(tempArr[2]);
                showAddRowButton();
                indexTable--;
            }

        });

        function showAddRowButton() {
            var table = document.getElementById("table_form");
            var btn = document.getElementById("add");

            var rowCount = table.tBodies[0].rows.length;
            if (rowCount >= 15) {
                btn.style.display = "none";
            } else {
                btn.style.display = "block";
            }
        }

        $(document).on('focus', '.item', function() {
            var itemId = $(this).attr("id");
            autocompleteItem(itemId);
        });

        function autocompleteItem(itemId) {
            if (itemListData.length > 0) {
                $('#'+itemId).autocomplete({
                    minLength: 2,
                    ignoreCase: false,
                    source: function(request, response) {
                        var result = $.ui.autocomplete.filter(itemListData, request.term);
                        response(result.slice(0, 50));
                    },
                    change: function(event, ui) {
                        /** Triggered when the field is blurred, if the value has changed */
                        var tempArr = itemId.split("_");

                        if (ui.item?.key == undefined) {
                            /** Reset row */
                            resetTableRow(tempArr[1]);

                            /** Show error message */
                            showItemErrorMessage(tempArr[1], 'Item not found');
                            disableTableRow(tempArr[1]);
                        } else {
                            checkDuplicateItem(tempArr[1]);
                        }
                    },
                    select: function (event, ui) {
                        var tempArr = itemId.split("_");

                        /** Set product value */
                        $('#'+itemId+'_id').val(ui.item.key);
                        $('#'+itemId).val(ui.item.label);
                        $('#'+itemId).autocomplete('close');

                        /** Check duplicate product */
                        if (checkDuplicateItem(tempArr[1])) {
                            $('#qty_'+tempArr[1]).prop('disabled', true);
                            return;
                        }

                        /** Reset qty, stock, unit */
                        document.getElementById("qty_"+tempArr[1]).value = '';
                        hideQtyErrorMessage(tempArr[1]);
                        $('#qty_'+tempArr[1]).prop('disabled', false);

                        return false;
                    },
                    response: function(event, ui) {
                        var tempArr = itemId.split("_");

                        if (!ui.content.length) {
                            showItemErrorMessage(tempArr[1], 'Item not found');
                            disableTableRow(tempArr[1]);
                        } else {
                            hideItemErrorMessage(tempArr[1]);
                        }
                    }
                });
            }
        }

        // ========================= SUBMIT TRANSFER =========================
        $(document).on('click', '#button_submit', function(event) {

            event.preventDefault();
            $("#button_submit").prop('disabled', true);

            var receivingDate = $('#receiving_date').val();
            var type = $('#select_type').val();
            var site = $('#select_site').val();
            var transfer = $('#select_transfer').val();
            var supplier = $('#select_supplier').val();
            var invoice_no = $('#invoice_number').val();
            var table = document.getElementById("table_form");
            var detailData = [];

            /** Prepare data for detail data */
            for (var i = 1, row ; row = table.rows[i] ; i++) {
                var tempArr = row.id.split("_");
                var itemId = $('#item_'+tempArr[1]+'_id').val();
                var qty = $('#qty_'+tempArr[1]).val();

                /** Get data detail that contain item id */
                if (itemId != '') {

                    /** Check item duplicate or not */
                    var checkDuplicate = detailData.find(function (element) {
                        return element.item_id == itemId;
                    });

                    if (checkDuplicate != undefined) {
                        showitemErrorMessage(tempArr[1], 'Item already exists');
                        disableTableRow(tempArr[1]);
                        return;
                    }

                    /** Validate qty input */
                    if (qty == '') {
                        showQtyErrorMessage(tempArr[1], 'Required');
                        disableTableRow(tempArr[1]);
                        return;
                    }

                    /** Append to array detail */
                    detailData.push(
                        {
                            item_id: itemId,
                            qty: qty,
                        }
                    );
                }
            }

            $.ajax({
                type: 'POST',
                url: "{{ url('/post-rec-submit') }}",
                dataType: 'json',
                data: {
                    receiving_date: receivingDate,
                    site_id: site,
                    transfer: transfer,
                    supplier: supplier,
                    invoice_no: invoice_no,
                    detail: detailData,
                },
                success: function(response) {

                    /** Disable all input field */
                    $('#select_site').prop('disabled', true);
                    disableTableRow(-1);

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
                        text: error.responseJSON.message ?? 'Failed submit receiving request',
                    });
                    $("#button_submit").prop('disabled', false);
                },
            });
        });

    </script>


@endsection
