<?php
include_once 'header.php';
require 'portal.inc.php';
?>
<form action="student11.php" method="POST">
	<input type="Submit" name="submit">
</form>
<?php
if(isset($_POST['submit']))
{
	$sql="SELECT * FROM student";
	$run=mysqli_query($conn,$sql);
	while($array=mysqli_fetch_assoc($run))
	{
		$year=$array['semester']/2;
		$Year=ceil($year);
		$st_id=$array['st_id'];
		$name=$array['name'];
		$branch=$array['branch'];
		$section=$array['section'];
	$query="INSERT INTO student2(`id`,`Roll_no`,`Name`,`Branch`,`Section`,`Year`) VALUES ('','$st_id','$name','$branch','$section','$Year')";
	$run_query=mysqli_query($con,$query);	
	}

}