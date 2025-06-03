@extends('layouts.document')
@section('containter')
<style>
    /* * {
        font-family: "Poppins", Arial, sans-serif;
    } */
    .table-data {
        width: 100%;
        text-align: center;
    }
    .table-data tr td {
        border: 1px solid black;
    }
    .table-data td {
        padding-top: 10px;
        padding-bottom: 10px;
    }
    .table-sign {
        width: 50%;
        text-align: center;
    }
    .table-sign tr {
        border: 1px solid black;
    }
    .tr-h-100 {
        height: 100px;
    }
</style>
<div class="row">
    <div class="col text-center" id="title">
        <h3 style="font-weight: 500; text-decoration: underline;">TRANSACTION INVOICE</h2>
    </div>
    <div class="container text-center mt-3" align="center" style="max-width:100%; margin-top: -10px">
        <div class="row" style="margin: 5px">
            <div class="col" style="padding-left: 0px;">
                <table style="color: black; width: 100%;">
                    <tr>
                        <td class="text-left font-weight-bold" style="font-size: 18px;">TRANSFER NO. {{ $trs_header_data?->trs_no }}</td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td class="text-left" style="font-size: 16px">
                            CUSTOMER NAME : {{ $trs_header_data?->customer_fullname }}
                        </td>
                    </tr>
                    <tr>
                        <td class="text-right" style="font-size: 16px">Date {{ date_format(new DateTime($trs_header_data?->trs_date), 'd/m/Y') }}</td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td class="text-left" style="font-size: 16px">
                            No. Telp : {{ $trs_header_data?->no_telp }}
                        </td>
                    </tr>
                </table>
            </div>
        </div>
        <div class="row" align="center">
            <div class="col-sm">
                <table class="table-data">
                    <thead>
                        <tr class="text-center font-weight-bold">
                            <td>Product Category</td>
                            <td>Qty</td>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($trs_detail_data as $d)
                        <tr>
                            <td>{{ $d?->item_code.' - '.$d?->item_desc }}</td>
                            <td>{{ $d?->quantity }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <div class="row pt-4" align="center">
            <div class="col-sm">
                <table class="table-sign">
                    <tr>
                        <td>ADMIN</td>
                    </tr>
                    <tr class="tr-h-100">
                        <td></td>
                    </tr>
                </table>
            </div>
            <div class="col-sm"></div>
            <div class="col-sm">
                <table class="table-sign">
                    <tr>
                        <td>CUSTOMER</td>
                    </tr>
                    <tr class="tr-h-100">
                        <td></td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
</div>
<script>
    $(document).ready(function () {
        window.print();
     });
</script>
@endsection
