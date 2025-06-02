<?php

namespace App\Http\Controllers;

use App\Exceptions\CommonCustomException;
use App\Models\Profile;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Session;

class UserController extends Controller
{

    public function masterUserPage()
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

        return view('/master_data/user', $data);

    }

    public function getUserListDatatable()
    {

        $user = Auth::user();
        $sql = ("SELECT DISTINCT u.id, u.username, u.name, p.profile_name AS profile, (CASE WHEN u.is_active=1 THEN 'Active' ELSE 'Non-active' END) AS status
                    FROM users u, profiles p
                    WHERE u.id is not null
                        AND u.profile_id = p.id
                    ORDER BY u.id ASC");

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
                </button>
                <button type="button" class="button_change_pw" title="Edit Site" id="button_change_pw" data-id="'.$row->id.'">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-key-fill" viewBox="0 0 16 16">
                        <path d="M3.5 11.5a3.5 3.5 0 1 1 3.163-5H14L15.5 8 14 9.5l-1-1-1 1-1-1-1 1-1-1-1 1H6.663a3.5 3.5 0 0 1-3.163 2M2.5 9a1 1 0 1 0 0-2 1 1 0 0 0 0 2"/>
                    </svg>
                </button>';


                return $buttons;
            })
            ->rawColumns(['actions'])
            ->make(true);

    }

    public function postNewUser(Request $request)
    {

        $user = Auth::user();

        /** Validate Input */
        $validate = Validator::make($request->all(), [
            'username' => ['required', 'string'],
            'name' => ['required', 'string'],
            'password' => ['required'],
            'profile' => ['required'],
            'status' => ['required'],
        ]);


        if ($validate->fails()) {
            throw new ValidationException($validate);
        }
        (array) $validated = $validate->validated();

        $username = $validated['username'];
        $name = $validated['name'];

        $userCek = User::where('username', $username)->first();
        if ( !is_null($userCek) ) {
            throw ValidationException::withMessages(['detail' => 'Username already exist!']);
        }

        // ===== BCRYPT PASSWORD =====
        $password = bcrypt($validated['password']);

        // ===== GET PROFILE & SITE =====
        $profile = Profile::where('id', $validated['profile'])->first();
        $status = $validated['status'];

        DB::beginTransaction();
        try {

            /** Insert transfer header */
            $userData = User::create([
                'username' => $username,
                'name' => $name,
                'password' => $password,
                'profile_id' => $profile->id,
                'is_active' => $status,
                'created_by' => $user?->id,
                'updated_by' => $user?->id,
            ]);

            (string) $title = 'Success';
            (string) $message = 'User request successfully submitted with username: '.$username;
            (array) $data = [
                'trx_number' => $username,
            ];
            (string) $route = route('/master_data/user');

            DB::commit();
            return response()->json([
                'title' => $title,
                'message' => $message,
                'route' => $route,
                'data' => $data,
            ]);
        } catch (ValidationException $e) {
            DB::rollBack();
            Log::warning('Validation error when submit user request', ['userId' => $user?->id, 'userName' => $user?->name, 'errors' => $e->getMessage()]);
            throw $e;
        } catch (\Throwable $e) {
            DB::rollBack();
            throw new CommonCustomException('Failed to submit user request', 422, $e);
        }

    }

    public function getOldDataUser(Request $request)
    {
        $data = User::where('id', $request->user_id)->first();
        return response()->json($data);
    }

    public function postEditUser(Request $request)
    {

        $user = Auth::user();

        /** Validate Input */
        $validate = Validator::make($request->all(), [
            'id_user' => ['required'],
            'username' => ['required', 'string'],
            'name' => ['required', 'string'],
            'profile' => ['required'],
            'status' => ['required'],
        ]);


        if ($validate->fails()) {
            throw new ValidationException($validate);
        }
        (array) $validated = $validate->validated();

        $username = $validated['username'];
        $name = $validated['name'];
        $profile = Profile::where('id', $validated['profile'])->first();
        $status = $validated['status'];

        DB::beginTransaction();
        try {

            $userData = User::where('id', $validated['id_user'])->first();

            $userData->username = $username;
            $userData->name = $name;
            $userData->profile_id = $profile->id;
            $userData->is_active = $status;
            $userData->updated_by = $user?->id;
            $userData->save();


            (string) $title = 'Success';
            (string) $message = "User request successfully submitted with username: ".$username;
            (array) $data = [
                'trx_number' => $username,
            ];
            (string) $route = route('/master_data/user');

            DB::commit();
            return response()->json([
                'title' => $title,
                'message' => $message,
                'route' => $route,
                'data' => $data,
            ]);
        } catch (ValidationException $e) {
            DB::rollBack();
            Log::warning('Validation error when submit user request', ['userId' => $user?->id, 'userName' => $user?->name, 'errors' => $e->getMessage()]);
            throw $e;
        } catch (\Throwable $e) {
            DB::rollBack();
            throw new CommonCustomException('Failed to submit user request', 422, $e);
        }

    }

    public function postUserReqResetPw(Request $request)
    {

        $newPw = 12345;
        $newPwBcrypt = bcrypt($newPw);

        DB::beginTransaction();
        try {

            $user = User::find($request->id_user);
            $user->password = $newPwBcrypt;

            $user->update();

            (string) $title = 'Success';
            (string) $message = 'User request successfully change password into: '.$newPw;
            (array) $data = [
                'trx_number' => $user->username,
            ];
            (string) $route = route('/master_data/user');

            DB::commit();
            return response()->json([
                'title' => $title,
                'message' => $message,
                'route' => $route,
                'data' => $data,
            ]);
        } catch (ValidationException $e) {
            DB::rollBack();
            Log::warning('Validation error when submit change password request', ['userId' => $user?->id, 'userName' => $user?->name, 'errors' => $e->getMessage()]);
            throw $e;
        } catch (\Throwable $e) {
            DB::rollBack();
            throw new CommonCustomException('Failed to submit change password request', 422, $e);
        }

    }

    public function getMenu()
    {

        $user = Auth::user();

        $query = "SELECT u.username, pm.menu_id, m.menu_name
                    FROM users u, profiles p, profile_menus pm, menus m
                    WHERE u.profile_id = p.id
                        AND pm.profile_id = p.id
                        AND pm.menu_id = m.id
                        AND u.id = $user->id";

        $data = DB::select($query);
        // return response()->json($data);

        Session::forget('listMenu');
        Session::put('listMenu', $data);

    }

}
