<?php
class myGroupTest extends GroupTest {
  function myGroupTest() {
    parent::GroupTest('');
    $this->addTestFile(dirname(__FILE__).'/test_CommentModel_validate.php');
    $this->addTestFile(dirname(__FILE__).'/test_ControllerFactory.php');
    $this->addTestFile(dirname(__FILE__).'/test_UrlModel.php');
    $this->addTestFile(dirname(__FILE__).'/test_UrlModel_validate.php');
    $this->addTestFile(dirname(__FILE__).'/test_UserModel_validate.php');
  }
}
?>