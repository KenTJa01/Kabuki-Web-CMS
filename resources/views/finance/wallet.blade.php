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

                <h4 class="title" style="margin-left: 0px;">MY WALLET</h4>

                <div class="user_guide active text-center">
                    <font class="text_tooltip">i</font>
                    <span class="user_guide_tooltip">You can manage the master data of DGM's gift items here.</span>
                </div>
            </div>
        </div>

        <hr>

        <div class="row input_modal">
            <label for="username" class="col-sm-2 col-form-label">Total Amount</label>
            <div class="col-sm-10">
                <input type="number" class="form-control" value="{{ $walletData->amount }}" disabled readonly>
            </div>
        </div>
        <div class="row input_modal">
            <label for="name" class="col-sm-2 col-form-label">Total Income</label>
            <div class="col-sm-10">
                <input type="number" class="form-control" value="{{ $totalIncome->total_income }}" disabled readonly>
            </div>
        </div>
        <div class="row input_modal">
            <label for="password" class="col-sm-2 col-form-label">Total Expense</label>
            <div class="col-sm-10">
                <input type="number" class="form-control" value="{{ $totalExpense->total_expense }}" disabled readonly>
            </div>
        </div>


    </div>
    <div class="bottom_space"></div>

    {{-- MODAL NEW CREATION --}}
    <div class="modal fade" id="newCreationModal" tabindex="-1" aria-labelledby="newCreationModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content" style="border: 0px;">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="newCreationModalLabel">CREATE NEW USER</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row input_modal">
                        <label for="username" class="col-sm-3 col-form-label">Username</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="username" placeholder="Enter username">
                        </div>
                    </div>
                    <div class="row input_modal">
                        <label for="name" class="col-sm-3 col-form-label">Name</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="name" placeholder="Enter name">
                        </div>
                    </div>
                    <div class="row input_modal">
                        <label for="password" class="col-sm-3 col-form-label">Password</label>
                        <div class="col-sm-9">
                            <input type="password" class="form-control" id="password" placeholder="Enter password">
                        </div>
                    </div>
                    <div class="row input_modal">
                        <label for="select_profile" class="col-sm-3 col-form-label">Profile</label>
                        <div class="col-sm-9">
                            <select name="select_profile" id="select_profile" class="form-select" style="width: 100%;">
                                <option value="" disabled>Select profile</option>
                            </select>
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
        <div class="modal-dialog">
            <div class="modal-content" style="border: 0px;">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="editModalLabel">EDIT USER</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="id" id="user_id_edit">
                    <div class="row input_modal">
                        <label for="username_edit" class="col-sm-3 col-form-label">Username</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="username_edit" placeholder="Enter username">
                        </div>
                    </div>
                    <div class="row input_modal">
                        <label for="name_edit" class="col-sm-3 col-form-label">Name</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="name_edit" placeholder="Enter name">
                        </div>
                    </div>
                    <div class="row input_modal">
                        <label for="select_profile_edit" class="col-sm-3 col-form-label">Profile</label>
                        <div class="col-sm-9">
                            <select name="select_profile_edit" id="select_profile_edit" class="form-select" style="width: 100%;">
                                <option value="" disabled>Select profile</option>
                            </select>
                        </div>
                    </div>
                    <div class="row input_modal">
                        <label for="status_edit" class="col-sm-3 col-form-label">Status</label>
                        <div class="col-sm-9">
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
                    {{-- <button type="button" class="button_clear_modal" id="button_clear_modal_edit">Clear</button> --}}
                    <button type="button" class="button_submit_modal" id="button_submit_modal_edit">Submit</button>
                </div>
            </div>
        </div>
    </div>

@endsection
