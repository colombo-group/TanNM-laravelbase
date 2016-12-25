@extends('admin.layout')
@section('nav-item')
<li class="nav-item active">
	<a class="nav-link" href="{{ route('admin.pages') }}" >Pages<span class="sr-only">(current)</span></a>
</li>
<li class="nav-item">
	<a class="nav-link" href="#">User</a>
</li> 
@endsection
@section('title','| Add POst')
@section('script')
<script type='text/javascript' src="{{ asset('js/tinymce/tinymce.min.js') }}"></script>
<script type='text/javascript' src="{{ asset('js/admin.js') }}"></script>
  <script src="/vendor/laravel-filemanager/js/lfm.js"></script>
@endsection
@section('content')
<div class="container">
	<div class="content">
	<h2 class="display-4 align-center">New Page</h2>
		<hr>
		<form action="{{ route('post.store') }}" method='POST' enctype="multipart/form-data">
			{{ csrf_field() }}
			<div class="form-group row">
				<label for="title" class="col-xs-2 col-form-label">Title</label>
				<div class="col-xs-10">
					<input class="form-control" type="text" id="title" placeholder="Title" name='title' required>
				</div>
				  @if($errors->has('title'))
                        <small id="help-block" class="form-text text-muted">{{ $errors->first('title') }}</small>
				@endif
			</div>
			<div class="form-group row">
				<label for="thumb" class="col-xs-2 col-form-label">Thumb</label>
				<div class="col-xs-10">
					<input class="form-control" type="file"  id="thumb" name="thumb"  accept="image/*">
				</div>
				  @if($errors->has('thumb'))
                        <small id="help-block" class="form-text text-muted">{{ $errors->first('thumb') }}</small>
					@endif
			</div>
			<div class="form-group row">
				<label for="content" class="col-xs-2 col-form-label">Content</label>
				<div class="col-xs-12">
					<textarea name="content" id="content" required></textarea>
				</div>
			</div>
			<br>
			<button type='submit' class='btn btn-success btn-lg'>Create</button>
		</form>
	</div>
</div>

@endsection