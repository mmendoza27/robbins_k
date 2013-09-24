<html>
<head>
<meta charset="ISO-8859-1">
<title>Show all URL-NASH entries</title>
</head>
<body>
<h1>URL-NASH entries so far</h1>

<section>
<?php 
extract($_POST);
print "URL: $url_eval<br>";
print "Category: $url_category<br>";
print "Description: $url_description<br>";

$error = "";
$url_eval = trim(filter_var($url_eval, FILTER_SANITIZE_URL));
if (!filter_var($url_eval, FILTER_VALIDATE_URL)) {
	$error .= "Invalid URL ";
}


if (strcmp($error, "") != 0) {
	echo "Error: " .$error . "<br>";
} else {

$con = mysqli_connect("localhost", "krobbins", "abc123", "evalurls");
if (mysqli_connect_errno()) {
   echo "Couldn't connect to database evalurls: " . mysqli_connect_errno();
}

$sql =  "INSERT INTO urlentry (url_eval, url_description, url_category)
VALUES ('$url_eval', '$url_description', '$url_category')";

if (!mysqli_query($con, $sql)) {
   die('Error: ' . mysqli_error($con));
}
echo $url_eval ." added to URL-NASH";
mysqli_close($con);
}
?>
<p>
<a href = "index.html">Return to main page</a></p>
</section>
</body>
</html>