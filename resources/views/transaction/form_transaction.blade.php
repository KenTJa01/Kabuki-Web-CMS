@extends("layouts.main")
@section("container")

<style>

    table thead th, td {
        padding: 5px 0px;
    }

</style>

    <div class="content">

        {{-- TITLE --}}
        <div class="title_n_button">
            <h4 class="title" style="margin-left: 0px">FORM OF TRANSACTION</h4>

            <div class="user_guide active text-center">
                <font class="text_tooltip">i</font>
                <span class="user_guide_tooltip">You can make new Redeem here.</span>
            </div>
        </div>

        <hr>

        <div class="form_header" style="padding: 0px 5px">
            <table style="width: 100%;">
                <tr>
                    {{-- TRANSACTION DATE --}}
                    <td class="label_form">Transaction Date</td>
                    <td class="container_input_form">
                        <input type="text" class="form-control input_form" id="transaction_date" readonly disabled>
                    </td>

                    {{-- VERTICAL LINE --}}
                    <td style="width: 4%" rowspan="3">
                        <hr class="vertical_line_three_row">
                    </td>

                    {{-- STATUS --}}
                    {{-- <td class="label_form">Payment Status</td>
                    <td class="container_input_form">
                        <select name="select_payment_status" id="select_payment_status" class="input_form" style="width: 100%;" disabled>
                            <option value="">Select payment status</option>
                        </select>
                    </td> --}}

                    {{-- NOTE --}}
                    <td class="label_form">Note</td>
                    <td class="container_input_form" rowspan="2">
                        <textarea class="form-control" id="note" cols="50" rows="3" style="resize: none;"></textarea>
                    </td>
                </tr>
                <tr>
                    {{-- WORK TYPE --}}
                    <td class="label_form">Work Type</td>
                    <td class="container_input_form">
                        <select name="select_work_type" id="select_work_type" class="input_form" style="width: 100%;">
                            <option value="">Select work type</option>
                        </select>
                    </td>

                    {{-- NOTE --}}
                    {{-- <td class="label_form">Note</td>
                    <td class="container_input_form" rowspan="2">
                        <textarea class="form-control" id="note" cols="50" rows="3" style="resize: none;"></textarea>
                    </td> --}}
                </tr>
                <tr>
                    {{-- ORDER TYPE --}}
                    <td class="label_form">Order Type</td>
                    <td class="container_input_form">
                        <select name="select_order_type" id="select_order_type" class="input_form" style="width: 100%;" disabled>
                            <option value="">Select order type</option>
                        </select>
                    </td>
                </tr>
            </table>
        </div>
    </div>

    {{-- CUSTOMER'S DATA --}}
    <div class="content mt-2" id="content_no_faktur">

        {{-- TITLE --}}
        <div class="title_n_button d-flex justify-content-between">
            <h4 class="title" style="margin-left: 0px">CUSTOMER'S DATA</h4>
        </div>

        <hr>

        <table style="width: 100%;">
            <tr>
                <td id="label_phone_member" style="width: 13.5%">Full Name</td>
                <td class="" style="width: 87%; margin: 0; padding: 0;">
                    <select name="select_customer_name" id="select_customer_name" class="input_form" disabled>
                        <option value="">Select customer's name</option>
                    </select>
                </td>
            </tr>
        </table>

        <table style="width: 100%; margin-top: 6px">
            <tr>

                {{-- CUSTOMER NAME --}}
                <td class="label_form">Address</td>
                <td class="container_input_form" rowspan=2>
                    <textarea class="form-control" id="address" rows="3" cols="50" style="resize: none;" readonly disabled></textarea>
                    {{-- <input type="text" class="form-control input_form" id="customer_name" readonly disabled> --}}
                </td>

                {{-- VERTICAL LINE --}}
                <td style="width: 4%" rowspan="2">
                    <hr class="vertical_line_two_row">
                </td>

                {{-- PHONE NUMBER --}}
                <td class="label_form phone_number" id="label_phone_number">Phone Number</td>
                <td class="container_input_form phone_number" id="input_phone_number" style="margin: 0; padding: 0;">
                    <input type="text" class="form-control input_form" id="phone_number" readonly disabled>
                </td>

            </tr>
            <tr>

                <td></td>

                {{-- NO MEMBER --}}
                <td class="label_form label_vehicle_number" id="label_vehicle_number">Vehicle Number</td>
                <td class="container_input_form label_vehicle_number" id="input_vehicle_number" style="margin: 0; padding: 0;">
                    <input type="text" class="form-control input_form" id="vehicle_number" disabled>
                </td>

            </tr>
        </table>

    </div>

    {{-- TABLE LIST ITEMS --}}
    <div class="content  mt-2" id="content_table_form">

        <div style="height: 290px;" id="container_table_form">

            {{-- TITLE --}}
            <div class="title_n_button">
                <h4 class="title" style="margin-left: 0px">LIST OF ITEMS</h4>
            </div>

            <hr>

            {{-- TABLE ITEM --}}
            <div class="table_scroll">
                <table class="table table-bordered align-middle table_form" id="table_form" style="width:100%;">
                    <thead class="thead">
                        <tr class="text-center" style="width: 100%;">
                            <th class="text-center">Items</th>
                            <th class="text-center" style="width:200px">Stock Quantity</th>
                            <th class="text-center" style="width:200px">Quantity</th>
                            <th class="text-center" style="width:300px">Subtotal</th>
                            <th class="text-center" style="width:100px">Action</th>
                        </tr>
                    </thead>
                    <tbody style="background-color: white"></tbody>
                </table>
            </div>

        </div>

        {{-- BUTTON ADD ROW --}}
        <div class="row text-left d-flex justify-content-between" id="addRowDiv" style="width: 100%; margin-left: 0px; margin-bottom: 5px">

            <button type="button" id="add" class="btn_add_row" style="display: none; width: 300px">
                <font style="color: white">+ Add row</font>
            </button>
            <div class="input_total d-flex" style="width: 300px">
                <font style="margin: 8px 10px 0 0; font-weight: 500">Total</font>
                <input type="number" class="form-control" id="total_price" value=0 readonly disabled style="text-align: right;">
            </div>
        </div>

    </div>

    {{-- BUTTON SUBMIT --}}
    <div class="d-flex justify-content-end" id="content_button_submit">
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
            document.getElementById("transaction_date").value = todayDate;

            $("#select_work_type").select2();
            $("#select_order_type").select2();
            // $("#select_payment_status").select2();
            $("#select_customer_name").select2();

            //getListSite();
            tableItems();

            $(".item").prop('disabled', true);
            $('.btn_remove').prop('disabled', true);

            getAllDataWorkType();

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

        $('#select_work_type').on('change', function() {

            var work_type_id = $("#select_work_type").val();
            $('#select_order_type').prop('disabled', false);
            getAllDataOrderType(work_type_id);

        });

        // ========================= GET ALL DATA ORDER TYPE =========================
        function getAllDataOrderType(work_type_id) {

            $("#select_order_type").html('<option value="">Select order type</option>');

            $.ajax({
                type: 'GET',
                url: "{{ url('/get-order-type-by-id') }}",
                dataType: 'json',
                data: {
                    work_type_id: work_type_id,
                },
                success: function(response) {

                    if (response.length === 0) {

                        $('#select_order_type').prop('disabled', true);
                        // $('#select_payment_status').prop('disabled', false);
                        $('#select_customer_name').prop('disabled', false);
                        getAllDataPaymentStatus();
                        getAllDataCustomer();

                    } else {

                        $.each(response,function(key, value)
                        {
                            $("#select_order_type").append('<option value="' + value.id + '">' + value.order_type_name + '</option>');
                        });

                    }

                },
                error: function(error) {
                    console.log(error.responseJSON);
                    Swal.fire({
                        icon: 'error',
                        title: "Error",
                        text: error.responseJSON.message ?? 'Failed get list of order type',
                    });
                },
            });

        }

        $('#select_order_type').on('change', function() {

            // $('#select_payment_status').prop('disabled', false);
            $('#select_customer_name').prop('disabled', false);
            // getAllDataPaymentStatus();
            getAllDataCustomer();

        });

        function getAllDataPaymentStatus() {

            $("#select_payment_status").html('<option value="">Select payment status</option>');

            $.ajax({
                type: 'GET',
                url: "{{ url('/get-all-data-payment-status') }}",
                dataType: 'json',
                data: {},
                success: function(response) {
                    $.each(response,function(key, value)
                    {
                        $("#select_payment_status").append('<option value="' + value.id + '">' + value.flag_desc + '</option>');
                    });
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

        }

        // ========================= GET ALL DATA CUSTOMER =========================
        function getAllDataCustomer() {

            $("#select_customer_name").html('<option value="">Select customer name</option>');

            $.ajax({
                type: 'GET',
                url: "{{ url('/get-all-data-customer') }}",
                dataType: 'json',
                data: {},
                success: function(response) {
                    $.each(response,function(key, value)
                    {
                        $("#select_customer_name").append('<option value="' + value.id + '">' + value.customer_name + '</option>');
                    });
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

        }

        $('#select_customer_name').on('change', function() {

            $customer_id = $("#select_customer_name").val();

            $.ajax({
                type: 'GET',
                url: "{{ url('/get-data-customer-by-id') }}",
                dataType: 'json',
                data: {
                    customer_id: $customer_id,
                },
                success: function(response) {
                    $("#address").val(response.address);
                    $("#phone_number").val(response.no_telp);
                    $("#vehicle_number").prop('disabled', false);
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

        $('#vehicle_number').on('change', function() {

            getListItem();
            resetTable();

        });

        var indexTable = 3;
        var productListData = [];
        var tampungTotalPrice = 0;

        function getListItem() {

            $.ajax({
                type: 'GET',
                url: "{{ url('/get-trs-item') }}",
                dataType: 'json',
                data: {},
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
                        text: error.responseJSON.message ?? 'Failed get list item',
                    });
                },
            });

        }

        function tableItems() {
            document.getElementById('add').style.display = 'block';

            for (var i = 0 ; i < indexTable ; i++) {
                addTableRow(i);
                $(".item").prop('disabled', true);
                $("#add").prop('disabled', true);
                $("#button_submit").prop('disabled', true);
            }
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
                        <p name="stock_qty_`+index+`" id="stock_qty_`+index+`" style="font-size: 16px; font-weight: 400;" />
                        <input type="hidden" name="stock_qty_` + index + `_hidden" id="stock_qty_` + index + `_hidden" value="">
                    </td>
                    <td>
                        <input type="number" min="1" class="form-control qty" name="qty_`+index+`" id="qty_`+index+`" style="width: 100%; text-align: right" disabled>
                        <div name="err_qty_`+index+`" id="err_qty_`+index+`" style="text-align: left; display: none;">
                            <p name="err_qty_msg_`+index+`" id="err_qty_msg_`+index+`" style="margin-bottom: 0; color: red; font-size: 12px;"></p>
                        </div>
                    </td>
                    <td>
                        <input type="number" min="1" class="form-control qty" name="price_`+index+`" id="price_`+index+`" style="width: 100%; text-align: right" disabled>
                        <div name="err_price_`+index+`" id="err_price_`+index+`" style="text-align: left; display: none;">
                            <p name="err_price_msg_`+index+`" id="err_price_msg_`+index+`" style="margin-bottom: 0; color: red; font-size: 12px;"></p>
                        </div>
                    </td>
                    <td class="text-center"><buxtton type="button" name="remove" id="button_remove_`+index+`" class="btn btn-danger btn_remove">X</button></td>
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
            document.getElementById("stock_qty_"+index).innerHTML = '';
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

                console.log(tempArr[2]);
                $cek = $('#price_'+tempArr[2]).val();
                console.log($cek);

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
                        document.getElementById("stock_qty_"+tempArr[1]).innerHTML = '';
                        hideQtyErrorMessage(tempArr[1]);

                        /** Get list stock qty */
                        getStockQty(tempArr[1]);

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

        function getStockQty(index) {

            var item = $('#item_'+index+'_id').val();

            /** Reset qty, stock, unit */
            document.getElementById("stock_qty_"+index).innerHTML = '';
            document.getElementById("qty_"+index).value = '';

            $.ajax({
                type: 'GET',
                url: "{{ url('/get-trs-stock-qty') }}",
                dataType: 'json',
                data: {
                    item_id: item,
                },
                success: function(response) {
                    document.getElementById("stock_qty_"+index).innerHTML = response?.quantity;

                    /** Enabled text input */
                    $('#qty_'+index).prop('disabled', false);
                },
                error: function(error) {
                    console.log(error.responseJSON);
                    Swal.fire({
                        icon: 'error',
                        title: "Error",
                        text: error.responseJSON.message ?? 'Failed get list stock quantity',
                    });
                },
            });

        }

        $(document).on('change', '.qty', function() {
            var qtyId = $(this).attr("id");

            var tempArr = qtyId.split("_");
            validateQty(tempArr[1]);
        });

        function validateQty(index) {
            var qty = $('#qty_'+index).val();
            var stockQty = document.getElementById("stock_qty_"+index).innerHTML;

            if (parseInt(qty) > parseInt(stockQty)) {
                showQtyErrorMessage(index, 'Stock not available');
                disableTableRow(index);
            } else {
                hideQtyErrorMessage(index);
                enableTableRow(index);

                $item_id = $('#item_'+index+'_id').val();
                cekSubtotal($item_id, qty, index);
            }
        }

        function cekSubtotal(item_id, qty, index) {
            $.ajax({
                type: 'GET',
                url: "{{ url('/get-trs-subtotal') }}",
                dataType: 'json',
                data: {
                    item_id: item_id,
                },
                success: function(response) {
                    $subtotal = response.price*qty;

                    /** Enabled text input */
                    $('#price_'+index).val($subtotal);

                    getTotalPrice();

                },
                error: function(error) {
                    console.log(error.responseJSON);
                    Swal.fire({
                        icon: 'error',
                        title: "Error",
                        text: error.responseJSON.message ?? 'Failed get subtotal',
                    });
                },
            });
        }

        function getTotalPrice() {

            $('#total_price').val("");
            tampungTotalPrice = 0;

            for (let i = 0; i < indexTable; i++) {

                $subtotal = Number($('#price_'+i).val());
                tampungTotalPrice += $subtotal;

            }

            $('#total_price').val(tampungTotalPrice);

        }

        // ========================= SUBMIT REDEEM =========================
        $(document).on('click', '#button_submit', function(event) {

            event.preventDefault();
            $("#button_submit").prop('disabled', true);

            var transaction_date = $('#transaction_date').val();
            var work_type = $('#select_work_type').val();
            var order_type = $('#select_order_type').val();
            // var payment_status = $('#select_payment_status').val();
            var note = $('#note').val();
            var customer_id = $("#select_customer_name").val();
            var address = $("#address").val();
            var no_telp = $("#phone_number").val();
            var vehicle_number = $("#vehicle_number").val();
            var table = document.getElementById("table_form");
            var detailData = [];

            var total_price = tampungTotalPrice;

            if ( order_type == "" ) {
                order_type = null;
            } else {
                order_type = $('#select_order_type').val();
            }

            /** Prepare data for detail data */
            for (var i = 1, row ; row = table.rows[i] ; i++) {
                var tempArr = row.id.split("_");
                var itemId = $('#item_'+tempArr[1]+'_id').val();
                var qty = $('#qty_'+tempArr[1]).val();
                var subtotal = $('#price_'+tempArr[1]).val();

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
                            subtotal: subtotal,
                        }
                    );
                }
            }

            $.ajax({
                type: 'POST',
                url: "{{ url('/post-trs-submit') }}",
                dataType: 'json',
                data: {
                    transaction_date: transaction_date,
                    work_type: work_type,
                    order_type: order_type,
                    // payment_status: payment_status,
                    note: note,
                    customer_id: customer_id,
                    address: address,
                    no_telp: no_telp,
                    vehicle_number: vehicle_number,
                    detail: detailData,
                    total_price: total_price,
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
                        text: error.responseJSON.message ?? 'Failed submit transaction request',
                    });
                    $("#button_submit").prop('disabled', false);
                },
            });

        });

    </script>

@endsection
