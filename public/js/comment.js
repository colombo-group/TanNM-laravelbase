$('document').ready(function(){
	$('.comment-form').on('submit',function(){

		var data = new FormData(this);
		 $.ajaxSetup({
       			headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') }
   		 })
		$.ajax({
			method :'post',
			url: url,
			dataType: 'json',
			data: {
				content : data.get('content'),
				parentId : data.get('comment_parent'),
				postId : data.get('postId'),
				userId : data.get('userId')
			},
			success: function(rs){
				if(rs){
					loadMore(rs);
				}
			}
		})
		return false;
	});


	$('.comment-section').on('click','a',function(){
		var html = "<br><form><textarea class='form-control col-xs-12'  name='content' ></textarea></div>";
		html+="<br><button class='btn btn-primary' parentId='"+$(this).attr('commentId')+"'>Bình luận</button></form>";
		$("a").off('click');
		$(this).parent($('.first-comment')).append(html);
	});

	$('.first-comment').on('click','button',function(){
		$(this).parent('form').fadeOut('400');
		var content  = $(this).parent('form').children('textarea').val();
		var parentId = $(this).attr('parentId');
		childComment(parentId , content);
		return false;
	});
})

	function childComment(parentId , content ){
		var postId = $('#postId').val();
		 $.ajaxSetup({
       			headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') }
   		 });
		$.ajax({
			url : url,
			type :'post',
			dataType :'json',
			data : {
				postId : postId,
				parentId :parentId,
				content : 	content
			},
			success :function(rs){
				loadMore(rs);
			}
		});
	}

function loadMore(rs){
	if(rs['parentId'] == 0 ){
		var html = "<div class='first-comment'>";
		html+= "<span><strong>";
		html+=rs['user'];
		html+="</strong></span><small class='text-muted'>";
		html+="  	vừa xong";
		html+="</small></span><p>";
		html+=rs['content'];
		html+="<a href='javascript:;' class='comment-button' commentId = '"+rs['id']+"'>   Trả lời</a></p><div class='second-comment-section' parentCommentSection='"+rs['id']+"'</div></div>";
		$('.comment-section').fadeIn('1000', function() {
			$(this).append(html);
		});
	}
	else{
		var html = "<div class='second-comment'>";
		html+= "<span><strong>";
		html+=rs['user'];
		html+="</strong></span><small class='text-muted'>";
		html+="  	vừa xong";
		html+="</small></span><p>";
		html+=rs['content'];
		var tmp = rs['parentId'];
		alert(tmp);
		/*$(".second-comment-section").attr('parentCommentSection' , tmp).fadeIn('1000', function() {
			$(this).append(html);
		});*/
	}
}