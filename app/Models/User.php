<?php

/**
 * Created by PhpStorm.
 * User: wang
 * Date: 2017/2/4
 * Time: 22:16
 */
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class User extends Model
{
    protected $table='bl_users';
    protected $primaryKey='user_id';
    /*public function getUserById($id){
        return DB::select('select * from '.$this->table.' where user_id = :id', ['id' => 1]);
    }*/
    protected function getUserById($id){
        $users = User::where('user_id','=',$id)->get();
        return $users;
    }
    protected function getUserIdByName($user_name){
        $users = User::where('user_name','=',$user_name)->first();
        return $users;
    }
    protected function checkUser($username,$password){
        $msg=0;
        $checkUsername = User::where('user_name','=',$username)
            ->count();
        if (!$checkUsername){
            $msg=2;
            return $msg;
        }
        $checkPassword = User::where('password','=',md5($password))
            ->count();
        if (!$checkPassword){
            $msg=3;
            return $msg;
        }
        $msg=1;
        return $msg;
    }

}