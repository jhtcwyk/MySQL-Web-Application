<?php

function authenticateSignUp($connection, $loginname, $useremail)
//function authenticateSignUp($connection, $username, $loginname, $useremail, $usercard, $password)
{
	if(!isset($loginname, $useremail))
    return false;

  $query1 = "SELECT * FROM user WHERE loginname = '{$loginname}'";
  $query2 = "SELECT * FROM user WHERE useremail = '{$useremail}'";
  
  $result1 = mysqli_query ($connection, $query1);
  $result2 = mysqli_query ($connection, $query2);

	 
  if (mysqli_num_rows($result1) > 0 || mysqli_num_rows($result2) > 0 )
    return false;
  else
    return true;
}
function getInput($array, $index, $maxlength, $connection)
{
  if (isset($array["{$index}"]))
  {
     $input = substr($array["{$index}"], 0, $maxlength);
     $input = mysqli_real_escape_string($connection, $input);
     return ($input);
  }
  return NULL;
}

function authenticateUser($connection, $loginname, $password)
{
  if (!isset($loginname) || !isset($password))
    return false;
  $query = "SELECT userid FROM user WHERE loginname = '{$loginname}' and password = '{$password}'";

  if (!$result = mysqli_query ($connection, $query))
     die("Error " . mysqli_errno() . " : " . mysqli_error());
	 
  if (mysqli_num_rows($result) != 1)
    return false;
  else
    return true;


}



// Connects to a session and checks that the user has
// authenticated and that the remote IP address matches
// the address used to create the session.
function sessionAuthenticate()
{
  // Check if the user hasn't logged in
  if (!isset($_SESSION["userid"]))
  {
    // The request does not identify a session
    $_SESSION["message"] = "no user name";

    header("Location: logout.php");
    exit;
  }

  // Check if the request is from a different IP address to previously
  if (!isset($_SESSION["loginIP"]) || 
     ($_SESSION["loginIP"] != $_SERVER["REMOTE_ADDR"]))
  {
    // The request did not originate from the machine
    // that was used to create the session.
    // THIS IS POSSIBLY A SESSION HIJACK ATTEMPT

    $_SESSION["message"] = "You are not authorized to access the URL 
                            {$_SERVER["REQUEST_URI"]} from the address 
                            {$_SERVER["REMOTE_ADDR"]}";

    header("Location: logout.php");
    exit;
  }
}

?>