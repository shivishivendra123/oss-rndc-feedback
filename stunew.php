<head>
  <style>
    .navbar{
      background-color: #64B8E9;
    }
  </style>
</head>
<?php
error_reporting(0);
include_once 'header.php';
date_default_timezone_set("Asia/Kolkata");
$date = date("d-m-Y");
?>
<nav class="navbar navbar-expand-lg navbar-dark bg-primary">
  <a class="navbar-brand" href="#"><h2>Student Feedback Portal</h2></a>
  
<a class="link ml-auto" href= "logout.php"><button class="btn btn-danger">Logout</button></a></nav>

<?php
session_start();
if(!isset($_SESSION['ses_name']) && isset($_POST['rollno'])){
	$_SESSION['ses_rollno']=$_POST['rollno'];
	$rollno = $_POST['rollno'];
}
else if(isset($_SESSION['ses_name']) && isset($_SESSION['ses_rollno'])){
	$rollno = $_SESSION['ses_rollno'];
}
$student = "SELECT * FROM student2 WHERE Roll_no='$rollno'";
$result=mysqli_query($con,$student);
if(!$result)
{
 echo mysqli_error($con);
 die();
}

if(mysqli_num_rows($result)<1 )
{
  die("<script type='text/javascript'>alert('Error');window.location='logout.php'</script>");
  // echo "<script type='text/javascript'>alert('Error');</script>";
  // header('location: index1.php');
}
$row=mysqli_fetch_assoc($result);
	if(!isset($_SESSION['ses_name'])){
			$_SESSION['ses_name']=$row['Name'];
	}
$branch = strtoupper(substr($row['Section'],0,strlen($row['Section'])-1));
$id = $row['id'];
// echo $id;
$select = "SELECT * FROM final WHERE id='$id' AND category='T'";
$selectQuery = mysqli_query($con,$select);
$t=1;
$subjects=array();
$facultys=array();
// $subname=array();
$names = array();
$facdep = array();
while($subject = mysqli_fetch_assoc($selectQuery))
{
  array_push($subjects,$subject['subject']);
  $idd=$subject['fac_id'];
  array_push($facultys,$subject['fac_id']);
  $facname = "select * from faculty where id = '$idd'";
  $query = mysqli_query($con,$facname);

  $name = mysqli_fetch_assoc($query);
  array_push($facdep,$name['department']);
  array_push($names,$name['name']);
  // array_push($subname,$subject['subjectname']);
}
// print_r($names);
// print_r($facdep);
// print_r($subname);
// print_r($subjects);
// print_r($facultys);
$sub=array_unique($subjects);
$nosub=sizeof($sub);
echo'<table class="table table-hover">
  <thead class="thead">
    <tr>
      <th scope="col">Name</th>
      <th scope="col">Roll no</th>
      <th scope="col">Section</th>
      <th scope="col">Year</th>
    </tr>
  </thead>
  <tbody>
    <tr>
      <td>';
      echo ucwords($row["Name"]);
      echo'</td>';
      echo '<td>';
      echo $row["Roll_no"];
      echo '</td>';
      echo '<td>';
      echo strtoupper($row["Section"]);
      echo '</td>';
      echo '<td>';
      echo $row["Year"];
      echo '</td>';
echo'</table>';
echo '<br>';
// echo '<h3 style=" border:1px solid black; margin-left:33em; margin-right:35em; background-color:#dddddd; padding-top:2px; padding-bottom:2px;">....THEORY....</h3>';
echo'<h1><span class="badge badge-secondary">THEORY</span></h1>';
$i=0;
$no_of_theory=0;
$no_of_practical=0;
$subject=array();
$subject['name'] = array();
$subject['disabled'] = array();
$faculty=array();
$practical_sub=array();
$practical_sub['name'] = array();
$practical_sub['disabled'] = array();
$practical_fac_1=array();
$practical_fac_2=array();
$studentid = $id;
$facname=array();

while($i<=$nosub)
{
if($facultys[$i]!=null){
$theory=$sub[$i];
$check_response = "SELECT * FROM theory_response WHERE subject = '$theory' AND student_id = '$studentid'";
$cr=mysqli_query($con,$check_response);
			if(mysqli_num_rows($cr)>0){
				$i++;
             array_push($subject['name'],$theory);
             array_push($subject['disabled'],true);
             $no_of_theory++;
             continue;
           }
           $fac_sql = "select * from faculty where faculty_id = '$facultys[$i]'"; //get faculty details
					 if(!($fa=mysqli_query($con,$fac_sql))){
						 echo mysqli_error($con);
						 die();
					 }
		$fac  = mysqli_fetch_assoc($fa);
			$no_of_theory++;
            array_push($subject['name'],$theory);
            array_push($subject['disabled'],false);
			array_push($faculty,$fac);
			array_push($facname,$fac['name']);
}
$i++;
}
echo '<br>';




