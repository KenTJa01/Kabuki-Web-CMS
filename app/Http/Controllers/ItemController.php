<?php

namespace App\Http\Controllers;

use App\Exceptions\CommonCustomException;
use App\Models\Item;
use App\Http\Requests\StoreItemRequest;
use App\Http\Requests\UpdateItemRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class ItemController extends Controller
{

    public function masterItemPage()
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

        return view('/master_data/item', $data);

    }

    public function getItemListDatatable()
    {

        $user = Auth::user();
        $sql = ("SELECT i.id, i.item_code, item_name, i.item_desc, i.unit_type, i.price, (CASE WHEN i.flag = 1 THEN 'Active' ELSE 'Non-active' END) AS status
                FROM items i
                ORDER BY i.id ASC");

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

    public function postNewItem(Request $request)
    {

        $user = Auth::user();

        /** Validate Input */
        $validate = Validator::make($request->all(), [
            'itemName' => ['required', 'string'],
            'itemDesc' => ['required', 'string'],
            'unitType' => ['required', 'string'],
            'price' => ['required', 'integer'],
            'status' => ['required'],
        ]);


        if ($validate->fails()) {
            throw new ValidationException($validate);
        }
        (array) $validated = $validate->validated();

        // Ambil item terakhir yang ada
        $lastItem = Item::whereNotNull('item_code')->latest('item_code')->first();

        // Ambil angka dari kode item terakhir, contoh G001 -> 001
        $lastCodeNumber = $lastItem ? (int) substr($lastItem->item_code, 1) : 0;

        // Buat kode item berikutnya
        $nextCodeNumber = $lastCodeNumber + 1;

        // Format kode item dengan menambahkan angka 0 di depan jika perlu (5 digit)
        $item_code = 'K' . str_pad($nextCodeNumber, 5, '0', STR_PAD_LEFT);

        $item_name = $validated['itemName'];
        $item_desc = $validated['itemDesc'];
        $unit_type = $validated['unitType'];
        $price = $validated['price'];
        $status = $validated['status'];

        $itemCek = Item::where('item_name', $item_name)->first();
        if ( !is_null($itemCek) ) {
            throw ValidationException::withMessages(['detail' => 'Item already exist!']);
        }

        DB::beginTransaction();
        try {

            /** Insert transfer header */
            $itemData = Item::create([
                'item_code' => $item_code,
                'item_name' => $item_name,
                'item_desc' => $item_desc,
                'unit_type' => $unit_type,
                'price' => $price,
                'flag' => $status,
                'created_by' => $user?->id,
                'updated_by' => $user?->id,
            ]);

            (string) $title = 'Success';
            (string) $message = 'Item request successfully submitted with item name: '.$item_name;
            (array) $data = [
                'trx_number' => $item_name,
            ];
            (string) $route = route('/master_data/item');

            DB::commit();
            return response()->json([
                'title' => $title,
                'message' => $message,
                'route' => $route,
                'data' => $data,
            ]);
        } catch (ValidationException $e) {
            DB::rollBack();
            Log::warning('Validation error when submit category request', ['userId' => $user?->id, 'userName' => $user?->name, 'errors' => $e->getMessage()]);
            throw $e;
        } catch (\Throwable $e) {
            DB::rollBack();
            throw new CommonCustomException('Failed to submit category request', 422, $e);
        }

    }

    public function getOldDataOfItem(Request $request)
    {
        $data = Item::where('id', $request->item_id)->first();
        return response()->json($data);
    }

    public function postEditItem(Request $request)
    {

        $user = Auth::user();

        /** Validate Input */
        $validate = Validator::make($request->all(), [
            'id_item' => ['required'],
            'item_code' => ['required', 'string'],
            'item_name' => ['required', 'string'],
            'item_desc' => ['required', 'string'],
            'unit_type' => ['required', 'string'],
            'price' => ['required'],
            'status' => ['required'],
        ]);


        if ($validate->fails()) {
            throw new ValidationException($validate);
        }
        (array) $validated = $validate->validated();

        $item_name = $validated['item_name'];
        $item_code = $validated['item_code'];
        $item_desc = $validated['item_desc'];
        $unit_type = $validated['unit_type'];
        $price = $validated['price'];
        $status = $validated['status'];

        DB::beginTransaction();
        try {

            $itemData = Item::where('id', $validated['id_item'])->first();

            $itemData->item_code = $item_code;
            $itemData->item_name = $item_name;
            $itemData->item_desc = $item_desc;
            $itemData->unit_type = $unit_type;
            $itemData->price = $price;
            $itemData->flag = $status;
            $itemData->updated_by = $user?->id;
            $itemData->save();


            (string) $title = 'Success';
            (string) $message = "Item request successfully submitted with item's name: ".$item_name;
            (array) $data = [
                'trx_number' => $item_name,
            ];
            (string) $route = route('/master_data/item');

            DB::commit();
            return response()->json([
                'title' => $title,
                'message' => $message,
                'route' => $route,
                'data' => $data,
            ]);
        } catch (ValidationException $e) {
            DB::rollBack();
            Log::warning('Validation error when submit item request', ['userId' => $user?->id, 'userName' => $user?->name, 'errors' => $e->getMessage()]);
            throw $e;
        } catch (\Throwable $e) {
            DB::rollBack();
            throw new CommonCustomException('Failed to submit item request', 422, $e);
        }

    }

}
