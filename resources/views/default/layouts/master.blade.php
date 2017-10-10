
<!DOCTYPE html>
<html lang="zh-CN">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- 上述3个meta标签*必须*放在最前面，任何其他内容都*必须*跟随其后！ -->
    <meta name="description" content="">
    <meta name="author" content="">
    <title></title>
    <link rel="icon" href="/favicon.ico">
    <link href="{{asset("assets/common/bootstrap/css/bootstrap.min.css")}}" rel="stylesheet">
    <link href="{{asset("assets/common/font-awesome-4.7.0/css/font-awesome.min.css")}}" rel="stylesheet">
    <link href="{{asset("assets/common/css/common.css")}}" rel="stylesheet">
    {{--自定义css js--}}
    @yield('my-head')


</head>

<body>

@section('nav')
    @include('layouts.nav.master_nav')
@show
<div class="container m-t60">
        @yield('content')
</div><!-- /.container -->


<!-- Bootstrap core JavaScript
================================================== -->
<!-- Placed at the end of the document so the pages load faster -->
<script src="{{asset("assets/common/jquery.min.js")}}"></script>
<script src="{{asset("assets/common/bootstrap/js/bootstrap.min.js")}}"></script>
@yield('my-js')
</body>
</html>
