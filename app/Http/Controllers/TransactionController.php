<?php

namespace App\Http\Controllers;

use App\Exceptions\CommonCustomException;
use App\Models\Customer;
use App\Models\Finance_income;
use App\Models\Income_type;
use App\Models\Item;
use App\Models\Movement_type;
use App\Models\Order_type;
use App\Models\Status;
use App\Models\Stock;
use App\Models\Stock_movement;
use App\Models\Transaction_detail;
use App\Models\Transaction_header;
use App\Models\Transaction_history;
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

class TransactionController extends Controller
{

    public function transactionListPage()
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

        return view('/transaction/list_transaction', $data);

    }

    public function transactionHistoryPage()
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

        return view('/transaction/history_transaction', $data);

    }

    public function getTransactionHistoryDatatable()
    {

        $user = Auth::user();
        $sql = ("SELECT
                    trsh.id AS trs_id,
                    trsh.trs_no,
                    trsh.trs_date,
                    trsh.customer_fullname AS customer_name,
                    wt.work_type_name AS work_type,
                    ot.order_type_name AS order_type,
                    s.flag_desc AS status
                FROM
                    transaction_histories trsh
                LEFT JOIN work_types wt ON wt.id = trsh.work_type_id
                LEFT JOIN order_types ot ON ot.id = trsh.order_type_id
                LEFT JOIN statuses s ON trsh.flag = s.flag_value
                ORDER BY
                    trsh.trs_date DESC");

        $data = DB::select($sql);

        return DataTables::of($data)
            ->addIndexColumn()
            ->addColumn("actions", function($row) {
                $buttons = '';
                $buttons = '
                <a href="/transaction/view/'.$row->trs_id.'" title="View">
                    <button type="button" class="button_edit" title="View More" id="button_view_detail" data-id="'.$row->trs_id.'">
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

    public function getTransactionListDatatable()
    {

        $user = Auth::user();
        $sql = ("SELECT
                    trs.id AS trs_id,
                    trs.trs_no,
                    trs.trs_date,
                    trs.customer_fullname AS customer_name,
                    wt.work_type_name AS work_type,
                    ot.order_type_name AS order_type,
                    s.flag_desc AS status
                FROM
                    transaction_headers trs
                LEFT JOIN work_types wt ON wt.id = trs.work_type_id
                LEFT JOIN order_types ot ON ot.id = trs.order_type_id
                LEFT JOIN statuses s ON trs.flag = s.flag_value
                ORDER BY
                    trs.trs_date DESC;");

        $data = DB::select($sql);

        return DataTables::of($data)
            ->addIndexColumn()
            ->addColumn("actions", function($row) {
                $buttons = '';
                $buttons = '
                <a href="/transaction/view/'.$row->trs_id.'" title="View">
                    <button type="button" class="button_edit" title="View More" id="button_view_detail" data-id="'.$row->trs_id.'">
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

    public function getOrderTypeById(Request $request)
    {
        $data = Order_type::where('work_type_id', $request->work_type_id)->where('flag', 1)->get();
        return response()->json($data);
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

    public function postTrsSubmit(Request $request)
    {

        $user = Auth::user();

        /** Validate Input */
        $validate = Validator::make($request->all(), [
            'transaction_date' => ['required'],
            'work_type' => ['required'],
            'payment_type' => ['required'],
            'customer_id' => ['required'],
            'address' => ['required', 'string'],
            'no_telp' => ['required', 'string'],
            'vehicle_number' => ['required', 'string'],
            'detail' => ['required', 'array'],
            'detail.*.item_id' => ['required', 'integer'],
            'detail.*.qty' => ['required', 'integer', 'min:1'],
            'detail.*.subtotal' => ['required', 'integer', 'min:1'],
            'total_price' => ['required'],
        ]);
        if ($validate->fails()) {
            throw new ValidationException($validate);
        }
        (array) $validated = $validate->validated();

        /** Prepare transaction number, Format: TRF/MM.YY/STORE_CODE/SEQ */
        $transactionDate = Carbon::createFromFormat('d/m/Y', $validated['transaction_date'], 'Asia/Jakarta')->setTimezone('Asia/Jakarta');
        $trsDateMonthYear = Carbon::parse($transactionDate)->setTimezone('Asia/Jakarta')->format('m.y');
        $prefixTrsNumber = 'TRS/'.$trsDateMonthYear.'/';

        $sql = ("SELECT COALESCE(MAX(TO_NUMBER(RIGHT(trs_no,3), '999')),0) AS no FROM transaction_headers WHERE trs_no LIKE '$prefixTrsNumber%'");
        $data = DB::select($sql);
        foreach ($data as $d) {
            $seqNum = $d->no + 1;
        }
        $trsNumber = $prefixTrsNumber.str_pad($seqNum, 3, '0', STR_PAD_LEFT);

        $work_type = Work_type::where('id', $validated['work_type'])->first();
        $order_type = "";

        if ( $request->order_type == null ) {

            $order_type = null;

        } else {

            $order_type = Order_type::where('id', $request->order_type)->first()->id;

        }

        $status = Status::where('module', 'transaction')->where('flag_value', 1)->first();

        $note = "";

        if ($note == null) {

            $note = "-";

        } else {

            $note = $request->note;

        }

        $customerData = Customer::where('id', $validated['customer_id'])->first();
        $customer_name = $customerData->customer_name;
        $address = $customerData->address;
        $no_telp = $customerData->no_telp;
        $vehicle_number = $validated['vehicle_number'];
        $total_price = $validated['total_price'];

        $prefixIncomeNumber = 'INC/'.$trsDateMonthYear.'/';
        $sqlIncome = ("SELECT COALESCE(MAX(TO_NUMBER(RIGHT(income_no,3), '999')),0) AS no FROM finance_incomes WHERE income_no LIKE '$prefixIncomeNumber%'");
        $dataIncome = DB::select($sqlIncome);
        foreach ($dataIncome as $d) {
            $seqNumIncome = $d->no + 1;
        }
        $incomeNumber = $prefixIncomeNumber.str_pad($seqNumIncome, 3, '0', STR_PAD_LEFT);

        $income_type = Income_type::where('income_name', 'Transaction')->first();
        $income_desc = "Transaksi atas nama " . $customer_name . ". Nomor Transaksi : " . $trsNumber . ".";

        DB::beginTransaction();
        try {
            /** Insert transaction header */
            $trsHeader = Transaction_header::create([
                'trs_no' => $trsNumber,
                'trs_date' => $transactionDate,
                'work_type_id' => $work_type->id,
                'order_type_id' => $order_type,
                'payment_type' => $validated['payment_type'],
                'customer_fullname' => $customer_name,
                'address' => $address,
                'no_telp' => $no_telp,
                'vehicle_number' => $vehicle_number,
                'total_price' => $total_price,
                'note' => $note,
                'flag' => $status->id,
                'created_by' => $user?->id,
                'updated_by' => $user?->id,
            ]);

            /** Insert Finance Income  */
            $financeIncome = Finance_income::create([
                'income_no' => $incomeNumber,
                'income_date' => $trsHeader->trs_date,
                'income_type_id' => $income_type->id,
                'amount' => $total_price,
                'description' => $income_desc,
                'created_by' => $user?->id,
                'updated_by' => $user?->id,
            ]);

            /** Insert transaction history */
            // $trsHistory = Transaction_history::create([
            //     'trs_no' => $trsNumber,
            //     'trs_date' => $transactionDate,
            //     'work_type_id' => $work_type->id,
            //     'order_type_id' => $order_type,
            //     'customer_fullname' => $customer_name,
            //     'address' => $address,
            //     'no_telp' => $no_telp,
            //     'vehicle_number' => $vehicle_number,
            //     'total_price' => $total_price,
            //     'note' => $note,
            //     'flag' => $status->id,
            //     'created_by' => $user?->id,
            //     'updated_by' => $user?->id,
            // ]);

            /** Looping details */
            foreach ($validated['detail'] as $detail) {

                $item = Item::where('id', $detail['item_id'])->first();

                /** Get stock data */
                $stock = Stock::where('item_id', $item->id)->first();
                $mov_code = Movement_type::where('mov_code', 'TRS')->first();

                /** Check stock is freeze or not */
                if ($stock->so_flag == 1) {
                    throw ValidationException::withMessages(['detail' => 'Failed to submit transaction, stock product '.$item->item_name.' is freeze.']);
                }

                /** Check product is active or not */
                if ($item->flag != 1) {
                    throw ValidationException::withMessages(['detail' => 'Failed to submit transaction, product '.$item->item_name.' is not active.']);
                }

                /** Validate input qty with stock */
                if (($stock->quantity) < $detail['qty']) {
                    Log::warning('Stock '.$item->item_name.' is not available. Total Transaction Qty: '.$detail['qty'].', Stock Qty: '.$stock->quantity, ['userId' => $user->id, 'trsId' => $trsHeader->id]);
                    throw ValidationException::withMessages(['detail' => 'Stock '.$item->item_name.' is not available. Total Transaction Qty: '.$detail['qty'].', Stock Qty: '.$stock->quantity]);
                }

                /** Insert transfer detail */
                Transaction_detail::create([
                    'trs_id' => $trsHeader->id,
                    'item_id' => $item->id,
                    'item_code' => $item->item_code,
                    'item_desc' => $item->item_desc,
                    'quantity' => $detail['qty'],
                    'total_price_per_item' => $detail['subtotal'],
                    'created_by' => $user?->id,
                    'updated_by' => $user?->id,
                ]);

                $stock->quantity -= $detail['qty'];
                $stock->save();

                Stock_movement::create([
                    'mov_date' => $transactionDate,
                    'item_id' => $item->id,
                    'item_code' => $item->item_code,
                    'quantity' => $detail['qty'] * -1,
                    'mov_code' => $mov_code->mov_code,
                    'ref_no' => $trsNumber,
                    'purch_price' => 0,
                    'sales_price' => 0,
                    'created_by' => $user?->id,
                    'updated_by' => $user?->id,
                ]);

            }

            (string) $title = 'Success';
            (string) $message = 'Transaction request successfully submitted with number: '.$trsNumber;
            (array) $data = [
                'trx_number' => $trsNumber,
            ];
            (string) $route = route('/transaction/list');

            DB::commit();
            return response()->json([
                'title' => $title,
                'message' => $message,
                'route' => $route,
                'data' => $data,
            ]);
        } catch (ValidationException $e) {
            DB::rollBack();
            Log::warning('Validation error when submit transaction request', ['userId' => $user?->id, 'userName' => $user?->name, 'errors' => $e->getMessage()]);
            throw $e;
        } catch (\Throwable $e) {
            DB::rollBack();
            throw new CommonCustomException('Failed to submit transaction request', 422, $e);
        }

    }

    public function viewTransactionPage($id): View
    {
        $user = Auth::user();
        Log::debug('User is request transfer request page', ['userId' => $user?->id, 'userName' => $user?->name, 'trsId' => $id]);

        /** Get status id */
        // $statusTrfSubmit = Status::where('module', 'transfer')->where('flag_value', 2)->first()->flag_value;

        /** Get sites permission */
        // $userSites = User_site::where('user_id', $user?->id)->get()->pluck('site_code')->toArray();

        /** Get transfer header data */
        $sqlHeader = "SELECT th.trs_no, th.trs_date, th.customer_fullname, wt.work_type_name,
                        ot.order_type_name, th.order_type_id, th.address, th.no_telp,
                        th.vehicle_number, th.note, th.flag, th.payment_type, th.total_price
                    FROM transaction_headers th
                    JOIN work_types wt ON th.work_type_id = wt.id
                    LEFT JOIN order_types ot ON th.order_type_id = ot.id
                    WHERE th.id = $id
                    LIMIT 1;
";

        /** Get transaction detail data */
        $sqlDetail = "SELECT td.id AS detail_id, td.item_id, td.item_code, td.item_desc,
                td.quantity, td.total_price_per_item
            FROM transaction_details td
            WHERE td.trs_id = $id
            ORDER BY td.item_desc";

        /** Permission for print document */
        // $isPrintAllowed = false;
        // $trfHeader = collect(DB::select($sqlHeader))->first();
        // if (Profile::authorize(InterfaceClass::transaction_PRINT) && $trfHeader->flag == $statusTrfSubmit && in_array($trfHeader->site_code_orig, $userSites)) {
        //     $isPrintAllowed = true;
        // }

        (array) $data = [
            'trs_id' => $id,
            'trs_header_data' => collect(DB::select($sqlHeader))->first(),
            'trs_detail_data' => DB::select($sqlDetail),
            // 'is_print_allowed' => $isPrintAllowed,
        ];

        return view('/transaction/view_transaction', $data);
    }

    public function documentTrsPage($id): View
    {
        $user = Auth::user();
        Log::debug('User is request transaction request page', ['userId' => $user?->id, 'userName' => $user?->name, 'trfId' => $id]);

        /** Get transaction header data */
        $sqlHeader = "SELECT *
            FROM transaction_headers th
                WHERE th.id = $id
            LIMIT 1";

        /** Get transaction detail data */
        $sqlDetail = "SELECT td.id AS detail_id, td.item_id, td.item_code, td.item_desc,
                td.quantity, td.total_price_per_item
            FROM transaction_details td
            WHERE td.trs_id = $id
            ORDER BY td.item_desc";

        /** Permission for print document */
        // $isPrintAllowed = false;
        // $trsHeader = collect(DB::select($sqlHeader))->first();
        // if (Profile::authorize(InterfaceClass::TRANSFER_PRINT) && $trsHeader->flag == $statustrsSubmit && in_array($trsHeader->site_code_orig, $userSites)) {
        //     $isPrintAllowed = true;
        // }

        (array) $data = [
            'trs_id' => $id,
            'trs_header_data' => collect(DB::select($sqlHeader))->first(),
            'trs_detail_data' => DB::select($sqlDetail),
            // 'is_print_allowed' => $isPrintAllowed,
        ];

        return view('transaction/document_transaction', $data);
    }

    // public function postTrsOnProcessSubmit(Request $request)
    // {

    //     $user = Auth::user();

    //     /** Validate Input */
    //     $validate = Validator::make($request->all(), [
    //         'id_trs_header' => ['required'],
    //         'work_type' => ['required', 'integer'],
    //         'order_type' => ['required', 'integer'],
    //     ]);


    //     if ($validate->fails()) {
    //         throw new ValidationException($validate);
    //     }
    //     (array) $validated = $validate->validated();

    //     $work_type = Work_type::where('id', $validated['work_type'])->first();
    //     $order_type = Order_type::where('id', $validated['order_type'])->first();

    //     DB::beginTransaction();
    //     try {

    //         $trsHeaderData = Transaction_header::where('id', $validated['id_trs_header'])->first();

    //         $trsHeaderData->work_type_id = $work_type->id;
    //         $trsHeaderData->order_type_id = $order_type->id;
    //         $trsHeaderData->updated_by = $user?->id;
    //         $trsHeaderData->save();

    //         /** Insert transaction history */
    //         $trsHeader = Transaction_history::create([
    //             'trs_no' => $trsHeaderData->trs_no,
    //             'trs_date' => $trsHeaderData->trs_date,
    //             'work_type_id' => $work_type->id,
    //             'order_type_id' => $order_type->id,
    //             'customer_fullname' => $trsHeaderData->customer_fullname,
    //             'address' => $trsHeaderData->address,
    //             'no_telp' => $trsHeaderData->no_telp,
    //             'vehicle_number' => $trsHeaderData->vehicle_number,
    //             'total_price' => $trsHeaderData->total_price,
    //             'note' => $trsHeaderData->note,
    //             'flag' => $trsHeaderData->flag,
    //             'created_by' => $user?->id,
    //             'updated_by' => $user?->id,
    //         ]);

    //         (string) $title = 'Success';
    //         (string) $message = "Transaction request successfully submitted with number: ".$trsHeaderData->trs_no;
    //         (array) $data = [
    //             'trx_number' => $trsHeaderData->trs_no,
    //         ];
    //         (string) $route = route('/transaction/list');

    //         DB::commit();
    //         return response()->json([
    //             'title' => $title,
    //             'message' => $message,
    //             'route' => $route,
    //             'data' => $data,
    //         ]);
    //     } catch (ValidationException $e) {
    //         DB::rollBack();
    //         Log::warning('Validation error when submit transaction request', ['userId' => $user?->id, 'userName' => $user?->name, 'errors' => $e->getMessage()]);
    //         throw $e;
    //     } catch (\Throwable $e) {
    //         DB::rollBack();
    //         throw new CommonCustomException('Failed to submit transaction request', 422, $e);
    //     }

    // }

}
