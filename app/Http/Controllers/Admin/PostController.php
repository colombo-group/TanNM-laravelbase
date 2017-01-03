<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\CateRepository;
use App\Repositories\PostRepository;
use Validator;
use Illuminate\Support\Facades\File;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;


class PostController extends Controller
{
    //
    protected $post;
    protected $cate;

    function __construct(){
    	$this->post = new PostRepository;
    	$this->cate = new CateRepository;
    }

    /**
     * show post trong danh mục
    */
    public function index($id){
    	$cate = $this->cate->findId($id);
    	$posts = $cate->posts()->orderBy('updated_at', 'DESC')->paginate(2);
    	return view('admin.post.index')->with(['cate'=>$cate, 'posts'=>$posts]);
    }

    /**
	 *Xóa post
    */
    public function delete($id ){
    	$post = $this->post->findId($id);
    	if($this->post->delete($id)){
    		return redirect()->route('admin.post.index' , $post->cateId)->with('status','đã xóa post!');
    	}else{
    		abort(404);
    	}
    }

    /**
     *Show
    */
    public function show($id){
        $post = $this->post->findId($id);
        return view('admin.post.show')->with('post',$post);
    } 

    /**
     *edit
    */
    public function edit($id){
        $post = $this->post->findId($id);
        $cates = $this->cate->showAll();
        return view('admin.post.edit')->with(['post'=>$post, 'cates'=>$cates]);
    }

    /**
     *update
    */
    public function update(Request $postRequest, $id){
        $post = $this->post->findId($id);
        $validate = Validator::make($postRequest->all(),[
           'title'=>'required|max:255' 
           ],['title.required'=>'Title không được trống']);

        if($validate->fails()){
            return redirect()->route('post.edit',$id)->withErrors($validate);
        }
        $store = null;
        $thumb=null;
          //lưu ảnh thumbnail
        if($postRequest->file('thumb')){
            $disk = Storage::disk('public');
            $year = Carbon::now()->year;
            $month = Carbon::now()->month;
            $day = Carbon::now()->day;
            $disk = Storage::disk('public');

            $store = "posts/$year/$month-$year/$day-$month-$year/";
            $thumb = $postRequest->file('thumb');
            $validate = Validator::make($postRequest->all(),
             ['thumb'=>'mimes:jpeg,jpg,png'],['thumb.mimes'=>'File tải lên phải là định dạng ảnh']);

            if($validate->fails()){
                return redirect()->route('post.edit',$id)->withErrors($validate);
            }
            if($disk->exists($post->thumb) && $post->thumb !=null){
                $disk->delete($post->thumb);
            }
            $fileName = time().".".$thumb->getClientOriginalExtension();
            $store .=$fileName; 
            $disk->put($store, File::get($thumb)); 
        }
        //Lưu csdl
        $id = $this->post->update($postRequest ,$id ,  $store );
        if($id !=false){
            return redirect()->route('admin.post.show',$id);
        }else{
            abort(404);
        }
    }
}
