@extends("layouts.main")
@section("container")

    {{-- BANNER --}}
    <div class="row" style="flex: 0;">
        <div class="col">
            <img src="img/banner_inv_home.png" class="banner_home">
        </div>
    </div>

    {{-- CONTENT --}}
    {{-- <div class="row" style="flex: 1; display: flex;">

        <div class="col" style="display: flex; flex-direction: column; ">
            <div class="content_1">
                <h4 style="color: white">Notification</h4>
                <div style="margin-top: 20px; background-color: white; width: 100%; height: 100%; border-radius: 10px; padding: 10px">
                    <div class="notification d-flex justify-content-between align-items-center mb-2">
                        <h6 class="mt-2">Need Approve Transfer</h6>
                        <a href="/transfer/list"><button class="button_view">View</button></a>
                    </div>
                    <div class="notification d-flex justify-content-between align-items-center mb-2">
                        <h6 class="mt-2">Need Approve Redeem</h6>
                        <a href="/redeem/list"><button class="button_view">View</button></a>
                    </div>
                </div>
            </div>
        </div>
        <div class="col" style="display: flex; flex-direction: column; ">
            <div class="content_2">
            </div>
        </div>
    </div> --}}

@endsection
