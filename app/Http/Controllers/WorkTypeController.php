<?php

namespace App\Http\Controllers;

use App\Exceptions\CommonCustomException;
use App\Models\Work_type;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class WorkTypeController extends Controller
{

    public function masterWorkTypePage()
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

        return view('/master_data/work_type', $data);

    }

    public function getWorkTypeListDatatable()
    {

        $user = Auth::user();
        $sql = ("SELECT wt.id, wt.work_type_code, wt.work_type_name, wt.work_type_desc, (CASE WHEN wt.flag = 1 THEN 'Active' ELSE 'Non-active' END) AS status
                FROM work_types wt
                ORDER BY wt.id ASC");

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

    public function postNewWorkType(Request $request)
    {

        $user = Auth::user();

        /** Validate Input */
        $validate = Validator::make($request->all(), [
            'workTypeName' => ['required', 'string'],
            'workTypeDesc' => ['required', 'string'],
            'status' => ['required'],
        ]);


        if ($validate->fails()) {
            throw new ValidationException($validate);
        }
        (array) $validated = $validate->validated();

        // Ambil order type terakhir yang ada
        $lastWorkType = Work_type::whereNotNull('work_type_code')->latest('work_type_code')->first();

        // Ambil angka dari kode order type terakhir, contoh G001 -> 001
        $lastCodeNumber = $lastWorkType ? (int) substr($lastWorkType->work_type_code, 2) : 0;

        // Buat kode order type berikutnya
        $nextCodeNumber = $lastCodeNumber + 1;

        // Format kode order type dengan menambahkan angka 0 di depan jika perlu (5 digit)
        $work_type_code = 'WT' . str_pad($nextCodeNumber, 5, '0', STR_PAD_LEFT);

        $work_type_name = $validated['workTypeName'];
        $work_type_desc = $validated['workTypeDesc'];
        $status = $validated['status'];

        $workTypeCek = Work_type::where('work_type_name', $work_type_name)->first();
        if ( !is_null($workTypeCek) ) {
            throw ValidationException::withMessages(['detail' => 'Work Type already exist!']);
        }

        DB::beginTransaction();
        try {

            /** Insert transfer header */
            $workTypeData = Work_type::create([
                'work_type_code' => $work_type_code,
                'work_type_name' => $work_type_name,
                'work_type_desc' => $work_type_desc,
                'flag' => $status,
                'created_by' => $user?->id,
                'updated_by' => $user?->id,
            ]);

            (string) $title = 'Success';
            (string) $message = 'Work Type request successfully submitted with work type name: '.$work_type_name;
            (array) $data = [
                'trx_number' => $work_type_name,
            ];
            (string) $route = route('/master_data/work_type');

            DB::commit();
            return response()->json([
                'title' => $title,
                'message' => $message,
                'route' => $route,
                'data' => $data,
            ]);
        } catch (ValidationException $e) {
            DB::rollBack();
            Log::warning('Validation error when submit work type request', ['userId' => $user?->id, 'userName' => $user?->name, 'errors' => $e->getMessage()]);
            throw $e;
        } catch (\Throwable $e) {
            DB::rollBack();
            throw new CommonCustomException('Failed to submit work type request', 422, $e);
        }

    }

    public function getOldDataOfWorkType(Request $request)
    {

        $data = Work_type::where('id', $request->work_type_id)->first();
        return response()->json($data);

    }

    public function postEditWorkType(Request $request)
    {

        $user = Auth::user();

        /** Validate Input */
        $validate = Validator::make($request->all(), [
            'id_work_type' => ['required'],
            'work_type_code' => ['required', 'string'],
            'work_type_name' => ['required', 'string'],
            'work_type_desc' => ['required', 'string'],
            'status' => ['required'],
        ]);


        if ($validate->fails()) {
            throw new ValidationException($validate);
        }
        (array) $validated = $validate->validated();

        $work_type_name = $validated['work_type_name'];
        $work_type_code = $validated['work_type_code'];
        $work_type_desc = $validated['work_type_desc'];
        $status = $validated['status'];

        DB::beginTransaction();
        try {

            $workTypeData = Work_type::where('id', $validated['id_work_type'])->first();

            $workTypeData->work_type_code = $work_type_code;
            $workTypeData->work_type_name = $work_type_name;
            $workTypeData->work_type_desc = $work_type_desc;
            $workTypeData->flag = $status;
            $workTypeData->updated_by = $user?->id;
            $workTypeData->save();


            (string) $title = 'Success';
            (string) $message = "Work Type request successfully submitted with work type's name: ".$work_type_name;
            (array) $data = [
                'trx_number' => $work_type_name,
            ];
            (string) $route = route('/master_data/work_type');

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
