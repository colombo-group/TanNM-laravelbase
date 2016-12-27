@extends('admin.layout')
@section('title','Admin | Pages')
@section('nav-item')
<li class="nav-item active">
	<a class="nav-link" href="{{ route('admin.pages') }}" >Pages<span class="sr-only">(current)</span></a>
</li>
<li class="nav-item dropdown">
	<a class="nav-link dropdown-toggle" data-toggle="dropdown" href="route('user.index')" role="button" aria-haspopup="true" aria-expanded="false">
		User
	</a>
	<div class="dropdown-menu" aria-labelledby="Preview">
		<a class="dropdown-item" href="{{ route('user.index') }}">List</a>
		<a class="dropdown-item" href="{{ route('admin.recycle') }}" >Recycle</a>

	</div>
</li>
@endsection

@section('content')
<div class="content">
	<h2 class="display-3 align-center">Pages</h2>
	<hr>
	<div class="row">
		<div class="float-xs-right">
			<a href="{{ route('page.create') }}" class="btn btn-info btn-sm">Add Page</a>
		</div>
	</div>	
	<div class="pages">
		@foreach($pages as $page)
		<div class="row clear">
			<div class="col-sm-12 col-md-1">
				@if($page->thumb !=null)
				<img src="{{ asset($page->thumb) }}" alt="" class="img-fluid" style="max-height:150px;">
				@endif	
			</div>
			<div class="col-sm-12 col-md-9">
				<a href="{{ route('page.show',$page->id) }}"><h4 class="display-5">{{ $page->title }}</h4></a>
				<?php 
				$sort = explode(" ", strip_tags($page->content));
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
				<footer class="blockquote-footer">Created at :{{ $page->created_at }}

					<span><a href="{{ route('page.edit',$page->id) }}" class="btn btn-primary btn-sm"><strong>Update</strong></a>
						<a href="javascript:;" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#delModal"><strong>Delete</strong></a></span></footer>
						<div class="modal fade" id="delModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
							<div class="modal-dialog" role="document">
								<div class="modal-content">
									<div class="modal-header">
										<button type="button" class="close" data-dismiss="modal" aria-label="Close">
											<span aria-hidden="true">&times;</span>
										</button>
										<h4 class="modal-title" id="myModalLabel">Xác nhận xóa</h4>
									</div>
									<div class="modal-body">
										Xóa "{{ $page->title }}" ?
									</div>
									<div class="modal-footer">
										<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
										<a href="{{route('page.destroy' , $page->id) }}" onclick="event.preventDefault();
											document.getElementById('delete-form').submit();" type="button" class="btn btn-primary">Delete</a>
											{{ Form::open(array('url' => 'admin/page/'. $page->id, 'class' => 'pull-right', 'style'=>'display:hidden','id'=>'delete-form')) }}
											{{ Form::hidden('_method', 'DELETE') }}
											{{ Form::close() }}
										</div>
									</div>
								</div>
							</div>
						</div>

					</div>
				</div>
				@endforeach
			{{ $pages->links('pagination') }}
		</div>

<br/>

@endsection
