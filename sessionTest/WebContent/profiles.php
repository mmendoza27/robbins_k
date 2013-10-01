  <?php 
  session_start();
  if(!isset($_SESSION['user'])) {
     header("Location: login.php");
     exit();
   }
  ?>

<html>
  <head><title>Profiles</title></head>
  <body> Hello <?php echo $_SESSION['user'] ?>
  <h1></h1>
  

  
  <h3>You can see the profiles</h3>
  
  <p>Click here to return to home: <a href="index.php">Link</a></p>
  </body>
  </html>
  