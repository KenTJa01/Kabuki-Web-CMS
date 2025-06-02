<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{

    public function loginPage()
    {

        return view('login');

    }

    public function postRequestLogin(Request $request)
    {

        $credentials = $request->validate([
            'username' => 'required',
            'password' => 'required',
        ]);

        $cekUser = User::where('username', $request->username)->first();

        // return $request;
        if ($cekUser){
            if ( $cekUser->is_active == 1 ) {

                if ( Auth::attempt($credentials) ) {

                    $userController = new UserController;
                    $userController->getMenu();
                    // $userController->getProfileDgmCore();
                    // $userController->getMenuDgmCore();

                    $request->session()->regenerate();
                    // Log::debug('SESSION', ['menu' => Session::get('listMenu')]);

                    return response()->json(['message' => 'Login Success!']);

                } else {

                    return response()->json(['errors' => 'LOGIN FAILED! Username or password are wrong!']);

                }

            } else {

                return response()->json(['errors' => 'User Not Active!']);

            }
        }
        return response()->json(['errors' => 'LOGIN FAILED! Username or password are wrong!']);

    }

    public function logout(Request $request)
    {

        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');

    }

}
