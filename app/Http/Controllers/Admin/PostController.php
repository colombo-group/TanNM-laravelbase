<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
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
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
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
    }
}
