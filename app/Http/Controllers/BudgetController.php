<?php
/**
 * Created by PhpStorm.
 * User: wang
 * Date: 2017/2/8
 * Time: 20:32
 */

namespace App\Http\Controllers;


use App\Models\Budget;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class BudgetController extends Controller
{
    private $oneday=86400;
    public function createBudget(Request $request){
        if ($request->isMethod('post')) {
            $this->validate($request, [
                'start_time' => 'required',
                'budget_name' => 'required',
                'avg_cash'=>'required',
                'day'=>'required'
            ], [
                'required' => ':attribute不能为空',
                'Integer'=>':attribute不合法'
            ],
                [
                    'start_time' => '开始时间',
                    'budget_name' => '预算名称',
                    'avg_cash'=>'每天花费',
                    'day'=>'天数'
                ]
            );
            $start_time=strtotime($request->input('start_time'));
            $budget_name=$request->input('budget_name');
            $avg_cash=$request->input('avg_cash');
            $day=$request->input('day');
            $end_time=$start_time+$this->oneday*$day;
            $user_id=User::getUserIdByName(Session::get('username'))->user_id;
            $Budget=new Budget();
            $Budget->budget_name=$budget_name;
            $Budget->avg_cash=$avg_cash;
            $Budget->start_time=$start_time;
            $Budget->end_time=$end_time;
            $Budget->user_id=$user_id;
            $bool=$Budget->save();
            if ($bool){
                $msg=1;
            }else{
                $msg=2;
            }
            return view('budget/create',['msg'=>$msg]);

        }else{

        }
        return view('budget/create');
    }
    public function budgetList(Request $request){
        $user_id = Session::get('user_id');
        $start_time=0;
        $end_time=time();

        $budget_list=Budget::getUserBudgetList($user_id);
        return view('budget.list',[
            'budget_list'=>$budget_list
        ]);
    }
}