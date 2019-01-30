<?php
$username = 'root';
$password = 'root';
$host = '127.0.0.1';
$database = 'portal';
$con = mysqli_connect($host,$username,$password,$database);
// Check connection
if (mysqli_connect_errno())
  {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  }
?>
