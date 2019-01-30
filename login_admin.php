<?php
include_once 'header.php';
if(isset($_POST['login'])){
  $username=$_POST['username'];
  $password=md5($_POST['password']);

  $query="SELECT * FROM admin where username='$username' AND password ='$password'";
  $execute=mysqli_query($con, $query);

  if(mysqli_num_rows($execute)>0)
  {
    session_start();
    $_SESSION['username']='admin';
    echo $_SESSION['username'];
    header('Location:admin_home.php');
  }
}


?>
<body>
  <nav class="navbar navbar-dark bg-primary">
  <a class="navbar-brand mr-auto" href="index1.php"><h3>Student Feedback Portal</h3></a>
</nav><br>
<br><br>
  <div class="container">
<body>
  <div class="card">
  <div class="card-header">
    Admin Login
  </div>
  <div class="card-body ">
    <h5 class="card-title">Login</h5>
    <form method="post" action="login_admin.php">
  <div class="form-group">
    <label>Enter your Login ID</label>
    <input type="text" class="form-control" id="rollno" name="username" placeholder="University Roll Number" required>
  </div>
  <div class="form-group">
    <label>Enter your password</label>
    <input type="password" class="form-control" name="password" placeholder="Password" required>
  </div>
  <button type="submit" name="login" class="btn btn-primary">Submit</button>
</form>
  </div>
  </div>
</body>
