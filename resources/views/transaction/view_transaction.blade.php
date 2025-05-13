@extends('inventory.layouts.main')

@section('container')

<div class="content">

    {{-- TITLE --}}
    <div class="title_n_button">
        <h4 class="title" style="margin-left: 0px">FORM OF REDEEM</h4>
    </div>

    <hr>

    <div class="form_header" style="padding: 0px 5px">
        <table style="width: 100%;">
            <tr>
                {{-- REDEEM NO --}}
                <td class="label_form">Redeem No.</td>
                <td class="container_input_form">
                    <input type="text" class="form-control input_form" id="redeem_no" value="{{ $red_header_data?->red_no }}" readonly disabled>
                </td>

                {{-- VERTICAL LINE --}}
                <td style="width: 4%" rowspan="2">
                    <hr class="vertical_line">
                </td>

                {{-- FROM SITE --}}
                <td class="label_form">From Store</td>
                <td class="container_input_form">
                    <input type="text" class="form-control input_form" id="from_store" value="{{ $red_header_data?->store_code.' - '.$red_header_data?->site_description }}" readonly disabled>
                </td>
            </tr>
            <tr>
                {{-- REDEEM DATE --}}
                <td class="label_form">Redeem Date</td>
                <td class="container_input_form">
                    <input type="text" class="form-control input_form" id="redeem_date" value="{{ date_format(new DateTime($red_header_data?->red_date), 'd/m/Y') }}" readonly disabled>
                </td>

                {{-- TO SITE --}}
                <td class="label_form">To Customer</td>
                <td class="container_input_form">
                    <input type="text" class="form-control input_form" id="to_supplier" value="{{ $red_header_data?->customer_fullname }}" readonly disabled>
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
            <table class="table tableData table-bordered align-middle table_form" id="table_form" style="width:100%;">
                <thead class="thead">
                    <tr class="text-center" style="width: 100%;">
                        <th class="text-center">Items</th>
                        <th class="text-center" style="width:200px">Redeem Quantity</th>
                    </tr>
                </thead>
                <tbody style="background-color: white">
                    @foreach ( $red_detail_data as $rdd )
                        <tr>
                            <td class="text-center">{{ $rdd?->item_desc . ' - ' . $rdd?->item_code }}</td>
                            <td class="text-center" style="width: 400px">{{ $rdd?->quantity }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

    </div>

</div>

<div class="bottom_space"></div>

@endsection
