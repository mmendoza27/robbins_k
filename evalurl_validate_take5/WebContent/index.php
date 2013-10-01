<!DOCTYPE html>
<html>
<head>
<meta charset="ISO-8859-1">
<title>URL-NASH</title>
</head>
<body>
<h1>URL-NASH  -- where web connoisseurs go to feast!</h1>

<section> 
<p>See all the sites:  <a href="showUrls.php">Show</a></p>
</section>

<section>
<p>Enter a new site: <a href="newUrl.php">Link</a></p>
</section>

<section>
<p>Enter a new comment: <a href="newComment.php">Link</a></p>
</section>

<section>
Search for a URL on URL-NASH:
<form  name="find_url"  method="get" action="findUrl.php">
<input type="hidden" name="url_controller" value="find" />
URL: <input type="text" name="url_name" value="http://www.cs.utsa.edu"><br>
<button type="submit" value="Submit">Submit</button>
</form>
</section>

</body>
</html>