<!DOCTYPE html>
<html>
<head>
<meta charset="ISO-8859-1">
<title>Comment form for URL-NASH</title>
</head>
<body>
<h1>Comment on a URL for URL-NASH</h1>

<section>
<p> 
Make a comment on URL</p>

<form  name="create_comment"  method="post" action="createComment.php">
URL: <input type="text" name="comment_url" value="http://www.cs.utsa.edu"><br>
Comment: <br>
<textarea name="comment_body" rows="20" cols="80" ></textarea><br>
<button type="submit" value="Submit">Submit</button>
<button type="reset" value="Reset">Reset</button>
</form>

</section>
</body>
</html>