<?php 
require 'connect.inc.php';
?>
<form action="" method="POST">
	<input type="submit" name="submit" value="Sync">
	<?php
	if(isset($_POST['submit']))
	{
		require 'portal.inc.php';
		$result="SELECT * FROM `student`";
		$run=mysqli_query($con,$result);
		while($arr=mysqli_fetch_assoc($run))
		{
			$id=$arr['id'];
			$sem=$arr['semester'];
			$sec=$arr['section']; 
			$bran=$arr['branch'];
				$sub="SELECT * FROM `subject` WHERE branch='$bran' && semester='$sem'";
				$sub_run=mysqli_query($conn,$sub);
				while($arr1=mysqli_fetch_assoc($sub_run))
				{
					echo $arr['sub_name'];
				}
		}
	}
	?>
</form>