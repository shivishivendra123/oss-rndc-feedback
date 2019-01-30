<?php
require 'connect.inc.php';
?>

<form method="POST" action="">
	<input type="submit" name="but" value="Sync">
</form>
<?php
if(isset($_POST['but']))
{
$result="SELECT * FROM `student`";
$result1=mysqli_query($con,$result);
{
	echo '
	<table>
	<tr>
		<th>id</th>
		<th>rollno</th>
		<th>name</th>
		<th>year</th>
		<th>department</th>
		<th>semester</th>
	</tr>

	';
	while($arr=mysqli_fetch_assoc($result1))
	{
		$id=$arr['id'];
		$rollno=$arr['rollno'];
$name=$arr['name'];
$year=$arr['year'];
$department=$arr['department'];
$semester=$arr['semester'];
$check_student = "SELECT * FROM sample1 WHERE rollno='$rollno' ";
$run_check=mysqli_query($con,$check_student);
if(mysqli_num_rows($run_check)==0)
		{
			$res="INSERT INTO `sample1`(`id`, `rollno`, `name`, `year`, `department`, `semester`) VALUES ('$id','$rollno','$name','$year','$department','$semester')";
		$run=mysqli_query($con,$res);
	}
	echo '<tr>';
		echo '<td>'.$arr['id'].'</td>';
		echo '<td>'.$arr['rollno'].'</td>';
		echo '<td>'.$arr['name'].'</td>';
		echo '<td>'.$arr['year'].'</td>';
		echo '<td>'.$arr['department'].'</td>';
		echo '<td>'.$arr['semester'].'</td>';
		echo '</tr>';
	}
	echo '</table>';
}	

}
?>