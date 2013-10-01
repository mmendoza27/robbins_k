<html>
  <head><title>Login page</title></head>
  <body>
  <h1>Has the login</h1>
  
  <h3>Login</h3>

  
  <?php 
  session_start();
  
  if(!isset($_SESSION['user'])) {
      $_SESSION['user'] = "Kay";
  }
  ?>
  
  <h3>Return to home page <a href="index.php">Link</a></h3>

  </body>
  </html>
    