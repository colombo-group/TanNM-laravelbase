<?php

namespace App\Http\Controllers\Post;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\UserRepository;
use App\Repositories\PostRepository;
use Validator;
use Auth;


/**
 * class làm việc với post
 */
class PostController extends Controller
{
    //
    protected $user;
    protected $post;

    /**
     * khởi tạo 2 repository user và post
     */
    function __construct(){
    	$this->user = new UserRepository;
    	$this->post = new PostRepository;
    }

    /**
     * create
     *@param int $userId id của user tạo post
     *@return view
     */
  	public function create($userId){
  		if($this->user->findId($userId)){
  			return view('post.create')->with('userId' , $userId);
  		}else{
  			abort(404);
  		}
  	}

  	/**
  	 * hàm lưu mới
  	 *@param int userId id của user tạo post
  	 *@param Request
  	 *@return View | error
  	 */
  	public function store($userId , Request $postRequest){

  		 $thumb=null;
          //lưu ảnh thumbnail
        if($postRequest->hasFile('thumb')){
            $thumb = $postRequest->file('thumb');
            $validate = Validator::make($postRequest->all(),
               ['thumb'=>'mimes:jpeg,jpg,png'],['thumb.mimes'=>'File tải lên phải là định dạng ảnh']);

            if($validate->fails()){
                return redirect()->intended('post/create/'.$userId)->withErrors($validate);
            }

            $path = 'upload/post';
            $fileName = time()."-".$thumb->getClientOriginalName();
            $thumb->move($path , $fileName); 
            $thumb = $path."/".$fileName;
        }
        $postId = $this->post->save($postRequest , $thumb);
  		if($postId){
  			return redirect()->route('post.show',$postId);
  		}else{
  			abort(404);
  		}
  	}

  	/**
  	 *show 
  	 */
  	public function show($id){
  		$post = $this->post->findId($id);
  		return view('post.post')->with('post',$post);
  	}

  	/**
     * Show list
  	 */

  	public function index(){
  		$posts = $this->post->postPaginateOrderBy('updated_at', 'DESC', 2 , Auth::user()->id);
  		return view('post.index')->with('posts', $posts);
  	}

  	/**
  	 *destroy 
  	 */
  	public function destroy($id){
  		$post = $this->post->findId($id);
  		return view('post.post')->with('post',$post);
  	}

  	public function edit($id){
  		echo 'fdf';
    	}
}
