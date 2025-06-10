<div class="sidebar">

    {{-- LOGO DGM --}}
    <div class="container_logo align-items-center" style="background-color: #2e2e2e; color: white">
        {{-- <img src="/img/svg/logo-yogya.svg" style="width: 130px; margin-top: 12px"> --}}
        <div class="btn button_dgm_core">
            {{-- <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="white" class="bi bi-grid-fill" viewBox="0 0 16 16" style="margin-top: -5px; margin-right: 2px">
                <path d="M1 2.5A1.5 1.5 0 0 1 2.5 1h3A1.5 1.5 0 0 1 7 2.5v3A1.5 1.5 0 0 1 5.5 7h-3A1.5 1.5 0 0 1 1 5.5zm8 0A1.5 1.5 0 0 1 10.5 1h3A1.5 1.5 0 0 1 15 2.5v3A1.5 1.5 0 0 1 13.5 7h-3A1.5 1.5 0 0 1 9 5.5zm-8 8A1.5 1.5 0 0 1 2.5 9h3A1.5 1.5 0 0 1 7 10.5v3A1.5 1.5 0 0 1 5.5 15h-3A1.5 1.5 0 0 1 1 13.5zm8 0A1.5 1.5 0 0 1 10.5 9h3a1.5 1.5 0 0 1 1.5 1.5v3a1.5 1.5 0 0 1-1.5 1.5h-3A1.5 1.5 0 0 1 9 13.5z"/>
            </svg>
            <strong style="font-size: 20px; color: white">Dashboard</strong> --}}
            <img src="{{ asset('img/logo_kabuki_landscape.svg') }}" style="width: 150px">
        </div>
    </div>

    {{-- MENU SIDEBAR --}}
    <div class="menu_sidebar">
        <nav>
            <ul class="list-unstyled components mb-5 text-left">

                {{-- MENU HOME --}}
                <li id="home" class="{{ Request::routeIs('/home') ? 'active' : '' }} ">
                    <a href="/home">Home</a>
                </li>

                {{-- MENU DATA MASTER --}}
                <li id="master" class="d-none dropend">
                    <a href="#masterSubmenu" id="masterLabel" data-toggle="collapse" aria-expanded="true" class="dropdown-toggle dropdown-sidebar collapsed">Master Data</a>
                    <ul class="collapse list-unstyled" id="masterSubmenu">

                        {{-- USERS --}}
                        <li class="{{ Request::routeIs('/master_data/user') ? 'active' : '' }} d-none" id="master-user">
                            <a href="/master_data/user">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-person-fill" viewBox="0 0 16 16">
                                    <path d="M3 14s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1zm5-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6"/>
                                </svg>
                                User
                            </a>
                        </li>

                        {{-- PROFILE --}}
                        <li class="{{ Request::routeIs('/master_data/profile') ? 'active' : '' }} d-none" id="master-profile">
                            <a href="/master_data/profile">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-person-vcard-fill" viewBox="0 0 16 16">
                                    <path d="M0 4a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v8a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2zm9 1.5a.5.5 0 0 0 .5.5h4a.5.5 0 0 0 0-1h-4a.5.5 0 0 0-.5.5M9 8a.5.5 0 0 0 .5.5h4a.5.5 0 0 0 0-1h-4A.5.5 0 0 0 9 8m1 2.5a.5.5 0 0 0 .5.5h3a.5.5 0 0 0 0-1h-3a.5.5 0 0 0-.5.5m-1 2C9 10.567 7.21 9 5 9c-2.086 0-3.8 1.398-3.984 3.181A1 1 0 0 0 2 13h6.96q.04-.245.04-.5M7 6a2 2 0 1 0-4 0 2 2 0 0 0 4 0"/>
                                </svg>
                                Profile
                            </a>
                        </li>

                        {{-- CUSTOMER --}}
                        <li class="{{ Request::routeIs('/master_data/customer') ? 'active' : '' }} d-none" id="master-customer">
                            <a href="/master_data/customer">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-people-fill" viewBox="0 0 16 16">
                                    <path d="M7 14s-1 0-1-1 1-4 5-4 5 3 5 4-1 1-1 1zm4-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6m-5.784 6A2.24 2.24 0 0 1 5 13c0-1.355.68-2.75 1.936-3.72A6.3 6.3 0 0 0 5 9c-4 0-5 3-5 4s1 1 1 1zM4.5 8a2.5 2.5 0 1 0 0-5 2.5 2.5 0 0 0 0 5"/>
                                </svg>
                                Customers
                            </a>
                        </li>

                        {{-- ITEMS --}}
                        <li class="{{ Request::routeIs('/master_data/item') ? 'active' : '' }} d-none" id="master-item">
                            <a href="/master_data/item">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-box-seam-fill" viewBox="0 0 16 16">
                                    <path fill-rule="evenodd" d="M15.528 2.973a.75.75 0 0 1 .472.696v8.662a.75.75 0 0 1-.472.696l-7.25 2.9a.75.75 0 0 1-.557 0l-7.25-2.9A.75.75 0 0 1 0 12.331V3.669a.75.75 0 0 1 .471-.696L7.443.184l.01-.003.268-.108a.75.75 0 0 1 .558 0l.269.108.01.003zM10.404 2 4.25 4.461 1.846 3.5 1 3.839v.4l6.5 2.6v7.922l.5.2.5-.2V6.84l6.5-2.6v-.4l-.846-.339L8 5.961 5.596 5l6.154-2.461z"/>
                                </svg>
                                Items
                            </a>
                        </li>

                        {{-- WORK TYPE --}}
                        <li class="{{ Request::routeIs('/master_data/work_type') ? 'active' : '' }} d-none" id="master-work-type">
                            <a href="/master_data/work_type">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-tools" viewBox="0 0 16 16">
                                    <path d="M1 0 0 1l2.2 3.081a1 1 0 0 0 .815.419h.07a1 1 0 0 1 .708.293l2.675 2.675-2.617 2.654A3.003 3.003 0 0 0 0 13a3 3 0 1 0 5.878-.851l2.654-2.617.968.968-.305.914a1 1 0 0 0 .242 1.023l3.27 3.27a.997.997 0 0 0 1.414 0l1.586-1.586a.997.997 0 0 0 0-1.414l-3.27-3.27a1 1 0 0 0-1.023-.242L10.5 9.5l-.96-.96 2.68-2.643A3.005 3.005 0 0 0 16 3q0-.405-.102-.777l-2.14 2.141L12 4l-.364-1.757L13.777.102a3 3 0 0 0-3.675 3.68L7.462 6.46 4.793 3.793a1 1 0 0 1-.293-.707v-.071a1 1 0 0 0-.419-.814zm9.646 10.646a.5.5 0 0 1 .708 0l2.914 2.915a.5.5 0 0 1-.707.707l-2.915-2.914a.5.5 0 0 1 0-.708M3 11l.471.242.529.026.287.445.445.287.026.529L5 13l-.242.471-.026.529-.445.287-.287.445-.529.026L3 15l-.471-.242L2 14.732l-.287-.445L1.268 14l-.026-.529L1 13l.242-.471.026-.529.445-.287.287-.445.529-.026z"/>
                                </svg>
                                Work Type
                            </a>
                        </li>

                        {{-- ORDER TYPE --}}
                        <li class="{{ Request::routeIs('/master_data/order_type') ? 'active' : '' }} d-none" id="master-order-type">
                            <a href="/master_data/order_type">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-basket2-fill" viewBox="0 0 16 16">
                                    <path d="M5.929 1.757a.5.5 0 1 0-.858-.514L2.217 6H.5a.5.5 0 0 0-.5.5v1a.5.5 0 0 0 .5.5h.623l1.844 6.456A.75.75 0 0 0 3.69 15h8.622a.75.75 0 0 0 .722-.544L14.877 8h.623a.5.5 0 0 0 .5-.5v-1a.5.5 0 0 0-.5-.5h-1.717L10.93 1.243a.5.5 0 1 0-.858.514L12.617 6H3.383zM4 10a1 1 0 0 1 2 0v2a1 1 0 1 1-2 0zm3 0a1 1 0 0 1 2 0v2a1 1 0 1 1-2 0zm4-1a1 1 0 0 1 1 1v2a1 1 0 1 1-2 0v-2a1 1 0 0 1 1-1"/>
                                </svg>
                                Order Type
                            </a>
                        </li>

                    </ul>
                </li>

                {{-- MENU TRANSACTION --}}
                <li id="transaction" class="d-none dropend">
                    <a href="#transactionSubmenu" id="transactionLabel" data-toggle="collapse" aria-expanded="true" class="dropdown-toggle dropdown-sidebar collapsed">Transaction</a>
                    <ul class="collapse list-unstyled" id="transactionSubmenu">

                        {{-- TRANSACTION FORM --}}
                        <li class="{{ Request::routeIs('/transaction/form') ? 'active' : '' }} d-none" id="form-transaction">
                            <a href="/transaction/form">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-ui-checks" viewBox="0 0 16 16">
                                    <path d="M7 2.5a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-7a.5.5 0 0 1-.5-.5zM2 1a2 2 0 0 0-2 2v2a2 2 0 0 0 2 2h2a2 2 0 0 0 2-2V3a2 2 0 0 0-2-2zm0 8a2 2 0 0 0-2 2v2a2 2 0 0 0 2 2h2a2 2 0 0 0 2-2v-2a2 2 0 0 0-2-2zm.854-3.646a.5.5 0 0 1-.708 0l-1-1a.5.5 0 1 1 .708-.708l.646.647 1.646-1.647a.5.5 0 1 1 .708.708zm0 8a.5.5 0 0 1-.708 0l-1-1a.5.5 0 0 1 .708-.708l.646.647 1.646-1.647a.5.5 0 0 1 .708.708zM7 10.5a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-7a.5.5 0 0 1-.5-.5zm0-5a.5.5 0 0 1 .5-.5h5a.5.5 0 0 1 0 1h-5a.5.5 0 0 1-.5-.5m0 8a.5.5 0 0 1 .5-.5h5a.5.5 0 0 1 0 1h-5a.5.5 0 0 1-.5-.5"/>
                                </svg>
                                Form
                            </a>
                        </li>

                        {{-- TRANSACTION LIST --}}
                        <li class="{{ Request::routeIs('/transaction/list') ? 'active' : '' }} d-none" id="list-transaction">
                            <a href="/transaction/list">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-card-list" viewBox="0 0 16 16">
                                    <path d="M14.5 3a.5.5 0 0 1 .5.5v9a.5.5 0 0 1-.5.5h-13a.5.5 0 0 1-.5-.5v-9a.5.5 0 0 1 .5-.5zm-13-1A1.5 1.5 0 0 0 0 3.5v9A1.5 1.5 0 0 0 1.5 14h13a1.5 1.5 0 0 0 1.5-1.5v-9A1.5 1.5 0 0 0 14.5 2z"/>
                                    <path d="M5 8a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 0 1h-7A.5.5 0 0 1 5 8m0-2.5a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 0 1h-7a.5.5 0 0 1-.5-.5m0 5a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 0 1h-7a.5.5 0 0 1-.5-.5m-1-5a.5.5 0 1 1-1 0 .5.5 0 0 1 1 0M4 8a.5.5 0 1 1-1 0 .5.5 0 0 1 1 0m0 2.5a.5.5 0 1 1-1 0 .5.5 0 0 1 1 0"/>
                                </svg>
                                List
                            </a>
                        </li>

                        {{-- TRANSACTION HISTORY --}}
                        {{-- <li class="{{ Request::routeIs('/transaction/history') ? 'active' : '' }} d-none" id="history-transaction">
                            <a href="/transaction/history">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-clock-history" viewBox="0 0 16 16">
                                    <path d="M8.515 1.019A7 7 0 0 0 8 1V0a8 8 0 0 1 .589.022zm2.004.45a7 7 0 0 0-.985-.299l.219-.976q.576.129 1.126.342zm1.37.71a7 7 0 0 0-.439-.27l.493-.87a8 8 0 0 1 .979.654l-.615.789a7 7 0 0 0-.418-.302zm1.834 1.79a7 7 0 0 0-.653-.796l.724-.69q.406.429.747.91zm.744 1.352a7 7 0 0 0-.214-.468l.893-.45a8 8 0 0 1 .45 1.088l-.95.313a7 7 0 0 0-.179-.483m.53 2.507a7 7 0 0 0-.1-1.025l.985-.17q.1.58.116 1.17zm-.131 1.538q.05-.254.081-.51l.993.123a8 8 0 0 1-.23 1.155l-.964-.267q.069-.247.12-.501m-.952 2.379q.276-.436.486-.908l.914.405q-.24.54-.555 1.038zm-.964 1.205q.183-.183.35-.378l.758.653a8 8 0 0 1-.401.432z"/>
                                    <path d="M8 1a7 7 0 1 0 4.95 11.95l.707.707A8.001 8.001 0 1 1 8 0z"/>
                                    <path d="M7.5 3a.5.5 0 0 1 .5.5v5.21l3.248 1.856a.5.5 0 0 1-.496.868l-3.5-2A.5.5 0 0 1 7 9V3.5a.5.5 0 0 1 .5-.5"/>
                                </svg>
                                History
                            </a>
                        </li> --}}

                    </ul>
                </li>

                <li id="receiving" class="d-none dropend">
                    <a href="#receivingSubmenu" id="receivingLabel" data-toggle="collapse" aria-expanded="true" class="dropdown-toggle dropdown-sidebar collapsed">Receiving</a>
                    <ul class="collapse list-unstyled" id="receivingSubmenu">

                        {{-- RECEIVING FORM --}}
                        <li class="{{ Request::routeIs('/receiving/form') ? 'active' : '' }} d-none" id="form-receiving">
                            <a href="/receiving/form">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-ui-checks" viewBox="0 0 16 16">
                                    <path d="M7 2.5a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-7a.5.5 0 0 1-.5-.5zM2 1a2 2 0 0 0-2 2v2a2 2 0 0 0 2 2h2a2 2 0 0 0 2-2V3a2 2 0 0 0-2-2zm0 8a2 2 0 0 0-2 2v2a2 2 0 0 0 2 2h2a2 2 0 0 0 2-2v-2a2 2 0 0 0-2-2zm.854-3.646a.5.5 0 0 1-.708 0l-1-1a.5.5 0 1 1 .708-.708l.646.647 1.646-1.647a.5.5 0 1 1 .708.708zm0 8a.5.5 0 0 1-.708 0l-1-1a.5.5 0 0 1 .708-.708l.646.647 1.646-1.647a.5.5 0 0 1 .708.708zM7 10.5a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-7a.5.5 0 0 1-.5-.5zm0-5a.5.5 0 0 1 .5-.5h5a.5.5 0 0 1 0 1h-5a.5.5 0 0 1-.5-.5m0 8a.5.5 0 0 1 .5-.5h5a.5.5 0 0 1 0 1h-5a.5.5 0 0 1-.5-.5"/>
                                </svg>
                                Form
                            </a>
                        </li>

                        {{-- RECEIVING LIST --}}
                        <li class="{{ Request::routeIs('/receiving/list') ? 'active' : '' }} d-none" id="list-receiving">
                            <a href="/receiving/list">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-card-list" viewBox="0 0 16 16">
                                    <path d="M14.5 3a.5.5 0 0 1 .5.5v9a.5.5 0 0 1-.5.5h-13a.5.5 0 0 1-.5-.5v-9a.5.5 0 0 1 .5-.5zm-13-1A1.5 1.5 0 0 0 0 3.5v9A1.5 1.5 0 0 0 1.5 14h13a1.5 1.5 0 0 0 1.5-1.5v-9A1.5 1.5 0 0 0 14.5 2z"/>
                                    <path d="M5 8a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 0 1h-7A.5.5 0 0 1 5 8m0-2.5a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 0 1h-7a.5.5 0 0 1-.5-.5m0 5a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 0 1h-7a.5.5 0 0 1-.5-.5m-1-5a.5.5 0 1 1-1 0 .5.5 0 0 1 1 0M4 8a.5.5 0 1 1-1 0 .5.5 0 0 1 1 0m0 2.5a.5.5 0 1 1-1 0 .5.5 0 0 1 1 0"/>
                                </svg>
                                List
                            </a>
                        </li>

                    </ul>
                </li>

                <li id="adjustment" class=" dropend">
                    <a href="#adjustmentSubmenu" id="adjustmentLabel" data-toggle="collapse" aria-expanded="true" class="dropdown-toggle dropdown-sidebar collapsed">Adjustment</a>
                    <ul class="collapse list-unstyled" id="adjustmentSubmenu">

                        {{-- adjustment FORM --}}
                        <li class="{{ Request::routeIs('/adjustment/form') ? 'active' : '' }} " id="form-adjustment">
                            <a href="/adjustment/form">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-ui-checks" viewBox="0 0 16 16">
                                    <path d="M7 2.5a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-7a.5.5 0 0 1-.5-.5zM2 1a2 2 0 0 0-2 2v2a2 2 0 0 0 2 2h2a2 2 0 0 0 2-2V3a2 2 0 0 0-2-2zm0 8a2 2 0 0 0-2 2v2a2 2 0 0 0 2 2h2a2 2 0 0 0 2-2v-2a2 2 0 0 0-2-2zm.854-3.646a.5.5 0 0 1-.708 0l-1-1a.5.5 0 1 1 .708-.708l.646.647 1.646-1.647a.5.5 0 1 1 .708.708zm0 8a.5.5 0 0 1-.708 0l-1-1a.5.5 0 0 1 .708-.708l.646.647 1.646-1.647a.5.5 0 0 1 .708.708zM7 10.5a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-7a.5.5 0 0 1-.5-.5zm0-5a.5.5 0 0 1 .5-.5h5a.5.5 0 0 1 0 1h-5a.5.5 0 0 1-.5-.5m0 8a.5.5 0 0 1 .5-.5h5a.5.5 0 0 1 0 1h-5a.5.5 0 0 1-.5-.5"/>
                                </svg>
                                Form
                            </a>
                        </li>

                        {{-- adjustment LIST --}}
                        <li class="{{ Request::routeIs('/adjustment/list') ? 'active' : '' }} " id="list-adjustment">
                            <a href="/adjustment/list">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-card-list" viewBox="0 0 16 16">
                                    <path d="M14.5 3a.5.5 0 0 1 .5.5v9a.5.5 0 0 1-.5.5h-13a.5.5 0 0 1-.5-.5v-9a.5.5 0 0 1 .5-.5zm-13-1A1.5 1.5 0 0 0 0 3.5v9A1.5 1.5 0 0 0 1.5 14h13a1.5 1.5 0 0 0 1.5-1.5v-9A1.5 1.5 0 0 0 14.5 2z"/>
                                    <path d="M5 8a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 0 1h-7A.5.5 0 0 1 5 8m0-2.5a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 0 1h-7a.5.5 0 0 1-.5-.5m0 5a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 0 1h-7a.5.5 0 0 1-.5-.5m-1-5a.5.5 0 1 1-1 0 .5.5 0 0 1 1 0M4 8a.5.5 0 1 1-1 0 .5.5 0 0 1 1 0m0 2.5a.5.5 0 1 1-1 0 .5.5 0 0 1 1 0"/>
                                </svg>
                                List
                            </a>
                        </li>

                    </ul>
                </li>

                {{-- MENU STOCK --}}
                <li id="stock" class="d-none dropend">
                    <a href="#stockSubmenu" id="stockLabel" data-toggle="collapse" aria-expanded="true" class="dropdown-toggle dropdown-sidebar collapsed">Stock</a>
                    <ul class="collapse list-unstyled" id="stockSubmenu">

                        {{-- STOCK LIST --}}
                        <li class="{{ Request::routeIs('/stock/list') ? 'active' : '' }} d-none" id="list-stock">
                            <a href="/stock/list">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-card-list" viewBox="0 0 16 16">
                                    <path d="M14.5 3a.5.5 0 0 1 .5.5v9a.5.5 0 0 1-.5.5h-13a.5.5 0 0 1-.5-.5v-9a.5.5 0 0 1 .5-.5zm-13-1A1.5 1.5 0 0 0 0 3.5v9A1.5 1.5 0 0 0 1.5 14h13a1.5 1.5 0 0 0 1.5-1.5v-9A1.5 1.5 0 0 0 14.5 2z"/>
                                    <path d="M5 8a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 0 1h-7A.5.5 0 0 1 5 8m0-2.5a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 0 1h-7a.5.5 0 0 1-.5-.5m0 5a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 0 1h-7a.5.5 0 0 1-.5-.5m-1-5a.5.5 0 1 1-1 0 .5.5 0 0 1 1 0M4 8a.5.5 0 1 1-1 0 .5.5 0 0 1 1 0m0 2.5a.5.5 0 1 1-1 0 .5.5 0 0 1 1 0"/>
                                </svg>
                                List
                            </a>
                        </li>

                        {{-- STOCK FORM --}}
                        <li class="{{ Request::routeIs('/stock/movement') ? 'active' : '' }} d-none" id="movement-stock">
                            <a href="/stock/movement">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-left-right" viewBox="0 0 16 16">
                                    <path fill-rule="evenodd" d="M1 11.5a.5.5 0 0 0 .5.5h11.793l-3.147 3.146a.5.5 0 0 0 .708.708l4-4a.5.5 0 0 0 0-.708l-4-4a.5.5 0 0 0-.708.708L13.293 11H1.5a.5.5 0 0 0-.5.5m14-7a.5.5 0 0 1-.5.5H2.707l3.147 3.146a.5.5 0 1 1-.708.708l-4-4a.5.5 0 0 1 0-.708l4-4a.5.5 0 1 1 .708.708L2.707 4H14.5a.5.5 0 0 1 .5.5"/>
                                </svg>
                                Movement
                            </a>
                        </li>
                    </ul>
                </li>

                {{-- MENU FINANCE --}}
                <li id="finance" class="d-none dropend">
                    <a href="#financeSubmenu" id="financeLabel" data-toggle="collapse" aria-expanded="true" class="dropdown-toggle dropdown-sidebar collapsed">Finance</a>
                    <ul class="collapse list-unstyled" id="financeSubmenu">

                        {{-- FINANCE INCOME --}}
                        <li class="{{ Request::routeIs('/finance/income') ? 'active' : '' }} d-none" id="list-finance">
                            <a href="/finance/income">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-piggy-bank-fill" viewBox="0 0 16 16">
                                    <path d="M7.964 1.527c-2.977 0-5.571 1.704-6.32 4.125h-.55A1 1 0 0 0 .11 6.824l.254 1.46a1.5 1.5 0 0 0 1.478 1.243h.263c.3.513.688.978 1.145 1.382l-.729 2.477a.5.5 0 0 0 .48.641h2a.5.5 0 0 0 .471-.332l.482-1.351c.635.173 1.31.267 2.011.267.707 0 1.388-.095 2.028-.272l.543 1.372a.5.5 0 0 0 .465.316h2a.5.5 0 0 0 .478-.645l-.761-2.506C13.81 9.895 14.5 8.559 14.5 7.069q0-.218-.02-.431c.261-.11.508-.266.705-.444.315.306.815.306.815-.417 0 .223-.5.223-.461-.026a1 1 0 0 0 .09-.255.7.7 0 0 0-.202-.645.58.58 0 0 0-.707-.098.74.74 0 0 0-.375.562c-.024.243.082.48.32.654a2 2 0 0 1-.259.153c-.534-2.664-3.284-4.595-6.442-4.595m7.173 3.876a.6.6 0 0 1-.098.21l-.044-.025c-.146-.09-.157-.175-.152-.223a.24.24 0 0 1 .117-.173c.049-.027.08-.021.113.012a.2.2 0 0 1 .064.199m-8.999-.65a.5.5 0 1 1-.276-.96A7.6 7.6 0 0 1 7.964 3.5c.763 0 1.497.11 2.18.315a.5.5 0 1 1-.287.958A6.6 6.6 0 0 0 7.964 4.5c-.64 0-1.255.09-1.826.254ZM5 6.25a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0"/>
                                </svg>
                                Income
                            </a>
                        </li>

                        {{-- FINANCE EXPENSE --}}
                        <li class="{{ Request::routeIs('/finance/expense') ? 'active' : '' }} d-none" id="expense-finance">
                            <a href="/finance/expense">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-cash-coin" viewBox="0 0 16 16">
                                    <path fill-rule="evenodd" d="M11 15a4 4 0 1 0 0-8 4 4 0 0 0 0 8m5-4a5 5 0 1 1-10 0 5 5 0 0 1 10 0"/>
                                    <path d="M9.438 11.944c.047.596.518 1.06 1.363 1.116v.44h.375v-.443c.875-.061 1.386-.529 1.386-1.207 0-.618-.39-.936-1.09-1.1l-.296-.07v-1.2c.376.043.614.248.671.532h.658c-.047-.575-.54-1.024-1.329-1.073V8.5h-.375v.45c-.747.073-1.255.522-1.255 1.158 0 .562.378.92 1.007 1.066l.248.061v1.272c-.384-.058-.639-.27-.696-.563h-.668zm1.36-1.354c-.369-.085-.569-.26-.569-.522 0-.294.216-.514.572-.578v1.1zm.432.746c.449.104.655.272.655.569 0 .339-.257.571-.709.614v-1.195z"/>
                                    <path d="M1 0a1 1 0 0 0-1 1v8a1 1 0 0 0 1 1h4.083q.088-.517.258-1H3a2 2 0 0 0-2-2V3a2 2 0 0 0 2-2h10a2 2 0 0 0 2 2v3.528c.38.34.717.728 1 1.154V1a1 1 0 0 0-1-1z"/>
                                    <path d="M9.998 5.083 10 5a2 2 0 1 0-3.132 1.65 6 6 0 0 1 3.13-1.567"/>
                                </svg>
                                Expense
                            </a>
                        </li>

                        {{-- FINANCE WALLET --}}
                        <li class="{{ Request::routeIs('/finance/wallet') ? 'active' : '' }} d-none" id="wallet-finance">
                            <a href="/finance/wallet">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-wallet2" viewBox="0 0 16 16">
                                    <path d="M12.136.326A1.5 1.5 0 0 1 14 1.78V3h.5A1.5 1.5 0 0 1 16 4.5v9a1.5 1.5 0 0 1-1.5 1.5h-13A1.5 1.5 0 0 1 0 13.5v-9a1.5 1.5 0 0 1 1.432-1.499zM5.562 3H13V1.78a.5.5 0 0 0-.621-.484zM1.5 4a.5.5 0 0 0-.5.5v9a.5.5 0 0 0 .5.5h13a.5.5 0 0 0 .5-.5v-9a.5.5 0 0 0-.5-.5z"/>
                                </svg>
                                My Wallet
                            </a>
                        </li>
                    </ul>
                </li>

            </ul>
            <br><br>
        </nav>
    </div>

    <div class="copyright">


        <form action="/logout" method="post">
            @csrf
            <button class="btn" style="background-color:rgb(31, 31, 31); color: white; width: 90%; margin: 0px 10px 0px 10px; padding: 10px 0 10px 0; font-size: 14px; font-weight: 600; border-radius: 10px">Logout</button>
        </form>

    </div>

    {{-- <div class="copyright">
        © 1TCS 2024. All rights reserved.
    </div> --}}

