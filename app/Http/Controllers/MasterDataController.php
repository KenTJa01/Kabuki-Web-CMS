<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\expense_type;
use App\Models\Income_type;
use App\Models\Item;
use Illuminate\Http\Request;
use App\Models\Menu;
use App\Models\Movement_type;
use App\Models\Order_type;
use App\Models\Profile;
use App\Models\Promo;
use App\Models\Status;
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

    public function getAllDataPaymentStatus()
    {
        $data = Status::where('module', 'transaction')->get();
        return response()->json($data);
    }

    public function getAllDataCustomer()
    {
        $data = Customer::where('flag', 1)->get();
        return response()->json($data);
    }

    public function getAllDataItem()
    {
        $data = Item::where('flag', 1)->get();
        return response()->json($data);
    }

    public function getAllDataMovementType()
    {
        $data = Movement_type::all();
        return response()->json($data);
    }

    public function getAllDataIncomeType()
    {
        $data = Income_type::where('flag', 1)->get();
        return response()->json($data);
    }

    public function getAllDataExpenseType()
    {
        $data = expense_type::where('flag', 1)->get();
        return response()->json($data);
    }

    public function getAllDataPromo()
    {
        $data = Promo::where('flag', 1)->get();
        return response()->json($data);
    }

}
