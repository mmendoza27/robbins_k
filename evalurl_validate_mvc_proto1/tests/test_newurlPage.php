<?php
require_once(dirname(__FILE__). '/../WebContent/newurl.php');
require_once('C:/Programs/simpletest/web_tester.php');
class test_newurlPage extends WebTestCase {
	
	function setUp() {
		
	}
	
	function tearDown() {
		
	}
	
	function testCanLoadNewUrlPage() {
		 $this->assertTrue(
		 		$this->get('http://localhost/evalurl_validate_mvc/newurl.php'),
                'It should successfully load newurl.php on get');
		 $this->assertTitle(new PatternExpectation('/URL/'), 
		 		'The newurl.php page title should have URL in the title');
		 $this->assertText('Did you find', 
		 		'The newurl.php page should have the words Did you find on the page');
	}
	
	function testUrlCreateForm() {
		$this->get('http://localhost/evalurl_validate_mvc/newurl.php');
		$this->assertField('url_eval', 'http://www.cs.utsa.edu', 
                   'The default url should be http://www.cs.utsa.edu');
		
	}
 
}
?>