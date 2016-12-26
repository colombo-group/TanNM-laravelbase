@extends('admin.layout')
@section('title','Admin | Pages')
@section('nav-item')
<li class="nav-item active">
	<a class="nav-link" href="{{ route('admin.pages') }}" >Pages<span class="sr-only">(current)</span></a>
</li>
<li class="nav-item">
	<a class="nav-link" href="{{  route('user.index') }}">Users</a>
</li> 
@endsection

@section('content')
<div class="content">
	<h2 class="display-3 align-center">Posts</h2>
	<hr>
	<div class="row">
		<div class="float-xs-right">
			<a href="{{ route('post.create') }}" class="btn btn-info btn-sm">Add Post</a>
		</div>
	</div>	
	<div class="posts">
	@foreach($posts as $post)
	<div class="row clear">
		<div class="col-xs-3">
		@if($post->thumb !=null)
			<img src="{{ asset($post->thumb) }}" alt="" class="img-fluid">
		@endif	
		</div>
		<div class="col-xs-8">
			<a href="{{ route('post.show',$post->id) }}"><h4 class="display-5">{{ $post->title }}</h4></a>
			<?php 
				$sort = explode(" ", strip_tags($post->content));
				$sortContent = [];
				if(count($sort) > 20){
					for ($i=0; $i < 20; $i++) { 
						array_push($sortContent, $sort[$i]);
					}
				}
				else{
					for ($i=0; $i < count($sort); $i++) { 
						array_push($sortContent, $sort[$i]);
					}
				}
			?>
			<p>{!! implode(" ",$sortContent)!!}...</p>
			<footer class="blockquote-footer">Created at :{{ $post->created_at }}</footer>
		</div>
	</div>
	@endforeach
	<br/>
	</div>
	{{ $posts->links('pagination') }}
</div>
@endsection
