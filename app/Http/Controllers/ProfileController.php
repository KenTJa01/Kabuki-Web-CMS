<?php

namespace App\Http\Controllers;

use App\Exceptions\CommonCustomException;
use App\Models\Profile;
use App\Models\Menu;
use App\Models\Profile_menu;
use App\Http\Requests\StoreItemRequest;
use App\Http\Requests\UpdateItemRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class ProfileController extends Controller
{

    public function masterProfilePage()
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

        return view('/master_data/profile', $data);

    }

    public function getProfileListDatatable()
    {

        $user = Auth::user();
        $sql = ("SELECT p.id, p.profile_code, profile_name, (CASE WHEN p.flag = 1 THEN 'Active' ELSE 'Non-active' END) AS status
                FROM profiles p
                ORDER BY p.id ASC");

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

    public function postNewProfile(Request $request)
    {

        $user = Auth::user();

        /** Validate Input */
        $validate = Validator::make($request->all(), [
            'profileName' => ['required', 'string'],
            'status' => ['required'],
        ]);


        if ($validate->fails()) {
            throw new ValidationException($validate);
        }
        (array) $validated = $validate->validated();

        // Ambil profile terakhir yang ada
        $lastProfile = Profile::whereNotNull('profile_code')->latest('profile_code')->first();

        // Ambil angka dari kode profile terakhir, contoh G001 -> 001
        $lastCodeNumber = $lastProfile ? (int) substr($lastProfile->profile_code, 1) : 0;

        // Buat kode profile berikutnya
        $nextCodeNumber = $lastCodeNumber + 1;

        // Format kode profile dengan menambahkan angka 0 di depan jika perlu (5 digit)
        $profile_code = 'P' . str_pad($nextCodeNumber, 5, '0', STR_PAD_LEFT);

        $profile_name = $validated['profileName'];
        $menuData = $request->menu;
        $status = $validated['status'];

        $profileCek = Profile::where('profile_name', $profile_name)->first();
        if ( !is_null($profileCek) ) {
            throw ValidationException::withMessages(['detail' => 'Item already exist!']);
        }

        DB::beginTransaction();
        try {

            /** Insert transfer header */
            $profileData = Profile::create([
                'profile_code' => $profile_code,
                'profile_name' => $profile_name,
                'flag' => $status,
                'created_by' => $user?->id,
                'updated_by' => $user?->id,
            ]);

            if ( !empty($menuData) ) {

                foreach ($menuData as $md) {
                    $menu = Menu::where('id', $md)->first();

                    Profile_menu::firstOrCreate([
                        'profile_id' => $profileData->id,
                        'menu_id' => $menu->id,
                    ], [
                        'created_by' => $user?->id,
                        'updated_by' => $user?->id,
                    ]);
                }

            }

            (string) $title = 'Success';
            (string) $message = 'Profile request successfully submitted with profile name: '.$profile_name;
            (array) $data = [
                'trx_number' => $profile_name,
            ];
            (string) $route = route('/master_data/profile');

            DB::commit();
            return response()->json([
                'title' => $title,
                'message' => $message,
                'route' => $route,
                'data' => $data,
            ]);
        } catch (ValidationException $e) {
            DB::rollBack();
            Log::warning('Validation error when submit profile request', ['userId' => $user?->id, 'userName' => $user?->name, 'errors' => $e->getMessage()]);
            throw $e;
        } catch (\Throwable $e) {
            DB::rollBack();
            throw new CommonCustomException('Failed to submit profile request', 422, $e);
        }

    }

    public function getOldDataProfile(Request $request)
    {
        $data = Profile::where('id', $request->profile_id)->first();
        return response()->json($data);
    }

    public function getProfileMenuById(Request $request)
    {
        $data = Profile_menu::where('profile_id', $request->profile_id)->get()->pluck('menu_id')->toArray();
        return response()->json($data);
    }

    public function postEditProfile(Request $request)
    {

        $user = Auth::user();

        /** Validate Input */
        $validate = Validator::make($request->all(), [
            'id_profile' => ['required'],
            'profile_name' => ['required', 'string'],
            'status' => ['required'],
        ]);


        if ($validate->fails()) {
            throw new ValidationException($validate);
        }
        (array) $validated = $validate->validated();

        $profile_name = $validated['profile_name'];
        $status = $validated['status'];

        DB::beginTransaction();
        try {

            $profileMenuData = Profile_menu::where('profile_id', $request->id_profile)->get();

            $i=0;
            foreach($profileMenuData as $pmd){
                $profileMenuData[$i++]->delete();
            }

            $menuData = $request->menu;

            foreach($menuData as $md){

                $menu = Menu::where('id', $md)->first();

                Profile_menu::firstOrCreate([
                    'profile_id' => $request->id_profile,
                    'menu_id' => $menu->id,
                ], [
                    'created_by' => $user?->id,
                    'updated_by' => $user?->id,
                ]);

            }

            $profileData = Profile::where('id', $validated['id_profile'])->first();

            $profileData->profile_name = $profile_name;
            $profileData->flag = $status;
            $profileData->updated_by = $user?->id;
            $profileData->save();


            (string) $title = 'Success';
            (string) $message = "Profile request successfully submitted with profile's name: ".$profile_name;
            (array) $data = [
                'trx_number' => $profile_name,
            ];
            (string) $route = route('/master_data/profile');

            DB::commit();
            return response()->json([
                'title' => $title,
                'message' => $message,
                'route' => $route,
                'data' => $data,
            ]);
        } catch (ValidationException $e) {
            DB::rollBack();
            Log::warning('Validation error when submit profile request', ['userId' => $user?->id, 'userName' => $user?->name, 'errors' => $e->getMessage()]);
            throw $e;
        } catch (\Throwable $e) {
            DB::rollBack();
            throw new CommonCustomException('Failed to submit profile request', 422, $e);
        }

    }

}
