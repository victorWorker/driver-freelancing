<?php

namespace App\Http\Middleware;

use Closure;

class AuthCheck
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $reqType = explode('/',$request->route()->uri)[1];
        $role = ($request->user()->type === 'ROOT') ? 'admin' : strtolower($request->user()->type);
        // dd($role);
        if($reqType === $role){
            return $next($request);
        }else{
            abort(400,"Access Denied");
        }
        
        // $main = explode("\\",$request->route()->getActionName());
        // $controller = explode("@",$main[4]);
        // $controller = $controller[0];
        // $module = $main[3];
        // // $department = strtolower($request->user()->department);
        // // $access = $request->user()->access;
        // if($request->user()->tokenCan($module.":".$controller) || $request->user()->department === "ROOT"){
        //     return $next($request);
        // }else{
        //     abort(400,"Access Denied");
        // }
    }
}
