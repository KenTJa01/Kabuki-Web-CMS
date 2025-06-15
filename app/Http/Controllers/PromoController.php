<?php

namespace App\Http\Controllers;

use App\Exceptions\CommonCustomException;
use App\Models\Promo;
use App\Http\Requests\StorePromoRequest;
use App\Http\Requests\UpdatePromoRequest;
use App\Models\Item;
use App\Models\Promo_item;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class PromoController extends Controller
{

    public function masterPromoPage()
    {

        $user = Auth::user();

        // $sqlPermissionCreate = "SELECT pp.id, perm.key, s.submenu_name, u.username
        //                 FROM profile_permissions pp, permissions perm, submenus s, profiles p, users u
        //                 WHERE pp.profile_id = p.id
        //                     AND pp.permission_id = perm.id
        //                     AND u.profile_id = p.id
        //                     AND perm.sub_menu_id = s.id
        //                     AND perm.sub_menu_id = 3
        //                     AND perm.key = 'master_promo_create'
        //                     AND u.id = $user->id";

        // $sqlPermissionExport = "SELECT pp.id, perm.key, s.submenu_name, u.username
        //                 FROM profile_permissions pp, permissions perm, submenus s, profiles p, users u
        //                 WHERE pp.profile_id = p.id
        //                     AND pp.permission_id = perm.id
        //                     AND u.profile_id = p.id
        //                     AND perm.sub_menu_id = s.id
        //                     AND perm.sub_menu_id = 3
        //                     AND perm.key = 'master_promo_export'
        //                     AND u.id = $user->id";

        // $lastData = Item::latest()->first();

        (array) $data = [
            // 'lastData' => $lastData,
            // 'permission_create' => DB::select($sqlPermissionCreate),
            // 'permission_export' => DB::select($sqlPermissionExport),
        ];

        return view('/master_data/promo', $data);

    }

    public function getPromoListDatatable()
    {

        $user = Auth::user();
        $sql = ("SELECT p.id, p.promo_code, promo_name, p.promo_desc, p.price, (CASE WHEN p.flag = 1 THEN 'Active' ELSE 'Non-active' END) AS status
                FROM promos p
                ORDER BY p.id ASC");

        // $sqlPermissionEdit = ("SELECT pp.id, perm.key, s.submenu_name, u.username
        //                         FROM profile_permissions pp, permissions perm, submenus s, profiles p, users u
        //                         WHERE pp.profile_id = p.id
        //                             AND pp.permission_id = perm.id
        //                             AND u.profile_id = p.id
        //                             AND perm.sub_menu_id = s.id
        //                             AND perm.sub_menu_id = 3
        //                             AND perm.key = 'master_promo_edit'
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

    public function getAllDataItemInPromo()
    {

        $user = Auth::user();
        $sql = ("SELECT * FROM items
                WHERE items.flag = 1
                ORDER BY id ASC");

        $data = DB::select($sql);

        return DataTables::of($data)
            ->addIndexColumn()
            ->make(true);

    }

    public function postNewPromo(Request $request)
    {

        $user = Auth::user();

        /** Validate Input */
        $validate = Validator::make($request->all(), [
            'promoName' => ['required', 'string'],
            'promoDesc' => ['required', 'string'],
            'price' => ['required', 'integer'],
            'status' => ['required'],
            'dataItem' => ['array'],
        ]);

        if ($validate->fails()) {
            throw new ValidationException($validate);
        }
        (array) $validated = $validate->validated();

        // Ambil promo terakhir yang ada
        $lastPromo = Promo::whereNotNull('promo_code')->latest('promo_code')->first();

        // Ambil angka dari kode promo terakhir, contoh G001 -> 001
        $lastCodeNumber = $lastPromo ? (int) substr($lastPromo->promo_code, 1) : 0;

        // Buat kode promo berikutnya
        $nextCodeNumber = $lastCodeNumber + 1;

        // Format kode promo dengan menambahkan angka 0 di depan jika perlu (5 digit)
        $promo_code = 'K' . str_pad($nextCodeNumber, 5, '0', STR_PAD_LEFT);

        $promo_name = $validated['promoName'];
        $promo_desc = $validated['promoDesc'];
        $price = $validated['price'];
        $status = $validated['status'];
        (array) $data_items = $validated['dataItem'];

        $promoCek = Promo::where('promo_name', $promo_name)->first();
        if ( !is_null($promoCek) ) {
            throw ValidationException::withMessages(['detail' => 'promo already exist!']);
        }

        DB::beginTransaction();
        try {

            /** Insert transfer header */
            $promoData = Promo::create([
                'promo_code' => $promo_code,
                'promo_name' => $promo_name,
                'promo_desc' => $promo_desc,
                'price' => $price,
                'flag' => $status,
                'created_by' => $user?->id,
                'updated_by' => $user?->id,
            ]);

            foreach( $data_items as $di ) {

                $item = Item::where('id', $di)->first();

                Promo_item::firstOrCreate([
                    'promo_id' => $promoData->id,
                    'item_id' => $item->id,
                ],[
                    'created_by' => $user?->id,
                    'updated_by' => $user?->id,
                ]);

            }

            (string) $title = 'Success';
            (string) $message = 'Promo request successfully submitted with promo name: '.$promo_name;
            (array) $data = [
                'trx_number' => $promo_name,
            ];
            (string) $route = route('/master_data/promo');

            DB::commit();
            return response()->json([
                'title' => $title,
                'message' => $message,
                'route' => $route,
                'data' => $data,
            ]);
        } catch (ValidationException $e) {
            DB::rollBack();
            Log::warning('Validation error when submit promo request', ['userId' => $user?->id, 'userName' => $user?->name, 'errors' => $e->getMessage()]);
            throw $e;
        } catch (\Throwable $e) {
            DB::rollBack();
            throw new CommonCustomException('Failed to submit promo request', 422, $e);
        }

    }

    public function getOldDataOfPromo(Request $request)
    {

        $promoData = Promo::where('id', $request->promo_id)->first();
        $promoItemData = Promo_item::where('promo_id', $promoData->id)->get()->pluck('item_id');

        (array) $data = [
            'promo_data' => $promoData,
            'promo_item_data' => $promoItemData,
        ];

        return response()->json($data);

    }

    public function postEditPromo(Request $request)
    {

        $user = Auth::user();

        /** Validate Input */
        $validate = Validator::make($request->all(), [
            'id_promo' => ['required'],
            'promo_code' => ['required', 'string'],
            'promo_name' => ['required', 'string'],
            'promo_desc' => ['required', 'string'],
            'price' => ['required'],
            'status' => ['required'],
            'dataItem' => ['array'],
        ]);


        if ($validate->fails()) {
            throw new ValidationException($validate);
        }
        (array) $validated = $validate->validated();

        $promo_name = $validated['promo_name'];
        $promo_code = $validated['promo_code'];
        $promo_desc = $validated['promo_desc'];
        $price = $validated['price'];
        $status = $validated['status'];
        (array) $data_items = $validated['dataItem'];

        DB::beginTransaction();
        try {

            $promoData = Promo::where('id', $validated['id_promo'])->first();

            $promoData->promo_code = $promo_code;
            $promoData->promo_name = $promo_name;
            $promoData->promo_desc = $promo_desc;
            $promoData->price = $price;
            $promoData->flag = $status;
            $promoData->updated_by = $user?->id;
            $promoData->save();

            $promoItem = Promo_item::where('promo_id', $validated['id_promo'])->get();
            $i=0;
            if ( $promoItem != null ) {
                foreach ( $promoItem as $pp ) {
                    $promoItem[$i++]->delete();
                }
            }

            foreach ( $data_items as $di ) {

                $item = Item::where('id', $di)->first();

                Promo_item::firstOrCreate([
                    'promo_id' => $promoData->id,
                    'item_id' => $item->id,
                ],[
                    'created_by' => $user?->id,
                    'updated_by' => $user?->id,
                ]);

            }

            (string) $title = 'Success';
            (string) $message = "Promo request successfully submitted with promo's name: ".$promo_name;
            (array) $data = [
                'trx_number' => $promo_name,
            ];
            (string) $route = route('/master_data/promo');

            DB::commit();
            return response()->json([
                'title' => $title,
                'message' => $message,
                'route' => $route,
                'data' => $data,
            ]);
        } catch (ValidationException $e) {
            DB::rollBack();
            Log::warning('Validation error when submit promo request', ['userId' => $user?->id, 'userName' => $user?->name, 'errors' => $e->getMessage()]);
            throw $e;
        } catch (\Throwable $e) {
            DB::rollBack();
            throw new CommonCustomException('Failed to submit promo request', 422, $e);
        }

    }

}
