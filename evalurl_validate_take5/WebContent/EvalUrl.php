<?php
class EvalUrl {
	public $url_id;
	public $url_eval;
	public $url_category;
	public $url_timestamp;
	public $url_description;
	
	public function __construct($array) {
        $this->url_id = $array['url_id']; 
        $this->url_eval = $array['url_eval']; 
        $this->category = $array['url_category']; 
        $this->timestamp = $array['url_timestamp']; 
        $this->description = $array['url_description']; 
	}
}

?>