<?php 
  session_start();
?>

  <html>
  <head><title>Login page</title></head>
  <body>
  
  <h1>Login page</h1>
  
  <?php  
  if(isset($_SESSION['user'])) {
  ?>
    <p><?php echo $_SESSION['user'] ?>, You are already logged on --- please log off before
    trying again.</p>
    
   <?php 
   } else {
      $_SESSION['user'] = "Kay";
   }
   ?>


  
  <h3>Return to home page <a href="index.php">Link</a></h3>

  </body>
  </html>
    