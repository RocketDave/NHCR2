<?php
/* Check to see if person accessing this page is logged in.    */
require_once("includes/Project.php");
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" href="css/bootstrap-theme.min.css">
    <!-- Custom styles for this template -->
    <link href="css/signin.css" rel="stylesheet">
    <title>NHCR2 login</title>
  </head>
  <body>
    <div class="container">
     <form class="form-signin" autocomplete="off" action="authenticate.php" method="post">
        <h2 class="form-signin-heading">NHCR2 PRODUCTION SITE</h2>
        <?php   if(isset($_SESSION['ERRORS']))    {    
             echo '<div class="text-info text-center bg-info h4">'.$_SESSION['ERRORS'].'</div>'; 
             $_SESSION = session_destroy();
        } ?>
        <label for="user_id" class="sr-only">Username</label>
        <input type="text" name="user_id" id="user_id" class="form-control" placeholder="Username" required autofocus>
        <label for="password" class="sr-only">Password</label>
        <input type="password" name="password" id="password" class="form-control" placeholder="Password" required>
        <button class="btn btn-lg btn-primary btn-block" type="submit">Sign in</button>
      </form>
   </div> <!-- /container -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
    <script type="text/javascript" src="./js/bootstrap.min.js"></script>
  </body>
</html>