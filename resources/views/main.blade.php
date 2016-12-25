
<html>
<head>
	<title>@yield('title')</title>
	<link rel="stylesheet" href="{{asset('css/app.css') }}">
	<script src="{{asset('js/app.js')}}"></script>
	<meta name="csrf-token" content="{{ csrf_token() }}">

</head>
<body>
	<div class="header">
		<div class="container">
			<div class="col-xs-12">
				<nav class="navbar navbar-dark bg-primary ">
					<a class="navbar-brand" href="/">Trainee Blog</a>
					<div class="float-xs-right">
						@if(Auth::check())
						<ul class="nav nav-pills">
						<li class="nav-item dropdown">
						<a class="nav-link dropdown-toggle " data-toggle="dropdown" href="javascript:;" role="button" aria-haspopup="true" aria-expanded="false">
							@if(Auth::user()->level ==4)
							Admin
							@else
							{{ Auth::user()->name }}
							@endif
						</a>
							<div class="dropdown-menu">
								<a class="dropdown-item " href="/user/{{ Auth::user()->id }}">Profile</a>
								<a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
						document.getElementById('logout-form').submit();">Đăng xuất</a>
						<form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display: none;">
						{{ csrf_field() }}
					</form>
							</div>
						</li>	
						</ul>
					@else
					<a href="{{ route('login') }}" class='btn btn-success btn-sm'>Đăng nhập</a>
					<a href="{{ route('register') }}" class='btn btn-primary btn-sm'>Đăng ký</a>
					@endif
				</div>		
			</nav>
		</div>
	</div>		
</div>
<div class="container">
	@yield('content')
</div>
</body>
</html>
