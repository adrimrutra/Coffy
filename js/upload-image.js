$(document).ready(function (e) {
	var contentid = 0;
	window.addImageFunction = function(){
		var id = $(this).attr('content-id');
		contentid = id;
		$('#hidden_content_id').val(id);
	}
	$(".add-btn").click(
		addImageFunction
	);
	
	
	$(".gallery-control.left").click(function(){
		var galleryParent = $(this).parent('.gallery'); 
		var images = galleryParent.find('.thumbnail'); 
		var index = images.index(galleryParent.find('.current'));
		images.removeClass('current'); 
		if(index >= 1){		
			images.eq(index-1).addClass('current');
		}else{
			images.eq(images.size()-1).addClass('current');
		}		
	});
	$(".gallery-control.right").click(function(){
		var galleryParent = $(this).parent('.gallery'); 
		var images = galleryParent.find('.thumbnail'); 
		var index = images.index(galleryParent.find('.current'));
		images.removeClass('current'); 
		if(index < images.size()-1){
			images.eq(index+1).addClass('current');
		}else{
			images.eq(0).addClass('current');
		}	
	});
	$("#uploadForm").on('submit',(function(e) {
		e.preventDefault();
		$.ajax({
        	url: "upload-image.php",
			type: "POST",
			data:  new FormData(this),
			contentType: false,
    	    cache: false,
			processData:false,
			success: function(data){
				$('#gallery-' + contentid).find('.thumbnail').removeClass('current');
				$('#gallery-' + contentid).append(data);
				
				$('#myModal2').modal('hide');
		    },
		  	error: function(){
			
	    	} 	        
	   });
	}));
});