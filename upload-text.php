<?php
require_once "connect_db.php";
	$Connect = new Connect(); 
			
	if(isset($_POST['shortname']))
		$shortname = $_POST['shortname'];
	if(isset($_POST['longname']))
		$longname = $_POST['longname'];
	if(isset($_POST['description']))
		$description = $_POST['description'];

	$id =  $Connect->addItem($shortname,$longname,$description);
	$template = file_get_contents ("templates/content.html");

		$content = str_replace("##ID##",  $id, $template);
		$content = str_replace("##SHORTNAME##",  $shortname, $content);
		$content = str_replace("##LONGNAME##",  $longname, $content);	

		echo $content;
	
	
?>






