<?php

namespace App\Http\Controllers\Front;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\CateRepository;
use App\Repositories\PostRepository;


class CateController extends Controller
{
    //

	protected $cate;
  protected $post;
	function __construct(){
    $this->cate = new CateRepository;
		$this->post = new PostRepository;
	}
    /**
     * show post
     */
    public function index(){
    	$cates = $this->cate->showAll();
    	return view('cate.index')->with('cates',$cates);
    }

    public function show($id){
   		$cate = $this->cate->findId($id);
   		if($cate){
        $posts = $cate->posts()->orderBy('updated_at','DESC')->paginate(2);
   			return view('cate.cateShow')->with(['cate'=>$cate, 'posts'=>$posts]);
   		}
   		else{
   			abort(404);
   		}
    }

    public function showPost($id){
      $post= $this->post->findId($id);
      return view('cate.showPost')->with('post', $post);
    }
}
