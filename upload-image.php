<?php
require_once "connect_db.php";
require_once "resize.php";	 

	function getExtension($str) {
		$i=strrpos($str,".");
		if(!$i){
			return"";
		}
		$l=strlen($str)-$i;
		$ext=substr($str,$i+1,$l);
		return $ext;
	}
	$formats = array("jpg", "png", "gif", "jpeg", "PNG", "JPG", "JPEG", "GIF");
	if(isset($_FILES['userImage']['tmp_name']))
	{
		$name = $_FILES['userImage']['name'];
		if(strlen($name))
		{
		    $ext = getExtension($name);
		    if(in_array($ext,$formats))
		    {
				list($width, $height, $type) = getimagesize($_FILES['userImage']['tmp_name']);
				switch ($type)
				{
					case 3: $tmpFile = "tmpFile.png"; break;
					case 2: $tmpFile = "tmpFile.jpg"; break;
					case 1: $tmpFile = "tmpFile.gif"; break;	
				}
			//	
				$handle = fopen($tmpFile, 'w') or die("can't open file");
				fclose($handle);
				
				$tmpFile = resize_image($_FILES['userImage']['tmp_name'],$tmpFile,163,150);

				$image_small = addslashes(file_get_contents($tmpFile));
				$image_name = addslashes($_FILES['userImage']['name']);
				$image_size = getimagesize($tmpFile);
			//	
				
				$tmpFile = resize_image($_FILES['userImage']['tmp_name'],$tmpFile,870,820);

				$image_large = addslashes(file_get_contents($tmpFile));
				$image_name = addslashes($_FILES['userImage']['name']);
				$image_size = getimagesize($tmpFile);
				
			//	
			
				$tmpFile = resize_image($_FILES['userImage']['tmp_name'],$tmpFile,600,560);

				$image_medium = addslashes(file_get_contents($tmpFile));
				$image_name = addslashes($_FILES['userImage']['name']);
				$image_size = getimagesize($tmpFile);
				
			//	
				
				if(isset($_POST['content_id']))
					$content_id = $_POST['content_id']; 
				
				$Connect = new Connect(); 
				
				$id = $Connect->addImage($image_small,$content_id,$image_large,$image_medium);
				unlink($tmpFile);
				
				$galery = file_get_contents ("templates/content-thumbnail.html");
				echo str_replace("##ID##",  $id, $galery);
			}
			else
			{
				echo "Invalid Image file format.";
		    }
		}
		
	}
	
	
?>