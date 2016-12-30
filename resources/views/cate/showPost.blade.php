@extends('main')
@section('title')
	&Iota; {{ $post->title }}
@endsection()
@section('nav-item')
<li class="nav-item ">
          <a class="nav-link" href="/" >Home</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="{{ route('cate.index') }}">Danh mục</a>
          </li>
          <li class="nav-item dropdown active">
          @if(Auth::check())
            <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
              @if(Auth::user()->level==0)
              Admin
              @else
              {{ Auth::user()->name}}
              @endif
            </a>
            <div class="dropdown-menu" aria-labelledby="Preview">
            @if(Auth::user()->level==0)
              <a href="{{ route('admin.pages')}}" class="dropdown-item">Trang quản trị</a>
              @endif
              <a class="dropdown-item" href="{{ route('user.profile',Auth::user()->id) }}">Profile</a>
              <a class="dropdown-item" href="{{ route('post.index',Auth::user()->id) }}">Posts</a>
              <a class="dropdown-item" href="{{ route('post.create',Auth::user()->id) }}">Viết bài</a>
              <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
              document.getElementById('logout-form').submit();">Đăng xuất</a>
              <form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display: none;">
                {{ csrf_field() }}
              </form>
            </div>

          </li>
                    @else

          <li class="nav-item"><a href="{{route('login')}}" class="nav-link">Đăng nhập</a></li> 
          <li class="nav-item"><a href="{{route('register')}}" class="nav-link">Đăng ký</a></li>
          @endif  
@endsection
@section('script')
<script type="text/javascript" src="{{ asset('js/page.js') }}"></script>
@endsection
@section('content')
	<div class="container wrapper">
		<div class="content">
			<div class="row">
				<h4 class="display-4">{{ $post->title }}</h4>
				<hr>
				<br>
				@if (session('status'))
    <div class="alert alert-success">
        {{ session('status') }}
    </div>
@endif
				<div class="col-sm-12 col-md-2">
					@if($post->thumb!=null)
						<img src="{{ asset($post->thumb) }}" alt="Thumb" class="img-fluid" >
					@endif
					<br>
					<h5>{{ $post->users->name }}</h5>
					<p><small>Cập nhật lúc: {{ $post->updated_at }}</small></p>
          <p><small>Danh mục: {{ $post->cates->title }}</small> </p>
				</div>
				<div class="col-sm-12 col-md-10">
					{!! $post->content !!}
				</div>
			</div>
		</div>
	</div>
	
@endsection
