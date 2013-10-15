<!DOCTYPE html>
<html>
<head>
<meta charset="ISO-8859-1">
<title>Some sample images</title>
</head>
<body>
<h1>Testing GD images</h1>

<h3>Get information about GD library</h3>
<?php print_r(gd_info()); ?>

<h3>Get the size of an image file</h3>
<?php print_r(getimagesize('./images/Desert.jpg')); ?>

<h3>Resize an image with resampling (from PhP manual example)</h3>
<?php
require_once(dirname(__FILE__). './imageresize.php');
// The file
$infile = './images/Desert.jpg';
$outfile = './images/TestDesert.jpg';

list($width_orig, $height_orig) = getimagesize($infile);
$jpeg_test = imageresize($infile, 100, 100);
imagejpeg($jpeg_test, $outfile, 100);
imagedestroy($jpeg_test);

?>
<h3> Original image</h3>
<img src="./images/Desert.jpg">
<h3> Resized image</h3>
<img src="./images/TestDesert.jpg">
</body>
</html>