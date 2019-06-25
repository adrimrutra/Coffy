<?php 

//-------------------------------------------------------------------------------
 	ob_start();
 	include "contents/indexContent.php";
 	$content = ob_get_contents();
 	ob_end_clean();

//------------------------------------------------------------------------------- 
 	$siteTemplate = file_get_contents ("templates/site.html");
	$indexTemplate = file_get_contents ("templates/index.html");
 	$template = str_replace("##CONTENT##",  $content, $indexTemplate);
 	echo str_replace("##PAGE##",  $template, $siteTemplate);
 
?>