<?php
class WebTests extends TestSuite {
  function WebTests() {
    $this->TestSuite('Web site tests');
    $this->addFile(dirname(__FILE__).'/test_indexPage.php');
    $this->addFile(dirname(__FILE__).'/test_newurlPage.php');
  }
}
?>