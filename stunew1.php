<?php
include_once 'header.php';
date_default_timezone_set("Asia/Kolkata");
$date = date("d-m-Y");
?>
<h1>Student Feedback Portal</h1>
<a href= "logout.php">Logout</a>
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
if(!mysqli_num_rows($result))
{
header('Location:index.php?login=false');
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
while($subject = mysqli_fetch_assoc($selectQuery))
{
  array_push($subjects,$subject['subject']);
  array_push($facultys,$subject['fac_id']);
  // array_push($subname,$subject['subjectname']);
}
// print_r($subname);
// print_r($subjects);
// print_r($facultys);
$sub=array_unique($subjects);
$nosub=sizeof($sub);
echo '
<table>
<tr>
<th>Name</th>
<th>Roll No.</th>
<th>Section</th>
<th>Year</th>
</tr>
<tr>
<td>'.ucwords($row["Name"]).'</td>
<td>'.$row["Roll_no"].'</td>
<td>'.strtoupper($row["Section"]).'</td>
<td>'.$row["Year"].'</td>
</trim(str)>
</table>';
echo "<center>--------------------------------------THEORY--------------------------------------------</center>";
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
$facdep=array();

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
			array_push($facdep,$fac['department']);
}
$i++;
}
echo '<br>';
echo '<br>';

// print_r($facname);
// print_r($facdep);
$stname=$row['Name'];
$j=0;
// echo $studentid;
	foreach ($subject['name'] as $key => $value) {
    if(!$subject['disabled'][$j]){
    	echo "Fill the entries";
    	echo '<form action="new.php" method="POST">
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
			echo $facname[$j];
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
			<input type="submit" name="nomodel" value="';
			echo $value;
			echo '">

			</form> 	
    	';
    }
    else
    {
    	echo "****Already Filled****";
    	echo '<form action="new.php" method="POST">
			<input type="hidden" name="nam" value="';
			echo $stname;
			echo '">
			<input type="hidden" name="sub" value="';
			echo $value;
			echo '">
			<input type="submit" disabled name="nomodel" value="';
			echo $value;
			echo ' ">
			</form> 	
    	';
    }
		$j++;
    }


   echo "<center>--------------------------------------PRACTICAL--------------------------------------------</center>";
   echo '<br>';
   echo '<br>';
   echo '<br>';
   $psf=array();
   $pf=array();
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
   // print_r($f);
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
              // continue;
            }
  }
}
// echo $i;
$j=0;
foreach ($practical_sub['name'] as $key => $value) {
  if(!$practical_sub['disabled'][$j]){
	echo "Fill the entries"; 
  	echo '<input type="submit" name="nomodel" value="';
			echo $value;
			echo '">';
			echo '<br>';
    
  }else{
  	echo "Already Filled";
  	echo '<br>';
  	echo '<input type="submit" name="nomodel" value="';
			echo $value;
			echo '">';
			echo '<br>';
			echo '<br>';
    
  }
$j++;
}
?>
