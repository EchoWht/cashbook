<?php
/**
 * Created by PhpStorm.
 * User: wang
 * Date: 2017/2/5
 * Time: 13:38
 */

namespace App\Http\Controllers;


use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Session;

class UserController extends Controller
{
    public function login(Request $request)
    {
        if ($request->isMethod('post')) {
            /*dd($request->input('username'));*/

            /*验证*/
            $this->validate($request, [
                'username' => 'required|min:2|max:30',
                'password' => 'required|min:6|max:30',
            ], [
                'required' => ':attribute不能为空',
                'min'=>':attribute不能小于:min个字符'
            ],
                [
                    'username' => '用户名',
                    'password' => '密码'
                ]
            );
            /*登录检验*/
            $username=$request->input('username');
            $password=$request->input('password');
           $msg= User::checkUser($username,$password);
           if ($msg==1){
               //登录状态
            Session::put('username',$username);
            $user_id=User::getUserIdByName($username)->user_id;
               Session::put('user_id',$user_id);
              /* if (Session::get('_previous.url')){
                   return redirect(Session::get('_previous.url'));
               }else{
                   return redirect('/');
               }*/
               return redirect('/create?cash_type=1');
           }
            return view('user.login')->with('msg', $msg);
        } else {
            if (Session::get('username')){

            }
//            var_dump(Session::get('_previous.url'));
            return view('user.login');
        }


    }
}