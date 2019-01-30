<?php
include_once 'header.php';
session_start();
if(isset($_SESSION['ses_name'])){
  header('Location:student.php');
}
?>
<body>

    <nav class="teal lighten-3">
      <div class="nav-wrapper">
        <a href="#" class="brand-logo center">Student Feedback Portal</a>
        <ul id="nav-mobile" class="left ">
          <li class="tab"><a href="login_admin.php"><b>Login Admin</b></a></li>
        </ul>
      </div>
      
    </nav>
<div class="row">
  <div class="col s12 m12"><br><br><br><br><br><br></div>
<div class="col s6 m6 offset-s3">
  <div class="card grey lighten-4">
    <div class="card-content">
    <div class="row">
    <form class="col s10 offset-s2" method="post" action="student.php">
      <div class="row">
        <div class="input-field col s12 pull-s1">
          <input id="rollno" type="text" class="validate" name="rollno">
          <label for="rollno">Enter your Roll No.</label>
        </div>
        <div class="input-field col s6 push-s2">
          <button type="submit" class="waves-effect waves-light btn" id="submit">Submit</button>
        </div>
      </div>
      <?php
      if(isset($_GET['login']) && $_GET['login']==false){
      echo '<div class="col s12 push-s2">
      <p style="color:red;">
        Roll No. does not exsist
      </p>
      </div>';
    }?>
  </form>
  </div>
  </div>
  </div>
  </div>
  </div>
</body>
