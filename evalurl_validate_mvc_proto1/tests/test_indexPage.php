<?php
require_once(dirname(__FILE__). '/../WebContent/index.php');
require_once('C:/Programs/simpletest/web_tester.php');
class test_indexPage extends WebTestCase {
	
	function setUp() {
		
	}
	
	function tearDown() {
		
	}
	
	function testCanLoadIndexPage() {
		 $this->assertTrue(
		 		$this->get('http://localhost/evalurl_validate_mvc/index.php'),
                'It should successfully load index.php on get');
		 $this->get('http://localhost/evalurl_validate_mvc/index.php');
		 $this->assertTitle('URL-NASH', 'The index.php page title should be URL-NASH');
		 $this->assertText('web connoisseurs', 
		 		'The index.php page should have the words web connoisseurs on the page');
	}
	
	function testCanNavigateToNewURL() {
		$this->get('http://localhost/evalurl_validate_mvc/index.php');
		$this->assertTitle('URL-NASH', 'The index.php page title should be URL-NASH');
		$this->clickLink('Link', 1);
		$this->assertTitle(new PatternExpectation('/URL/'), 
		 		'The newurl.php page title should have URL in the title');
	}
 
}
?>