<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Models\User;
use App\Http\Controllers\Controller;

class AdminController extends Controller
{
    public function index(Request $request){
    	$request->session()->flash('status', 'Task was successful!');
    	$users = User::paginate(2);
    	return view('admin/index')->with('users',$users);
    }
}
