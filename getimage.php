<?php 
require_once "connect_db.php";
	header('Content-Type: image/png');
	if(isset($_GET["id"]))
	{
		$Connect = new Connect(); 
		$id = $_GET["id"];
		$image = $Connect->getImageById($id);
		$type = isset( $_GET["type"] ) ? $_GET["type"]:'';
		switch($type)
		{
			case 'large': $decoder_image = stripslashes ( $image->large );break;
			case 'medium': $decoder_image = stripslashes ( $image->medium );break;
			default : $decoder_image = stripslashes ($image->small);
		}
		$im = imagecreatefromstring($decoder_image);
		imagepng($im);
		imagedestroy($im);
	}
?>