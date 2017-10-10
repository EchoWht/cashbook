<?php
/**
 * Created by PhpStorm.
 * User: wang
 * Date: 2017/2/6
 * Time: 9:49
 */

namespace App\Models;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class CashList extends Model
{
    protected $table='bl_cash_list';
    protected $fillable =['user_id','created_time','is_budget','category_id','cash_total','cash_type'];
    public $timestamps=true;
    /*一对一*/
    public function category()
    {
        return $this->hasOne('App\Models\Category', 'id', 'category_id');
    }


    protected function getDateFormat()
    {
        return time();
    }

   /* protected function getCashListByUserId($user_id){
        /*SELECT bl_cash_list.*,bl_category.category_name
        FROM  bl_cash_list, bl_category
        WHERE bl_cash_list.category_id = bl_category.id

        SELECT bl_cash_list.*,bl_category.category_name
        FROM bl_cash_list INNER JOIN bl_category
        ON bl_cash_list.category_id = bl_category.id

        return  Category::whereRaw('user_id=?',[$user_id])->get();
    }*/

    protected function getCashListByUserId($user_id,$orderBy='created_time',$row=5){
       /* return DB::select('
         SELECT bl_cash_list.*,bl_category.category_name
        FROM bl_cash_list INNER JOIN bl_category
        ON bl_cash_list.category_id = bl_category.id
        ');*/
       //        return DB::table('bl_category')->paginate(1);
        //    return Category::paginate(2);
       return DB::table("bl_cash_list")
           ->join("bl_category","bl_cash_list.category_id","=","bl_category.id")
           ->orderBy($orderBy,'desc')
           ->whereRaw("bl_cash_list.user_id=$user_id")
           ->select("bl_cash_list.*","bl_category.category_name")
           ->paginate($row);
    }

    protected function getUserCashTotal($user_id,$s_time,$e_time,$cash_type,$is_budget=null,$category_id=null){
        $where='user_id=?  and created_time BETWEEN ? and ?  and cash_type=? ';
        $where_file=array($user_id,$s_time,$e_time,$cash_type);
        if ($is_budget!=null){
            $where=$where.' and is_budget = ?';
            array_push($where_file,$is_budget);
        }
        if ($category_id!=null){
            $where=$where.' and category_id = ?';
            array_push($where_file,$category_id);
        }
//return $where;
        $total=CashList::whereRaw(
            $where,
            $where_file
        )
            ->sum('cash_total');
        return $total;
    }
}