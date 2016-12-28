<?php

namespace App\Http\Controllers\Post;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\UserRepository;
use App\Repositories\PostRepository;
use Validator;
use Auth;
use Illuminate\Support\Facades\File;



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
        if($post){
            //Xóa file ảnh
            $results  = "";
            //preg_match('/< *img[^>]*src *= *["\']?([^"\']*)/i', $post->content, $matches);
            preg_match_all('/<img[^>]+>/i',$post->content, $results);
            //preg_match('/< *img[^>]*src *= *["\']?([^"\']*)/i', $results[0][2], $src);
              //  var_dump($src[1]);  
                //die();
            foreach ($results[0] as $key => $value) {
                $src = "";
                preg_match('/< *img[^>]*src *= *["\']?([^"\']*)/i', $value, $src);
                $srcDel = trim($src[1],'/');
                $srcDelThumb = str_replace('shares', 'shares/thumbs', $srcDel);
                if(File::exists($srcDel)){
                    File::delete($srcDel); 
                }      
                if(File::exists($srcDelThumb)){
                    File::delete($srcDelThumb);
                }             
            }    
            if(File::exists($post->thumb)){
                File::delete($post->thumb);
            }
            if($this->post->delete($id)){
                return redirect()->route('post.index')->with('status','Xóa rồi nhé !');
             }else{
                abort(404);
             }   
        }else{
            abort(404);
        }
  	}

  	public function edit($id){
  		$post = $this->post->findId($id);
  		if($post){
  			return view('post.edit')->with('post',$post);
  		}else{
  			abort(404);
  		}
    }


     /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $postRequest, $id)
    {
     $post = $this->post->findId($id);
     $validate = Validator::make($postRequest->all(),[
         'title'=>'required|max:255' 
         ],['title.required'=>'Title không được trống']);

     if($validate->fails()){
        return redirect()->route('post.edit',$id)->withErrors($validate);
    }

    $thumb=null;
          //lưu ảnh thumbnail
    if($postRequest->file('thumb')){
        $thumb = $postRequest->file('thumb');
        $validate = Validator::make($postRequest->all(),
           ['thumb'=>'mimes:jpeg,jpg,png'],['thumb.mimes'=>'File tải lên phải là định dạng ảnh']);

        if($validate->fails()){
            return redirect()->route('post.edit',$id)->withErrors($validate);
        }
        $path = 'upload/post';
        $fileName = time()."-".$thumb->getClientOriginalName();
        if(File::exists($post->thumb)){
                    File::delete($post->thumb);
          }
                	 $thumb->move($path , $fileName); 
                	 $thumb = $path."/".$fileName;
      }
        //Lưu csdl
        $id = $this->post->update($postRequest ,$id ,  $thumb );
        if($id !=false){
            return redirect()->route('post.show',$id);
        }else{
            abort(404);
        }
 }
}
