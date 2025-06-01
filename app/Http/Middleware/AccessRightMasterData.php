<?php

namespace App\Http\Middleware;

use App\Models\Menu;
use App\Models\Profile_menu;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class AccessRightMasterData
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {

        if ( auth()->guest() ) {

            abort(403);

        } else {

            $user = Auth::user();
            $userProfile = $user->profile_id;

            $subMenu = Menu::where('submenu_name', 'User')->first();
            $profileMenu = Profile_menu::where('profile_id', $userProfile)
                            ->select('sub_menu_id')
                            ->pluck('sub_menu_id')
                            ->toArray();

            if ( !in_array($subMenu->id, $profileMenu) ) {

                abort(403);

            }

        }

        return $next($request);

    }
}
