@extends("inventory.layouts.main")
@section("container")

    <div class="content">

        {{-- TITLE --}}
        <div class="title_n_button">
            <h4 class="title" style="margin-left: 0px">FORM OF STOCK OPNAME</h4>
        </div>

        <hr>

        <div class="form_header" style="padding: 0px 5px">
            <table style="width: 100%;">
                <tr>
                    {{-- SO NO --}}
                    <td class="label_form">Stock Opname No.</td>
                    <td class="container_input_form">
                        <input type="text" class="form-control input_form" id="stock_opname_date" value="{{ $so_header_data->so_no }}" readonly disabled>
                    </td>

                    {{-- VERTICAL LINE --}}
                    <td style="width: 4%" rowspan="2">
                        <hr class="vertical_line" style="height: 40px">
                    </td>

                    {{-- STORE --}}
                    <td class="label_form">Store</td>
                    <td class="container_input_form">
                        <input type="text" class="form-control input_form" name="input_site"input_site id="input_site" value="{{ $so_header_data->site_code }}" readonly disabled>
                    </td>
                </tr>
                <tr>
                    {{-- SO DATE --}}
                    <td class="label_form">Date</td>
                    <td class="container_input_form">
                        <input type="text" class="form-control input_form" id="stock_opname_date" value="{{ $so_header_data->so_date }}" readonly disabled>
                    </td>

                    <td></td>
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
                            <th class="text-center">Quantity Counted</th>
                        </tr>
                    </thead>
                    <tbody style="background-color: white">
                        @foreach ( $so_detail_data as $sdd )
                            <tr id="{{ 'row_'.$sdd->detail_id }}">
                                <td class="text-center">{{ $sdd?->item_desc . ' - ' . $sdd?->item_code }}</td>
                                <td class="text-center"><input type="number" min="0" class="form-control input_form" name="{{ 'qty_'.$sdd->detail_id }}" id="{{ 'qty_'.$sdd->detail_id }}" value="{{ $sdd->after_quantity }}"></td>
                            </tr>
                        @endforeach
                    </tbody>
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
        <button class="button_submit_form mt-2" id="button_submit">Save</button>
    </div>

    <div class="bottom_space"></div>

    <script>
        $(document).on('click', '#button_submit', function(event) {

            event.preventDefault();
            $("#btn-submit").prop('disabled', true);

            var headerId = '{{ $so_header_data?->so_id }}';
            var table = document.getElementById("table_form");
            var detailData = [];

            /** Prepare data for detail data */
            for (var i = 1, row ; row = table.rows[i] ; i++) {
                var tempArr = row.id.split("_");
                var detailId = tempArr[1];

                var qty = $('#qty_'+tempArr[1]).val();

                /** Append to array detail */
                detailData.push(
                    {
                        detail_id: detailId,
                        qty: qty,
                    }
                );
            }

            $.ajax({
                type: 'POST',
                url: "{{ url('/post-stock-opname-input-stock') }}",
                dataType: 'json',
                data: {
                    header_id: headerId,
                    detail: detailData,
                },
                success: function(response) {

                    /** Disable all input field */
                    // disableTableRow();

                    return Swal.fire({
                        title: response.title,
                        text: response.message,
                        timer: 5000,
                        icon: "success",
                        timerProgressBar: true,
                        showConfirmButton: true,
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
                        text: error.responseJSON.message ?? 'Failed submit input stock',
                    });
                    $("#btn-submit").prop('disabled', false);
                },
            });
        });
    </script>

@endsection
