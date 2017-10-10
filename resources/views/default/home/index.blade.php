@extends('layouts.master')
@section('my-head')
    <link href="{{asset("assets/default/css/home.css")}}" rel="stylesheet">
@stop
@section('content')
    <div class="content">
        <div class="title">
            {{trans('default.home.welcome')}}
        </div>
        <div class="links">
            <a href="{{ url('/register') }}">{{trans('default.link.register')}}</a>
            <a href="{{ url('/create') }}?cash_type=1">{{trans('default.link.work')}}</a>
        </div>
    </div>
@stop