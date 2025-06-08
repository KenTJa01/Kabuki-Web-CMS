<?php

namespace App\Http\Controllers;

use App\Exceptions\CommonCustomException;
use App\Models\Adjustment_detail;
use App\Models\Adjustment_header;
use App\Models\Item;
use App\Models\Movement_type;
use App\Models\Status;
use App\Models\Stock;
use App\Models\Stock_movement;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;
use Carbon\Carbon;
use Illuminate\View\View;

class AdjustmentController extends Controller
{

    public function adjustmentListPage()
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

        return view('/adjustment/list_adjustment', $data);

    }

    public function getAdjustmentListDatatable()
    {

        $user = Auth::user();
        $sql = ("SELECT ah.id AS adj_id, ah.adj_no, ah.adj_date, s.flag_desc AS status, s.flag_value
                FROM adjustment_headers ah, statuses s
                WHERE ah.flag = s.flag_value
                    AND s.module = 'adjustment'
                ORDER BY ah.adj_date DESC");

        $data = DB::select($sql);

        return DataTables::of($data)
            ->addIndexColumn()
            ->addColumn("actions", function($row) {
                $buttons = '';
                $buttons = '
                <a href="/adjustment/view/'.$row->adj_id.'" title="View">
                <button type="button" class="button_edit" title="View More" id="button_view_detail" data-id="'.$row->adj_id.'">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-eye-fill" viewBox="0 0 16 16">
                        <path d="M10.5 8a2.5 2.5 0 1 1-5 0 2.5 2.5 0 0 1 5 0"/>
                        <path d="M0 8s3-5.5 8-5.5S16 8 16 8s-3 5.5-8 5.5S0 8 0 8m8 3.5a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7"/>
                    </svg>
                </button>
                </a>';

                return $buttons;
            })
            ->rawColumns(['actions'])
            ->make(true);

    }

    public function adjustmentFormPage()
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

        return view('/adjustment/form_adjustment', $data);

    }

    public function getAdjItem()
    {

        $user = Auth::user();

        $sql = ("SELECT DISTINCT i.id AS item_id, i.item_code, i.item_name
            FROM stocks s, items i
            WHERE i.flag = 1
            ORDER BY i.item_name");
		$data = DB::select($sql);

        return response()->json($data);

    }

    public function getAdjStockQty(Request $request)
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

    public function getAdjUpdQty(Request $request)
    {

        $user = Auth::user();

        /** Validate Input */
        $validate = Validator::make($request->all(), [
            'operator' => ['required'],
            'qtyData' => ['required', 'integer'],
            'stockQtyData' => ['required', 'integer'],
        ]);
        if ($validate->fails()) {
            throw new ValidationException($validate);
        }
        (array) $validated = $validate->validated();

        $operator = $validated['operator'];

        $stockQty = (int)$validated['stockQtyData'];
        $qtyData = (int)$validated['qtyData'];

        $updateStock = $stockQty + (($operator == '-' ? $qtyData * -1 : $qtyData));

        // if ($reason-> == 1) {
        //     $updateStock = $validated['stockQtyData'] - $validated['qtyData'];
        // } else if ($validated['reasonData'] == 2) {
        //     $updateStock = $validated['stockQtyData'] + $validated['qtyData'];
        // }

        return response()->json($updateStock);

    }

    public function postAdjSubmit(Request $request)
    {

        $user = Auth::user();

        /** Validate Input */
        $validate = Validator::make($request->all(), [
            'adjustment_date' => ['required'],
            'detail' => ['required', 'array'],
            'detail.*.item_id' => ['required', 'integer'],
            'detail.*.operator' => ['required'],
            'detail.*.stock_qty' => ['required', 'integer'],
            'detail.*.qty' => ['required', 'integer', 'min:1', 'max:10000'],
            'detail.*.update_qty' => ['required', 'integer', 'min:0'],
        ]);

        if ($validate->fails()) {
            throw new ValidationException($validate);
        }
        (array) $validated = $validate->validated();

        $adjustmentDate = Carbon::createFromFormat('d/m/Y', $validated['adjustment_date'], 'Asia/Jakarta')->setTimezone('Asia/Jakarta');
        $adjDateMonthYear = Carbon::parse($adjustmentDate)->setTimezone('Asia/Jakarta')->format('m.y');
        $prefixAdjNumber = 'ADJ/'.$adjDateMonthYear.'/';

        $sql = ("SELECT COALESCE(MAX(TO_NUMBER(RIGHT(adj_no,3), '999')),0) AS no FROM adjustment_headers WHERE adj_no LIKE '$prefixAdjNumber%'");
        $data = DB::select($sql);
        foreach ($data as $d) {
            $seqNum = $d->no + 1;
        }

        $adjNumber = $prefixAdjNumber.str_pad($seqNum, 3, '0', STR_PAD_LEFT);

        $statusAdj = Status::where('module', 'adjustment')->where('flag_value', 1)->first()->flag_value;

        DB::beginTransaction();
        try {
            /** Insert transfer header */
            $adjHeader = Adjustment_header::create([
                'adj_no' => $adjNumber,
                'adj_date' => $adjustmentDate,
                'flag' => $statusAdj,
                'created_by' => $user?->id,
                'updated_by' => $user?->id,
            ]);

            /** Looping details */
            foreach ($validated['detail'] as $detail) {

                $item = Item::where('id', $detail['item_id'])->first();
                $stockQty = $detail['stock_qty'];
                $adjQty = $detail['qty'];
                $updateQty = $detail['update_qty'];
                $operator = $detail['operator'];
                $operatorToString = "";

                // BELOM PASTI
                $move_code = Movement_type::where('mov_code', 'ADJ')->first();

                /** Get stock data */
                $dataStock = Stock::where('item_id', $item->id)->first();

                /** Check stock is freeze or not */
                if ($dataStock->so_flag == 1) {
                    throw ValidationException::withMessages(['detail' => 'Failed to submit adjustment, stock product '.$item->item_name.' is freeze.']);
                }

                /** Check product is active or not */
                if ($item->flag != 1) {
                    throw ValidationException::withMessages(['detail' => 'Failed to submit adjustment, item '.$item->item_name.' is not active.']);
                }

                if ($operator == "+") {
                    $operatorToString = "PLUS";
                } else {
                    $operatorToString = "MINUS";
                }

                /** Insert transfer detail */
                Adjustment_detail::create([
                    'adj_id' => $adjHeader->id,
                    'item_id' => $item->id,
                    'item_code' => $item->item_code,
                    'item_desc' => $item->item_name,
                    'adj_qty' => ($operator == '-' ? $adjQty * -1 : $adjQty),
                    'stock_before_adj' => $stockQty,
                    'stock_after_adj' => $updateQty,
                    'reason' => $operatorToString,
                    'created_by' => $user?->id,
                    'updated_by' => $user?->id,
                ]);

                $dataStock->quantity = $updateQty;
                $dataStock->updated_at = date('Y-m-d H:i:s');
                $dataStock->updated_by = $user?->id;
                $dataStock->save();

                // MOVEMENT BELOM
                Stock_movement::create([
                    'mov_date' => $adjustmentDate,
                    'item_id' => $item->id,
                    'item_code' => $item->item_code,
                    'quantity' => ($operator == '-' ? $adjQty * -1 : $adjQty),
                    'mov_code' => $move_code->mov_code,
                    'ref_no' => $adjNumber,
                    'purch_price' => 0,
                    'sales_price' => 0,
                    'created_by' => $user?->id,
                    'updated_by' => $user?->id,
                ]);


            }

            (string) $title = 'Success';
            (string) $message = 'Adjustment request successfully submitted with number: '.$adjNumber;
            (array) $data = [
                'trx_number' => $adjNumber,
            ];
            (string) $route = route('/adjustment/list');

            DB::commit();
            return response()->json([
                'title' => $title,
                'message' => $message,
                'route' => $route,
                'data' => $data,
            ]);
        } catch (ValidationException $e) {
            DB::rollBack();
            Log::warning('Validation error when submit adjustment request', ['userId' => $user?->id, 'userName' => $user?->name, 'errors' => $e->getMessage()]);
            throw $e;
        } catch (\Throwable $e) {
            DB::rollBack();
            throw new CommonCustomException('Failed to submit adjustment request', 422, $e);
        }

    }

    public function viewAdjustmentPage($id): View
    {
        $user = Auth::user();
        Log::debug('User is request transfer request page', ['userId' => $user?->id, 'userName' => $user?->name, 'trfId' => $id]);

        // Get adjustment header data
        $sqlHeader = "SELECT ah.id, ah.adj_no, ah.adj_date
            FROM adjustment_headers ah
            WHERE ah.id = $id
            LIMIT 1";

        $sqlDetail = "SELECT ad.id, ad.item_id, ad.item_code, ad.item_desc, ad.adj_qty, ad.stock_before_adj, ad.stock_after_adj, ad.reason
        FROM adjustment_details ad
        WHERE ad.adj_id = $id
        ORDER BY ad.item_desc";

        /** Permission for print document */
        // $isPrintAllowed = false;
        // $trfHeader = collect(DB::select($sqlHeader))->first();
        // if (Profile::authorize(InterfaceClass::TRANSFER_PRINT) && $trfHeader->flag == $statusTrfSubmit && in_array($trfHeader->site_code_orig, $userSites)) {
        //     $isPrintAllowed = true;
        // }

        (array) $data = [
            'adj_id' => $id,
            'adj_header_data' => collect(DB::select($sqlHeader))->first(),
            'adj_detail_data' => DB::select($sqlDetail),
            // 'is_print_allowed' => $isPrintAllowed,
        ];

        return view('/adjustment/view_adjustment', $data);
    }

}
