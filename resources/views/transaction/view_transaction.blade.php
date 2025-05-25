@extends('layouts.main')

@section('container')

<style>

    table thead th, td {
        padding: 5px 0px;
    }

</style>

<div class="content">

    {{-- TITLE --}}
    <div class="title_n_button">
        <h4 class="title" style="margin-left: 0px">VIEW TRANSACTION</h4>
    </div>

    <hr>

    <div class="form_header" style="padding: 0px 5px">
        <table style="width: 100%;">
            <tr>

                {{-- ID TRANSACTION HEADER HIDDEN --}}
                <input type="hidden" id="transaction_header_id" value="{{ $trs_id }}">

                {{-- TRANSACTION DATE --}}
                <td class="label_form">Transaction Date</td>
                <td class="container_input_form">
                    <input type="text" class="form-control input_form" id="transaction_date" value="{{ $trs_header_data->trs_date }}" readonly disabled>
                </td>

                {{-- VERTICAL LINE --}}
                <td style="width: 4%" rowspan="3">
                    <hr class="vertical_line_three_row">
                </td>

                {{-- STATUS --}}
                <input type="hidden" id="payment_status_id" value="{{ $trs_header_data->flag }}">
                <td class="label_form">Payment Status</td>
                <td class="container_input_form">
                    <select name="select_payment_status" id="select_payment_status" class="input_form" style="width: 100%;" disabled>
                        <option value="">Select payment status</option>
                    </select>
                </td>
            </tr>
            <tr>
                {{-- WORK TYPE --}}
                <input type="hidden" id="work_type_id" value="{{ $trs_header_data->work_type_id }}">
                <td class="label_form">Work Type</td>
                <td class="container_input_form">
                    <select name="select_work_type" id="select_work_type" class="input_form" style="width: 100%;">
                        <option value="">Select work type</option>
                    </select>
                </td>

                {{-- NOTE --}}
                <td class="label_form">Note</td>
                <td class="container_input_form" rowspan="2">
                    <textarea class="form-control" id="note" cols="50" rows="3" style="resize: none;" readonly disabled>{{ $trs_header_data->note }}</textarea>
                </td>
            </tr>
            <tr>
                {{-- ORDER TYPE --}}
                <input type="hidden" id="order_type_id" value="{{ $trs_header_data->order_type_id }}">
                <td class="label_form">Order Type</td>
                <td class="container_input_form">
                    <select name="select_order_type" id="select_order_type" class="input_form" style="width: 100%;">
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
                <input type="text" class="form-control" id="customer_name" value="{{ $trs_header_data->customer_fullname }}" readonly disabled>
            </td>
        </tr>
    </table>

    <table style="width: 100%; margin-top: 6px">
        <tr>

            {{-- CUSTOMER NAME --}}
            <td class="label_form">Address</td>
            <td class="container_input_form" rowspan=2>
                <textarea class="form-control" id="address" rows="3" cols="50" style="resize: none;" readonly disabled>{{ $trs_header_data->address }}</textarea>
                {{-- <input type="text" class="form-control input_form" id="customer_name" readonly disabled> --}}
            </td>

            {{-- VERTICAL LINE --}}
            <td style="width: 4%" rowspan="2">
                <hr class="vertical_line_two_row">
            </td>

            {{-- PHONE NUMBER --}}
            <td class="label_form phone_number" id="label_phone_number">Phone Number</td>
            <td class="container_input_form phone_number" id="input_phone_number" style="margin: 0; padding: 0;">
                <input type="text" class="form-control input_form" id="phone_number" value="{{ $trs_header_data->no_telp }}" readonly disabled>
            </td>

        </tr>
        <tr>

            <td></td>

            {{-- NO MEMBER --}}
            <td class="label_form label_vehicle_number" id="label_vehicle_number">Vehicle Number</td>
            <td class="container_input_form label_vehicle_number" id="input_vehicle_number" style="margin: 0; padding: 0;">
                <input type="text" class="form-control input_form" id="vehicle_number" value="{{ $trs_header_data->vehicle_number }}" disabled>
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
            <table class="table tableData table-bordered align-middle table_form" id="table_form" style="width:100%;">
                <thead class="thead">
                    <tr class="text-center" style="width: 100%;">
                        <th class="text-center">Items</th>
                        <th class="text-center" style="width:200px">Redeem Quantity</th>
                    </tr>
                </thead>
                <tbody style="background-color: white">
                    @foreach ( $trs_detail_data as $tdd )
                        <tr>
                            <td class="text-center">{{ $tdd?->item_desc . ' - ' . $tdd?->item_code }}</td>
                            <td class="text-center" style="width: 400px">{{ $tdd?->quantity }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
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

        $('#select_work_type').select2();
        $('#select_order_type').select2();
        $('#select_payment_status').select2();

        const id_work_type = $('#work_type_id').val();
        const id_order_type = $('#order_type_id').val();
        const id_payment_status = $('#payment_status_id').val();

        getOldWorkTypeData(id_work_type);
        getOldOrderTypeData(id_order_type);
        getOldPaymentStatusData(id_payment_status);

    });

    function getOldWorkTypeData(id_work_type)
    {

        $.ajax({
            type: 'GET',
            url: "{{ url('/get-all-data-work-type') }}",
            dataType: 'json',
            data: {},
            success: function(response) {

                $.each(response,function(key, value)
                {
                    if ( value.id == id_work_type ) {
                        $("#select_work_type").append('<option value="' + value.id + '" selected>' + value.work_type_name + '</option>');
                    } else {
                        $("#select_work_type").append('<option value="' + value.id + '">' + value.work_type_name + '</option>');
                    }
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

    function getOldOrderTypeData(id_order_type)
    {

        $.ajax({
            type: 'GET',
            url: "{{ url('/get-all-data-order-type') }}",
            dataType: 'json',
            data: {},
            success: function(response) {

                $.each(response,function(key, value)
                {
                    if ( value.id == id_order_type ) {
                        $("#select_order_type").append('<option value="' + value.id + '" selected>' + value.order_type_name + '</option>');
                    } else {
                        $("#select_order_type").append('<option value="' + value.id + '">' + value.order_type_name + '</option>');
                    }
                });

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

    function getOldPaymentStatusData(id_payment_status)
    {

        $.ajax({
            type: 'GET',
            url: "{{ url('/get-all-data-payment-status') }}",
            dataType: 'json',
            data: {},
            success: function(response) {

                $.each(response,function(key, value)
                {
                    if ( value.id == id_payment_status ) {
                        $("#select_payment_status").append('<option value="' + value.id + '" selected>' + value.flag_desc + '</option>');
                    } else {
                        $("#select_payment_status").append('<option value="' + value.id + '">' + value.flag_desc + '</option>');
                    }
                });

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

    // ========================= SUBMIT TRANSACTION =========================
    $(document).on('click', '#button_submit', function(event) {

        event.preventDefault();
        $("#button_submit").prop('disabled', true);

        var id_trs_header = $('#transaction_header_id').val();
        var work_type = $('#select_work_type').val();
        var order_type = $('#select_order_type').val();

        $.ajax({
            type: 'POST',
            url: "{{ url('/post-trs-on-process-submit') }}",
            dataType: 'json',
            data: {
                id_trs_header: id_trs_header,
                work_type: work_type,
                order_type: order_type,
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
