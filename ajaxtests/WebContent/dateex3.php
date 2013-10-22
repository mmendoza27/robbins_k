<!DOCTYPE html>
<html>
<head>
</head>
<body>
<h1>Set date</h1>

<p>Click the button to execute the <em>displayDate()</em> function.</p>
<form action="dateex3.php">
<button id="myBtn">Try it</button>
</form>
<p id="demo">
<?php 
    echo date('l F j\, Y H:i:s e');
?>
</p>
</body>
</html>