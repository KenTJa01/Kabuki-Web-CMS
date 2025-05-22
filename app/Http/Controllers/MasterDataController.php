<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;
use App\Models\Menu;
use App\Models\Order_type;
use App\Models\Profile;
use App\Models\Work_type;

class MasterDataController extends Controller
{

    public function getAllDataMenu()
    {
        $data = Menu::where('flag', 1)->get();
        return response()->json($data);
    }

    public function getAllDataProfile()
    {
        $data = Profile::where('flag', 1)->get();
        return response()->json($data);
    }

    public function getAllDataWorkType()
    {
        $data = Work_type::where('flag', 1)->get();
        return response()->json($data);
    }

    public function getAllDataOrderType()
    {
        $data = Order_type::where('flag', 1)->get();
        return response()->json($data);
    }

    public function getAllDataCustomer()
    {
        $data = Customer::where('flag', 1)->get();
        return response()->json($data);
    }

}
