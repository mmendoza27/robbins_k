
<html>
  <head><title>Cookies and sessions</title></head>
  <body>
  <h1>Some simple demonstrations of cookies and session</h1>
  
  <h3>Cookies</h3>
  This link goes to a page that increments a cookie variable
    <p>Click here for <a href="cookieExample.php">Give me a cookie</a></p>
    
  <h3>Sessions</h3>
  This page will show a login link if the user has not visited the login page.
  
  <?php 
 
  session_start();
  if(!isset($_SESSION['user'])) {
  ?>
      <a href="login.php">Login now</a>
  <?php 
  } else {
  ?>
      <a href="profiles.php">Show profiles</a>
  <?php      
  }
  ?>
  
  <h3>This section dumps the supers</h3>
  <?php 
   require_once("dumpSupers.php");
   dumpSupers("On index");
   ?>
  </body>
</html>