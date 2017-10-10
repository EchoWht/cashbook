@extends('layouts.master')
@section('my-head')
    <link href="{{asset("assets/common/bootstrap-datetimepicker/css/bootstrap-datetimepicker.css")}}" rel="stylesheet">
    <link href="{{asset("assets/default/css/create.css")}}" rel="stylesheet">
    <script src="{{asset("assets/common/vue.js")}}"></script>
@stop
@section('nav')
    @include('layouts.nav.master_nav')
@stop
@section('content')
    @include('validate')
    @if(isset($msg))
        <div class="alert alert-danger">
            @if($msg==1)
                保存成功
            @elseif($msg==2)
                出了点错误，稍后再试
            @endif
        </div>
    @endif

    <form class="form-horizontal" method="post">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <div class="form-group">
            <label for="budget_name" class="col-sm-2 control-label">预算名称</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" name="budget_name" id="budget_name" value="预算{{date("Y-m-d")}}">
            </div>
        </div>

        <div class="form-group">
            <label for="start_time" class="col-sm-2 control-label">开始时间</label>
            <div class="col-sm-10">
                <input type="text" class="form-control start_time" name="start_time" id="start_time" value="{{date("Y-m-d H:i:s")}}">
            </div>
        </div>
        <div id="app">
            <div class="form-group">
                <label for="day" class="col-sm-2 control-label">天数</label>
                <div class="col-sm-10">
                    <input type="text"  v-model="day"  class="form-control" name="day" id="day" value="30">
                </div>
            </div>
            <div class="form-group">
                <label for="avg_cash" class="col-sm-2 control-label">每天预算</label>
                <div class="col-sm-10">
                    <input type="number"  v-model="avg_cash"  name="avg_cash" class="form-control" id="avg_cash" value="30">
                </div>
            </div>
            <div class="form-group text-center">
                <h4 class="text-success">总预算：@{{ day*avg_cash }}</h4>
            </div>
        </div>
        <div class="form-group">
            <div class="col-sm-offset-2 col-sm-10">
                <button type="submit" class="btn btn-default">提交</button>
            </div>
        </div>
    </form>
@stop
@section('my-js')
    <script src="{{asset("assets/common/bootstrap-datetimepicker/js/bootstrap-datetimepicker.js")}}"></script>
    <script type="text/javascript">
        $(".start_time").datetimepicker({
            format: "yyyy-mm-dd H:i:s",
            autoclose: true,
            todayBtn: true,
        });
        $(".end_time").datetimepicker({
            format: "yyyy-mm-dd H:i:s",
            autoclose: true,
            todayBtn: true,
        });
    </script>
    <script>
        var app = new Vue({
            el: '#app',
            data: {
                day: 30,
                avg_cash:30
            }
        })
    </script>

@stop