<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Menu;
use App\Models\Profile;

class MasterDataController extends Controller
{

    public function getAllDataMenu()
    {
        $data = Menu::where('flag', 1)->get();
        return response()->json($data);
    }

    public function getAllDataProfile()
    {
        $data = Profile::where('flag', 1)->get();
        return response()->json($data);
    }

}
