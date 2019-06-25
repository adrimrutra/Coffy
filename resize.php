<?php
	function resize_image($filename,$tmpFile,$max_width ,$max_height)
	{
		list($width, $height, $type) = getimagesize($filename);
		switch($type)
		{
			case 1: header('Content-Type: image/gif'); break;
			case 2: header('Content-Type: image/jpeg'); break;
			case 3: header('Content-Type: image/png'); break;
		}
		// Get new dimensions
		
		list($width, $height) = getimagesize($filename);
		$x_ratio = $max_width / $width;
		$y_ratio = $max_height / $height;

		if( ($width <= $max_width) && ($height <= $max_height) ){
			$tn_width = $width;
			$tn_height = $height;
			}elseif (($x_ratio * $height) < $max_height){
				$tn_height = ceil($x_ratio * $height);
				$tn_width = $max_width;
			}else{
				$tn_width = ceil($y_ratio * $width);
				$tn_height = $max_height;
		}
		// Resample
		$image_p = imagecreatetruecolor($tn_width, $tn_height);
		if($type == 1 or $type == 3)
		{
			imagecolortransparent($image_p, imagecolorallocatealpha($image_p, 0, 0, 0, 127));
			imagealphablending($image_p, false);
			imagesavealpha($image_p, true);
		}
		switch($type)
		{
			case 1: $image = imagecreatefromgif($filename); break;		
			case 2: $image = imagecreatefromjpeg($filename); break;
			case 3: $image = imagecreatefrompng($filename); break;	
		}

		imagecopyresampled($image_p, $image, 0, 0, 0, 0, $tn_width, $tn_height, $width, $height);
		switch($type)
		{
			case 1: imagegif($image_p,$tmpFile); break;
			case 2: imagejpeg($image_p,$tmpFile); break;
			case 3: imagepng($image_p,$tmpFile); break;
		}
		return $tmpFile;
	}
?>







