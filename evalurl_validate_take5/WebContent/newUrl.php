<!DOCTYPE html>
<html>
<head>
<meta charset="ISO-8859-1">
<title>URL candidate entry form for URL-NASH</title>
</head>
<body>
<h1>Submit a new URL to URL-NASH</h1>

<section>
<p> 
Did you find a web site that is notable --- for great design, innovative features, unusual
approach or shameful use of web technology? Just fill in this form and get the URL-NASH community chew on it!</p>

<form  name="create_url"  method="post" action="createUrl.php">
URL: <input type="text" name="url_name" value="http://www.cs.utsa.edu"><br>
Category: <br>
<input type="radio" name="url_category" value="best" checked>Best in class<br>
<input type="radio" name="url_category" value="first">First look<br>
<input type="radio" name="url_category" value="dude">Hey dude look at this<br>
<input type="radio" name="url_category" value="shame">Wall of shame<br>
Description: <br>
<textarea name="url_description" rows="20" cols="80" ></textarea><br>
<button type="submit" value="Submit">Submit</button>
<button type="reset" value="Reset">Reset</button>
</form>

</section>
</body>
</html>