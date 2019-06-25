<?php 

//-------------------------------------------------------------------------------
 	ob_start();
 	include "contents/itemContent.php";
 	$content = ob_get_contents();
 	ob_end_clean();

//------------------------------------------------------------------------------- 
 	$siteTemplate = file_get_contents ("templates/site.html");
	$itemTemplate = file_get_contents ("templates/item.html");
 	$template = str_replace("##CONTENT##",  $content, $itemTemplate);
 	echo str_replace("##PAGE##",  $template, $siteTemplate);
 
?>