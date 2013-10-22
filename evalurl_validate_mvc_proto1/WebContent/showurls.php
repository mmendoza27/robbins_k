<html>
<head>
<meta charset="ISO-8859-1">
<title>URL-NASH entries</title>
</head>
<body>

<h1>URL-NASH entries so far</h1>

<section>
<?php 
	$model = new EvalUrlModel("localhost", "krobbins", "abc123", "evalurls");
	$vals = $model->showAll();
	if (array_key_exists('error', $vals)) {
	    echo $vals['error'];
	} else {
		$result = $vals['result'];
        while ($row = mysqli_fetch_array($result)) {
	        echo "URL: " . $row["url_eval"] . "<br>";
	    } 
     }

?>

<a href = "index.php">Return to main page</a>
</section>
</body>
</html>