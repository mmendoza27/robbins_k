<?php 
require_once(dirname(__FILE__). './imagecreatefromfile.php');
function imageresize($fileIn, $width = 200, $height = 200) {
	// Get new dimensions
	list($width_orig, $height_orig) = getimagesize($fileIn);
	$ratio_orig = $width_orig/$height_orig;
	
	if ($width/$height > $ratio_orig) {
	   $width = $height*$ratio_orig;
	} else {
	   $height = $width/$ratio_orig;
	}
	
	// Resample
	$image_p = imagecreatetruecolor($width, $height);
	$image = imagecreatefromfile($fileIn);
	imagecopyresampled($image_p, $image, 0, 0, 0, 0, $width, $height, $width_orig, $height_orig);
	return $image_p;
}
?>