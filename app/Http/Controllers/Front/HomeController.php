<?php

namespace App\Http\Controllers\Front;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Repositories\PageRepository;


class HomeController extends Controller
{

    protected $page;
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(PageRepository $page)
    {
        //$this->middleware('auth');
        $this->page = $page;

    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   
        $pages = $this->page->paginateOrderBy('updated_at' , 'DESC' , 2);
         return view('index')->with('pages', $pages);
    }

    public function show($id){
        $page = $this->page->findId($id);
        if($page){
            return view('page')->with('page',$page);
        }else{
            abort(404);
        }
    }
}
