@extends('admin.layout')
@section('script')
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
@endsection
@section('content')
	@if(Session::has('flash_message'))
		{{ Session::get('flash_message') }}
	@endif
	<table class="table table-inverse" style="margin-top:100px">
	<thead >

	 <tr>
      <th>Họ tên</th>
      <th>Email</th>
      <th>Giới tính</th>
      <th>Ngày sinh</th>
      <th>Địa chỉ</th>
      <th>Slogan</th>
    </tr>
    </thead>
    <tbody>
	<?php $i =0 ?>
	@foreach($users as $user)
	@if($i%2==0)
	<tr class="bg-primary">
	@else
	<tr class="bg-danger">
	@endif
		<td>{{ $user->name }}</td>
		<td>{{ $user->email }}</td>
		<td>{{ $user->sex }}</td>
		<td>{{ $user->birthday }}</td>
		<td>{{ $user->address }}</td>
		<td>{{ $user->slogan }}</td>
	</tr>
	<?php $i++; ?>
	@endforeach
	</tbody>
	</table>
	
	<nav aria-label="...">{{ $users->links('pagination') }}</nav>
@endsection