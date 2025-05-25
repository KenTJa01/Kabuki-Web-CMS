@extends('layouts.main')

@section('container')

<div class="content">

    {{-- TITLE --}}
    <div class="title_n_button">
        <h4 class="title" style="margin-left: 0px">VIEW RECEIVING DETAIL</h4>
    </div>

    <hr>

    <div class="form_header" style="padding: 0px 5px">
        <table style="width: 100%;">
            <tr>
                {{-- RECEIVING DATE --}}
                <td class="label_form">Receiving Date</td>
                <td class="container_input_form">
                    <input type="text" class="form-control input_form" id="receiving_date" value="{{ $rec_header_data->rec_date }}" readonly disabled>
                </td>

                {{-- VERTICAL LINE --}}
                <td style="width: 4%" rowspan="2">
                    <hr class="vertical_line_two_row">
                </td>

                {{-- SUPPLIER NAME --}}
                <td class="label_form">Supplier Name</td>
                <td class="container_input_form">
                    <input type="text" class="form-control input_form" id="supplier_name" value="{{ $rec_header_data->supp_name }}" readonly disabled>
                </td>
            </tr>
            <tr>
                {{-- INVOICE --}}
                <td class="label_form">Invoice No.</td>
                <td class="container_input_form">
                    <input type="text" class="form-control input_form" id="invoice_no" value="{{ $rec_header_data->invoice_no }}" readonly disabled>
                </td>
            </tr>
        </table>
    </div>
</div>

{{-- TABLE LIST ITEMS --}}
<div class="content mt-2" id="content_table_form">

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
                        <th class="text-center" style="width:200px">Receiving Quantity</th>
                    </tr>
                </thead>
                <tbody style="background-color: white">
                    @foreach ( $rec_detail_data as $rdd )
                        <tr>
                            <td class="text-center">{{ $rdd?->item_desc }}</td>
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
