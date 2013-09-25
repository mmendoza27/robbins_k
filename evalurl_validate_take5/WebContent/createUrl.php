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
print_r($_POST);

$model = new UrlModel("localhost", "krobbins", "abc123", "evalurls");
$model->create($_POST);
echo $model->getError();

?>
<p>
<a href = "index.php">Return to main page</a></p>
</section>
</body>
</html>