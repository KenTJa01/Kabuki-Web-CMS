<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;
use Carbon\Carbon;
use Illuminate\View\View;

class StockController extends Controller
{

    public function stockListPage()
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

        return view('/stock/list_stock', $data);

    }

    public function getStockListDatatable(Request $request)
    {

        $user = Auth::user();
        $validate = Validator::make($request->all(), [
            'item' => ['nullable', 'integer'],
        ]);
        if ($validate->fails()) {
            throw new ValidationException($validate);
        }
        (array) $validated = $validate->validated();

        /** Prepare for parameters */
        $params = '';
        if (! is_null($validated['item'])) {
            $params .= " AND i.id = ".$validated['item'];
        }

        $sql = ("SELECT *, i.item_name, i.item_desc AS item_description
                 FROM stocks s, items i
                 WHERE s.item_id = i.id
                    $params
                 ORDER BY s.id DESC");

        $data = DB::select($sql);

        return DataTables::of($data)
            ->addIndexColumn()
            ->make(true);

    }

    public function listStockMovementPage()
    {

        $user = Auth::user();

        // $sqlPermissionExport = "SELECT pp.id, perm.key, s.submenu_name, u.username
        //                         FROM profile_permissions pp, permissions perm, submenus s, profiles p, users u
        //                         WHERE pp.profile_id = p.id
        //                             AND pp.permission_id = perm.id
        //                             AND u.profile_id = p.id
        //                             AND perm.sub_menu_id = s.id
        //                             AND perm.sub_menu_id = 15
        //                             AND perm.key = 'stockmovement_export'
        //                             AND u.id = $user->id";

        (array) $data = [
            // 'permission_export' => DB::select($sqlPermissionExport),
        ];

        return view('/stock/movement_stock', $data);

    }

    public function getMovementStockList(Request $request)
    {

        $user = Auth::user();
        $validate = Validator::make($request->all(), [
            'fromDate' => ['nullable'],
            'toDate' => ['nullable'],
            'item' => ['nullable', 'integer'],
            'mov_type' => ['nullable', 'integer'],
        ]);
        if ($validate->fails()) {
            throw new ValidationException($validate);
        }
        (array) $validated = $validate->validated();

        /** Prepare for parameters */
        $params = '';

        if (! is_null($validated['item'])) {
            $params .= " AND sm.item_id = ".$validated['item'];
        }

        if (! is_null($validated['mov_type'])) {
            $params .= " AND mt.id = ".$validated['mov_type'];
            // $params .= " AND sm.mov_code = '".$validated['movType']."'";
        }

        if (! is_null($validated['fromDate'])) {
            $params .= " AND sm.mov_date >= '".Carbon::parse($validated['fromDate'])->setTimezone('Asia/Jakarta')->format('Y-m-d')."'";
        }

        if (! is_null($validated['toDate'])) {
            $params .= " AND sm.mov_date <= '".Carbon::parse($validated['toDate'])->setTimezone('Asia/Jakarta')->format('Y-m-d')."'";
        }

        $sql = ("SELECT sm.id, i.item_name, sm.mov_date, sm.mov_code, sm.quantity, sm.ref_no
            FROM stock_movements sm, transaction_headers trs, items i, movement_types mt
            WHERE sm.mov_code = 'TRS'
                AND sm.ref_no = trs.trs_no
                AND sm.item_id = i.id
                AND sm.mov_code = mt.mov_code
                $params
            -- UNION ALL
            --     SELECT sm.id, i.item_name, sm.mov_date, sm.mov_code, sm.quantity, CAST(rec.origin_site_code AS TEXT) as from_site, rec.destination_site_code as to_site, sm.ref_no
            --     FROM stock_movements sm, receiving_headers rec, items i, movement_types mt
            --     WHERE sm.mov_code = 'TRF-IN'
            --         AND sm.ref_no = rec.rec_no
            --         AND sm.item_id = i.id
            --         AND rec.origin_site_code is not null
            --
            --         AND sm.mov_code = mt.mov_code
            --         AND EXISTS (
            --             SELECT 1
            --             FROM user_sites us
            --             WHERE us.site_id = sites.id
            --                 AND us.user_id = $user->id
            --         )$params
            UNION ALL
                SELECT sm.id, i.item_name, sm.mov_date, sm.mov_code, sm.quantity, sm.ref_no
                FROM stock_movements sm, receiving_headers rec, items i, movement_types mt
                WHERE sm.mov_code = 'REC'
                    AND sm.ref_no = rec.rec_no
                    AND sm.item_id = i.id
                    AND sm.mov_code = mt.mov_code
                    $params
            -- UNION ALL
            --     SELECT sm.id, i.item_name, sm.mov_date, sm.mov_code, sm.quantity, CAST(adj.site_code AS TEXT) as from_site, sm.ref_no
            --     FROM stock_movements sm, adjustment_headers adj, items i, movement_types mt
            --     WHERE sm.mov_code = 'ADJ'
            --         AND sm.ref_no = adj.adj_no
            --         AND sm.item_id = i.id
            --         AND sm.mov_code = mt.mov_code
            --         $params
            -- UNION ALL
            --     SELECT sm.id, i.item_name, sm.mov_date, sm.mov_code, sm.quantity, CAST(so.site_code AS TEXT) as from_site, sm.ref_no
            --     FROM stock_movements sm, stock_opname_headers so, items i, movement_types mt
            --     WHERE sm.mov_code = 'SO'
            --         AND sm.ref_no = so.so_no
            --         AND sm.item_id = i.id
            --         AND sm.mov_code = mt.mov_code
            --         $params
            -- UNION ALL
            --     SELECT sm.id, i.item_name, sm.mov_date, sm.mov_code, sm.quantity, CAST(sm.site_code AS TEXT) AS from_site, sm.ref_no
            --     FROM stock_movements sm, items i, movement_types mt
            --     WHERE sm.mov_code = 'OB'
            --         AND sm.item_id = i.id
            --         AND sm.mov_code = mt.mov_code
            --         $params
            -- UNION ALL
            --     SELECT sm.id, i.item_name, sm.mov_date, sm.mov_code, sm.quantity, ret.supp_name as from_site, ret.site_code as to_site, sm.ref_no
            --     FROM stock_movements sm, return_headers ret, items i, movement_types mt
            --     WHERE sm.mov_code = 'RET'
            --         AND sm.ref_no = ret.ret_no
            --         AND sm.item_id = i.id
            --         AND sm.mov_code = mt.mov_code
            --         $params
        ");
        $data = DB::select($sql);

        return DataTables::of($data)->addIndexColumn()->make(true);

    }

}
