<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\User;
use App\Models\User_permission;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class CheckUserPermission
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  mixed  ...$requiredPermissions
     * @return mixed
     */
    public function handle(Request $request, Closure $next, $requiredPermissions)
    {
        if (!Session::has('user')) {
            // No user session, redirect to login or logout
            return redirect('/login')->with('error', 'Please login to access this page.');
        }

        $user = $this->getUser(Session::get('user'));
        $uper = User_permission::where('uid',$user->id)->first();
        if (!$this->hasRequiredPermissions($uper->permission, $requiredPermissions)) {
            // return json_encode();
            // User does not have the required permission
            return redirect('/unauthorized-access')->with('error', json_encode([$uper->permission, $requiredPermissions]));
        }

        // User has permission, proceed with request
        return $next($request);
    }

    /**
     * Fetch the user model.
     *
     * @param  int|string  $userId
     * @return \App\Models\User|null
     */
    protected function getUser($userId)
    {
        return User::find($userId);
    }

    /**
     * Check if the user has any of the required permissions.
     *
     * @param  \App\Models\User  $user
     * @param  array  $requiredPermissions
     * @return bool
     */
    protected function hasRequiredPermissions($per, $requiredPermissions)
    {
        // Assuming the User model has a relation `permissions` that retrieves associated permissions
        $userPermissions = explode(",",$per);

            if (in_array($requiredPermissions, $userPermissions)) {
                return true; // User has at least one of the required permissions
            }

        return false; // User does not have any of the required permissions
    }
}
