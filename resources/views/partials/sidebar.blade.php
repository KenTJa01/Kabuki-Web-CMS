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
                <li class="{{ Request::routeIs('/home') ? 'active' : '' }} ">
                    <a href="/home">Home</a>
                </li>

                {{-- MENU DATA MASTER --}}
                <li id="master" class=" dropend">
                    <a href="#masterSubmenu" id="masterLabel" data-toggle="collapse" aria-expanded="true" class="dropdown-toggle dropdown-sidebar collapsed">Master Data</a>
                    <ul class="collapse list-unstyled" id="masterSubmenu">

                        {{-- USERS --}}
                        <li class="{{ Request::routeIs('/master_data/user') ? 'active' : '' }} " id="master-user">
                            <a href="/master_data/user">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-person-fill" viewBox="0 0 16 16">
                                    <path d="M3 14s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1zm5-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6"/>
                                </svg>
                                User
                            </a>
                        </li>

                        {{-- PROFILE --}}
                        <li class="{{ Request::routeIs('/master_data/profile') ? 'active' : '' }} " id="master-profile">
                            <a href="/master_data/profile">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-person-vcard-fill" viewBox="0 0 16 16">
                                    <path d="M0 4a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v8a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2zm9 1.5a.5.5 0 0 0 .5.5h4a.5.5 0 0 0 0-1h-4a.5.5 0 0 0-.5.5M9 8a.5.5 0 0 0 .5.5h4a.5.5 0 0 0 0-1h-4A.5.5 0 0 0 9 8m1 2.5a.5.5 0 0 0 .5.5h3a.5.5 0 0 0 0-1h-3a.5.5 0 0 0-.5.5m-1 2C9 10.567 7.21 9 5 9c-2.086 0-3.8 1.398-3.984 3.181A1 1 0 0 0 2 13h6.96q.04-.245.04-.5M7 6a2 2 0 1 0-4 0 2 2 0 0 0 4 0"/>
                                </svg>
                                Profile
                            </a>
                        </li>

                        {{-- CUSTOMER --}}
                        <li class="{{ Request::routeIs('/master_data/customer') ? 'active' : '' }} " id="master-customer">
                            <a href="/master_data/customer">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-people-fill" viewBox="0 0 16 16">
                                    <path d="M7 14s-1 0-1-1 1-4 5-4 5 3 5 4-1 1-1 1zm4-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6m-5.784 6A2.24 2.24 0 0 1 5 13c0-1.355.68-2.75 1.936-3.72A6.3 6.3 0 0 0 5 9c-4 0-5 3-5 4s1 1 1 1zM4.5 8a2.5 2.5 0 1 0 0-5 2.5 2.5 0 0 0 0 5"/>
                                </svg>
                                Customers
                            </a>
                        </li>

                        {{-- ITEMS --}}
                        <li class="{{ Request::routeIs('/master_data/item') ? 'active' : '' }} " id="master-item">
                            <a href="/master_data/item">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-box-seam-fill" viewBox="0 0 16 16">
                                    <path fill-rule="evenodd" d="M15.528 2.973a.75.75 0 0 1 .472.696v8.662a.75.75 0 0 1-.472.696l-7.25 2.9a.75.75 0 0 1-.557 0l-7.25-2.9A.75.75 0 0 1 0 12.331V3.669a.75.75 0 0 1 .471-.696L7.443.184l.01-.003.268-.108a.75.75 0 0 1 .558 0l.269.108.01.003zM10.404 2 4.25 4.461 1.846 3.5 1 3.839v.4l6.5 2.6v7.922l.5.2.5-.2V6.84l6.5-2.6v-.4l-.846-.339L8 5.961 5.596 5l6.154-2.461z"/>
                                </svg>
                                Items
                            </a>
                        </li>

                        {{-- WORK TYPE --}}
                        <li class="{{ Request::routeIs('/master_data/order_type') ? 'active' : '' }} " id="master-order-type">
                            <a href="/master_data/order_type">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-basket2-fill" viewBox="0 0 16 16">
                                    <path d="M5.929 1.757a.5.5 0 1 0-.858-.514L2.217 6H.5a.5.5 0 0 0-.5.5v1a.5.5 0 0 0 .5.5h.623l1.844 6.456A.75.75 0 0 0 3.69 15h8.622a.75.75 0 0 0 .722-.544L14.877 8h.623a.5.5 0 0 0 .5-.5v-1a.5.5 0 0 0-.5-.5h-1.717L10.93 1.243a.5.5 0 1 0-.858.514L12.617 6H3.383zM4 10a1 1 0 0 1 2 0v2a1 1 0 1 1-2 0zm3 0a1 1 0 0 1 2 0v2a1 1 0 1 1-2 0zm4-1a1 1 0 0 1 1 1v2a1 1 0 1 1-2 0v-2a1 1 0 0 1 1-1"/>
                                </svg>
                                Order Type
                            </a>
                        </li>

                        {{-- WORK TYPE --}}
                        <li class="{{ Request::routeIs('/master_data/work_type') ? 'active' : '' }} " id="master-work-type">
                            <a href="/master_data/work_type">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-tools" viewBox="0 0 16 16">
                                    <path d="M1 0 0 1l2.2 3.081a1 1 0 0 0 .815.419h.07a1 1 0 0 1 .708.293l2.675 2.675-2.617 2.654A3.003 3.003 0 0 0 0 13a3 3 0 1 0 5.878-.851l2.654-2.617.968.968-.305.914a1 1 0 0 0 .242 1.023l3.27 3.27a.997.997 0 0 0 1.414 0l1.586-1.586a.997.997 0 0 0 0-1.414l-3.27-3.27a1 1 0 0 0-1.023-.242L10.5 9.5l-.96-.96 2.68-2.643A3.005 3.005 0 0 0 16 3q0-.405-.102-.777l-2.14 2.141L12 4l-.364-1.757L13.777.102a3 3 0 0 0-3.675 3.68L7.462 6.46 4.793 3.793a1 1 0 0 1-.293-.707v-.071a1 1 0 0 0-.419-.814zm9.646 10.646a.5.5 0 0 1 .708 0l2.914 2.915a.5.5 0 0 1-.707.707l-2.915-2.914a.5.5 0 0 1 0-.708M3 11l.471.242.529.026.287.445.445.287.026.529L5 13l-.242.471-.026.529-.445.287-.287.445-.529.026L3 15l-.471-.242L2 14.732l-.287-.445L1.268 14l-.026-.529L1 13l.242-.471.026-.529.445-.287.287-.445.529-.026z"/>
                                </svg>
                                Work Type
                            </a>
                        </li>

                    </ul>
                </li>
                <!-- <li id="master" class="d-none dropend">
                    <a href="#masterSubmenu" id="masterLabel" data-toggle="collapse" aria-expanded="true" class="dropdown-toggle dropdown-sidebar collapsed">Master Data</a>
                    <ul class="collapse list-unstyled" id="masterSubmenu">

                        {{-- USERS --}}
                        {{-- <li class="{{ Request::routeIs('/master_data/user') ? 'active' : '' }} d-none" id="master-user">
                            <a href="/master_data/user">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-person-fill" viewBox="0 0 16 16">
                                    <path d="M3 14s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1zm5-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6"/>
                                </svg>
                                User
                            </a>
                        </li> --}}

                        {{-- PROFILES --}}
                        <li class="{{ Request::routeIs('/master_data/profile') ? 'active' : '' }} d-none" id="master-profile">
                            <a href="/master_data/profile">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-person-vcard-fill" viewBox="0 0 16 16">
                                    <path d="M0 4a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v8a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2zm9 1.5a.5.5 0 0 0 .5.5h4a.5.5 0 0 0 0-1h-4a.5.5 0 0 0-.5.5M9 8a.5.5 0 0 0 .5.5h4a.5.5 0 0 0 0-1h-4A.5.5 0 0 0 9 8m1 2.5a.5.5 0 0 0 .5.5h3a.5.5 0 0 0 0-1h-3a.5.5 0 0 0-.5.5m-1 2C9 10.567 7.21 9 5 9c-2.086 0-3.8 1.398-3.984 3.181A1 1 0 0 0 2 13h6.96q.04-.245.04-.5M7 6a2 2 0 1 0-4 0 2 2 0 0 0 4 0"/>
                                </svg>
                                Profile
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

                        {{-- CATEGORY --}}
                        <li class="{{ Request::routeIs('/master_data/category') ? 'active' : '' }} d-none" id="master-category">
                            <a href="/master_data/category">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-tags-fill" viewBox="0 0 16 16">
                                    <path d="M2 2a1 1 0 0 1 1-1h4.586a1 1 0 0 1 .707.293l7 7a1 1 0 0 1 0 1.414l-4.586 4.586a1 1 0 0 1-1.414 0l-7-7A1 1 0 0 1 2 6.586zm3.5 4a1.5 1.5 0 1 0 0-3 1.5 1.5 0 0 0 0 3"/>
                                    <path d="M1.293 7.793A1 1 0 0 1 1 7.086V2a1 1 0 0 0-1 1v4.586a1 1 0 0 0 .293.707l7 7a1 1 0 0 0 1.414 0l.043-.043z"/>
                                </svg>
                                Category
                            </a>
                        </li>

                        {{-- MERCHANT --}}
                        <li class="{{ Request::routeIs('/master_data/merchant') ? 'active' : '' }} d-none" id="master-merchant">
                            <a href="#">
                                <svg width="16" height="16" viewBox="0 0 16 16" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                    <g clip-path="url(#clip0_211_2479)">
                                        <path d="M0.5 5L3.5 1.5H12.5L14 3.5L15 4.5L15.5 5.5L15 6.5L14 7.5C13.6667 7.5 12.9 7.4 12.5 7L11.5 6L11 7C10.6667 7.16667 9.9 7.5 9.5 7.5C9.1 7.5 9 7.16667 9 7L8 6L7 7L6 7.5L5 7L4.5 6L3.5 7L2.5 7.5L0.5 6.5V5Z" fill="currentColor"/>
                                        <path d="M2.97 1.35C3.06389 1.24023 3.18044 1.15211 3.31163 1.09169C3.44283 1.03127 3.58556 0.99999 3.73 1H12.27C12.4144 0.99999 12.5572 1.03127 12.6884 1.09169C12.8196 1.15211 12.9361 1.24023 13.03 1.35L15.639 4.394C15.8719 4.66583 16 5.01201 16 5.37V5.625C16.0001 6.11998 15.8455 6.6026 15.5578 7.00542C15.2702 7.40824 14.8639 7.71113 14.3957 7.87174C13.9275 8.03236 13.4208 8.04268 12.9465 7.90127C12.4721 7.75986 12.0538 7.47377 11.75 7.083C11.5282 7.36882 11.2439 7.60007 10.9189 7.75902C10.5939 7.91797 10.2368 8.0004 9.875 8C9.51321 8.0004 9.15612 7.91797 8.83112 7.75902C8.50611 7.60007 8.22181 7.36882 8 7.083C7.77819 7.36882 7.49389 7.60007 7.16888 7.75902C6.84388 7.91797 6.48679 8.0004 6.125 8C5.76321 8.0004 5.40612 7.91797 5.08112 7.75902C4.75611 7.60007 4.47181 7.36882 4.25 7.083C3.94619 7.47377 3.52788 7.75986 3.05354 7.90127C2.57919 8.04268 2.07252 8.03236 1.60432 7.87174C1.13613 7.71113 0.729823 7.40824 0.442182 7.00542C0.154542 6.6026 -5.45986e-05 6.11998 1.44645e-08 5.625V5.37C1.26075e-05 5.01201 0.128057 4.66583 0.361 4.394L2.97 1.35ZM4.75 5.625C4.75 5.98967 4.89487 6.33941 5.15273 6.59727C5.41059 6.85513 5.76033 7 6.125 7C6.48967 7 6.83941 6.85513 7.09727 6.59727C7.35513 6.33941 7.5 5.98967 7.5 5.625C7.5 5.49239 7.55268 5.36521 7.64645 5.27145C7.74021 5.17768 7.86739 5.125 8 5.125C8.13261 5.125 8.25979 5.17768 8.35355 5.27145C8.44732 5.36521 8.5 5.49239 8.5 5.625C8.5 5.98967 8.64487 6.33941 8.90273 6.59727C9.16059 6.85513 9.51033 7 9.875 7C10.2397 7 10.5894 6.85513 10.8473 6.59727C11.1051 6.33941 11.25 5.98967 11.25 5.625C11.25 5.49239 11.3027 5.36521 11.3964 5.27145C11.4902 5.17768 11.6174 5.125 11.75 5.125C11.8826 5.125 12.0098 5.17768 12.1036 5.27145C12.1973 5.36521 12.25 5.49239 12.25 5.625C12.25 5.98967 12.3949 6.33941 12.6527 6.59727C12.9106 6.85513 13.2603 7 13.625 7C13.9897 7 14.3394 6.85513 14.5973 6.59727C14.8551 6.33941 15 5.98967 15 5.625V5.37C15 5.25083 14.9575 5.13557 14.88 5.045L12.27 2H3.73L1.12 5.045C1.04255 5.13557 0.999991 5.25083 1 5.37V5.625C1 5.98967 1.14487 6.33941 1.40273 6.59727C1.66059 6.85513 2.01033 7 2.375 7C2.73967 7 3.08941 6.85513 3.34727 6.59727C3.60513 6.33941 3.75 5.98967 3.75 5.625C3.75 5.49239 3.80268 5.36521 3.89645 5.27145C3.99021 5.17768 4.11739 5.125 4.25 5.125C4.38261 5.125 4.50979 5.17768 4.60355 5.27145C4.69732 5.36521 4.75 5.49239 4.75 5.625ZM1.5 8.5C1.63261 8.5 1.75979 8.55268 1.85355 8.64645C1.94732 8.74021 2 8.86739 2 9V15H14V9C14 8.86739 14.0527 8.74021 14.1464 8.64645C14.2402 8.55268 14.3674 8.5 14.5 8.5C14.6326 8.5 14.7598 8.55268 14.8536 8.64645C14.9473 8.74021 15 8.86739 15 9V15H15.5C15.6326 15 15.7598 15.0527 15.8536 15.1464C15.9473 15.2402 16 15.3674 16 15.5C16 15.6326 15.9473 15.7598 15.8536 15.8536C15.7598 15.9473 15.6326 16 15.5 16H0.5C0.367392 16 0.240215 15.9473 0.146447 15.8536C0.0526784 15.7598 1.44645e-08 15.6326 1.44645e-08 15.5C1.44645e-08 15.3674 0.0526784 15.2402 0.146447 15.1464C0.240215 15.0527 0.367392 15 0.5 15H1V9C1 8.86739 1.05268 8.74021 1.14645 8.64645C1.24021 8.55268 1.36739 8.5 1.5 8.5ZM3.5 9C3.63261 9 3.75979 9.05268 3.85355 9.14645C3.94732 9.24021 4 9.36739 4 9.5V13H12V9.5C12 9.36739 12.0527 9.24021 12.1464 9.14645C12.2402 9.05268 12.3674 9 12.5 9C12.6326 9 12.7598 9.05268 12.8536 9.14645C12.9473 9.24021 13 9.36739 13 9.5V13C13 13.2652 12.8946 13.5196 12.7071 13.7071C12.5196 13.8946 12.2652 14 12 14H4C3.73478 14 3.48043 13.8946 3.29289 13.7071C3.10536 13.5196 3 13.2652 3 13V9.5C3 9.36739 3.05268 9.24021 3.14645 9.14645C3.24021 9.05268 3.36739 9 3.5 9Z" fill="currentColor"/>
                                    </g>
                                    <defs>
                                        <clipPath id="clip0_211_2479">
                                            <rect width="16" height="16" fill="currentColor"/>
                                        </clipPath>
                                    </defs>
                                </svg>
                                Merchant
                            </a>
                        </li>

                        {{-- SITE --}}
                        <li class="{{ Request::routeIs('/master_data/site') ? 'active' : '' }} d-none" id="master-site">
                            <a href="/master_data/site">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-geo-alt-fill" viewBox="0 0 16 16">
                                    <path d="M8 16s6-5.686 6-10A6 6 0 0 0 2 6c0 4.314 6 10 6 10m0-7a3 3 0 1 1 0-6 3 3 0 0 1 0 6"/>
                                </svg>
                                Site
                            </a>
                        </li>

                        {{-- SUPPLIER --}}
                        <li class="{{ Request::routeIs('/master_data/supplier') ? 'active' : '' }} d-none" id="master-supplier">
                            <a href="/master_data/supplier">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-people-fill" viewBox="0 0 16 16">
                                    <path d="M7 14s-1 0-1-1 1-4 5-4 5 3 5 4-1 1-1 1zm4-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6m-5.784 6A2.24 2.24 0 0 1 5 13c0-1.355.68-2.75 1.936-3.72A6.3 6.3 0 0 0 5 9c-4 0-5 3-5 4s1 1 1 1zM4.5 8a2.5 2.5 0 1 0 0-5 2.5 2.5 0 0 0 0 5"/>
                                </svg>
                                Supplier
                            </a>
                        </li>

                    </ul>
                </li> -->

                {{-- MENU TRANSACTION --}}
                <li id="transaction" class=" dropend">
                    <a href="#transactionSubmenu" id="transactionLabel" data-toggle="collapse" aria-expanded="true" class="dropdown-toggle dropdown-sidebar collapsed">Transaction</a>
                    <ul class="collapse list-unstyled" id="transactionSubmenu">

                        {{-- TRANSACTION FORM --}}
                        <li class="{{ Request::routeIs('/transaction/form') ? 'active' : '' }} " id="form-transaction">
                            <a href="/transaction/form">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-ui-checks" viewBox="0 0 16 16">
                                    <path d="M7 2.5a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-7a.5.5 0 0 1-.5-.5zM2 1a2 2 0 0 0-2 2v2a2 2 0 0 0 2 2h2a2 2 0 0 0 2-2V3a2 2 0 0 0-2-2zm0 8a2 2 0 0 0-2 2v2a2 2 0 0 0 2 2h2a2 2 0 0 0 2-2v-2a2 2 0 0 0-2-2zm.854-3.646a.5.5 0 0 1-.708 0l-1-1a.5.5 0 1 1 .708-.708l.646.647 1.646-1.647a.5.5 0 1 1 .708.708zm0 8a.5.5 0 0 1-.708 0l-1-1a.5.5 0 0 1 .708-.708l.646.647 1.646-1.647a.5.5 0 0 1 .708.708zM7 10.5a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-7a.5.5 0 0 1-.5-.5zm0-5a.5.5 0 0 1 .5-.5h5a.5.5 0 0 1 0 1h-5a.5.5 0 0 1-.5-.5m0 8a.5.5 0 0 1 .5-.5h5a.5.5 0 0 1 0 1h-5a.5.5 0 0 1-.5-.5"/>
                                </svg>
                                Form
                            </a>
                        </li>

                        {{-- TRANSACTION LIST --}}
                        <li class="{{ Request::routeIs('/transaction/list') ? 'active' : '' }} " id="list-transaction">
                            <a href="/transaction/list">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-card-list" viewBox="0 0 16 16">
                                    <path d="M14.5 3a.5.5 0 0 1 .5.5v9a.5.5 0 0 1-.5.5h-13a.5.5 0 0 1-.5-.5v-9a.5.5 0 0 1 .5-.5zm-13-1A1.5 1.5 0 0 0 0 3.5v9A1.5 1.5 0 0 0 1.5 14h13a1.5 1.5 0 0 0 1.5-1.5v-9A1.5 1.5 0 0 0 14.5 2z"/>
                                    <path d="M5 8a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 0 1h-7A.5.5 0 0 1 5 8m0-2.5a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 0 1h-7a.5.5 0 0 1-.5-.5m0 5a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 0 1h-7a.5.5 0 0 1-.5-.5m-1-5a.5.5 0 1 1-1 0 .5.5 0 0 1 1 0M4 8a.5.5 0 1 1-1 0 .5.5 0 0 1 1 0m0 2.5a.5.5 0 1 1-1 0 .5.5 0 0 1 1 0"/>
                                </svg>
                                On Process
                            </a>
                        </li>

                        {{-- TRANSACTION HISTORY --}}
                        <li class="{{ Request::routeIs('/transaction/history') ? 'active' : '' }} " id="history-transaction">
                            <a href="/transaction/history">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-clock-history" viewBox="0 0 16 16">
                                    <path d="M8.515 1.019A7 7 0 0 0 8 1V0a8 8 0 0 1 .589.022zm2.004.45a7 7 0 0 0-.985-.299l.219-.976q.576.129 1.126.342zm1.37.71a7 7 0 0 0-.439-.27l.493-.87a8 8 0 0 1 .979.654l-.615.789a7 7 0 0 0-.418-.302zm1.834 1.79a7 7 0 0 0-.653-.796l.724-.69q.406.429.747.91zm.744 1.352a7 7 0 0 0-.214-.468l.893-.45a8 8 0 0 1 .45 1.088l-.95.313a7 7 0 0 0-.179-.483m.53 2.507a7 7 0 0 0-.1-1.025l.985-.17q.1.58.116 1.17zm-.131 1.538q.05-.254.081-.51l.993.123a8 8 0 0 1-.23 1.155l-.964-.267q.069-.247.12-.501m-.952 2.379q.276-.436.486-.908l.914.405q-.24.54-.555 1.038zm-.964 1.205q.183-.183.35-.378l.758.653a8 8 0 0 1-.401.432z"/>
                                    <path d="M8 1a7 7 0 1 0 4.95 11.95l.707.707A8.001 8.001 0 1 1 8 0z"/>
                                    <path d="M7.5 3a.5.5 0 0 1 .5.5v5.21l3.248 1.856a.5.5 0 0 1-.496.868l-3.5-2A.5.5 0 0 1 7 9V3.5a.5.5 0 0 1 .5-.5"/>
                                </svg>
                                History
                            </a>
                        </li>

                    </ul>
                </li>

                <li id="receiving" class=" dropend">
                    <a href="#receivingSubmenu" id="receivingLabel" data-toggle="collapse" aria-expanded="true" class="dropdown-toggle dropdown-sidebar collapsed">Receiving</a>
                    <ul class="collapse list-unstyled" id="receivingSubmenu">

                        {{-- RECEIVING FORM --}}
                        <li class="{{ Request::routeIs('/receiving/form') ? 'active' : '' }} " id="form-receiving">
                            <a href="/receiving/form">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-ui-checks" viewBox="0 0 16 16">
                                    <path d="M7 2.5a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-7a.5.5 0 0 1-.5-.5zM2 1a2 2 0 0 0-2 2v2a2 2 0 0 0 2 2h2a2 2 0 0 0 2-2V3a2 2 0 0 0-2-2zm0 8a2 2 0 0 0-2 2v2a2 2 0 0 0 2 2h2a2 2 0 0 0 2-2v-2a2 2 0 0 0-2-2zm.854-3.646a.5.5 0 0 1-.708 0l-1-1a.5.5 0 1 1 .708-.708l.646.647 1.646-1.647a.5.5 0 1 1 .708.708zm0 8a.5.5 0 0 1-.708 0l-1-1a.5.5 0 0 1 .708-.708l.646.647 1.646-1.647a.5.5 0 0 1 .708.708zM7 10.5a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-7a.5.5 0 0 1-.5-.5zm0-5a.5.5 0 0 1 .5-.5h5a.5.5 0 0 1 0 1h-5a.5.5 0 0 1-.5-.5m0 8a.5.5 0 0 1 .5-.5h5a.5.5 0 0 1 0 1h-5a.5.5 0 0 1-.5-.5"/>
                                </svg>
                                Form
                            </a>
                        </li>

                        {{-- RECEIVING LIST --}}
                        <li class="{{ Request::routeIs('/receiving/list') ? 'active' : '' }} " id="list-receiving">
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

                {{-- MENU STOCK --}}
                <li id="stock" class="dropend">
                    <a href="#stockSubmenu" id="stockLabel" data-toggle="collapse" aria-expanded="true" class="dropdown-toggle dropdown-sidebar collapsed">Stock</a>
                    <ul class="collapse list-unstyled" id="stockSubmenu">

                        {{-- STOCK LIST --}}
                        <li class="{{ Request::routeIs('/stock/list') ? 'active' : '' }} " id="list-stock">
                            <a href="/stock/list">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-card-list" viewBox="0 0 16 16">
                                    <path d="M14.5 3a.5.5 0 0 1 .5.5v9a.5.5 0 0 1-.5.5h-13a.5.5 0 0 1-.5-.5v-9a.5.5 0 0 1 .5-.5zm-13-1A1.5 1.5 0 0 0 0 3.5v9A1.5 1.5 0 0 0 1.5 14h13a1.5 1.5 0 0 0 1.5-1.5v-9A1.5 1.5 0 0 0 14.5 2z"/>
                                    <path d="M5 8a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 0 1h-7A.5.5 0 0 1 5 8m0-2.5a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 0 1h-7a.5.5 0 0 1-.5-.5m0 5a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 0 1h-7a.5.5 0 0 1-.5-.5m-1-5a.5.5 0 1 1-1 0 .5.5 0 0 1 1 0M4 8a.5.5 0 1 1-1 0 .5.5 0 0 1 1 0m0 2.5a.5.5 0 1 1-1 0 .5.5 0 0 1 1 0"/>
                                </svg>
                                List
                            </a>
                        </li>

                        {{-- STOCK FORM --}}
                        <li class="{{ Request::routeIs('/stock/movement') ? 'active' : '' }} " id="movement-stock">
                            <a href="/stock/movement">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-left-right" viewBox="0 0 16 16">
                                    <path fill-rule="evenodd" d="M1 11.5a.5.5 0 0 0 .5.5h11.793l-3.147 3.146a.5.5 0 0 0 .708.708l4-4a.5.5 0 0 0 0-.708l-4-4a.5.5 0 0 0-.708.708L13.293 11H1.5a.5.5 0 0 0-.5.5m14-7a.5.5 0 0 1-.5.5H2.707l3.147 3.146a.5.5 0 1 1-.708.708l-4-4a.5.5 0 0 1 0-.708l4-4a.5.5 0 1 1 .708.708L2.707 4H14.5a.5.5 0 0 1 .5.5"/>
                                </svg>
                                Movement
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

                {{-- MENU STOCK OPNAME --}}
                <li id="stockOpname" class="d-none dropend">
                    <a href="#stockOpnameSubmenu" id="stockOpnameLabel" data-toggle="collapse" aria-expanded="true" class="dropdown-toggle dropdown-sidebar collapsed">Stock Opname</a>
                    <ul class="collapse list-unstyled" id="stockOpnameSubmenu">

                        {{-- STOCK OPNAME LIST --}}
                        <li class="{{ Request::routeIs('/stock_opname/list') ? 'active' : '' }} d-none" id="list-stock-opname">
                            <a href="/stock_opname/list">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-card-list" viewBox="0 0 16 16">
                                    <path d="M14.5 3a.5.5 0 0 1 .5.5v9a.5.5 0 0 1-.5.5h-13a.5.5 0 0 1-.5-.5v-9a.5.5 0 0 1 .5-.5zm-13-1A1.5 1.5 0 0 0 0 3.5v9A1.5 1.5 0 0 0 1.5 14h13a1.5 1.5 0 0 0 1.5-1.5v-9A1.5 1.5 0 0 0 14.5 2z"/>
                                    <path d="M5 8a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 0 1h-7A.5.5 0 0 1 5 8m0-2.5a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 0 1h-7a.5.5 0 0 1-.5-.5m0 5a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 0 1h-7a.5.5 0 0 1-.5-.5m-1-5a.5.5 0 1 1-1 0 .5.5 0 0 1 1 0M4 8a.5.5 0 1 1-1 0 .5.5 0 0 1 1 0m0 2.5a.5.5 0 1 1-1 0 .5.5 0 0 1 1 0"/>
                                </svg>
                                List
                            </a>
                        </li>

                        {{-- STOCK OPNAME FORM --}}
                        <li class="{{ Request::routeIs('/stock_opname/form') ? 'active' : '' }} d-none" id="form-stock-opname">
                            <a href="/stock_opname/form">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-ui-checks" viewBox="0 0 16 16">
                                    <path d="M7 2.5a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-7a.5.5 0 0 1-.5-.5zM2 1a2 2 0 0 0-2 2v2a2 2 0 0 0 2 2h2a2 2 0 0 0 2-2V3a2 2 0 0 0-2-2zm0 8a2 2 0 0 0-2 2v2a2 2 0 0 0 2 2h2a2 2 0 0 0 2-2v-2a2 2 0 0 0-2-2zm.854-3.646a.5.5 0 0 1-.708 0l-1-1a.5.5 0 1 1 .708-.708l.646.647 1.646-1.647a.5.5 0 1 1 .708.708zm0 8a.5.5 0 0 1-.708 0l-1-1a.5.5 0 0 1 .708-.708l.646.647 1.646-1.647a.5.5 0 0 1 .708.708zM7 10.5a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-7a.5.5 0 0 1-.5-.5zm0-5a.5.5 0 0 1 .5-.5h5a.5.5 0 0 1 0 1h-5a.5.5 0 0 1-.5-.5m0 8a.5.5 0 0 1 .5-.5h5a.5.5 0 0 1 0 1h-5a.5.5 0 0 1-.5-.5"/>
                                </svg>
                                Form
                            </a>
                        </li>
                    </ul>
                </li>

                {{-- MENU ADJUSTMENT --}}
                <li id="adjustment" class="d-none dropend">
                    <a href="#adjustmentSubmenu" id="adjustmentLabel" data-toggle="collapse" aria-expanded="true" class="dropdown-toggle dropdown-sidebar collapsed">Adjustment</a>
                    <ul class="collapse list-unstyled" id="adjustmentSubmenu">

                        {{-- ADJUSTMENT LIST --}}
                        <li class="{{ Request::routeIs('/adjustment/list') ? 'active' : '' }} d-none" id="list-adjustment">
                            <a href="/adjustment/list">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-card-list" viewBox="0 0 16 16">
                                    <path d="M14.5 3a.5.5 0 0 1 .5.5v9a.5.5 0 0 1-.5.5h-13a.5.5 0 0 1-.5-.5v-9a.5.5 0 0 1 .5-.5zm-13-1A1.5 1.5 0 0 0 0 3.5v9A1.5 1.5 0 0 0 1.5 14h13a1.5 1.5 0 0 0 1.5-1.5v-9A1.5 1.5 0 0 0 14.5 2z"/>
                                    <path d="M5 8a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 0 1h-7A.5.5 0 0 1 5 8m0-2.5a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 0 1h-7a.5.5 0 0 1-.5-.5m0 5a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 0 1h-7a.5.5 0 0 1-.5-.5m-1-5a.5.5 0 1 1-1 0 .5.5 0 0 1 1 0M4 8a.5.5 0 1 1-1 0 .5.5 0 0 1 1 0m0 2.5a.5.5 0 1 1-1 0 .5.5 0 0 1 1 0"/>
                                </svg>
                                List
                            </a>
                        </li>

                        {{-- ADJUSTMENT FORM --}}
                        <li class="{{ Request::routeIs('/adjustment/form') ? 'active' : '' }} d-none" id="form-adjustment">
                            <a href="/adjustment/form">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-ui-checks" viewBox="0 0 16 16">
                                    <path d="M7 2.5a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-7a.5.5 0 0 1-.5-.5zM2 1a2 2 0 0 0-2 2v2a2 2 0 0 0 2 2h2a2 2 0 0 0 2-2V3a2 2 0 0 0-2-2zm0 8a2 2 0 0 0-2 2v2a2 2 0 0 0 2 2h2a2 2 0 0 0 2-2v-2a2 2 0 0 0-2-2zm.854-3.646a.5.5 0 0 1-.708 0l-1-1a.5.5 0 1 1 .708-.708l.646.647 1.646-1.647a.5.5 0 1 1 .708.708zm0 8a.5.5 0 0 1-.708 0l-1-1a.5.5 0 0 1 .708-.708l.646.647 1.646-1.647a.5.5 0 0 1 .708.708zM7 10.5a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-7a.5.5 0 0 1-.5-.5zm0-5a.5.5 0 0 1 .5-.5h5a.5.5 0 0 1 0 1h-5a.5.5 0 0 1-.5-.5m0 8a.5.5 0 0 1 .5-.5h5a.5.5 0 0 1 0 1h-5a.5.5 0 0 1-.5-.5"/>
                                </svg>
                                Form
                            </a>
                        </li>
                    </ul>
                </li>

                {{-- MENU RETURN --}}
                <li id="return" class="d-none dropend">
                    <a href="#returnSubmenu" id="returnLabel" data-toggle="collapse" aria-expanded="true" class="dropdown-toggle dropdown-sidebar collapsed">Return</a>
                    <ul class="collapse list-unstyled" id="returnSubmenu">

                        {{-- RETURN LIST --}}
                        <li class="{{ Request::routeIs('/return/list') ? 'active' : '' }} d-none" id="list-return">
                            <a href="/return/list">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-card-list" viewBox="0 0 16 16">
                                    <path d="M14.5 3a.5.5 0 0 1 .5.5v9a.5.5 0 0 1-.5.5h-13a.5.5 0 0 1-.5-.5v-9a.5.5 0 0 1 .5-.5zm-13-1A1.5 1.5 0 0 0 0 3.5v9A1.5 1.5 0 0 0 1.5 14h13a1.5 1.5 0 0 0 1.5-1.5v-9A1.5 1.5 0 0 0 14.5 2z"/>
                                    <path d="M5 8a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 0 1h-7A.5.5 0 0 1 5 8m0-2.5a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 0 1h-7a.5.5 0 0 1-.5-.5m0 5a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 0 1h-7a.5.5 0 0 1-.5-.5m-1-5a.5.5 0 1 1-1 0 .5.5 0 0 1 1 0M4 8a.5.5 0 1 1-1 0 .5.5 0 0 1 1 0m0 2.5a.5.5 0 1 1-1 0 .5.5 0 0 1 1 0"/>
                                </svg>
                                List
                            </a>
                        </li>

                        {{-- RETURN FORM --}}
                        <li class="{{ Request::routeIs('/return/form') ? 'active' : '' }} d-none" id="form-return">
                            <a href="/return/form">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-ui-checks" viewBox="0 0 16 16">
                                    <path d="M7 2.5a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-7a.5.5 0 0 1-.5-.5zM2 1a2 2 0 0 0-2 2v2a2 2 0 0 0 2 2h2a2 2 0 0 0 2-2V3a2 2 0 0 0-2-2zm0 8a2 2 0 0 0-2 2v2a2 2 0 0 0 2 2h2a2 2 0 0 0 2-2v-2a2 2 0 0 0-2-2zm.854-3.646a.5.5 0 0 1-.708 0l-1-1a.5.5 0 1 1 .708-.708l.646.647 1.646-1.647a.5.5 0 1 1 .708.708zm0 8a.5.5 0 0 1-.708 0l-1-1a.5.5 0 0 1 .708-.708l.646.647 1.646-1.647a.5.5 0 0 1 .708.708zM7 10.5a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-7a.5.5 0 0 1-.5-.5zm0-5a.5.5 0 0 1 .5-.5h5a.5.5 0 0 1 0 1h-5a.5.5 0 0 1-.5-.5m0 8a.5.5 0 0 1 .5-.5h5a.5.5 0 0 1 0 1h-5a.5.5 0 0 1-.5-.5"/>
                                </svg>
                                Form
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
    const receiving = document.getElementById("receiving");
    const redeem = document.getElementById("redeem");
    const transfer = document.getElementById("transfer");
    const stock = document.getElementById("stock");
    const stockOpname = document.getElementById("stockOpname");
    const adjustment = document.getElementById("adjustment");
    const retur = document.getElementById("return");

    const masterSub = document.getElementById("masterSubmenu");
    const masterLab = document.getElementById("masterLabel");
    // const masterUser = document.getElementById("master-user");
    const masterProfile = document.getElementById("master-profile");
    const masterItem = document.getElementById("master-item");
    const masterCategory = document.getElementById("master-category");
    const masterSite = document.getElementById("master-site");
    const masterSupplier = document.getElementById("master-supplier");

    const recSub = document.getElementById("receivingSubmenu");
    const recLab = document.getElementById("receivingLabel");
    const recList = document.getElementById("list-receiving");
    const recForm = document.getElementById("form-receiving");

    const redeemSub = document.getElementById("redeemSubmenu");
    const redeemLab = document.getElementById("redeemLabel");
    const redeemList = document.getElementById("list-redeem");
    const redeemForm = document.getElementById("form-redeem");

    const trfSub = document.getElementById("transferSubmenu");
    const trfLab = document.getElementById("transferLabel");
    const trfList = document.getElementById("list-transfer");
    const trfForm = document.getElementById("form-transfer");

    const stockSub = document.getElementById("stockSubmenu");
    const stockLab = document.getElementById("stockLabel");
    const stkList = document.getElementById("list-stock");
    const stkMovement = document.getElementById("movement-stock");

    const stockOpnameSub = document.getElementById("stockOpnameSubmenu");
    const stockOpnameLab = document.getElementById("stockOpnameLabel");
    const stkOpnList = document.getElementById("list-stock-opname");
    const stkOpnForm = document.getElementById("form-stock-opname");

    const adjustmentSub = document.getElementById("adjustmentSubmenu");
    const adjustmentLab = document.getElementById("adjustmentLabel");
    const adjList = document.getElementById("list-adjustment");
    const adjForm = document.getElementById("form-adjustment");

    const returnSub = document.getElementById("returnSubmenu");
    const returnLab = document.getElementById("returnLabel");
    const rtnList = document.getElementById("list-return");
    const rtnForm = document.getElementById("form-return");

    var angkaMaster = 0;
    var angkaReceiving = 0;
    var angkaTransfer = 0;
    var angkaRedeem = 0;
    var angkaStock = 0;
    var angkaStockOpname = 0;
    var angkaAdjustment = 0;
    var angkaReturn = 0;

    $(document).ready(function () {

        const data = <?php echo json_encode($listMenu); ?>;

        data.forEach(function(element) {

            if ( element.menu_name == "Master Data" ) {
                master.classList.remove("d-none");
                // master.classList.remove("dropend");
                // if ( element.submenu_name == "User" ) {
                //     masterUser.classList.remove("d-none");
                // }
                if ( element.submenu_name == "Profile" ) {
                    masterProfile.classList.remove("d-none");
                } else if ( element.submenu_name == "Item" ) {
                    masterItem.classList.remove("d-none");
                } else if ( element.submenu_name == "Category" ) {
                    masterCategory.classList.remove("d-none");
                } else if ( element.submenu_name == "Site" ) {
                    masterSite.classList.remove("d-none");
                } else if ( element.submenu_name == "Supplier" ) {
                    masterSupplier.classList.remove("d-none");
                }
            } else if ( element.menu_name == "Receiving" ) {
                receiving.classList.remove("d-none");
                if ( element.submenu_name == "List" ) {
                    recList.classList.remove("d-none");
                } else if ( element.submenu_name == "Form" ) {
                    recForm.classList.remove("d-none");
                }
            } else if ( element.menu_name == "Redeem" ) {
                redeem.classList.remove("d-none");
                if ( element.submenu_name == "List" ) {
                    redeemList.classList.remove("d-none");
                } else if ( element.submenu_name == "Form" ) {
                    redeemForm.classList.remove("d-none");
                }
            } else if ( element.menu_name == "Transfer" ) {
                transfer.classList.remove("d-none");
                if ( element.submenu_name == "List" ) {
                    trfList.classList.remove("d-none");
                } else if ( element.submenu_name == "Form" ) {
                    trfForm.classList.remove("d-none");
                }
            } else if ( element.menu_name == "Stock" ) {
                stock.classList.remove("d-none");
                if ( element.submenu_name == "List" ) {
                    stkList.classList.remove("d-none");
                } else if ( element.submenu_name == "Movement" ) {
                    stkMovement.classList.remove("d-none");
                }
            } else if ( element.menu_name == "Stock Opname" ) {
                stockOpname.classList.remove("d-none");
                if ( element.submenu_name == "List" ) {
                    stkOpnList.classList.remove("d-none");
                } else if ( element.submenu_name == "Form" ) {
                    stkOpnForm.classList.remove("d-none");
                }
            } else if ( element.menu_name == "Adjustment" ) {
                adjustment.classList.remove("d-none");
                if ( element.submenu_name == "List" ) {
                    adjList.classList.remove("d-none");
                } else if ( element.submenu_name == "Form" ) {
                    adjForm.classList.remove("d-none");
                }
            } else if ( element.menu_name == "Return" ) {
                retur.classList.remove("d-none");
                if ( element.submenu_name == "List" ) {
                    rtnList.classList.remove("d-none");
                } else if ( element.submenu_name == "Form" ) {
                    rtnForm.classList.remove("d-none");
                }
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

        $(document).on('click', '#redeem', function() {

            angkaRedeem += 1;

            if (redeem.classList.contains('aktif')) {

                if (angkaRedeem % 2 === 0) {
                    redeem.classList.remove('dropend');
                    redeem.classList.add('dropdown');
                } else {
                    redeem.classList.add('dropend');
                    redeem.classList.remove('dropdown');
                }

                } else {

                if (angkaRedeem % 2 === 0) {
                    redeem.classList.add('dropend');
                    redeem.classList.remove('dropdown');
                } else {
                    redeem.classList.remove('dropend');
                    redeem.classList.add('dropdown');
                }

            }

        });

        $(document).on('click', '#transfer', function() {

            angkaTransfer += 1;

            if (transfer.classList.contains('aktif')) {

                if (angkaTransfer % 2 === 0) {
                    transfer.classList.remove('dropend');
                    transfer.classList.add('dropdown');
                } else {
                    transfer.classList.add('dropend');
                    transfer.classList.remove('dropdown');
                }

                } else {

                if (angkaTransfer % 2 === 0) {
                    transfer.classList.add('dropend');
                    transfer.classList.remove('dropdown');
                } else {
                    transfer.classList.remove('dropend');
                    transfer.classList.add('dropdown');
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

        $(document).on('click', '#stockOpname', function() {

            angkaStockOpname += 1;

            if (stockOpname.classList.contains('aktif')) {

                if (angkaStockOpname % 2 === 0) {
                    stockOpname.classList.remove('dropend');
                    stockOpname.classList.add('dropdown');
                } else {
                    stockOpname.classList.add('dropend');
                    stockOpname.classList.remove('dropdown');
                }

                } else {

                if (angkaStockOpname % 2 === 0) {
                    stockOpname.classList.add('dropend');
                    stockOpname.classList.remove('dropdown');
                } else {
                    stockOpname.classList.remove('dropend');
                    stockOpname.classList.add('dropdown');
                }

            }

        });

        $(document).on('click', '#adjustment', function() {

            angkaAdjustment += 1;

            if (adjustment.classList.contains('aktif')) {

                if (angkaAdjustment % 2 === 0) {
                    adjustment.classList.remove('dropend');
                    adjustment.classList.add('dropdown');
                } else {
                    adjustment.classList.add('dropend');
                    adjustment.classList.remove('dropdown');
                }

                } else {

                if (angkaAdjustment % 2 === 0) {
                    adjustment.classList.add('dropend');
                    adjustment.classList.remove('dropdown');
                } else {
                    adjustment.classList.remove('dropend');
                    adjustment.classList.add('dropdown');
                }

            }

        });

        $(document).on('click', '#return', function() {

            angkaReturn += 1;

            if (retur.classList.contains('aktif')) {

                if (angkaReturn % 2 === 0) {
                    retur.classList.remove('dropend');
                    retur.classList.add('dropdown');
                } else {
                    retur.classList.add('dropend');
                    retur.classList.remove('dropdown');
                }

                } else {

                if (angkaReturn % 2 === 0) {
                    retur.classList.add('dropend');
                    retur.classList.remove('dropdown');
                } else {
                    retur.classList.remove('dropend');
                    retur.classList.add('dropdown');
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


        // ===== MENU EXPENDING =====
        $("#redeemLabel").attr("aria-expanded",false);
        redeemLab.classList.add('collapsed');
        redeemSub.classList.remove('show');


        // ===== MENU TRANSFER =====
        $("#transferLabel").attr("aria-expanded",false);
        trfLab.classList.add('collapsed');
        trfSub.classList.remove('show');


        // ===== MENU STOCK =====
        $("#stockLabel").attr("aria-expanded",false);
        stockLab.classList.add('collapsed');
        stockSub.classList.remove('show');


        // ===== MENU STOCK OPNAME =====
        $("#stockOpnameLabel").attr("aria-expanded",false);
        stockOpnameLab.classList.add('collapsed');
        stockOpnameSub.classList.remove('show');


        // ===== MENU ADJUSTMENT =====
        $("#adjustmentLabel").attr("aria-expanded",false);
        adjustmentLab.classList.add('collapsed');
        adjustmentSub.classList.remove('show');

    });

    // GLOBAL SETUP CSRF
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN' : $('meta[name="csrf-token"]').attr('content')
        }
    });

</script>
