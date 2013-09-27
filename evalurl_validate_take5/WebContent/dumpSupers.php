<?php 
function dumpSupers($msg)  {
	
    echo "<h3>".$msg ."</h3>";
    echo "<br><h3>Post:</h3>";
	print_r( $_POST );
	
	echo "<br><h3>Session:</h3>";
	print_r ( $_SESSION );
	
	echo "<br><h3>Cookie:</h3>";
	print_r ( $_COOKIE );
	
	echo "<br><h3>Server:</h3>";
	print_r ( $_SERVER );
	
	echo "<br><h3>Request:</h3>";
	print_r ( $_REQUEST );
	
	echo "<br><h3>Env:</h3>";
	print_r ( $_ENV );
	
	echo "<br><h3>Files:</h3>";
	print_r ( $_FILES );
	
}
?>