@extends('admin.layout')
@section('title')
	&Iota; {{ $post->title }}
@endsection()
@section('content')
	<div class="container">
		<div class="content">
			<div class="row">
				<h4 class="display-4">{{ $post->title }}</h4>
				<hr>
				<br>
				<div class="col-xs-2">
					@if($post->thumb!=null)
					<img src="{{ asset($post->thumb) }}" alt="Thumb" class="img-fluid" >
					@endif
					<br>
					<h5>Administrator</h5>
					<p><small>Created at: {{ $post->created_at }}</small></p>
					<a href="" class="btn btn-primary btn-sm"><strong>Update</strong></a>
					<a href="" class="btn btn-danger btn-sm"><strong>Delete</strong></a>
				</div>
				<div class="col-xs-10">
					{!! $post->content !!}
				</div>
			</div>
		</div>
	</div>
@endsection
