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
				@if($user->level !=0)
				<tr>
					<td><a href="{{route('user.show', $user->id) }}">{{ $user->username }}</a></td>
					<td><p>{{ $user->email }}</p></td>
					<td><p>{{ $user->name }}</p></td>
					<td><p>{{ $user->address }}</p></td>
					<th>

						</th>
					</tr>
					@endif	
					@endforeach
				</tbody>
			</table>
			<h2>
			<a href="{{ route('admin.user.delList') }}" class="btn btn-default float-xs-right">Deleted List</a></h2>
			{{ $users->links('pagination') }}
		</div>
	</div>


	@endsection