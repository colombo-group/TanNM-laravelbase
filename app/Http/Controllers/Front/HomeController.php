<?php

namespace App\Http\Controllers\Front;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Models\Post;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   
        $posts = Post::paginate(2);
         return view('index')->with('posts', $posts);
    }

    public function show($id){
        $post = Post::find($id);
        if($post){
            return view('post')->with('post',$post);
        }else{
            abort(404);
        }
    }
}
