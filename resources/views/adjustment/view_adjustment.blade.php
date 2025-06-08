@extends('layouts.main')

@section('container')

<div class="content">

    {{-- TITLE --}}
    <div class="title_n_button">
        <h4 class="title" style="margin-left: 0px">FORM OF ADJUSTMENT</h4>
    </div>

    <hr>

    <div class="form_header" style="padding: 0px 5px">
        <table style="width: 100%;">
            <tr>
                {{-- ADJUSTMENT NO --}}
                <td class="label_form">Adjustment No.</td>
                <td class="container_input_form">
                    <input type="text" class="form-control input_form" id="ADJUSTMENT_no" value="{{ $adj_header_data?->adj_no }}" readonly disabled>
                </td>

                {{-- VERTICAL LINE --}}
                <td style="width: 4%">
                    <hr class="vertical_line_one_row">
                </td>

                {{-- ADJUSTMENT DATE --}}
                <td class="label_form">Adjustment Date</td>
                <td class="container_input_form">
                    <input type="text" class="form-control input_form" id="ADJUSTMENT_date" value="{{ date_format(new DateTime($adj_header_data?->adj_date), 'd/m/Y') }}" readonly disabled>
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
                        <th class="text-center" style="width:200px">Reason</th>
                        <th class="text-center">Before Adjustment</th>
                        <th class="text-center">Adjust Qty</th>
                        <th class="text-center">After Adjustment</th>
                    </tr>
                </thead>
                <tbody style="background-color: white">
                    @foreach ( $adj_detail_data as $add )
                        <tr>
                            <td class="text-center">{{ $add?->item_desc . ' - ' . $add?->item_code }}</td>
                            <td class="text-center" style="width: 100px">{{ $add?->reason }}</td>
                            <td class="text-center" style="width: 200px">{{ $add?->stock_before_adj }}</td>
                            <td class="text-center" style="width: 150px">{{ $add?->adj_qty }}</td>
                            <td class="text-center" style="width: 200px">{{ $add?->stock_after_adj }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

    </div>

</div>

<div class="bottom_space"></div>

@endsection
