<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class AdminController extends Controller
{
    public function index(Request $request){
    	$request->session()->flash('status', 'Task was successful!');
    	$users = User::paginate(2);
    	return view('admin/index')->with('users',$users);
    }
}
