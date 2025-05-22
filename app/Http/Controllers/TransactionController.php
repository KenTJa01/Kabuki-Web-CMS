<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Item;
use App\Models\Stock;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class TransactionController extends Controller
{

    public function transactionFormPage()
    {

        $user = Auth::user();

        // $sqlPermissionCreate = "SELECT pp.id, perm.key, s.submenu_name, u.username
        //                 FROM profile_permissions pp, permissions perm, submenus s, profiles p, users u
        //                 WHERE pp.profile_id = p.id
        //                     AND pp.permission_id = perm.id
        //                     AND u.profile_id = p.id
        //                     AND perm.sub_menu_id = s.id
        //                     AND perm.sub_menu_id = 3
        //                     AND perm.key = 'master_item_create'
        //                     AND u.id = $user->id";

        // $sqlPermissionExport = "SELECT pp.id, perm.key, s.submenu_name, u.username
        //                 FROM profile_permissions pp, permissions perm, submenus s, profiles p, users u
        //                 WHERE pp.profile_id = p.id
        //                     AND pp.permission_id = perm.id
        //                     AND u.profile_id = p.id
        //                     AND perm.sub_menu_id = s.id
        //                     AND perm.sub_menu_id = 3
        //                     AND perm.key = 'master_item_export'
        //                     AND u.id = $user->id";

        // $lastData = Item::latest()->first();

        (array) $data = [
            // 'lastData' => $lastData,
            // 'permission_create' => DB::select($sqlPermissionCreate),
            // 'permission_export' => DB::select($sqlPermissionExport),
        ];

        return view('/transaction/form_transaction', $data);

    }

    public function getDataCustomerById(Request $request)
    {
        $data = Customer::where('id', $request->customer_id)->where('flag', 1)->first();
        return response()->json($data);
    }

    public function getTrsItem(Request $request)
    {

        $user = Auth::user();

        $sql = ("SELECT DISTINCT i.id AS item_id, i.item_code, i.item_name
            FROM stocks s, items i
            WHERE s.item_id = i.id
                AND i.flag = 1
            ORDER BY i.item_name");
		$data = DB::select($sql);

        return response()->json($data);

    }

    public function getTrsStockQty(Request $request)
    {

        $user = Auth::user();

        $validate = Validator::make($request->all(), [
            'item_id' => ['required', 'integer'],
        ]);
        if ($validate->fails()) {
            throw new ValidationException($validate);
        }
        (array) $validated = $validate->validated();

        $itemId = $validated['item_id'];

        $dataStock = Stock::where('item_id', $itemId)->first();

        return response()->json($dataStock);

    }

    public function getTrsSubtotal(Request $request)
    {

        $user = Auth::user();

        $validate = Validator::make($request->all(), [
            'item_id' => ['required', 'integer'],
        ]);
        if ($validate->fails()) {
            throw new ValidationException($validate);
        }
        (array) $validated = $validate->validated();

        $itemId = $validated['item_id'];

        $dataItem = Item::where('id', $itemId)->first();

        return response()->json($dataItem);

    }

}
