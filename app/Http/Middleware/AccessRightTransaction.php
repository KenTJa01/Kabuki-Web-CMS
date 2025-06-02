<?php

namespace App\Http\Middleware;

use App\Models\Menu;
use App\Models\Profile_menu;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class AccessRightTransaction
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

            $menu = Menu::where('menu_name', 'Transaction')->first();
            $profileMenu = Profile_menu::where('profile_id', $userProfile)
                            ->select('menu_id')
                            ->pluck('menu_id')
                            ->toArray();

            if ( !in_array($menu->id, $profileMenu) ) {

                abort(403);

            }

        }

        return $next($request);

    }
}
