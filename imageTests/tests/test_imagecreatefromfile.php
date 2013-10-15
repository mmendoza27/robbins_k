<?php
require_once(dirname(__FILE__). '/../WebContent/imagecreatefromfile.php');
class test_imagecreatefromfile extends UnitTestCase {
	private $infile;
	private $outfile;
	
	function setUp() {
		$this->infile = dirname(__FILE__). '/../WebContent/images/Jellyfish.jpg';
		$this->outfile = dirname(__FILE__). '/../WebContent/images/TestJellyfish.jpg';
	}
	
	function tearDown() {
		//unlink($this->outfile);
		
	}
	
  function testMakeImage(){
  	$jpeg_test = imagecreatefromfile($this->infile);
  	$this->assertTrue($jpeg_test != null, 'imagecreatefromfile should create a non-empty item');
  	$temp = tempnam("Blech", "");
  	imagejpeg($jpeg_test, $temp, 100);  
  }
  
  function testRewriteImage(){
  	$jpeg_test = imagecreatefromfile($this->infile);
  	$this->assertTrue($jpeg_test != null, 'imagecreatefromfile should create a non-empty item');
  	imagejpeg($jpeg_test, $this->outfile, 100);
  	$jpeg_new = imagecreatefromfile($this->outfile);
  	$this->assertTrue($jpeg_new != null, 'imagecreatefromfile should be able to read an image that was written out');
  }
  
}
?>