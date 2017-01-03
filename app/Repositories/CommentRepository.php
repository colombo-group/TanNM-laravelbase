<?php 
	
	namespace App\Repositories;

	use App\Models\Comment;
	use App\Repositories\RepositoryInterface;
use Auth;
	
	class commentRepository implements RepositoryInterface{
	/**
	 * function tìm kiếm comment theo ID
	 *@param int $id id của comment
	 *@return object
	 */
	public function findId($id){
		return Comment::find($id);
	}

	/**
	 * function soft delete comment theo ID
	 *@param int $id id của comment
	 *@return true|false
	 */
	public function delete($id){
		$comment  = Comment::find($id);
		$comments = Comment::All();
		function del($id , $comments){

			foreach ($comments as $key ) {
				if($key->parent_id == $id){
					del($key->id, $comments);
					Self::delPost($$key->id);
					$key->delete();
				}
			}
		}
		if($comment){
				del($comment->id , $comments);
				$comment->delete();
				return true;
			}
		else{
			return false;
		}
	}
    
    /**
	 *Xóa post theo danh mục
    */

    public static function delPost($id){
    	$comment = Comment::find($id);
    	$comment->posts()->delete();
    }			

	/**
	 * Show all
	 */
	public function showAll(){
		return Comment::orderBy('created_at' ,'DESC');
	}


    /**
	 * function xóa comment  theo ID
	 *@param int $id id của comment
	 *@return object
	 */
	public function forceDel($id){
		
	}


		/**
		 * function paginateOrderBy
		 *@param string $order sắp xép theo
		 *@param string $rule luật
		 *@param int $limit biến phân trang
		 *@return object  	
		 */	
		public function paginateOrderBy($order , $rule , $limit){
			return Comment::orderBy($order , $rule)->paginate($limit);
		}

		/**
		 * function paginateOrderBy
		 *@param string $order sắp xép theo
		 *@param string $rule luật
		 *@param int $limit biến phân trang
		 *@return object  	
		 */	
		public function commentPaginateOrderBy($order , $rule , $limit ,$userId){
			$user = Comment::find($userId);
			$comment =  $user->comments()->orderBy($order , $rule)->paginate($limit);
			return $comment;	
		}


		/**
         * hàm lưu 
         *@param request input mảng dữ liệu truyền vào để lưu
         *@return true|fale 
		 */
		public function save($input , $optional=null){
			$comment = new Comment;
			$comment->content = $input->input('content');
			$comment->parent_id = $input->parentId;
			$comment->user_id = Auth::user()->id;
			$comment->post_id = $input->postId;
			if($comment->save()){
				return $comment;
			}
			else{
				return false;
			}
		}

		/**
         * hàm lưu 
         *@param request input mảng dữ liệu truyền vào để lưu
         *@return true|fale 
		 */
		public function update($input , $id , $thumb){

			
		}
		
	}

?>