<?php

	require_once "connect_db.php";
	$Connect = new Connect(); 

	$items = $Connect->getItems();
	$template = file_get_contents ("templates/content.html");
	$galery = file_get_contents ("templates/content-thumbnail.html");
	
	foreach($items  as $item){
		$images = $Connect->getImagesByContentId($item['id']);
		
		$content = str_replace("##ID##",  $item['id'], $template);
		$content = str_replace("##SHORTNAME##",  $item['shortname'], $content);
		$content = str_replace("##LONGNAME##",  $item['longname'], $content);	
		$thumbnails ='';
		foreach($images  as $image)
		{
			$thumbnails = $thumbnails . str_replace("##ID##",  $image['id'], $galery);
		}
		$content = str_replace("##GALERIES##",  $thumbnails, $content);
		echo $content;
	}
		
?>










