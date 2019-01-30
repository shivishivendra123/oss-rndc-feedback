<?php
session_start();
if(isset($_SESSION['ses_name']) || isset($_SESSION['username'])){
  session_destroy();
  header('Location:login_admin.php');
}
 ?>
