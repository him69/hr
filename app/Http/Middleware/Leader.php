<?php

namespace App\Http\Middleware;

use Closure;
use Session;
use App\Models\User;
use Illuminate\Http\Request;

class Leader
{
    /**
     * Handle an incoming request.
     * 
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if (!empty(Session::get('user'))) {
            $user_id = Session::get('user');
            $request->user = $this->user($user_id);;
            return $next($request);
        }
        return redirect('/logout')->with('error', 'You are not authorized to access this page.');
    }
    
    public function user($user_id, $lt = 0)
    {
        $user = User::select('user.*', 'department.d_name')->where('user.id', $user_id)->leftJoin('department', 'user.user_type', 'department.id');
        if ($user->count() > 0) {
            return $user->first();
        } else {
            return redirect('logout');
        }
    }
}
