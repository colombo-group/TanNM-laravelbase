<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Validator;
use Illuminate\Database\Eloquent\SoftDeletes;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $users = User::orderBy('created_at', 'desc')->paginate(6);
        return view('admin.users')->with('users' ,$users);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
        $user = User::find($id);
        if($user){
            return view('admin.user')->with('user',$user);
        }else{
            abort(404);
        }
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
        $user = User::find($id);
        if($user){
            return view('admin.userUpdate')->with('user',$user);
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
    public function update(Request $userRequest, $id)
    {
        //
        $user = User::find($id);
        $validate = Validator::make($userRequest->all(),[
                'username'=>'required|max:255|unique:users,username,'.$user->id,
                'email' => 'required|email|unique:users,email,'.$user->id
            ]);
        if($validate->fails()){
            return redirect()->route('user.edit',$user->id)->withErrors($validate);
        }else{
            $user->fill($userRequest->all())->save();
            return redirect()->route('user.show',$user->id);
        }
    }


    /**
     * SHhơ the Del List.
     *
     * 
     * @return view
     */
    public function recycle()
    {
        $user = User::onlyTrashed()->paginate(5);
        return view('admin.recycle')->with('users',$user);
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
        $user = User::find($id);
        if($user){
           
                $user->delete();
                return redirect()->route('user.index')->with('status','Xóa rồi nhé !');
            
        }else{
            abort(404);
        }
    }
    public function delete($id){
        $user = User::withTrashed()->where('id', '=', $id)->first();
        if($user){
            $user->forceDelete();
            return redirect()->route('admin.recycle')->with('status','Đã xóa vĩnh viễn!');
        }else{
            abort(404);
        }
    }
    /**
     *Restore
    */
    public function restore($id){
       $user = User::withTrashed()->where('id', '=', $id)->first();
        if($user->trashed()){
            $user->restore();
            return redirect()->route('user.index')->with('status', 'Đã khôi phục User');
        }
        else{
           abort(404);
        }
    }
}
