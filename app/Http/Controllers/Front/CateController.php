<?php

namespace App\Http\Controllers\Front;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\PostRepository;
use App\Models\Post;
use App\Models\User;

class CateController extends Controller
{
    //

	protected $post;

	function __construct(){
		$this->post = new PostRepository;
	}
    /**
     * show post
     */
    public function index(){
    	$posts = $this->post->paginateOrderBy('updated_at' , 'DESC' , 2);
    	return view('cate.index')->with('posts',$posts);
    }

    public function show($id){
   		$post = $this->post->findId($id);
   		if($post){
   			return view('cate.post')->with('post',$post);
   		}
   		else{
   			abort(404);
   		}
    }
}
