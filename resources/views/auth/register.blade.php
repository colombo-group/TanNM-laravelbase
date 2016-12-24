@extends('../main')
@section('content')
<div class="container content">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <h2 class="display-4">Register</h2>
                <div class="panel-body" style="margin-top:30px;">
                  
                <form method="post" action="{{route('register')}}">
                    {{ csrf_field() }}
                      <div class="form-group">
                            <label for="name">Họ tên</label>
                            <input type="text" class="form-control" id='name' name='name' placeholder=" Nhập họ tên">
                      </div>

                      <div class="form-group">
                        <label for="username">Username</label>
                        <input type="text" class="form-control" id="username" name='username' aria-describedby="emailHelp" placeholder="Nhập username">
                        @if($errors->has('username'))
                        <small id="help-block" class="form-text text-muted">{{ $errors->first('username') }}</small>
                        @endif
                    </div>

                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" class="form-control" id="email" name='email' placeholder="Nhập email"> 
                         @if($errors->has('email'))
                        <small class="form-text text-muted">{{ $errors->first('email') }}</small>
                        @endif
                    </div>

                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" class="form-control" id='password' name='password' placeholder="Nhập password">
                         @if($errors->has('password'))
                        <small class="form-text text-muted">{{ $errors->first('password') }}</small>
                        @endif
                  </div>

                  <div class="form-group">
                    <label for="password_confirmation">Xác nhận password</label>
                    <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" placeholder="Xác nhận password">
              </div>
              <button type="submit" class="btn btn-primary">Đăng ký</button>
  
            </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
