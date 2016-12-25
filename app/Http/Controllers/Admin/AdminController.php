<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Models\User;
use App\Http\Controllers\Controller;

/**
 * lớp làm việc với admin
*/
class AdminController extends Controller
{

	/**
     * hàm hiển thị danh sách các post
     *@return view của trng admin
	*/
    public function index(Request $request){
    	$request->session()->flash('status', 'Task was successful!');
    	$users = User::paginate(2);
    	return view('admin/index')->with('users',$users);
    }

    /**
	 * hàm hiển thị view của trang thêm post
	 *@return view trang thêm post
    */
    public function addPost(){
    	return view('admin.addPost');

    }


}
