@extends('layouts.master')
@section('my-head')
    <link href="{{asset("assets/default/css/list.css")}}" rel="stylesheet">
@stop
@section('nav')
    @include('layouts.nav.master_nav')
@stop
@section('content')
    <ul class="timeline">
        @foreach ($cashlist as $cash)
            <li @if($cash->cash_type==2)class="timeline-inverted"@endif>
                <div class="timeline-badge @if($cash->cash_type==2) success @else danger @endif">
                    <i class="glyphicon glyphicon-piggy-bank"></i>
                </div>
                <div class="timeline-panel">
                    <div class="timeline-heading">
                        <h5 class="timeline-title">
                            {{$cash->category_name}}
                        </h5>
                        <p><small class="text-muted"><i class="glyphicon glyphicon-time"></i>
                            {{date("Y年m月d日 H:i:s",$cash->created_time)}}
                            </small></p>
                    </div>
                    <div class="timeline-body"> @if($cash->cash_type==2) + @else - @endif{{$cash->cash_total}}
                    </div>
                </div>
            </li>
        @endforeach
    </ul>
     <?php echo $cashlist->render() ?>
@stop

@section('my-js')
@stop