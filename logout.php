<?php
session_start();
if(isset($_SESSION['ses_name']) || isset($_SESSION['username'])){
  session_destroy();
  header('Location:index1.php');
}else{
	header('Location:index1.php');
}
?>
