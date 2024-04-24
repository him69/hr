<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use Session;
use App\Models\RequestLog;

class LogRequest
{
    public function handle($request, Closure $next)
    {
        $response = $next($request);

        $requestLog = new RequestLog();
        $requestLog->uid = Session::get('admin');
        $requestLog->request_url = $request->url();
        $requestLog->request_data = json_encode($request->all());
        $requestLog->save();

        return $response;
    }
}
