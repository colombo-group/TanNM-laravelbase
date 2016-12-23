@extends('main')
@section('title')
{{ $user->name }}
@endsection

@section('content')
<div class="content">
	<h2 class="display-2">Cập nhật profile</h2>
	{!! Form::open(['route' => ['user.save', $user->id] ,'method'=>'post'	 ,'class'=>'form-group']) !!}
  	{{ Form::token() }}  
	{{ Form::label('name', 'Họ tên') }}	
	{{ Form::text('name' , $user->name , ['class'=>'form-control']) }}
  <br>
	{{ Form::label('email', 'Email', ['class' => 'awesome']) }}	
	{{ Form::email('email' , $user->email , ['class'=>'form-control']) }}
	 @if ($errors->has('email'))
        <span class="help-block">
                         <strong>{{ $errors->first('email') }}</strong>
                                    </span><br/>
                                @endif
                                <br>
	{{ Form::label('sex', 'Giới tính', ['class' => 'awesome']) }}	
	<fieldset class="form-group">
    <div class="form-check">
      <label class="form-check-label">
      @if($user->sex=='boy')
        <input type="radio" class="form-check-input" name="sex" id="optionsRadios1" value="boy" checked>Boy
       @else
        <input type="radio" class="form-check-input" name="sex" id="optionsRadios1" value="boy" >
        Boy
        @endif
      </label>
    </div>
    <div class="form-check">
    <label class="form-check-label">
        @if($user->sex=='girl')
        <input type="radio" class="form-check-input" name="sex" id="optionsRadios1" value="girl" checked>
        Girl
       @else
        <input type="radio" class="form-check-input" name="sex" id="optionsRadios1" value="girl" >
        Girl
        @endif
      </label>
    </div>	
  </fieldset>
<br>
	{{ Form::label('birthday', 'Ngày sinh', ['class' => 'awesome']) }}	
	{{ Form::date('birthday' , $user->birthday->format('Y-m-d') , ['class'=>'form-control']) }}
  <br>
	{{ Form::label('address', 'Địa chỉ', ['class' => 'awesome']) }}	
	{{ Form::text('address' , $user->address , ['class'=>'form-control']) }}
  <br>
  {{ Form::label('slogan', 'Solgan', ['class' => 'awesome']) }}	
	{{ Form::textarea('slogan' , $user->slogan , ['class'=>'form-control']) }}
  <br>
	{{ Form::submit('Cập nhật', ['class'=>'btn btn-success']) }}
	{!! Form::close() !!}
</div>
@endsection