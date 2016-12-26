@extends('main')
@section('title')
	&Iota; {{ $post->title }}
@endsection()
@section('nav-item')
<li class="nav-item">
					<a class="nav-link" href="/" >Home</a>
					</li>
@endsection
@section('script')
@endsection
@section('content')
	<div class="container">
		<div class="content">
			<div class="row">
				<h4 class="display-4">{{ $post->title }}</h4>
				<hr>
				<br>
				<div class="col-xs-1">
					@if($post->thumb!=null)
						<img src="{{ asset($post->thumb) }}" alt="Thumb" class="img-fluid" >
					@endif
					<br>
					<p>Administrator</p>
					<p><small>Created at: {{ $post->created_at }}</small></p> 
				</div>
				<div class="col-xs-10 offset-xs-1">
					{!! $post->content !!}
				</div>
			</div>
		</div>
	</div>
@endsection
