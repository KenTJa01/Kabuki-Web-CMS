<?php

namespace App\Http\Controllers;

use App\Exceptions\CommonCustomException;
use App\Models\Customer;
use App\Models\Item;
use App\Models\Movement_type;
use App\Models\Order_type;
use App\Models\Receiving_detail;
use App\Models\Receiving_header;
use App\Models\Status;
use App\Models\Stock;
use App\Models\Stock_movement;
use App\Models\Work_type;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;
use Carbon\Carbon;
use Illuminate\View\View;

class ReceivingController extends Controller
{

    public function receivingListPage()
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

        return view('/receiving/list_receiving', $data);

    }

    public function getReceivingListDatatable()
    {

        $user = Auth::user();
        $sql = ("SELECT rh.id AS rec_id, rh.rec_no, rh.rec_date, rh.invoice_no, rh.supp_name, s.flag_desc AS status, s.flag_value
            FROM receiving_headers rh, statuses s
            WHERE rh.flag = s.flag_value
                AND s.module = 'receiving'
            ORDER BY rh.rec_date DESC");

        $data = DB::select($sql);

        return DataTables::of($data)
            ->addIndexColumn()
            ->addColumn("actions", function($row) {
                $buttons = '';
                $buttons = '
                <a href="/receiving/view/'.$row->rec_id.'" title="View">
                <button type="button" class="button_edit" title="View More" id="button_view_detail" data-id="'.$row->rec_id.'">
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

    public function receivingFormPage()
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

        return view('/receiving/form_receiving', $data);

    }

    public function getRecItem()
    {

        $sql = ("SELECT i.id AS item_id, i.item_code, i.item_name
            FROM items i
            WHERE i.flag = 1
            ORDER BY i.item_name");

		$data = DB::select($sql);

        return response()->json($data);

    }

    public function postRecSubmit(Request $request)
    {

        $user = Auth::user();

        /** Validate Input */
        $validate = Validator::make($request->all(), [
            'receiving_date' => ['required'],
            'invoice_no' => ['required', 'string'],
            'supplier_name' => ['required', 'string'],
            'detail' => ['required', 'array'],
            'detail.*.item_id' => ['required', 'integer'],
            'detail.*.qty' => ['required', 'integer', 'min:1'],
        ]);
        if ($validate->fails()) {
            throw new ValidationException($validate);
        }
        (array) $validated = $validate->validated();

        /** Prepare receiving number, Format: REC/MM.YY/STORE_CODE/SEQ */
        $receivingDate = Carbon::createFromFormat('d/m/Y', $validated['receiving_date'], 'Asia/Jakarta')->setTimezone('Asia/Jakarta');
        $recDateMonthYear = Carbon::parse($receivingDate)->setTimezone('Asia/Jakarta')->format('m.y');
        $prefixRecNumber = 'REC/'.$recDateMonthYear.'/';

        $sql = ("SELECT COALESCE(MAX(TO_NUMBER(RIGHT(rec_no,3), '999')),0) AS no FROM receiving_headers WHERE rec_no LIKE '$prefixRecNumber%'");
        $data = DB::select($sql);
        foreach ($data as $d) {
            $seqNum = $d->no + 1;
        }
        $recNumber = $prefixRecNumber.str_pad($seqNum, 3, '0', STR_PAD_LEFT);

        $invoice_no = $validated['invoice_no'];
        $supplier_name = $validated['supplier_name'];
        $statusRecReceived = Status::where('module', 'receiving')->where('flag_value', 1)->first()->flag_value;

        DB::beginTransaction();
        try {
            /** Insert receiving header */
            $recHeader = Receiving_header::create([
                'rec_no' => $recNumber,
                'rec_date' => $receivingDate,
                'supp_name' => $supplier_name,
                'invoice_no' => $invoice_no,
                'flag' => $statusRecReceived,
                'created_by' => $user?->id,
                'updated_by' => $user?->id,
            ]);

            /** Looping details */
            foreach ($validated['detail'] as $detail) {

                $item = Item::where('id', $detail['item_id'])->first();
                $quantity = $detail['qty'];

                /** Get stock data */
                $stock = Stock::where('item_id', $item->id)->first();
                $mov_code = Movement_type::where('mov_code', 'REC')->first();

                /** Check product is active or not */
                if ($item->flag != 1) {
                    throw ValidationException::withMessages(['detail' => 'Failed to submit receiving, product '.$item->item_name.' is not active.']);
                }

                /** Insert transfer detail */
                Receiving_detail::create([
                    'rec_id' => $recHeader->id,
                    'item_id' => $item->id,
                    'item_code' => $item->item_code,
                    'item_desc' => $item->item_desc,
                    'quantity' => $quantity,
                    'created_by' => $user?->id,
                    'updated_by' => $user?->id,
                ]);

                $dataStock = Stock::where('item_id', $item->id)->first();

                if ( is_null($dataStock) ) {
                    Stock::create([
                        'item_id' => $item->id,
                        'item_code' => $item->item_code,
                        'quantity' => $quantity,
                        'so_flag' => 0,
                        'created_by' => $user?->id,
                        'updated_by' => $user?->id,
                    ]);
                } else {
                    /** Check stock is freeze or not */
                    if ($dataStock->so_flag == 1) {
                        throw ValidationException::withMessages(['detail' => 'Failed to receiving, stock product '.$item->item_name.' is freeze.']);
                    }

                    $dataStock->quantity += $quantity;
                    $dataStock->updated_at = date('Y-m-d H:i:s');
                    $dataStock->updated_by = $user?->id;
                    $dataStock->save();
                }

                Stock_movement::create([
                    'mov_date' => $receivingDate,
                    'item_id' => $item->id,
                    'item_code' => $item->item_code,
                    'quantity' => $detail['qty'] * -1,
                    'mov_code' => $mov_code->mov_code,
                    'ref_no' => $recNumber,
                    'purch_price' => 0,
                    'sales_price' => 0,
                    'created_by' => $user?->id,
                    'updated_by' => $user?->id,
                ]);

            }

            (string) $title = 'Success';
            (string) $message = 'Receiving request successfully submitted with number: '.$recNumber;
            (array) $data = [
                'trx_number' => $recNumber,
            ];
            (string) $route = route('/receiving/list');

            DB::commit();
            return response()->json([
                'title' => $title,
                'message' => $message,
                'route' => $route,
                'data' => $data,
            ]);
        } catch (ValidationException $e) {
            DB::rollBack();
            Log::warning('Validation error when submit receiving request', ['userId' => $user?->id, 'userName' => $user?->name, 'errors' => $e->getMessage()]);
            throw $e;
        } catch (\Throwable $e) {
            DB::rollBack();
            throw new CommonCustomException('Failed to submit receiving request', 422, $e);
        }

    }

    public function viewReceivingPage($id): View
    {

        $user = Auth::user();
        Log::debug('User is request receiving request page', ['userId' => $user?->id, 'userName' => $user?->name, 'recId' => $id]);

        /** Get status id */
        // $statusTrfSubmit = Status::where('module', 'receiving')->where('flag_value', 2)->first()->flag_value;

        /** Get sites permission */
        // $userSites = User_site::where('user_id', $user?->id)->get()->pluck('site_code')->toArray();

        /** Get receiving header data */
        $sqlHeader = "SELECT rh.rec_no, rh.rec_date, rh.supp_name, rh.invoice_no, rh.flag
            FROM receiving_headers rh
            WHERE rh.id = $id
            LIMIT 1";

        /** Get receiving detail data */
        $sqlDetail = "SELECT rd.id AS detail_id, rd.item_id, rd.item_code, rd.item_desc,
                rd.quantity
            FROM receiving_details rd
            WHERE rd.rec_id = $id
            ORDER BY rd.item_desc";

        /** Permission for print document */
        // $isPrintAllowed = false;
        // $trfHeader = collect(DB::select($sqlHeader))->first();
        // if (Profile::authorize(InterfaceClass::receiving_PRINT) && $trfHeader->flag == $statusTrfSubmit && in_array($trfHeader->site_code_orig, $userSites)) {
        //     $isPrintAllowed = true;
        // }

        (array) $data = [
            'rec_id' => $id,
            'rec_header_data' => collect(DB::select($sqlHeader))->first(),
            'rec_detail_data' => DB::select($sqlDetail),
            // 'is_print_allowed' => $isPrintAllowed,
        ];

        return view('/receiving/view_receiving', $data);

    }

}
