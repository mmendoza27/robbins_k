<?php
class myGroupTest extends GroupTest {
  function myGroupTest() {
    parent::GroupTest('');
    $this->addTestFile(dirname(__FILE__).'/test_Request.php');
    $this->addTestFile(dirname(__FILE__).'/test_Response.php');
    $this->addTestFile(dirname(__FILE__).'/test_FrontController.php');
  }
}
?>