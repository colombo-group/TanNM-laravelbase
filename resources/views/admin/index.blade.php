@extends('admin.layout')
@section('title','Admin | Pages')
@section('nav-item')
	<li class="nav-item active">
					<a class="nav-link" href="{{ route('admin.pages') }}" >Pages<span class="sr-only">(current)</span></a>
					</li>
					<li class="nav-item">
		<a class="nav-link" href="#">User</a>
	</li> 
@endsection

@section('content')
	<div class="content">
		<h2 class="display-3 align-center">Pages</h2>
		<hr>
		<div class="row">
			<div class="float-xs-right">
				<a href="{{ route('post.create') }}" class="btn btn-info btn-sm">Add Post</a>
			</div>
		</div>
	</div>
@endsection
