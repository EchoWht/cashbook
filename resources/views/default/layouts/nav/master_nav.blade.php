<nav class="navbar navbar-inverse navbar-fixed-top">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="#">记账</a>
        </div>
        <div id="navbar" class="collapse navbar-collapse">
            <ul class="nav navbar-nav">
                <li><a href="{{route('create')}}?cash_type=1">记支出</a></li>
				<li><a href="{{route('create')}}?cash_type=2">记收入</a></li>
                <li><a href="{{route('budget')}}">预算</a></li>
                <li><a href="{{route('list')}}">出入列表</a></li>
                <li><a href="{{route('budget_list')}}">预算列表</a></li>
                <li><a href="{{route('dashboard')}}">仪表盘</a></li>
            </ul>
        </div><!--/.nav-collapse -->
    </div>
</nav>