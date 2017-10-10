@extends('layouts.master')
@section('my-head')
    <link href="{{asset("assets/default/css/budget_list.css")}}" rel="stylesheet">
@stop
@section('nav')
    @include('layouts.nav.master_nav')
@stop
@section('content')
    <ul class="timeline">
        @foreach ($budget_list as $budget)
            <section class="card @if($budget->end_time<time()) theme-purple @else theme-red @endif" >
                <section class="card__part card__part-2">
                    <div class="card__part__side m--back">
                        <div class="card__part__inner card__face">
                            <div class="card__face__colored-side"></div>
                            <h3 class="card__face__price ng-binding">￥{{$budget->avg_cash}}</h3>
                            <div class="card__face__divider"></div>
                            <div class="card__face__path"></div>
                            <div class="card__face__from-to">
                                <p class="ng-binding">{{date('Y年m月d H:i:s',$budget->start_time)}}</p>
                                <p class="ng-binding">{{date('Y年m月d H:i:s',$budget->end_time)}}</p>
                            </div>
                            <div class="card__face__deliv-date ng-binding">
                                日预算

                            </div>
                            <div class="card__face__stats card__face__stats--req">
                                天数
                                <p class="ng-binding">{{($budget->end_time-$budget->start_time)/86400}}</p>
                            </div>
                            <div class="card__face__stats card__face__stats--pledge">
                                总预算
                                <p class="ng-binding">
                                    ￥{{($budget->end_time-$budget->start_time)/86400*$budget->avg_cash}}
                                </p>
                            </div>
                        </div>
                    </div>
                </section>

            </section>
        @endforeach
    </ul>
    <?php echo $budget_list->render() ?>
@stop

@section('my-js')
@stop