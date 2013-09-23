<html>
<head>
<meta charset="ISO-8859-1">
<title>URL find URL-NASH entries</title>
</head>
<body>
<h1>URL-NASH Entry</h1>

<section>
<?php 
require_once('EvalUrlModel.php');
require_once('EvalUrl.php');
print_r($_GET);
echo "<br>";

$model = new EvalUrlModel("localhost", "krobbins", "abc123", "evalurls");
$myUrl = $model->getUrl($_GET['url_eval']);
echo "<br>myUrl returns: ";
print_r($myUrl);
echo "<br>";
?>
<p>
<a href = "index.php">Return to main page</a></p>
</section>
</body>
</html>