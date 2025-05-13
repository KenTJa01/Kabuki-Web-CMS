@extends('inventory.layouts.main')

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
                {{-- RECEIVING NO --}}
                <td class="label_form">Receiving No.</td>
                <td class="container_input_form">
                    <input type="text" class="form-control input_form" id="receiving_no" value="{{ $rec_header_data?->rec_no }}" readonly disabled>
                </td>

                {{-- VERTICAL LINE --}}
                <td style="width: 4%" rowspan="3">
                    <hr class="vertical_line">
                </td>

                {{-- SITE --}}
                <td class="label_form">Site</td>
                <td class="container_input_form">
                    <input type="text" class="form-control input_form" id="site" value="{{ $rec_header_data?->to_store_code.' - '.$rec_header_data?->to_site_description }}" readonly disabled>
                </td>
            </tr>
            <tr>
                {{-- RECEIVING DATE --}}
                <td class="label_form">Receiving Date</td>
                <td class="container_input_form">
                    <input type="text" class="form-control input_form" id="receiving_date" value="{{ date_format(new DateTime($rec_header_data?->rec_date), 'd/m/Y') }}" readonly disabled>
                </td>



                @if ( $rec_type == 'Transfer' )
                    <td class="label_form">From {{ $rec_type }}</td>
                    <td>
                        <input type="text" class="form-control input_form" name="siteFrom" id="siteFrom" value="{{ $from_sup_site->site_code.' - '.$from_sup_site->store_code.' - '.$from_sup_site->site_description }}" readonly disabled>

                    </td>
                @else
                    <td class="label_form">From {{ $rec_type }}</td>
                    <td>
                        <input type="text" class="form-control input_form" name="siteFrom" id="siteFrom" value="{{ $rec_header_data->supplier_name }}" readonly disabled>
                    </td>
                @endif
            </tr>
            <tr>
                {{-- TYPE --}}
                <td class="label_form">Type</td>
                <td class="container_input_form">
                    <input type="text" class="form-control input_form" value="{{ $rec_type }}" readonly disabled>
                </td>
            </tr>
        </table>
    </div>
</div>

@if ( $rec_type == 'Supplier' )
    {{-- INPUT NOMOR FAKTUR --}}
    <div class="content mt-2" id="content_no_faktur">
        <table style="width: 100%;">
            <tr>
                <td class="" style="width: 13%">Invoice Number</td>
                <td class="" style="width: 87%">
                    <input type="text" class="form-control input_form" id="invoice_number" value="{{ $rec_header_data->invoice_no }}" readonly disabled>
                </td>
            </tr>
        </table>
    </div>
@endif

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
