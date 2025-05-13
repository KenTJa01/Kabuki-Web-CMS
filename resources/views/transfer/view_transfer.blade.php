@extends('inventory.layouts.main')

@section('container')

<div class="content">

    {{-- TITLE --}}
    <div class="title_n_button">
        <h4 class="title" style="margin-left: 0px">FORM OF TRANSFER</h4>
    </div>

    <hr>

    <div class="form_header" style="padding: 0px 5px">
        <table style="width: 100%;">
            <tr>
                {{-- TRANSFER NO --}}
                <td class="label_form">Transfer No.</td>
                <td class="container_input_form">
                    <input type="text" class="form-control input_form" id="transfer_no" value="{{ $trf_header_data?->trf_no }}" readonly disabled>
                </td>

                {{-- VERTICAL LINE --}}
                <td style="width: 4%" rowspan="2">
                    <hr class="vertical_line">
                </td>

                {{-- FROM SITE --}}
                <td class="label_form">From Store</td>
                <td class="container_input_form">
                    <input type="text" class="form-control input_form" id="from_store" value="{{ $trf_header_data?->store_code_orig.' - '.$trf_header_data?->site_description_orig }}" readonly disabled>
                </td>
            </tr>
            <tr>
                {{-- TRANSFER DATE --}}
                <td class="label_form">Transfer Date</td>
                <td class="container_input_form">
                    <input type="text" class="form-control input_form" id="transfer_date" value="{{ date_format(new DateTime($trf_header_data?->trf_date), 'd/m/Y') }}" readonly disabled>
                </td>

                {{-- TO SITE --}}
                <td class="label_form">To Store</td>
                <td class="container_input_form">
                    <input type="text" class="form-control input_form" id="to_store" value="{{ $trf_header_data?->store_code_dest.' - '.$trf_header_data?->site_description_dest }}" readonly disabled>
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
                        <th class="text-center" style="width:200px">Transfer Quantity</th>
                    </tr>
                </thead>
                <tbody style="background-color: white">
                    @foreach ( $trf_detail_data as $tdd )
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

<div class="bottom_space"></div>

@endsection
