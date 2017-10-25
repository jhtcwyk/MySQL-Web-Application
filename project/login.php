<?php

require 'authentication.inc';

if (!$connection = $con = mysqli_connect("localhost","root","","project_demo"))
  die("Cannot connect");

// Clean the data collected in the <form>
$loginname = getInput($_POST, "loginname", 40, $connection);
$password = getInput($_POST, "password", 40, $connection);


session_start();

if (authenticateUser($connection, $loginname, $password))
{
  $query = "SELECT userid FROM user WHERE loginname = '{$loginname}' and password = '{$password}'";
  $result = mysqli_query ($connection, $query);
  $row=mysqli_fetch_assoc($result);
  $userid = $row["userid"];
  // Register the loginUsername
  $_SESSION["userid"] = $userid;
  $_SESSION["loginname"] = $loginname;

  // Register the IP address that started this session
  $_SESSION["loginIP"] = $_SERVER["REMOTE_ADDR"];

  // Relocate back to the first page of the application
  header("Location: loginpage.php");
  mysqli_close($con);
  exit;
}
else
{
  // The authentication failed: setup a logout message
  $_SESSION["message"] = 
    "Could not connect to the application as '{$loginname}'";

  // Relocate to the logout page
  header("Location: logout.php");
  mysqli_close($con);
  exit;
}

?>