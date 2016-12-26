@extends('admin.layout')
@section('title')
	&Iota; {{ $post->title }}
@endsection()
@section('nav-item')
<li class="nav-item active">
	<a class="nav-link" href="{{ route('admin.pages') }}" >Pages<span class="sr-only">(current)</span></a>
</li>
<li class="nav-item">
	<a class="nav-link" href="{{ route('user.index')}}">User</a>
</li> 
@endsection
@section('script')
<script type="text/javascript" src="{{ asset('js/post.js') }}"></script>
@endsection
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
					<a href="{{ route('post.edit',$post->id) }}" class="btn btn-primary btn-sm"><strong>Update</strong></a>
					<a href="javascript:;" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#delModal"><strong>Delete</strong></a>
				</div>
				<div class="col-xs-10">
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
        <a href="{{route('post.destroy' , $post->id) }}" onclick="event.preventDefault();
							document.getElementById('delete-form').submit();" type="button" class="btn btn-primary">Delete</a>
        	 {{ Form::open(array('url' => 'admin/post/' . $post->id, 'class' => 'pull-right', 'style'=>'display:hidden','id'=>'delete-form')) }}
                    {{ Form::hidden('_method', 'DELETE') }}
               {{ Form::close() }}
      </div>
    </div>
  </div>
</div>
@endsection
