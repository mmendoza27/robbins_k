<?php 
if (!array_key_exists('CountCookie', $_COOKIE)) {
	$count = 1;
} else {
	$count = $_COOKIE['CountCookie'];
	$count++;
}
setcookie('CountCookie', $count, time() + 24*3600);
?>
<html>
  <head><title>Cookies</title></head>
  <body>
    <p>You have visited this page <?=$count ?> times.</p>
      <a href="index.php">Back to index</a>
  </body>
</html>