<?php
include_once 'header.php';
session_start();
if(!(isset($_SESSION['username']))){
  header('Location:index.php');
}
?>
<!-- <button onclick="goBack()">Go Back</button>

<script>
function goBack() {
    window.history.back();
}
</script> -->
<nav class="navbar navbar-dark bg-primary">
  <a class="navbar-brand" href=""><h3>Admin Panel</h3></a>
  <a href="logout_admin.php" class="btn btn-success"><i class="fa fa-sign-out" aria-hidden="true"></i>Logout</a>
</nav>
<br>
<br>
<div class="container">
      <div class="card">
  <h5 class="card-header">Select from the following options</h5>
  <div class="card-body">
    <h5 class="card-title"></h5>
    <a class="btn btn-primary" href="theory_1.php" role="button"> Departmentwise Theory Response</a>
    <br>
     <br>
     <a class="btn btn-primary" href="practical_1.php" role="button"> Departmentwise Practical Faculty Response</a>
     <br>

     <!-- <br>
     /**<a class="btn btn-primary" href="student_details.php" role="button">Student Details</a>**/
<br> -->
<br>
        <a class="btn btn-primary" href="practical_2.php" role="button"> Departmentwise Lab Assistant Response</a>
<br>
<br>
        <a class="btn btn-primary" href="fac_all.php" role="button"> All Faculty Response</a>
  </div>
</div>
<br>
  
</div>
