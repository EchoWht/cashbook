@extends('layouts.master')
@section('my-head')
    <link href="{{asset("assets/common/bootstrap-datetimepicker/css/bootstrap-datetimepicker.css")}}" rel="stylesheet">
    <link href="{{asset("assets/default/css/create.css")}}" rel="stylesheet">
@stop
@section('nav')
    @include('layouts.nav.master_nav')
@stop
@section('content')

    <div>
        @include('validate')
        @if(isset($msg))
            <div class="alert alert-danger">
                @if($msg==1)
                    成功记下一比
                @elseif($msg==2)
                    出了点错误，稍后再试
                @endif
            </div>
        @endif
        <div class="row">
            <div class="col-xs-3">今天预算：{{$cash_datas['now_budget_cash']}}(已花费{{$cash_datas['today_cash']}})</div>
            <div class="col-xs-3">结余：{{$cash_datas['surplus']}}</div>
        </div>
        <form action="" method="post">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">

            <div class="form-group">
                <div class="row">
                    <div class="toppings toppings-box">
                        @if($_GET['cash_type']==1)
                            @foreach($cash_datas['categorys'] as $cate )
                                <div class="col-xs-3">
                                    <input type="radio" id="cate{{$cate->id}}" name="category" value="{{$cate->id}} "
                                           @if($cate->id==2) checked @endif/>
                                    <label for="cate{{$cate->id}}" class="caramel">
                                        <i class="fa fa-{{$cate->category_icon}}"></i><br>
                                        {{$cate->category_name}}
                                    </label>
                                </div>
                            @endforeach
                            @else
                            @foreach($cash_datas['categorys_income'] as $cate )
                                <div class="col-xs-3">
                                    <input type="radio" id="cate{{$cate->id}}" name="category" value="{{$cate->id}} "
                                           @if($cate->id==3) checked @endif/>
                                    <label for="cate{{$cate->id}}" class="caramel">
                                        <i class="fa fa-{{$cate->category_icon}}"></i><br>
                                        {{$cate->category_name}}
                                    </label>
                                </div>
                            @endforeach
                        @endif

                    </div>
                </div>
                {{-- <label class="radio-inline">
                     <input type="radio" name="category" value="{{$cate->id}}"> {{$cate->category_name}}
                 </label>--}}


            </div>

                @if($_GET['cash_type']==2)
                    <input type="hidden" name="cash_type" value="2">
                @else
                    <input type="hidden" name="cash_type" value="1">
                @endif

            <div class="form-group">

                <div class="row toppings">
                    <div class="col-xs-4">
                       <div class="calendar">
                           {{--<span class="glyphicon glyphicon-calendar"  id="created_time"></span>--}}
                           <input type="text" class="form-control" id="created_time"
                                  name="created_time" value="{{date('Y-m-d H:i:s')}}" >
                       </div>
                    </div>
                    <div class="col-xs-4">
                        <input type="radio" id="budget1" name="budget" checked value="1"/>
                        <label for="budget1" class="sprinkles">
                            预算内
                        </label>
                    </div>
                    <div class="col-xs-4">
                        <input type="radio" id="budget2" name="budget" value="2"/>
                        <label for="budget2" class="sprinkles">
                            预算外
                        </label>
                    </div>
                </div>


            </div>
            <div class="keyboard-box">
                <div class="col-xs-12">
                    <form>
                        <div class="form-group">
                            <input name="cash_total" type="text" readonly class="form-control text-number"
                                   id="text-number" placeholder="0"
                                   autofocus>
                        </div>

                        <!--<div class="checkbox">
                            <label>
                                <input type="checkbox"> Check me out
                            </label>
                        </div>
                        <button type="submit" class="btn btn-default">Submit</button>-->
                    </form>
                </div>
                <div class="col-xs-4 col-sm-4  keyboard">
                    <button class="btn btn-default btn-number" type="button" onclick="addNumber(1)">1</button>
                </div>
                <div class="col-xs-4 col-sm-4  keyboard">
                    <button class="btn btn-default btn-number" type="button" onclick="addNumber(2)">2</button>
                </div>
                <div class="col-xs-4 col-sm-4  keyboard">
                    <button class="btn btn-default btn-number" type="button" onclick="addNumber(3)">3</button>
                </div>
                <div class="col-xs-4 col-sm-4  keyboard">
                    <button class="btn btn-default btn-number" type="button" onclick="addNumber(4)">4</button>
                </div>
                <div class="col-xs-4 col-sm-4  keyboard">
                    <button class="btn btn-default btn-number" type="button" onclick="addNumber(5)">5</button>
                </div>
                <div class="col-xs-4 col-sm-4  keyboard">
                    <button class="btn btn-default btn-number" type="button" onclick="addNumber(6)">6</button>
                </div>
                <div class="col-xs-4 col-sm-4  keyboard">
                    <button class="btn btn-default btn-number" type="button" onclick="addNumber(7)">7</button>
                </div>
                <div class="col-xs-4 col-sm-4  keyboard">
                    <button class="btn btn-default btn-number" type="button" onclick="addNumber(8)">8</button>
                </div>
                <div class="col-xs-4 col-sm-4  keyboard">

                    <button class="btn btn-default btn-number" type="button" onclick="addNumber(9)">9</button>
                </div>

                <div class="col-xs-4 col-sm-4  keyboard">
                    <button class="btn btn-default btn-number" type="button" onclick="addNumber(0)">0</button>
                </div>
                <div class="col-xs-4 col-sm-4  keyboard">
                    <button class="btn btn-default btn-number" type="button" onclick="addNumber('.')">·</button>
                </div>
                <div class="col-xs-4 col-sm-4  keyboard">
                    <button class="btn btn-default btn-number" type="button" onclick="delNumber(1)">Del</button>
                </div>
                <div class="col-xs-12 col-sm-12  keyboard">
                    <button class="btn btn-success btn-number" type="submit">完成</button>
                </div>

            </div>
        </form>
    </div>
@stop
@section('my-js')
    <script src="{{asset("assets/common/js/keyboard.js")}}"></script>
    {{--<script src="http://cdn.bootcss.com/hammer.js/2.0.8/hammer.min.js"></script>--}}
    <script src="{{asset("assets/common/bootstrap-datetimepicker/js/bootstrap-datetimepicker.js")}}"></script>
    <script>
       /* $(function () {
            var myElement = document.getElementById('carousel-example-generic')
            var hm = new Hammer(myElement);
            hm.on("swipeleft", function () {
                $('#carousel-example-generic').carousel('next')
            })
            hm.on("swiperight", function () {
                $('#carousel-example-generic').carousel('prev')
            })
        })*/
    </script>
  {{--  <script type="text/javascript">
        $(".form_datetime").datetimepicker({format: 'yyyy-mm-dd hh:ii'});
    </script>--}}



    <script type="text/javascript">
        $("#created_time").datetimepicker({
            format: 'yyyy-mm-dd hh:ii',
            autoclose: true,
            todayBtn: true,
        });
        $("#created_time").click(function () {
            $("#created_time"). addClass('text-danger')
        })
    </script>
@stop