<?php
class EvalUrl {
	public $url;
	public $category;
	public $description;
	
	public function _construct($url, $category, $description) {
		$this->url = $url;
		$this->category = $category;
		$this->description = $description;
	}
}
 ?>