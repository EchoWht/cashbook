<?php
/**
 * Created by PhpStorm.
 * User: wang
 * Date: 2017/2/5
 * Time: 22:26
 */

namespace App\Http\Controllers;


use App\Models\Budget;
use App\Models\CashList;
use App\Models\Category;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class WorkController extends Controller

{
    protected function getUserid(){
            return  Session::get('user_id');
    }
    public function create(Request $request){

        /*获取公共分类和用户分类*/
        $user_id = $this->getUserid();
       $categorys= Category::getCategory($user_id,2);
       $categorys_income= Category::getCategory($user_id,1);

       /*获取当前的budeget*/
       $now=time();
       $now_budget_list=Budget::getUserNowBudgetList($user_id,$now,$now);

       /*今天budget的总额*/
       $now_budget_cash=Budget::getUserTodayBudgetCash($user_id,$now,$now);

       /*之前的结余*/
        $surplus=Budget:: getUserAgoBudgetCash($user_id);

        /*今天花费*/
        $todayTime= strtotime('today');
        $today_cash=CashList::getUserCashTotal($user_id,$todayTime,$now,1,1);
        $cash_datas=array(
            'categorys'=>$categorys,
            'categorys_income'=>$categorys_income,
            'now_budget_cash'=>$now_budget_cash,
            'surplus'=>$surplus,
            'today_cash'=>$today_cash
        );


        if ($request->isMethod('post')) {
            /*验证*/
            $this->validate($request, [
                'created_time' => 'required',
                'budget' => 'required|Integer',
                'category'=>'required',
                'cash_total'=>'required',
                 'cash_type'=>'required'
            ], [
                'required' => ':attribute不能为空',
                'Integer'=>':attribute不合法'
            ],
                [
                    'created_time' => '时间',
                    'budget' => '预算',
                    'category'=>'类型',
                    'cash_total'=>'金额',
                    'cash_type'=>'入出'
                ]
            );
            /*获取数据*/
            $created_time=$request->input('created_time');
            $budget=$request->input('budget');
            $category=$request->input('category');
            $cash_total=$request->input('cash_total');
            $cash_type=$request->input('cash_type');
            $user_id=User::getUserIdByName(Session::get('username'))->user_id;
            /*实例化模型 保存数据*/
            $CashList=new CashList();
            $CashList->created_time=strtotime($created_time);
            $CashList->is_budget=$budget;
            $CashList->category_id=$category;
            $CashList->cash_total=$cash_total;
            $CashList->cash_type=$cash_type;
            $CashList->user_id=$user_id;

            $bool=$CashList->save();
            if ($bool){
                $msg=1;
            }else{
                $msg=2;
            }
//            dd($category);
 return redirect()->route('list');
            // return view('work.create',
                // [
                    // 'msg'=>$msg,
                    // 'cash_datas'=>$cash_datas
                // ]);
        }else{
            return view('work.create',
                [
                    'cash_datas'=>$cash_datas
                ]);
        }

    }
    public function cashlist(){
        $user_id = $this->getUserid();
        $cashlist=CashList::getCashListByUserId($user_id);
//        $cashlist=$cashlist->toArray();
        // dd($cashlist);
        return view('work.list',['cashlist'=>$cashlist]);
    }
}