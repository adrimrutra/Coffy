$( document ).ready(function( $ ) {

	$( ".my-gallery div" ).first().addClass('my-gallery-item-checked');
	$( ".my-gallery div img" ).first().addClass('my-gallery-item-img-checked');
	
	window.myGalleryImageFunction = function(){
		
		var id = $(this).attr('item-id');
		var galleryParent = $(this).parent('.my-gallery'); 
		var item = galleryParent.find('.my-gallery-item'); 
		var index = item.index(galleryParent.find('.my-gallery-item-checked'));	
		item.removeClass('my-gallery-item-checked').addClass('my-gallery-item'); 
		item.children().removeClass('my-gallery-item-img-checked').addClass('my-gallery-item-img');
		$( "#item-"+id ).addClass('my-gallery-item-checked');
		$( "#image-"+id ).addClass('my-gallery-item-img-checked');
	}
	$(".my-gallery-item").click(
		myGalleryImageFunction
	);
	
	
	
	window.GalleryImageFunc = function(){
		var id = $(this).attr('item-id');
		$('#myModal-photo').modal('show');
		$('#modal-image').attr('src','getimage.php?id='+id+'&type=large');
		//$('#modal-image').attr('src','getimage.php?id='+id+'&type=large');
	}
	$(".my-gallery-item-two").click(
		GalleryImageFunc
	);
	

	
	$('#myForm').submit(function(){
		$.ajax({
			type: "POST",
			url: "upload-text.php",
			data: "shortname="+$("#shortname").val()+"&"+"longname="+$("#longname").val()+"&"+"description="+$("#description").val(),
			success: function(data){
				var newItem = $(data);
				$(newItem).find('.add-btn').click(window.addImageFunction);
				$('#content').append(newItem);
				$('#myModal').modal('hide');
				$('html,body').animate({scrollTop: $(newItem).offset().top});	
		   }
		});
		return false;
	});
});