<html>
<head>
<meta charset="ISO-8859-1">
<title>Show all URL-NASH entries</title>
</head>
<body>
<h1>URL-NASH entries so far</h1>

<section>
<?php 
require_once('EvalUrlModel.php');
print_r($_POST);
echo "<br>";

$model = new EvalUrlModel("localhost", "krobbins", "abc123", "evalurls");
$model->createUrl($_POST);
echo $model->getError();

?>
<p>
<a href = "index.php">Return to main page</a></p>
</section>
</body>
</html>