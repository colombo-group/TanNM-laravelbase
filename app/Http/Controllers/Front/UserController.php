<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;

/**
 *@author nguyenminhtan<nguyenminhtan893@gmail.com>
 * class sử lý user
 */
class UserController extends Controller
{
    /**
     * hàm hiển thị profile user
    */
    public function profile($id){

    	//kiểm tra id có tồn tại không
    	$user = user::find($id);
    	if($user != null){
    		return view('profile')->with('user',$user);
    	}
    	else{
    		abort(404);
    	}
    }

    /**
     * hàm update profile user
    */
    public function update($id){

    	//kiểm tra id có tồn tại không
    	$user = user::find($id);
    	if($user != null){
    		return view('profile_update')->with('user',$user);
    	}
    	else{
    		abort(404);
    	}
    } 

    /**
     * hàm save profile user
    */
    public function save($id  ,Request $request){

    	//kiểm tra id có tồn tại không

    	$user = user::find($id);
    	if($user != null){
    		$validate =  Validator::make($request->all(), [
       			'name' => 'required|max:255',
        		'email' => 'required|email|unique:users,email,'.$user->id,
        		'sex'=>'required'
    		]);

    		if($validate->fails()){
    			return redirect()->route('user.update',$user->id)->withErrors($validate);
    		}else{
    			$user->name= $request->input('name');
    			$user->email= $request->input('email');
    			$user->birthday= $request->input('birthday');
    			$user->address= $request->input('address');
    			$user->slogan= $request->input('slogan');
    			$user->sex= $request->input('sex');
    			if($user->save()){
    				return redirect()->route('user.profile',$user->id);
    			}else{
    				abort(404);
    			}
    		}
    	}
    	else{
    		abort(404);
    	}
    }


}
