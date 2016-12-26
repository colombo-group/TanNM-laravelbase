@extends('main')

@section('title', '| Trang chủ')

@section('content')
<div class="container">
  <h4 class="display-3 content">Posts</h4>
  <hr>
  @foreach($posts as $post)
  <div class="row content">
    <div class="col-xs-3">
      @if($post->thumb !=null)
      <img src="{{ asset($post->thumb)}}" alt="" class="img-fluid">
      @endif
    </div>
    <div class="col-xs-8">
      <a href="{{ route('front.post.show',$post->id) }}"><h4 class="display-5">{{ $post->title }}</h4></a>
      <?php 
      $sort = explode(" ", strip_tags($post->content));
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
      <footer class="blockquote-footer">Created at :{{ $post->created_at }}</footer>
    </div>
  </div>
  @endforeach
  <br>
<div class="align-center">{{ $posts->links('pagination') }}</div>
</div>
@endsection