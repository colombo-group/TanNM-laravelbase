@extends('admin.layout')
@section('nav-item')	
<li class="nav-item ">
	<a class="nav-link" href="{{ route('admin.pages') }}" >Pages<span class="sr-only">(current)</span></a>
</li>
<li class="nav-item dropdown active">
						<a class="nav-link dropdown-toggle" data-toggle="dropdown" href="route('admin.cate.index')" role="button" aria-haspopup="true" aria-expanded="false">
							Danh mục
						</a>
						<div class="dropdown-menu" aria-labelledby="Preview">
							<a class="dropdown-item" href="{{ route('admin.cate.index') }}">Tất cả danh mục</a>
							<a class="dropdown-item" href="{{ route('admin.cate.manage') }}" >Quản lý danh mục</a>
							
						</div>
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
@section('title','| Categories')
@section('script')

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
					<h5>{{ $post->users->name}}</h5>
					<p><small>Cập nhật lúc: {{ $post->updated_at }}</small></p>
          <p><small>Danh mục: {{ $post->cates->title }}</small> </p>
					<a href="{{ route('admin.post.edit',$post->id) }}" class="btn btn-primary btn-sm"><strong>Sửa</strong></a>
					<a href="javascript:;" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#delModal"><strong>Delete</strong></a>
				</div>
				<div class="col-sm-12 col-md-10">
					{!! $post->content !!}
				</div>
			</div>
		</div>
	</div>
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
        Xóa "{{ $post->title }}" ?
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <a href="{{route('admin.post.delete' , $post->id) }}" onclick="event.preventDefault();
							document.getElementById('delete-form').submit();" type="button" class="btn btn-primary">Delete</a>
        	 {{ Form::open(array('route' => ['admin.post.delete' , $post->id]	, 'class' => 'pull-right', 'style'=>'display:hidden','id'=>'delete-form')) }}
                    {{ Form::hidden('_method', 'get	') }}
               {{ Form::close() }}
      </div>
    </div>
  </div>
</div>
@endsection