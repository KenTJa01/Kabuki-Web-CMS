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
            <h4 class="title" style="margin-left: 0px">FORM OF RETURN</h4>

            <div class="user_guide active text-center">
                <font class="text_tooltip">i</font>
                <span class="user_guide_tooltip">You can make new Return here.</span>
            </div>
        </div>

        <hr>

        <div style="margin-top: 0px; padding: 0px 10px">
            <table style="width: 100%;">
                <tr>
                    {{-- REDEEM DATE --}}
                    <td class="label_form">Return Date</td>
                    <td class="container_input_form" style="margin: 0; padding: 0;">
                        <input type="text" class="form-control input_form" id="return_date" readonly disabled>
                    </td>

                    {{-- VERTICAL LINE --}}
                    <td style="width: 4%" rowspan="2">
                        <hr class="vertical_line_two_row">
                    </td>

                    {{-- TO SUPPLIER --}}
                    <td class="label_form supp">To Supplier</td>
                    <td class="container_input_form supp" style="margin: 0; padding: 0;">
                        <select name="select_supplier" id="select_supplier" class="form-select input_form" style="width: 100%;" disabled>
                            <option value="">Select supplier</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    {{-- STORE --}}
                    <td class="label_form">From Store</td>
                    <td class="container_input_form" style="margin: 0; padding: 0;">
                        <select name="select_site" id="select_site" class="input_form" disabled style="width: 100%">
                            <option value="">Select store</option>
                        </select>
                    </td>
                </tr>

            </table>
        </div>
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
                            <th class="text-center" style="width:200px">Return Quantity</th>
                            <th class="text-center" style="width:100px">Action</th>
                        </tr>
                    </thead>
                    <tbody style="background-color: white"></tbody>
                </table>
            </div>

        </div>

        {{-- BUTTON ADD ROW --}}
        <div class="row text-left" id="addRowDiv" style="width: 300px; margin-left: 0px; margin-bottom: 5px">
            <button type="button" id="add" class="btn_add_row" style="display: none;">
                <font style="color: white">+ Add row</font>
            </button>
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
            document.getElementById("return_date").value = todayDate;

            $("#select_site").select2();
            $("#select_supplier").select2();

            $('#select_site').prop('disabled', false);
            getListSite();

            tableItems();

            $(".item").prop('disabled', true);
            $('.btn_remove').prop('disabled', true);

        });

        var indexTable = 3;
        var itemListData = [];

        function getListSite() {

            $.ajax({
                type: 'GET',
                url: "{{ url('/get-user-site-permission') }}",
                dataType: 'json',
                data: {},
                success: function(response) {

                    var data = response;

                    $('#select_site').find('option').remove().end().append();
                    if (data.length != 1) {
                        $('#select_site').append('<option value="" disabled selected>Select store</option>');
                    }
                    for (var i = 0; i < data.length; i++) {
                        text = data[i].store_code+' - '+data[i].site_description;
                        value = data[i].site_id;
                        $('#select_site').append($("<option></option>").attr("value", value).text(text));
                    }

                    if (data.length == 1) {
                        $('#select_supplier').prop('disabled', false);
                        resetTable();
                        getListSupplier();
                        getListItem();
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

        $(document).on('change', '#select_site', function(event){

            $('#select_supplier').prop('disabled', false);
            getListSupplier();

        });

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
                        getListItem();
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

            getListItem();

        });

        function getListItem() {

            var supp_id = $('#select_supplier').val();

            $.ajax({
                type: 'GET',
                url: "{{ url('/get-rtn-item') }}",
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
                        text: error.responseJSON.message ?? 'Failed get list item',
                    });
                },
            });

        }

        function tableItems() {
            document.getElementById('add').style.display = 'block';

            for (var i = 0 ; i < indexTable ; i++) {
                addTableRow(i);
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
                        <div name="err_stock_qty_`+index+`" id="err_stock_qty_`+index+`" style="text-align: left; display: none;">
                            <p name="err_stock_qty_msg_`+index+`" id="err_stock_qty_msg_`+index+`" style="margin-bottom: 0; color: red; font-size: 12px;"></p>
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
            $('#product_'+index).focus();
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
            var buttonId = $(this).attr("id");

            var tempArr = buttonId.split("_");
            $('#row_'+tempArr[2]).remove();

            enableTableRow(tempArr[2]);
            showAddRowButton();
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

            var site = $('#select_site').val();
            var item = $('#item_'+index+'_id').val();

            /** Reset qty, stock, unit */
            document.getElementById("stock_qty_"+index).innerHTML = '';
            document.getElementById("qty_"+index).value = '';

            $.ajax({
                type: 'GET',
                url: "{{ url('/get-rtn-stock-qty') }}",
                dataType: 'json',
                data: {
                    site_id: site,
                    item_id: item,
                },
                success: function(response) {

                    if( response.quantity == null ) {

                        Swal.fire({
                            icon: 'error',
                            title: "Error",
                            text: 'There are no stock in this site',
                        });

                        disableTableRow(index);

                    } else {

                        document.getElementById("stock_qty_"+index).innerHTML = response?.quantity;

                    }


                    /** Enabled text input */
                    $('#qty_'+index).prop('disabled', false);
                },
                error: function(error) {
                    console.log(error.responseJSON);
                    Swal.fire({
                        icon: 'error',
                        title: "Error",
                        text: error.responseJSON.message ?? 'Failed get list product location',
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
            }
        }

        // ========================= SUBMIT RETURN =========================
        $(document).on('click', '#button_submit', function(event) {

            event.preventDefault();
            $("#button_submit").prop('disabled', true);

            var returnDate = $('#return_date').val();
            var site = $('#select_site').val();
            var supplier = $('#select_supplier').val();
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
                url: "{{ url('/post-rtn-submit') }}",
                dataType: 'json',
                data: {
                    return_date: returnDate,
                    site_id: site,
                    note: note,
                    supplier: supplier,
                    detail: detailData,
                },
                success: function(response) {

                    /** Disable all input field */
                    $('#select_site').prop('disabled', true);
                    $('#select_supplier').prop('disabled', true);
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
                        text: error.responseJSON.message ?? 'Failed submit transfer request',
                    });
                    $("#button_submit").prop('disabled', false);
                },
            });
        });

    </script>

@endsection
