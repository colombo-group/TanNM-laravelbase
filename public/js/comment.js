$('document').ready(function(){
	disableLink();
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
			 	content :data.get('content'),
				parentId:data.get('comment_parent'),
				postId : data.get('postId'),
				userId : data.get('userId')
			},
			success: function(rs){
				if(rs){
					loadMore(rs);
				}
			}
		});
	$('#textarea').val("");
		
		return false;
	});


	$('.comment-section').on('click','a',function(){
		var html = "<form class='comment-child-form'><textarea class='form-control col-xs-12'  name='content' ></textarea></div>";
		html+="<button class='btn btn-primary' parentId='"+$(this).attr('commentId')+"'>Bình luận</button></form>";
		$('.comment-section').children('a').off('click');
		$(this).parent($('.first-comment')).fadeIn('slow', function() {
			$(this).append(html);
		});
	});

	$('.comment-section').on('submit','form',function(){
		$(this).fadeOut('400');
		var content  = $(this).children('textarea').val();
		var parentId = $(this).children('button').attr('parentId');
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
		var html = "<div class='col-xs-12 first-comment'>";
			html+= "<span><strong>";
			html+=rs['user'];
			html+="</strong></span><small class='text-muted'>";
			html+="&#32;&#32;&#32;&#32; vừa xong";
			html+="</small><p>";
			html+=rs['content'];
			html+="<a href='javascript:;' class='comment-button' commentId = '"+rs['id']+"'>&#32;&#32;&#32;&#32; Trả lời</a></p><div class='child-comment col-xs-10 col-offset-2' parent-Section='"+rs['id']+"'</div></div>";
		$('.comment-section').fadeIn('1000', function() {
			$(this).append(html);
		});
	}
	else{
		var html = "<div class='col-xs-12'>";
		html+= "<span><strong>";
		html+=rs['user'];
		html+="</strong></span><small class='text-muted'>";
		html+="&#32;&#32;&#32;&#32;vừa xong";
		html+="</small><p>";
		html+=rs['content'];
		var tmp = rs['parentId'];
		$('.child-comment').each(function(index, el) {
			if($(this).attr('parent-Section') == tmp){
				$(this).fadeIn('slow',function(){
					$(this).append(html);	
				});
			}
		});
	}
}

function disableLink(){
	$('.main a').each(function(){
		$(this).attr('href','javascript:;');
	})
}