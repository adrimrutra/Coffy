<?php
	if(isset($_GET['id']))
	{
		require_once "connect_db.php";
		$Connect = new Connect(); 
		
		$item =  $Connect->getItem($_GET['id']);
		if($item != null)
		{
			$template = file_get_contents ("templates/itemContent.html");
			//$galery = file_get_contents ("templates/myGalleryItem.html");
			$galery = file_get_contents ("templates/myGalleryItemTwo.html");
		
			$content = str_replace("##LONGNAME##",  $item->longname, $template);
			$content = str_replace("##DESCRIPTION##",  $item->description, $content);
			
			$images = $Connect->getImagesByContentId($_GET['id']);
			$galeryItem ='';
			foreach($images  as $image)
			{
				$galeryItem = $galeryItem . str_replace("##ID##",  $image['id'], $galery);
				//echo '<img src="getimage.php?id='.$image['id'].'&type=large"/>';
			}
			$content = str_replace("##GALERIES##",  $galeryItem, $content);
			echo $content;

		}
	}
?>