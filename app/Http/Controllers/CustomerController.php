<?php

namespace App\Http\Controllers;

use App\Exceptions\CommonCustomException;
use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class CustomerController extends Controller
{

    public function masterCustomerPage()
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

        return view('/master_data/customer', $data);

    }

    public function getCustomerListDatatable()
    {

        $user = Auth::user();
        $sql = ("SELECT c.id, c.customer_code, c.customer_name, c.no_telp, c.address, c.vehicle_type, c.vehicle_no, (CASE WHEN c.flag = 1 THEN 'Active' ELSE 'Non-active' END) AS status
                FROM customers c
                ORDER BY c.id ASC");

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

    public function postNewCustomer(Request $request)
    {

        $user = Auth::user();

        /** Validate Input */
        $validate = Validator::make($request->all(), [
            'customerName' => ['required', 'string'],
            'noTelp' => ['required', 'string'],
            'address' => ['required', 'string'],
            'vehicleType' => ['required', 'string'],
            'vehicleNo' => ['required', 'string'],
            'status' => ['required'],
        ]);


        if ($validate->fails()) {
            throw new ValidationException($validate);
        }
        (array) $validated = $validate->validated();

        // Ambil item terakhir yang ada
        $lastCustomer = Customer::whereNotNull('customer_code')->latest('customer_code')->first();

        // Ambil angka dari kode item terakhir, contoh G001 -> 001
        $lastCodeNumber = $lastCustomer ? (int) substr($lastCustomer->customer_code, 1) : 0;

        // Buat kode item berikutnya
        $nextCodeNumber = $lastCodeNumber + 1;

        // Format kode item dengan menambahkan angka 0 di depan jika perlu (5 digit)
        $customer_code = 'C' . str_pad($nextCodeNumber, 5, '0', STR_PAD_LEFT);

        $customer_name = $validated['customerName'];
        $no_telp = $validated['noTelp'];
        $address = $validated['address'];
        $vehicle_type = $validated['vehicleType'];
        $vehicle_no = $validated['vehicleNo'];
        $status = $validated['status'];

        $customerCek = Customer::where('customer_name', $customer_name)->first();
        if ( !is_null($customerCek) ) {
            throw ValidationException::withMessages(['detail' => 'customer already exist!']);
        }

        DB::beginTransaction();
        try {

            /** Insert transfer header */
            $customerData = Customer::create([
                'customer_code' => $customer_code,
                'customer_name' => $customer_name,
                'no_telp' => $no_telp,
                'address' => $address,
                'vehicle_type' => $vehicle_type,
                'vehicle_no' => $vehicle_no,
                'flag' => $status,
                'created_by' => $user?->id,
                'updated_by' => $user?->id,
            ]);

            (string) $title = 'Success';
            (string) $message = 'Customer request successfully submitted with customer name: '.$customer_name;
            (array) $data = [
                'trx_number' => $customer_name,
            ];
            (string) $route = route('/master_data/customer');

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

    public function getOldDataOfCustomer(Request $request)
    {
        $data = Customer::where('id', $request->customer_id)->first();
        return response()->json($data);
    }

    public function postEditCustomer(Request $request)
    {

        $user = Auth::user();

        /** Validate Input */
        $validate = Validator::make($request->all(), [
            'id_customer' => ['required'],
            'customer_name' => ['required', 'string'],
            'no_telp' => ['required', 'string'],
            'address' => ['required', 'string'],
            'vehicle_type' => ['required', 'string'],
            'vehicle_no' => ['required', 'string'],
            'status' => ['required'],
        ]);


        if ($validate->fails()) {
            throw new ValidationException($validate);
        }
        (array) $validated = $validate->validated();

        $customer_name = $validated['customer_name'];
        $no_telp = $validated['no_telp'];
        $address = $validated['address'];
        $vehicle_type = $validated['vehicle_type'];
        $vehicle_no = $validated['vehicle_no'];
        $status = $validated['status'];

        DB::beginTransaction();
        try {

            $customerData = Customer::where('id', $validated['id_customer'])->first();

            $customerData->customer_name = $customer_name;
            $customerData->no_telp = $no_telp;
            $customerData->address = $address;
            $customerData->vehicle_type = $vehicle_type;
            $customerData->vehicle_no = $vehicle_no;
            $customerData->flag = $status;
            $customerData->updated_by = $user?->id;
            $customerData->save();


            (string) $title = 'Success';
            (string) $message = "Customer request successfully submitted with customer's name: ".$customer_name;
            (array) $data = [
                'trx_number' => $customer_name,
            ];
            (string) $route = route('/master_data/customer');

            DB::commit();
            return response()->json([
                'title' => $title,
                'message' => $message,
                'route' => $route,
                'data' => $data,
            ]);
        } catch (ValidationException $e) {
            DB::rollBack();
            Log::warning('Validation error when submit customer request', ['userId' => $user?->id, 'userName' => $user?->name, 'errors' => $e->getMessage()]);
            throw $e;
        } catch (\Throwable $e) {
            DB::rollBack();
            throw new CommonCustomException('Failed to submit customer request', 422, $e);
        }

    }

}
