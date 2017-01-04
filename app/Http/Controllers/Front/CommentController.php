<?php

namespace App\Http\Controllers\Front;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\CommentRepository;
use Illuminate\Http\Response;
use Auth;

/**
 * Class Comment
 */
class CommentController extends Controller
{
    //
	protected $comment ;
	function __construct(){
		$this->comment = new CommentRepository;
	}

    /**
  	 * Submit comment	
     */
    public function store(Request $comment){
    	$rs['status'] = null;

        if($comment->input('postId') == ""){
    	$comment = $this->comment->save($comment , true);
    }else{
        $comment = $this->comment->save($comment , null);
    }
    	if($comment){
    		$rs['content'] = $comment->content;
    		$rs['user'] = $comment->users->name;
    		$rs['id'] = $comment->id;
    		$rs['created_at'] = $comment->created_at;
    		$rs['parentId'] = $comment->parent_id;
    	}
    	else{
    		$rs['status'] = false;
    	}

    	return response()->json($rs);
    }

}
