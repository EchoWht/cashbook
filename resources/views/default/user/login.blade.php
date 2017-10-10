@extends('layouts.master')
@section('my-head')
    <link href="{{asset("assets/default/css/login.css")}}" rel="stylesheet">
@stop
@section('content')

    <div class="content">

            @include('validate')
            @if(isset($msg)&&$msg!=1)
            <div class="alert alert-danger">
                @if($msg==2)
                    用户名不存在
                @elseif($msg==3)
                    密码错误
                @endif
            </div>
            @endif

        <form class="form-signin" method="post" action="{{ url('/login') }}">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <div class="form-group">{{$errors->first('username')}}
                <label for="username" class="sr-only">Username</label>
                <input name="username" type="text" id="username"
                       class="form-control"
                       placeholder="{{trans('default.form.username')}}"
                       value="{{old('username')}}"
                       autofocus>
                <label for="password" class="sr-only">Password</label>
                <input name="password" type="password" id="password"
                       class="form-control"
                       placeholder="{{trans('default.form.password')}}"
                       value="{{old('password')}}">
            </div>

            <div class="checkbox">
                <label>
                    <input type="checkbox" value="remember-me"> Remember me
                </label>
            </div>
            <button class="btn btn-lg btn-primary btn-block" type="submit">{{trans('default.link.login')}}</button>
        </form>
    </div>
@stop