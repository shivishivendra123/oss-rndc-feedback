<?php
include_once 'header.php';
session_start();
if(isset($_SESSION['ses_name'])){
  header('Location:stunew.php');
}
?>
<nav class="navbar navbar-dark bg-primary">
  <a class="navbar-brand ml-auto" href="#"><h3>Student Feedback Portal</h3></a>
  <a class="link ml-auto" href= "login_admin.php"><button class="btn btn-success">Admin Login</button></a></nav>
</nav>
<br>
<br>
<br>
<br>
<div class="container">
<body>
  <div class="card">
  <div class="card-header">
    Student Login
  </div>
  <div class="card-body">
    <h5 class="card-title">Login</h5>
    <form method="post" action="stunew.php">
  <div class="form-group">
    <label>Enter your Roll number</label>
    <input type="text" class="form-control" id="rollno" name="rollno" placeholder="University Roll Number" required>
  </div>
  <button type="submit" class="btn btn-primary">Submit</button>
</form>
  </div>
</div>
      
  <!--  <form class="col s10 offset-s2" method="post" action="stunew.php">
        <div class="form-feed">
          <label for="rollno"><h3>Enter your Roll No.</h3></label>
          <input id="rollno" type="text" class="validate" name="rollno">

        </div>
         <br>
        <div class="form-feed">
          <button type="submit"><b>Submit</b></button>
        </div>
      </div>
      <br><br><br> -->
      <!-- -->
</div>
</body>
