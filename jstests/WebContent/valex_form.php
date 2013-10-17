<!DOCTYPE html>
<html>
<head>
</head>
<body>
<h1>Form is submitted</h1>

Welcome 
<?php 
if (array_key_exists('fname', $_POST)) {
	echo $_POST['fname'];
} else {
	echo "Nobody";
}
?>