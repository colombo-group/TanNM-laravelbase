@extends('admin.layout')
@section('title','Admin | Users')
@section('nav-item')
<li class="nav-item active">
	<a class="nav-link" href="{{ route('admin.pages') }}" >Pages</a>
</li>
<li class="nav-item">
	<a class="nav-link" href="{{  route('user.index') }}">User<span class="sr-only">(current)</span></a>
</li> 
@endsection
@section('content')
<div class="container">
	<div class="content">
		<h2 class="display-3 align-center">Users</h2>
		<hr>
		<table class="table table-striped">
			<thead>
				<tr>
					<th>Username</th>
					<th>Email</th>
					<th>Full name</th>
					<th>Address</th>
					<th>Option</th>
				</tr>
			</thead>
			<tbody>
				@foreach($users as $user)
					<tr>
						<td><a href="">{{ $user->username }}</a></td>
						<td><a href="">{{ $user->email }}</a></td>
						<td><a href="">{{ $user->name }}</a></td>
						<td><a href="">{{ $user->address }}</a></td>
						<th><a href="" class="btn btn-danger btn-sm"><strong>Delete</strong></a></th>
					</tr>
				@endforeach
			</tbody>
		</table>
	</div>
</div>
@endsection