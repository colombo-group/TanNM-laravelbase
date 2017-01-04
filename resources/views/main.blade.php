<html>
<head>
	<title>@yield('title')</title>
	<link rel="stylesheet" href="{{asset('css/app.css') }}">
	<script src="{{asset('js/app.js')}}"></script>
	<meta name="csrf-token" content="{{ csrf_token() }}">
	@yield('script')
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
					
				</ul>	
			</nav>
		</div>
		</div>
	</div>		
</div>
<div class="container">
	<div class="col-sm-9 col-xs-12">
		@yield('content')
	</div>
	<div class="col-sm-3 col-xs-12 cate" style="margin-top: 80px;">
		<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
		tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
		quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
		consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
		cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
		proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
	</div>
</div>

<footer id="footer">
		<div class="container">
			<div class="row">
				<div class="col-xs-12">
					<p class="align-center">Design by Losblancos893</p>
				</div>
			</div>
		</div>
	</footer>
</body>
</html>
