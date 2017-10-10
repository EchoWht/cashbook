<?php
/**
 * Created by PhpStorm.
 * User: wang
 * Date: 2017/2/7
 * Time: 11:00
 */

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Session;

class LoginAuth
{
    public function handle($request ,Closure $next){
        $username = Session::get('username', 'default');
        if ($username=='default'){
            return redirect()->route('login');
        }
        return $next($request);
    }
}