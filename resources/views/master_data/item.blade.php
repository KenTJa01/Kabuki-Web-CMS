@extends(" layouts.main")
@section("container")

    <style>
        .select2-container .select2-selection {
            height: 147px;
            border: 1px solid #DEE2E6;
            border-radius: 0.375rem;
        }

        #select_category {
            overflow: hidden;
        }

        #select_supplier {
            border: 1px solid #DEE2E6;
            border-radius: 0.375rem;
        }

        #select_supplier + .select2-container .select2-selection {
            overflow-y: auto !important;
        }

        #select_supplier_edit {
            border: 1px solid #DEE2E6;
            border-radius: 0.375rem;
        }

        #select_supplier_edit + .select2-container .select2-selection {
            overflow-y: auto !important;
        }

    </style>

    <div class="content">

        {{-- TITLE & BUTTON NEW --}}
        <div class="title_n_button justify-content-between">
            <div style="display: flex">
                {{-- @if ( $permission_create != null ) --}}
                    <button class="button_new" id="button_new" data-bs-toggle="modal" data-bs-target="#newCreationModal">
                        <svg xmlns="http://www.w3.org/2000/svg" style="margin-top: -3px" width="20" viewBox="0 0 24 24" stroke-width="3.5" stroke-linejoin="round" stroke-linecap="round" stroke="currentColor" height="20" fill="none" class="svg"><line y2="19" y1="5" x2="12" x1="12"></line><line y2="12" y1="12" x2="19" x1="5"></line></svg>
                        New
                    </button>
                {{-- @endif --}}

                <h4 class="title">LIST OF ITEMS</h4>

                <div class="user_guide active text-center">
                    <font class="text_tooltip">i</font>
                    <span class="user_guide_tooltip">You can manage the master data of DGM's gift items here.</span>
                </div>
            </div>
            <div>
                {{-- @if ( $permission_export != null ) --}}
                <button class="button_export" id="buttonExport">Export</button>
                {{-- @endif --}}
            </div>
        </div>

        <hr>

        <div class="container_table">
            <table id="tableData" class="table table-striped table-bordered tableData dataTables_scrollBody">
                <thead>
                    <tr>
                        <th style="width: 50px" class="top_left_tableData">No.</th>
                        <th style="width: 120px">Item Code</th>
                        <th>Item Name</th>
                        <th>Item Description</th>
                        <th>Category</th>
                        <th>Supplier</th>
                        <th style="width: 120px">Status</th>
                        <th style="width: 120px" class="top_right_tableData">Action</th>
                    </tr>
                </thead>
                <tbody></tbody>
                <tfoot>
                    <tr>
                        <th style="width: 50px" class="bottom_left_tableData"></th>
                        <th style="width: 120px">Item Code</th>
                        <th>Item Name</th>
                        <th>Item Description</th>
                        <th>Category</th>
                        <th>Supplier</th>
                        <th style="width: 120px"></th>
                        <th style="width: 120px" class="bottom_right_tableData"></th>
                    </tr>
                </tfoot>
            </table>
        </div>

    </div>
    <div class="bottom_space"></div>

    {{-- MODAL NEW CREATION --}}
    <div class="modal fade" id="newCreationModal" tabindex="-1" aria-labelledby="newCreationModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content" style="border: 0px;">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="newCreationModalLabel">CREATE NEW ITEM</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row input_modal">
                        <label for="item_name" class="col-sm-3 col-form-label">Item Name</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="item_name" placeholder="Enter name">
                        </div>
                    </div>
                    <div class="row input_modal">
                        <label for="item_description" class="col-sm-3 col-form-label">Description</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="item_description" placeholder="Enter description">
                        </div>
                    </div>
                    <div class="row input_modal">
                        <label for="price" class="col-sm-3 col-form-label">Price</label>
                        <div class="col-sm-9">
                            <input type="number" class="form-control" id="price" placeholder="Enter description">
                        </div>
                    </div>
                    <div class="row input_modal">
                        <label for="status" class="col-sm-3 col-form-label">Status</label>
                        <div class="col-sm-9">
                            <div style="width: 75px;">
                                <div class="container_toggle">
                                    <input type="checkbox" class="checkbox" id="status" value="1" checked>
                                    <label class="switch" for="status">
                                        <span class="slider"></span>
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="button_clear_modal" id="button_clear_modal">Clear</button>
                    <button type="button" class="button_submit_modal" id="button_submit_modal">Submit</button>
                </div>
            </div>
        </div>
    </div>

    {{-- MODAL EDIT --}}
    <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content" style="border: 0px;">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="editModalLabel">EDIT ITEM</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="id" id="item_id_edit">
                    <div class="row input_modal">
                        <label for="item_code_edit" class="col-sm-2 col-form-label">Item Code</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="item_code_edit" disabled placeholder="Enter code">
                        </div>
                    </div>
                    <div class="row input_modal">
                        <label for="item_name_edit" class="col-sm-2 col-form-label">Item Name</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="item_name_edit" placeholder="Enter name">
                        </div>
                    </div>
                    <div class="row input_modal">
                        <label for="item_description_edit" class="col-sm-2 col-form-label">Description</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="item_description_edit" placeholder="Enter description">
                        </div>
                    </div>
                    <div class="row input_modal">
                        <label for="select_category_edit" class="col-sm-2 col-form-label">Category</label>
                        <div class="col-sm-10">
                            <select name="select_category_edit" id="select_category_edit" class="form-select" style="width: 100%;">
                                <option value="">Select category</option>
                            </select>
                        </div>
                    </div>
                    <div class="row input_modal">
                        <label for="select_supplier_edit" class="col-sm-2 col-form-label">Supplier</label>
                        <div class="col-sm-10">
                            <select name="select_supplier_edit" id="select_supplier_edit" class="form-select" style="width: 100%;"></select>
                        </div>
                    </div>
                    <div class="row input_modal">
                        <label for="status_edit" class="col-sm-2 col-form-label">Status</label>
                        <div class="col-sm-10">
                            <div style="width: 75px;">
                                <div class="container_toggle">
                                    <input type="checkbox" class="checkbox" id="status_edit" value="1" checked>
                                    <label class="switch" for="status_edit">
                                        <span class="slider"></span>
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="button_clear_modal" id="button_clear_modal_edit">Clear</button>
                    <button type="button" class="button_submit_modal" id="button_submit_modal_edit">Submit</button>
                </div>
            </div>
        </div>
    </div>



@endsection
