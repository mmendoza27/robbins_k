<html>
<head>
<meta charset="ISO-8859-1">
<title>Show all URL-NASH entries</title>
</head>
<body>
<h1>URL-NASH entries so far</h1>

<section>
<?php 
require_once('UrlModel.php');
require_once('ControllerFactory.php');
require_once('dumpSupers.php');
dumpSupers("Entering createUrl");

$db = ControllerFactory::buildDb("localhost", "krobbins", "abc123", "evalurls");
$model = new UrlModel($db);
$model->create($_POST);
echo "<br><br>----";
echo $model->getError();

?>
<p>
<a href = "index.php">Return to main page</a></p>
</section>
</body>
</html>