<?php
require_once(dirname(__FILE__). '/../WebContent/validations.php');
class test_validations extends UnitTestCase {
  function testReturnsErrorWhenProtocolIsMissing(){
  	$inarray = array ('url_eval' => 'www.cs.utsa.edu',
	                  'url_category' => 'First',
	                  'url_description' => 'My description');
  	$outarray = validate_newurl($inarray);
    $this->assertTrue(is_array($outarray), 
    		'The validations function should always return an array');
    $this->assertTrue(array_key_exists('error', $outarray), 
    		'The validations return value should have an error');
    $this->assertTrue(strcmp('Invalid URL', $outarray['error']),
    		'The error message should be Invalid URL');
  }
}
?>