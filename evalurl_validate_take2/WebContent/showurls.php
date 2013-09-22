<html>
<head>
<meta charset="ISO-8859-1">
<title>URL-NASH entries</title>
</head>
<body>

<h1>URL-NASH entries so far</h1>

<section>
<?php 
require_once('EvalUrlModel.php');
$model = new EvalUrlModel("localhost", "krobbins", "abc123", "evalurls");
while ($row = $model->nextUrl()) {
	echo "URL: " . $row["url_eval"] . "<br>";
}
?>

<a href = "index.php">Return to main page</a>
</section>
</body>
</html>