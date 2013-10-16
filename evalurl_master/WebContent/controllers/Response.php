<?php
class Response {
  private $responses = array();
  private $headers = array();
  private $response_sent = false;
  
  public function __construct() {
  }
  
  public function addHeader($header) {
    $this->headers[] = $header;
    return $this;
  }
  
  public function addHeaders(array $headers) {
    foreach ($headers as $header) {
      $this->addHeader($header);
    }
    return $this;
  }
  
  public function addResponse($response) {
  	$this->responses[] = $response;
  	return $this;
  }
  
  public function addResponses(array $responses) {
  	foreach ($responses as $response) {
  		$this->addResponse($response);
  	}
  	return $this;
  }
  
  public function getHeaders() {
    return $this->headers;
  }
  
  public function getResponses() {
  	return $this->responses;
  }
  
  public function send() {
    if (!$this->response_sent) {
      foreach($this->headers as $header) {
        header($header, true);
      }
      foreach($this->responses as $response) {
      	echo($response);
      }
      $this->response_sent = true;
    }  
    return $this;
  }
}
?>