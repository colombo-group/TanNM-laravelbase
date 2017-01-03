@extends('main')
@section('title')
	&Iota; {{ $post->title }}
@endsection()
@section('nav-item')
<li class="nav-item ">
          <a class="nav-link" href="/" >Home</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="{{ route('cate.index') }}">Danh mục</a>
          </li>
          <li class="nav-item dropdown active">
          @if(Auth::check())
            <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
              @if(Auth::user()->level==0)
              Admin
              @else
              {{ Auth::user()->name}}
              @endif
            </a>
            <div class="dropdown-menu" aria-labelledby="Preview">
            @if(Auth::user()->level==0)
              <a href="{{ route('admin.pages')}}" class="dropdown-item">Trang quản trị</a>
              @endif
              <a class="dropdown-item" href="{{ route('user.profile',Auth::user()->id) }}">Profile</a>
              <a class="dropdown-item" href="{{ route('post.index',Auth::user()->id) }}">Posts</a>
              <a class="dropdown-item" href="{{ route('post.create',Auth::user()->id) }}">Viết bài</a>
              <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
              document.getElementById('logout-form').submit();">Đăng xuất</a>
              <form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display: none;">
                {{ csrf_field() }}
              </form>
            </div>

          </li>
                    @else

          <li class="nav-item"><a href="{{route('login')}}" class="nav-link">Đăng nhập</a></li> 
          <li class="nav-item"><a href="{{route('register')}}" class="nav-link">Đăng ký</a></li>
          @endif  
@endsection
@section('script')
<script type="text/javascript" src="{{ asset('js/page.js') }}"></script>
<script type="text/javascript" src='{{ asset('js/comment.js') }}'></script>
@endsection
@section('content')
	<div class="container wrapper">
    <div class="content">
      <div class="row">
      <div class="col-xs-12">
        <h4 class="display-5">{{ $post->title }}</h4>
        <p>by <a href="javascript:;">{{$post->users->name }}</a></p>
        <hr>
       <input type="hidden" name="postId" value="{{ $post->id}}" id='postId'>
    </div>
        <div class="col-xs-12">
          <p>Posted on : {{ $post->created_at}}</p>
          <hr>
          <img src="{{ asset('storage/'.$post->thumb )}}" class="image-resposive">

        </div>
                
        <div class="col-sm-12 col-md-12">
          {!! $post->content !!}
          
          <div class="comment">
            <div class="col-xs-12 xs-offset-1">
            @if(Auth::user())
              <form action="javascript:; " method="POST" class='comment-form'>
              {{ csrf_field() }}
                <input type="hidden" name="comment_parent" value='0'>
                <input type="hidden" name="userId" value='{{ Auth::user()->id}}'>
                <input type="hidden" name="postId" value='{{ $post->id}}'>
                <div class="form-group">
                  <label><h5>Comment</h5></label>
                   <textarea class="form-control" rows="4" required name="content"></textarea> 
                </div>
                <button class="btn btn-primary" id="comment-form-button" >Comment</button>
              </form>
             @else
             <p>Đăng nhập để bình luận</p>
             @endif 
            </div>   
          </div>  
          <div class="comment-section">
          @foreach($comments as $comment)
            @if($comment->parent_id ==0)
              <div class="first-comment">
                <span>
                  <strong>{{ $comment->users->name }}</strong>
                </span>
                <small class='text-muted'>
                  {{ date_format($comment->created_at, 'Y-m-d h:m:i') }}
                </small>
                <p>
                  {{ $comment->content }}
                      <a href="javascript:;" class='comment-button' commentId ='{{ $comment->id }}'>Trả lời</a>
                </p>
                <div class='second-comment-section' parentCommentSection="{{ $comment->id }}">
            @endif
            @foreach($comments as $key=>$value)
              @if($value->parent_id == $comment->id)
                <div class="second-comment">
                  <span>
                    <strong>{{ $value->users->name }}</strong>
                  </span>
                  <small class='text-muted'>
                    {{  date_format($value->created_at, 'Y-m-d h:m:i') }}
                  </small>
                  <p>
                    {{ $value->content }}
                  </p>
                </div>
              @endif

            @endforeach
            </div>
            </div>
          @endforeach
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection
<script type="text/javascript">
  var token = "{{ Session::token() }}";
  var url = "{{ route('comment.store')}}";
</script>
