<html>
<head>
<meta charset="ISO-8859-1">
<title>URL-NASH entries</title>
</head>
<body>

<h1>URL-NASH entries so far</h1>

<section>
<?php 
require_once('CommentModel.php');
$model = new CommentModel("localhost", "krobbins", "abc123", "evalurls");
while ($row = $model->nextComment()) {
	echo "URL:  " . $row['comment_url']. ": " . $row['comment_body'] . "<br>";
}
?>

<a href = "index.php">Return to main page</a>
</section>
</body>
</html>