<?php

namespace App\Http\Controllers;

use App\Exceptions\CommonCustomException;
use App\Models\Finance_income;
use App\Models\Income_type;
use App\Models\Status;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;
use Carbon\Carbon;
use Illuminate\View\View;

class FinanceController extends Controller
{

    public function financeIncomePage()
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

        return view('/finance/income', $data);

    }

    public function getIncomeListDatatable()
    {

        $user = Auth::user();
        $sql = ("SELECT
                    fc.id AS income_id,
                    fc.income_no,
                    fc.income_date,
                    fc.amount,
                    fc.description,
                    ic.income_name
                FROM
                    finance_incomes fc, income_types ic
                WHERE
                    fc.income_type_id = ic.id
                ORDER BY
                    fc.income_date DESC");

        $data = DB::select($sql);

        return DataTables::of($data)
            ->addIndexColumn()
            ->addColumn("actions", function($row) {
                $buttons = '';
                $buttons = '
                <a href="/transaction/view/'.$row->income_id.'" title="View">
                    <button type="button" class="button_edit" title="View More" id="button_view_detail" data-id="'.$row->income_id.'">
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

    public function postFinIncomeSubmit(Request $request)
    {

        $user = Auth::user();

        /** Validate Input */
        $validate = Validator::make($request->all(), [
            'income_date' => ['required'],
            'income_type' => ['required'],
            'amount' => ['required'],
            'description' => ['required'],
        ]);
        if ($validate->fails()) {
            throw new ValidationException($validate);
        }
        (array) $validated = $validate->validated();

        /** Prepare transaction number, Format: TRF/MM.YY/STORE_CODE/SEQ */
        $income_date = Carbon::createFromFormat('Y-m-d', $validated['income_date'], 'Asia/Jakarta')->setTimezone('Asia/Jakarta');
        $incomeDateMonthYear = Carbon::parse($income_date)->setTimezone('Asia/Jakarta')->format('m.y');
        $prefixIncNumber = 'INC/'.$incomeDateMonthYear.'/';

        $sql = ("SELECT COALESCE(MAX(TO_NUMBER(RIGHT(income_no,3), '999')),0) AS no FROM finance_incomes WHERE income_no LIKE '$prefixIncNumber%'");
        $data = DB::select($sql);
        foreach ($data as $d) {
            $seqNum = $d->no + 1;
        }
        $incomeNumber = $prefixIncNumber.str_pad($seqNum, 3, '0', STR_PAD_LEFT);

        $income_type = Income_type::where('id', $validated['income_type'])->first();
        $amount = $validated['amount'];
        $description = $validated['description'];

        DB::beginTransaction();
        try {
            /** Insert Finance Income  */
            $financeIncome = Finance_income::create([
                'income_no' => $incomeNumber,
                'income_date' => $income_date,
                'income_type_id' => $income_type->id,
                'amount' => $amount,
                'description' => $description,
                'created_by' => $user?->id,
                'updated_by' => $user?->id,
            ]);

            (string) $title = 'Success';
            (string) $message = 'Income request successfully submitted with number: '.$incomeNumber;
            (array) $data = [
                'trx_number' => $incomeNumber,
            ];
            (string) $route = route('/finance/income');

            DB::commit();
            return response()->json([
                'title' => $title,
                'message' => $message,
                'route' => $route,
                'data' => $data,
            ]);
        } catch (ValidationException $e) {
            DB::rollBack();
            Log::warning('Validation error when submit income request', ['userId' => $user?->id, 'userName' => $user?->name, 'errors' => $e->getMessage()]);
            throw $e;
        } catch (\Throwable $e) {
            DB::rollBack();
            throw new CommonCustomException('Failed to submit income request', 422, $e);
        }

    }

    public function financeExpensePage()
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

        return view('/finance/expense', $data);

    }

    public function getExpenseListDatatable()
    {

        $user = Auth::user();
        $sql = ("SELECT
                    fe.id AS expense_id,
                    fe.expense_no,
                    fe.expense_date,
                    fe.amount,
                    fe.description,
                    ic.expense_name
                FROM
                    finance_expenses fe, expense_types ic
                WHERE
                    fe.expense_type_id = ic.id
                ORDER BY
                    fe.expense_date DESC");

        $data = DB::select($sql);

        return DataTables::of($data)
            ->addIndexColumn()
            ->addColumn("actions", function($row) {
                $buttons = '';
                $buttons = '
                <a href="/transaction/view/'.$row->expense_id.'" title="View">
                    <button type="button" class="button_edit" title="View More" id="button_view_detail" data-id="'.$row->expense_id.'">
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
}
