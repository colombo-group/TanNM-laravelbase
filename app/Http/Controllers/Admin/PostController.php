<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use App\Http\Controllers\Controller;
use App\Models\Post;
use Validator;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $posts = Post::paginate(2);


        return view('admin.index')->with('posts', $posts ); 
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.addPost');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $postRequest)
    {
            //Kiểm tra title
        $validate = Validator::make($postRequest->all(),[
         'title'=>'required|max:255' 
         ],['title.required'=>'Title không được trống']);

        if($validate->fails()){
            return redirect()->intended('admin/post/create')->withErrors($validate);
        }

        $thumb=null;
          //lưu ảnh thumbnail
        if($postRequest->hasFile('thumb')){
            $thumb = $postRequest->file('thumb');
            $validate = Validator::make($postRequest->all(),
               ['thumb'=>'mimes:jpeg,jpg,png'],['thumb.mimes'=>'File tải lên phải là định dạng ảnh']);

            if($validate->fails()){
                return redirect()->intended('admin/post/create')->withErrors($validate);
            }
            $path = 'upload';
            $fileName = time()."-".$thumb->getClientOriginalName();
            $thumb->move($path , $fileName); 
            $thumb = $path."/".$fileName;
        }
            //Lưu csdl
        $post = new Post();
        $post->title = $postRequest->input('title');
        $post->thumb = $thumb;
        $post->content = $postRequest->input('content');
        $post->save();
        return redirect()->route('post.show',$post->id);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        $post  = Post::find($id);
        return view('admin.post')->with('post',$post);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //check id
        $post = Post::find($id);
        if($post){
         return view('admin.editPost')->with('post', $post);
     }
     else{
        abort(404);        }
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
     $post = Post::find($id);
     $validate = Validator::make($postRequest->all(),[
         'title'=>'required|max:255' 
         ],['title.required'=>'Title không được trống']);

     if($validate->fails()){
        return redirect()->route('post.edit',$id)->withErrors($validate);
    }

    $thumb=null;
          //lưu ảnh thumbnail
    if($postRequest->hasFile('thumb')){
        $thumb = $postRequest->file('thumb');
        $validate = Validator::make($postRequest->all(),
           ['thumb'=>'mimes:jpeg,jpg,png'],['thumb.mimes'=>'File tải lên phải là định dạng ảnh']);

        if($validate->fails()){
            return redirect()->route('post.edit',$id)->withErrors($validate);
        }
        $path = 'upload';
        $fileName = time()."-".$thumb->getClientOriginalName();
        if(File::exists($post->thumb)){
         File::delete($post->thumb);}
         $thumb->move($path , $fileName); 
         $thumb = $path."/".$fileName;
     }
            //Lưu csdl
     $post->title = $postRequest->input('title');
     if($thumb!=null){$post->thumb = $thumb;}
     $post->content = $postRequest->input('content');
     $post->save();
     return redirect()->route('post.show',$post->id);
 }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $post = Post::find($id);
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
            $post->delete();
            return redirect()->route('post.index')->with('status','Xóa rồi nhé !');
        }else{
            abort(404);
        }
    }
}
