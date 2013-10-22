<html>
<head>
<meta charset="ISO-8859-1">
<title>Show all URL-NASH entries</title>
</head>
<body>
<h1>URL-NASH entries so far</h1>

<section>
<?php 
include 'validations.php';
require_once('./EvalUrlModel.php');
$newvals = validate_newurl($_POST);
print_r($newvals);
echo "<br>";

if (array_key_exists('error', $newvals)) {
	echo "Invalid input: <br>" . $newvals['error'];

} else {
	$model = new EvalUrlModel("localhost", "krobbins", "abc123", "evalurls");
	$vals = $model->create($newvals);
    if (array_key_exists('error', $vals)) {
    	echo $vals['error'];
	} else {
		echo $newvals['url_eval'] ." added to URL-NASH";
    }
}
?>
<p>
<a href = "index.php">Return to main page</a></p>
</section>
</body>
</html>