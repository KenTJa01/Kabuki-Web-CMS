<?php

namespace App\Http\Controllers;

use App\Exceptions\CommonCustomException;
use App\Models\Order_type;
use App\Models\Work_type;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class OrderTypeController extends Controller
{

    public function masterOrderTypePage()
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

        return view('/master_data/order_type', $data);

    }

    public function getOrderTypeListDatatable()
    {

        $user = Auth::user();
        $sql = ("SELECT ot.id, ot.order_type_code, ot.order_type_name, ot.order_type_desc, wt.work_type_name, (CASE WHEN ot.flag = 1 THEN 'Active' ELSE 'Non-active' END) AS status
                FROM order_types ot, work_types wt
                WHERE ot.work_type_id = wt.id
                ORDER BY ot.id ASC");

        // $sqlPermissionEdit = ("SELECT pp.id, perm.key, s.submenu_name, u.username
        //                         FROM profile_permissions pp, permissions perm, submenus s, profiles p, users u
        //                         WHERE pp.profile_id = p.id
        //                             AND pp.permission_id = perm.id
        //                             AND u.profile_id = p.id
        //                             AND perm.sub_menu_id = s.id
        //                             AND perm.sub_menu_id = 3
        //                             AND perm.key = 'master_item_edit'
        //                             AND u.id = $user->id");

        // $canEdit = DB::select($sqlPermissionEdit);

        $data = DB::select($sql);

        return DataTables::of($data)
            ->addIndexColumn()
            ->addColumn("actions", function($row) {
                $buttons = '';

                $buttons = '
                <button type="button" class="button_edit" title="Edit Site" id="button_edit_modal" data-bs-toggle="modal" data-bs-target="#editModal" data-id="'.$row->id.'">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-fill" viewBox="0 0 16 16">
                        <path d="M12.854.146a.5.5 0 0 0-.707 0L10.5 1.793 14.207 5.5l1.647-1.646a.5.5 0 0 0 0-.708zm.646 6.061L9.793 2.5 3.293 9H3.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.207zm-7.468 7.468A.5.5 0 0 1 6 13.5V13h-.5a.5.5 0 0 1-.5-.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.5-.5V10h-.5a.5.5 0 0 1-.175-.032l-.179.178a.5.5 0 0 0-.11.168l-2 5a.5.5 0 0 0 .65.65l5-2a.5.5 0 0 0 .168-.11z"/>
                    </svg>
                </button>';


                return $buttons;
            })
            ->rawColumns(['actions'])
            ->make(true);

    }

    public function postNewOrderType(Request $request)
    {

        $user = Auth::user();

        /** Validate Input */
        $validate = Validator::make($request->all(), [
            'orderTypeName' => ['required', 'string'],
            'orderTypeDesc' => ['required', 'string'],
            'workType' => ['required'],
            'status' => ['required'],
        ]);


        if ($validate->fails()) {
            throw new ValidationException($validate);
        }
        (array) $validated = $validate->validated();

        // Ambil order type terakhir yang ada
        $lastOrderType = Order_type::whereNotNull('order_type_code')->latest('order_type_code')->first();

        // Ambil angka dari kode order type terakhir, contoh G001 -> 001
        $lastCodeNumber = $lastOrderType ? (int) substr($lastOrderType->order_type_code, 2) : 0;

        // Buat kode order type berikutnya
        $nextCodeNumber = $lastCodeNumber + 1;

        // Format kode order type dengan menambahkan angka 0 di depan jika perlu (5 digit)
        $order_type_code = 'OT' . str_pad($nextCodeNumber, 5, '0', STR_PAD_LEFT);

        $order_type_name = $validated['orderTypeName'];
        $order_type_desc = $validated['orderTypeDesc'];
        $work_type = Work_type::where('id', $validated['workType'])->first();
        $status = $validated['status'];

        $orderTypeCek = Order_type::where('order_type_name', $order_type_name)->first();
        if ( !is_null($orderTypeCek) ) {
            throw ValidationException::withMessages(['detail' => 'Order Type already exist!']);
        }

        DB::beginTransaction();
        try {

            /** Insert transfer header */
            $orderTypeData = Order_type::create([
                'order_type_code' => $order_type_code,
                'order_type_name' => $order_type_name,
                'order_type_desc' => $order_type_desc,
                'work_type_id' => $work_type->id,
                'flag' => $status,
                'created_by' => $user?->id,
                'updated_by' => $user?->id,
            ]);

            (string) $title = 'Success';
            (string) $message = 'Order Type request successfully submitted with order type name: '.$order_type_name;
            (array) $data = [
                'trx_number' => $order_type_name,
            ];
            (string) $route = route('/master_data/order_type');

            DB::commit();
            return response()->json([
                'title' => $title,
                'message' => $message,
                'route' => $route,
                'data' => $data,
            ]);
        } catch (ValidationException $e) {
            DB::rollBack();
            Log::warning('Validation error when submit order type request', ['userId' => $user?->id, 'userName' => $user?->name, 'errors' => $e->getMessage()]);
            throw $e;
        } catch (\Throwable $e) {
            DB::rollBack();
            throw new CommonCustomException('Failed to submit order type request', 422, $e);
        }

    }

    public function getOldDataOfOrderType(Request $request)
    {
        $data = Order_type::where('id', $request->order_type_id)->first();
        return response()->json($data);
    }

    public function postEditOrderType(Request $request)
    {

        $user = Auth::user();

        /** Validate Input */
        $validate = Validator::make($request->all(), [
            'id_order_type' => ['required'],
            'order_type_code' => ['required', 'string'],
            'order_type_name' => ['required', 'string'],
            'order_type_desc' => ['required', 'string'],
            'work_type' => ['required'],
            'status' => ['required'],
        ]);


        if ($validate->fails()) {
            throw new ValidationException($validate);
        }
        (array) $validated = $validate->validated();

        $order_type_name = $validated['order_type_name'];
        $order_type_code = $validated['order_type_code'];
        $order_type_desc = $validated['order_type_desc'];
        $work_type = Work_type::where('id', $validated['work_type'])->first();
        $status = $validated['status'];

        DB::beginTransaction();
        try {

            $orderTypeData = Order_type::where('id', $validated['id_order_type'])->first();

            $orderTypeData->order_type_code = $order_type_code;
            $orderTypeData->order_type_name = $order_type_name;
            $orderTypeData->order_type_desc = $order_type_desc;
            $orderTypeData->work_type_id = $work_type->id;
            $orderTypeData->flag = $status;
            $orderTypeData->updated_by = $user?->id;
            $orderTypeData->save();


            (string) $title = 'Success';
            (string) $message = "Order Type request successfully submitted with order type's name: ".$order_type_name;
            (array) $data = [
                'trx_number' => $order_type_name,
            ];
            (string) $route = route('/master_data/order_type');

            DB::commit();
            return response()->json([
                'title' => $title,
                'message' => $message,
                'route' => $route,
                'data' => $data,
            ]);
        } catch (ValidationException $e) {
            DB::rollBack();
            Log::warning('Validation error when submit order type request', ['userId' => $user?->id, 'userName' => $user?->name, 'errors' => $e->getMessage()]);
            throw $e;
        } catch (\Throwable $e) {
            DB::rollBack();
            throw new CommonCustomException('Failed to submit order type request', 422, $e);
        }

    }

}
