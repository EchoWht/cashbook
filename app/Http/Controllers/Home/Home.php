<?php

/**
 * Created by PhpStorm.
 * User: wang
 * Date: 2017/2/4
 * Time: 22:25   laravel 5.1
 */
namespace App\Http\Controllers\Home;
use App\Http\Controllers\Controller;
class Home extends Controller
{
    public function index(){
        return view('home/index');
    }
}