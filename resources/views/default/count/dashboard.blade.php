@extends('layouts.master')
@section('my-head')
    <link href="{{asset("assets/common/donut-chart/css/style.css")}}" rel="stylesheet">
@stop
@section('nav')
    @include('layouts.nav.master_nav')
@stop
@section('content')
    <section class="row">
        <div class="column">
            <div class="donut-chart" data-donut-chart="1"></div>
        </div>
        <div class="column">
            <div class="donut-chart" data-donut-chart="2"></div>
        </div>
    </section>
@stop

@section('my-js')
    <script src="{{asset("assets/common/donut-chart/js/index.js")}}" ></script>
    <script>
        function count(o){
            var t = typeof o;
            if(t == 'string'){
                return o.length;
            }else if(t == 'object'){
                var n = 0;
                for(var i in o){
                    n++;
                }
                return n;
            }
            return false;
        };
        // Select containers
        var chartContainer1 = document.querySelector('[data-donut-chart="1"]');
        var chartContainer2 = document.querySelector('[data-donut-chart="2"]');

        $.ajax({
            type:'get',
            url:'{{route('json_dashboard')}}',
            data:{},
            success:function(result){
                if(result.msg=='success'){
                 //遍历对象
                    obj1=new Object();
var i=0;
                    for (var key in result.categorys_pay){
//                       console.log(result.categorys_pay[key].category_name)
                        i++
                        obj1[i]=result.categorys_pay[key].category_name;
                        obj1.push=result.categorys_pay[key].category_name;

                    }
                    console.log(obj1)

                }
            }
        });

        // Data
        var chartData1a = {
            total: 325,
            wedges: [
                { id: 'a', color: '#4FC1E9', value: '250' },
                { id: 'b', color: '#A0D468', value: 25 },
                { id: 'c', color: '#ED5565', value: 25 },
                { id: 'd', color: '#AC92EC', value: 25 }
            ]
        };

        var chartData1b = {
            total: 96,
            wedges: [
                { id: 'a', color: '#4FC1E9', value: '26i' },
                { id: 'b', color: '#A0D468', value: 20 },
                { id: 'c', color: '#ED5565', value: 18 },
                { id: 'd', color: '#AC92EC', value: 32 }
            ]
        };

        var chartData2a = {
            total: 200,
            wedges: [
                { id: 'a', color: '#5D9CEC', value: 45 },
                { id: 'b', color: '#48CFAD', value: 25 },
                { id: 'c', color: '#FFCE54', value: 30 },
                { id: 'd', color: '#FC6E51', value: 100 }
            ]
        };

        var chartData2b = {
            total: 220,
            wedges: [
                { id: 'a', color: '#5D9CEC', value: 65 },
                { id: 'b', color: '#48CFAD', value: 40 },
                { id: 'c', color: '#FFCE54', value: 60 },
                { id: 'd', color: '#FC6E51', value: 55 }
            ]
        };

        // Create new chart objects
        var Chart1 = Object.create(DonutChart);
        var Chart2 = Object.create(DonutChart);

        Chart1.init({
            container: chartContainer1,
            data: chartData1a
        });

        Chart2.init({
            container: chartContainer2,
            data: chartData2a
        });

    </script>
@stop