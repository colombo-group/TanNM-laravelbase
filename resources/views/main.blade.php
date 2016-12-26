
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
		<div class="row">
			<div class="col-xs-12">
				<nav class="navbar navbar-dark bg-primary ">
					<a class="navbar-brand" href="/">Trainee Blog</a>

					<ul class="nav navbar-nav float-xs-right">
					@yield('nav-item')
				<!-- 	<li class="nav-item">
					<a class="nav-link" href="#" >Pages</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" href="#">User</a>
					</li> -->
					<li class="nav-item dropdown">
						<a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
							Admin
						</a>
						<div class="dropdown-menu" aria-labelledby="Preview">
							<a class="dropdown-item" href="{{ route('user.profile',Auth::user()->id) }}">Profile</a>
							<a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
							document.getElementById('logout-form').submit();">Đăng xuất</a>
							<form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display: none;">
								{{ csrf_field() }}
							</form>
						</div>
					</li>
				</ul>	
			</nav>
		</div>
		</div>
	</div>		
</div>
<div class="container">
	@yield('content')
</div>
</body>
</html>
