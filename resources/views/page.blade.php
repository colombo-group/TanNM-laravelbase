@extends('main')
@section('title')
	&Iota; {{ $page->title }}
@endsection()
@section('nav-item')

@endsection
@section('script')
@endsection
@section('content')
	<div class="container wrapper">
		<div class="content">
			<div class="row">
				<h4 class="display-4">{{ $page->title }}</h4>
				<hr>
				<br>
				<div class="col-sm-12 col-md-2">
					@if($page->thumb!=null)
						<img class="img" src="{{ asset($page->thumb) }}" alt="Thumb" class="img-fluid" >
					@endif
					<br>
					<p>Administrator</p>
					<p><small>Created at: {{ $page->created_at }}</small></p> 
				</div>
				<div class="col-sm-12 col-md-10 ">
					{!! $page->content !!}
				</div>
			</div>
		</div>
	</div>
@endsection