// print_r($facname);
// print_r($facdep);
$stname=$row['Name'];
$j=0;
// echo $row["Roll_no"];
// echo $studentid;
	foreach ($subject['name'] as $key => $value) {
    if(!$subject['disabled'][$j]){
      
    	echo '
      <div style="margin-left:44em; text-color:green;">
			<form action="new.php" method="POST">
       <div class="form-group">
			<input type="hidden" name="nam" value="';
			echo $stname;
			echo '">
			<input type="hidden" name="id" value="';
			echo $studentid;
			echo '">
			<input type="hidden" name="s" value="';
			echo $value;
			echo '">
			<input type="hidden" name="fac" value="';
			echo $facultys[$j];
			echo '">
			<input type="hidden" name="facnam" value="';
			echo $names[$j];
			echo '">
			<input type="hidden" name="dep" value="';
			echo $facdep[$j];
			echo '">
			<input type="hidden" name="branch" value="';
			echo $row['Branch'];
			echo '">
			<input type="hidden" name="year" value="';
			echo $row['Year'];
			echo '">
			<input type="hidden" name="section" value="';
			echo $row['Section'];
			echo '">
			<input type="hidden" name="roll" value="';
			echo $row["Roll_no"];
			echo '">
      </div>
      <button type="submit" name="nomodel" class ="btn btn-success">';
       echo $value;
       echo '</button>';
			echo '
			</form>
			</div>
    	';
      
    }

    else
    {
			echo '<div  style="margin-left:44em";>';
    	echo '<div style="margin-left:-2.5em; color:white;"><font size="4"></font></div>';
    	echo'
      <button type="button" class="btn btn-outline-success">';
      echo $value;
      echo'</button>';
     	echo '</div>
      <br>
    	';
    
    }
		$j++;
    }

echo '

	<br>';
   // echo '<h3 style=" border:1px solid black; margin-left:33em; margin-right:35em; background-color:#dddddd; padding-top:2px; padding-bottom:2px;">....PRACTICAL....</h3>';
   echo '<br>';
   echo'<h1><span class="badge badge-secondary">PRACTICAL</span></h1>';

   $psf=array();
   $pf=array();
   // $selectp = "SELECT * FROM final WHERE id='$id' AND category='P'";
   // $prt="SELECT DISTINCT(subject) FROM final WHERE id='$id' AND category='P'";
   // $prt_run=mysqli_query($con,$prt);
   // $run=array();
   // while($arr=mysqli_fetch_assoc($prt_run))
   // {
   //   array_push($run,$arr['subject']);
   // }
   // $selectpque= mysqli_query($con,$selectp);
   // while($pr=mysqli_fetch_assoc($selectpque))
   // {
   //   array_push($psf,$pr['subject']);
   //   array_push($pf,$pr['fac_id']);
   // }
   // $f=array_unique($run);
   // $lfa=array();
   // print_r($pf);
   // print_r($f);
   $selectp = "SELECT * FROM final WHERE id='$id' AND category='P'";
   $prt="SELECT DISTINCT(subject) FROM final WHERE id='$id' AND category='P'";
   $prt_run=mysqli_query($con,$prt);
   $run=array();
   while($arr=mysqli_fetch_assoc($prt_run))
   {
     array_push($run,$arr['subject']);
   }
   $selectpque= mysqli_query($con,$selectp);
   while($pr=mysqli_fetch_assoc($selectpque))
   {
     array_push($psf,$pr['subject']);
     array_push($pf,$pr['fac_id']);
   }
   $f=array_unique($run);
   $lfa=array();
   // print_r($pf);


    $k=0;

    while($k<=3){
              $code=$f[$k];
          if($code!=null){ //if lab not null
            $check_response = "select * from practical_faculty_response where student_id = '$studentid' and subject = '$code'";
             if(!($cr=mysqli_query($con,$check_response))){
              echo mysqli_error($con);
               die();
             }
             if(mysqli_num_rows($cr)>0){
              $k++;
              array_push($practical_sub['name'],$code);
              array_push($practical_sub['disabled'],true);
              // $no_of_practical++;
               continue;
            }
            else{
              $k++;
              array_push($practical_sub['name'],$code);
              array_push($practical_sub['disabled'],false);
              // $no_of_practical++;
               continue;
            }

  }
  else
    $k++;
}
// echo $i;
$j=0;
// echo $studentid;
// echo $row["Roll_no"];
// var_dump($practical_sub['name']);
foreach ($practical_sub['name'] as $key => $value) {
  if(!$practical_sub['disabled'][$j]){
	echo '<div class style="margin-left:42em; color:white;"><font size="5"></font></div>';

	echo '
  <div style="margin-left:44em; text-color:green;">
	<form action="prac_new.php" method="POST">
  <input type="hidden" name="stud" value="';
			echo $studentid;
			echo '">';
			echo '<input type="hidden" name="prac_sub" value="';
			echo $value;
			echo '">';
			echo '<input type="hidden" name="roll" value="';
			echo $row["Roll_no"];
			echo '">';
			echo '<input type="hidden" name="year" value="';
			echo $row['Year'];;
			echo '">';
			echo '<input type="hidden" name="section" value="';
			echo $row['Section'];
			echo '">';
  			echo '<button type="submit" name="nomodelprac" class ="btn btn-success">';
			 echo $value;
       echo '</button>';

       echo '</form>
				</div>';  
  }else{
   	echo '<div  style="margin-left:44em";>';
  echo '<div style="margin-left:-2.5em; color:white;"><font size="4"></font></div>';
  	echo '<button type="button" class="btn btn-outline-success">';
    echo $value;
    echo'</button>';
			echo '<br>';
			echo '<br></div>';

  }
$j++;
}

?>
