<?php
require_once(dirname(__FILE__). '/../WebContent/imagecreatefromfile.php');
require_once(dirname(__FILE__). '/../WebContent/imageresize.php');
class test_imageresize extends UnitTestCase {
	private $infile;
	private $outfile;
	
	function setUp() {
		$this->infile = dirname(__FILE__). '/../WebContent/images/Jellyfish.jpg';
		$this->outfile = dirname(__FILE__). '/../WebContent/images/TestJellyfish.jpg';
	}
	
	function tearDown() {
		//unlink($this->outfile);
		
	}
	
  function testResizeImage(){
  	list($width_orig, $height_orig) = getimagesize($this->infile);
  	$this->assertTrue($width_orig > 0, 'Input image should have non zero width');
  	$this->assertTrue($height_orig > 0, 'Input image should have non zero height');
  	$jpeg_test = imageresize($this->infile);
  	$this->assertTrue($jpeg_test != null, 'imageresize should create a non-empty item');
  	$this->assertTrue(imagesx($jpeg_test) == 200, 'imageresize should create a resource with the correct width');
  }
  
  function testRewriteImage(){
  	list($width_orig, $height_orig) = getimagesize($this->infile);
  	$this->assertTrue($width_orig > 0, 'Input image should have non zero width');
  	$this->assertTrue($height_orig > 0, 'Input image should have non zero height');
  	$jpeg_test = imageresize($this->infile);
   	imagejpeg($jpeg_test, $this->outfile, 100);
    $this->assertTrue($jpeg_test != null, 'imageresize should be able to create a resized image');
  }
  
}
?>