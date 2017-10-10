<?php
/**
 * Created by PhpStorm.
 * User: wang
 * Date: 2017/2/6
 * Time: 10:38
 */

namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $table='bl_category';
    protected $fillable =['category_type','category_name'];
    public $timestamps=true;
    protected function getDateFormat()
    {
        return time();
    }
    protected function getCategoryByUserId($user_id){
      return  Category::whereRaw('user_id=?',[$user_id])->get();
    }

    protected function getCategoryById($id){
        return  Category::whereRaw('id=?',[$id])->first();
    }
    protected function getCategory($user_id,$type=2){
        $user=User::find($user_id);
        $user_sex=$user->sex;
        return  Category::whereRaw('(user_id=? or is_common=? or is_common=3) and category_type=? '
            ,[$user_id,$user_sex,$type])
            ->get();
    }

}