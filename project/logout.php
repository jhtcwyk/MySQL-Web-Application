<?php
  session_start();

  $message = "";

  // An authenticated user has logged out -- be polite and thank them for
  // using your application.
  if (isset($_SESSION["loginname"]))
    $message .= "Thanks {$_SESSION["loginname"]} for
                 using the Application.";

  // Some script, possibly the setup script, may have set up a 
  // logout message
  if (isset($_SESSION["message"]))
  {
    $message .= $_SESSION["message"];
  }

  // Destroy the session.
  session_unset(); 
  session_destroy();
  //echo $_GET["label"];

?>
<!DOCTYPE html>
<html>
<head>
   <meta charset="utf-8"> 
   <title>logout</title>
   <!-- Latest compiled and minified CSS -->
   <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

   <!-- Optional theme -->
   <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">

   <!-- Latest compiled and minified JavaScript -->
   <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
</head>
<body>
<div class="jumbotron" style="font-size:110%;">
<?php
	echo $message;
	echo '<br></br>';

	echo '<a href="login.html" class="btn btn-info btn-lg" role="button">Sign In Now</a>';

?>
</div>
</body>
</html>