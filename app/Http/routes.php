<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

/*Route::get('/', function () {
    return view('welcome');
});*/

Route::get('/','Home\Home@index');

Route::get('/test',function (){
    dd(\Illuminate\Support\Facades\Session::all());
});
/*Route::group(['middleware'=>['web']],function (){

});*/
Route::any('/login',['as' => 'login','uses'=>'UserController@login']);


Route::group(['middleware'=>['loginauth']],function (){
    Route::any('/create',
        ['as' => 'create','uses'=>'WorkController@create']
       );
    Route::any('/list',
        ['as' => 'list','uses'=>'WorkController@cashlist']
      );
    Route::any('/create/budget',
        ['as' => 'budget','uses'=>'BudgetController@createBudget']
    );
    Route::any('/list/budget',
        ['as' => 'budget_list','uses'=>'BudgetController@budgetList']
    );
    Route::any('/dashboard',
        ['as' => 'dashboard','uses'=>'CountController@dashboard']
    );
    Route::any('/json/dashboard',
        ['as' => 'json_dashboard','uses'=>'CountController@jsonDashboard']
    );
});