</div>

@php
    $listMenu = Session::get('listMenu');
@endphp

<script>

    const home = document.getElementById("home");
    const master = document.getElementById("master");
    const transaction = document.getElementById("transaction");
    const receiving = document.getElementById("receiving");
    const stock = document.getElementById("stock");
    const finance = document.getElementById("finance");

    const masterSub = document.getElementById("masterSubmenu");
    const masterLab = document.getElementById("masterLabel");
    const masterUser = document.getElementById("master-user");
    const masterProfile = document.getElementById("master-profile");
    const masterCustomer = document.getElementById("master-customer");
    const masterItem = document.getElementById("master-item");
    const masterWorkType = document.getElementById("master-work-type");
    const masterOrderType = document.getElementById("master-order-type");

    const trsSub = document.getElementById("transactionSubmenu");
    const trsLab = document.getElementById("transactionLabel");
    const trsList = document.getElementById("list-transaction");
    const trsForm = document.getElementById("form-transaction");

    const recSub = document.getElementById("receivingSubmenu");
    const recLab = document.getElementById("receivingLabel");
    const recList = document.getElementById("list-receiving");
    const recForm = document.getElementById("form-receiving");

    const stockSub = document.getElementById("stockSubmenu");
    const stockLab = document.getElementById("stockLabel");
    const stkList = document.getElementById("list-stock");
    const stkMovement = document.getElementById("movement-stock");

    const finSub = document.getElementById("financeSubmenu");
    const finLab = document.getElementById("financeLabel");
    const finList = document.getElementById("list-finance");
    const finExpense = document.getElementById("expense-finance");
    const finWallet = document.getElementById("wallet-finance");

    var angkaMaster = 0;
    var angkaTransaction = 0;
    var angkaReceiving = 0;
    var angkaStock = 0;
    var angkaFinance = 0;

    $(document).ready(function () {

        const data = <?php echo json_encode($listMenu); ?>;

        data.forEach(function(element) {

            if ( element.menu_name == "Master Data" ) {

                master.classList.remove("d-none");
                // master.classList.remove("dropend");
                masterUser.classList.remove("d-none");
                masterProfile.classList.remove("d-none");
                masterCustomer.classList.remove("d-none");
                masterItem.classList.remove("d-none");
                masterWorkType.classList.remove("d-none");
                masterOrderType.classList.remove("d-none");

            } else if ( element.menu_name == "Transaction" ) {

                transaction.classList.remove("d-none");
                trsList.classList.remove("d-none");
                trsForm.classList.remove("d-none");

            } else if ( element.menu_name == "Receiving" ) {

                receiving.classList.remove("d-none");
                recList.classList.remove("d-none");
                recForm.classList.remove("d-none");

            } else if ( element.menu_name == "Stock" ) {

                stock.classList.remove("d-none");
                stkList.classList.remove("d-none");
                stkMovement.classList.remove("d-none");

            } else if ( element.menu_name == "Finance" ) {

                finance.classList.remove("d-none");
                finList.classList.remove("d-none");
                finExpense.classList.remove("d-none");
                finWallet.classList.remove("d-none");

            }

        });

        $(document).on('click', '#master', function() {

            angkaMaster += 1;


            if (master.classList.contains('aktif')) {

                if (angkaMaster % 2 === 0) {
                    master.classList.remove('dropend');
                    master.classList.add('dropdown');
                } else {
                    master.classList.add('dropend');
                    master.classList.remove('dropdown');
                }

            } else {

                if (angkaMaster % 2 === 0) {
                    master.classList.add('dropend');
                    master.classList.remove('dropdown');
                } else {
                    master.classList.remove('dropend');
                    master.classList.add('dropdown');
                }

            }

        });

        $(document).on('click', '#transaction', function() {

            angkaTransaction += 1;

            if (transaction.classList.contains('aktif')) {

                if (angkaTransaction % 2 === 0) {
                    transaction.classList.remove('dropend');
                    transaction.classList.add('dropdown');
                } else {
                    transaction.classList.add('dropend');
                    transaction.classList.remove('dropdown');
                }

                } else {

                if (angkaTransaction % 2 === 0) {
                    transaction.classList.add('dropend');
                    transaction.classList.remove('dropdown');
                } else {
                    transaction.classList.remove('dropend');
                    transaction.classList.add('dropdown');
                }

            }

        });

        $(document).on('click', '#receiving', function() {

            angkaReceiving += 1;

            if (receiving.classList.contains('aktif')) {

                if (angkaReceiving % 2 === 0) {
                    receiving.classList.remove('dropend');
                    receiving.classList.add('dropdown');
                } else {
                    receiving.classList.add('dropend');
                    receiving.classList.remove('dropdown');
                }

                } else {

                if (angkaReceiving % 2 === 0) {
                    receiving.classList.add('dropend');
                    receiving.classList.remove('dropdown');
                } else {
                    receiving.classList.remove('dropend');
                    receiving.classList.add('dropdown');
                }

            }

        });

        $(document).on('click', '#stock', function() {

            angkaStock += 1;

            if (receiving.classList.contains('aktif')) {

                if (angkaStock % 2 === 0) {
                    stock.classList.remove('dropend');
                    stock.classList.add('dropdown');
                } else {
                    stock.classList.add('dropend');
                    stock.classList.remove('dropdown');
                }

                } else {

                if (angkaStock % 2 === 0) {
                    stock.classList.add('dropend');
                    stock.classList.remove('dropdown');
                } else {
                    stock.classList.remove('dropend');
                    stock.classList.add('dropdown');
                }

            }

        });

        $(document).on('click', '#finance', function() {

            angkaFinance += 1;

            if (finance.classList.contains('aktif')) {

                if (angkaFinance % 2 === 0) {
                    finance.classList.remove('dropend');
                    finance.classList.add('dropdown');
                } else {
                    finance.classList.add('dropend');
                    finance.classList.remove('dropdown');
                }

                } else {

                if (angkaFinance % 2 === 0) {
                    finance.classList.add('dropend');
                    finance.classList.remove('dropdown');
                } else {
                    finance.classList.remove('dropend');
                    finance.classList.add('dropdown');
                }

            }

        });

        // ===== MENU MASTER =====
        $("#masterLabel").attr("aria-expanded",false);
        masterLab.classList.add('collapsed');
        masterSub.classList.remove('show');

        // ===== MENU RECEIVING =====
        $("#receivingLabel").attr("aria-expanded",false);
        recLab.classList.add('collapsed');
        recSub.classList.remove('show');


        // ===== MENU TRANSACTION =====
        $("#transactionLabel").attr("aria-expanded",false);
        trsLab.classList.add('collapsed');
        trsSub.classList.remove('show');

        // ===== MENU STOCK =====
        $("#stockLabel").attr("aria-expanded",false);
        stockLab.classList.add('collapsed');
        stockSub.classList.remove('show');


        // ===== MENU ADJUSTMENT =====
        $("#financeLabel").attr("aria-expanded",false);
        finLab.classList.add('collapsed');
        finSub.classList.remove('show');

    });

    // GLOBAL SETUP CSRF
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN' : $('meta[name="csrf-token"]').attr('content')
        }
    });

</script>
