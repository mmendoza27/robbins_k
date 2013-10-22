<?php
function validate_newurl($myarray) {
	
	$error = "";
	$url_eval = trim(filter_var($myarray['url_eval'], FILTER_SANITIZE_URL));
	if (!filter_var($url_eval, FILTER_VALIDATE_URL)) {
		$error .= "Invalid URL ";
	}
	$newvals = array ('url_eval' => $url_eval,
	                  'url_category' => $myarray['url_category'],
	                  'url_description' => $myarray['url_description']);
	if (strcmp($error, "") != 0) {
		$newvals['error'] = $error;
     }
     return $newvals;
}