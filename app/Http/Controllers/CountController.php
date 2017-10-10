<?php
/**
 * Created by PhpStorm.
 * User: wang
 * Date: 2017/2/12
 * Time: 22:13
 */

namespace App\Http\Controllers;


use App\Models\CashList;
use App\Models\Category;
use Illuminate\Support\Facades\Session;

class CountController extends Controller
{
    public function dashboard(){

       return view('count.dashboard');
    }
    public function jsonDashboard(){
        $user_id = Session::get('user_id');
        /*获取总收入*/
        $income_total=CashList:: getUserCashTotal($user_id,0,time(),2);
        /*获取总支出*/
        $pay_total=CashList:: getUserCashTotal($user_id,0,time(),1);

        /*分类*/
        $categorys= Category::getCategory($user_id,2);
        $i=0;
        $categorys_pay=array();
        foreach ($categorys as $category){
            $i++;
            $categorys_pay[$i]['cash']=    CashList:: getUserCashTotal($user_id,0,time(),1,null,$category->id);
            $categorys_pay[$i]['id']=$category->id;
            $categorys_pay[$i]['category_name']=$category->category_name;
        }
        $categorys_income= Category::getCategory($user_id,1);
//        dd($categorys_pay);
//        echo "<br>";
//        echo $pay_total;
        $data=array(
            'msg'=>'success',
            'categorys_pay'=>$categorys_pay
        );
        return  response()->json($data);
    }
}