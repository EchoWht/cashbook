<?php
/**
 * Created by PhpStorm.
 * User: wang
 * Date: 2017/2/8
 * Time: 20:27
 */

namespace App\Models;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Budget extends Model
{
    protected $table='bl_budget';
    protected $fillable =['id','budget_name','avg_cash','start_time','end_time'];
    public $timestamps=true;
    protected function getDateFormat()
    {
        return time();
    }
    /*当前的list*/
    protected function getUserNowBudgetList($user_id,$start_time,$endtime,$row=5){
       $budget_list= Budget::whereRaw('user_id=? and start_time<?  and end_time>?',
           [$user_id,$start_time,$endtime])
//           ->get();
        ->paginate($row);
        return $budget_list;
    }
    protected function getUserTodayBudgetCash($user_id,$start_time,$endtime){
        $budget_cash= Budget::whereRaw('user_id=? and start_time<?  and end_time>?',
            [$user_id,$start_time,$endtime])
            ->sum('avg_cash');
        return $budget_cash;
    }
    protected function getUserAgoBudgetCash($user_id){
        /*SELECT `budget_name`,`avg_cash`, from_unixtime(`start_time`),from_unixtime(`end_time`) FROM `bl_budget` WHERE 1*/
        /*所有预算-所有花费*/
        $todayTime= strtotime('today');
        /*1.之前所有的预算,结束的，进行中的*/
        $budget_cash_ed=Budget::whereRaw('user_id=?  and end_time<?',
            [$user_id,$todayTime])
            ->sum('avg_cash');
        $budget_cash_ing =DB::select('select sum(ceil((?-start_time)/86400)*avg_cash) as cash  from bl_budget where user_id=?  and end_time>? and start_time <?',
            [$todayTime,$user_id,$todayTime,$todayTime]);
        $all_budget_cash_ago=$budget_cash_ed+$budget_cash_ing[0]->cash;

        /*2.之前的预算总花费*/
        $pay_total=CashList::getUserCashTotal($user_id,0,$todayTime,1,1);
        /*2.之前的预算总收入*/
        $income_total=CashList::getUserCashTotal($user_id,0,$todayTime,2,1);

        $budget_cash=$all_budget_cash_ago+$income_total-$pay_total;

        return $budget_cash;
    }
    protected function getUserBudgetList($user_id,$order_by='created_at',$row=5){
        $budget_list= Budget::whereRaw('user_id=?',
            [$user_id])
            ->orderBy($order_by,'desc')
            ->paginate($row);
        return $budget_list;
    }
}