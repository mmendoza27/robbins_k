<?php
class myGroupTest extends GroupTest {
  function myGroupTest() {
    parent::GroupTest('');
    $this->addTestFile(dirname(__FILE__).'/test_EvalUrlModel.php');
    $this->addTestFile(dirname(__FILE__).'/test_EvalUrlModel_validate.php');
    $this->addTestFile(dirname(__FILE__).'/test_EvalUrl.php');
  }
}
?>