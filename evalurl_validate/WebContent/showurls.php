<html>
<head>
<meta charset="ISO-8859-1">
<title>URL-NASH entries</title>
</head>
<body>

<h1>URL-NASH entries so far</h1>

<section>
<?php 
$con = mysqli_connect("localhost", "krobbins", "abc123", "evalurls");
if (mysqli_connect_errno()) {
   echo "Couldn't connect to database evalurls: " . mysqli_connect_errno();
}

$result = mysqli_query($con, "SELECT * FROM urlentry");
while ($row = mysqli_fetch_array($result)) {
	echo "URL: " . $row["url_eval"] . "<br>";
}

mysqli_close($con);
?>

<a href = "index.html">Return to main page</a>
</section>
</body>
</html>