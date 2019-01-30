<?php 
require 'connect.inc.php';
require 'portal.inc.php';
?>
<form action="" method="POST">
	<input type="submit" name="submit" value="Sync">
	<?php
	if(isset($_POST['submit']))
	{
		$result="SELECT * FROM `student`";
		$run=mysqli_query($conn,$result);
		echo '
	 <table>
	 <tr>
	 <th>count</th>
	 	<th>sub_id</th>
	 	<th>fac_id</th>
	 	<th>category</th>
	 </tr>

	 ';
	 $i=1;
		while($arr=mysqli_fetch_assoc($run))
		{
		
			$id=$arr['st_id'];
			$name=$arr['name'];
			$sem=$arr['semester'];
			$sec=$arr['section']; 
			$bran=$arr['branch'];
				$sub="SELECT * FROM subject WHERE branch='$bran' && semester='$sem'";
				$sub_run=mysqli_query($conn,$sub);
				while($arr1=mysqli_fetch_assoc($sub_run))
				{
				    $sub_id=$arr1['sub_id'];
					$subject=$arr1['sub_name'];
					$cat=$arr1['category'];
			         $query="SELECT * FROM `assignrole` WHERE section='$sec' && sub_id='$sub_id'";
			         $query_run=mysqli_query($conn,$query);
			         while($arr3=mysqli_fetch_assoc($query_run))
			         {
			         	$fac_id=$arr3['fac_id'];
			         	 $final="INSERT INTO `final`(`id`,`subject`,`fac_id`,`category`) VALUES ('$i','$sub_id','$fac_id','$cat')"; 
			         	 $final_run=mysqli_query($con,$final);  
			         	echo '<tr>';
			         	echo '<td>'.$i.'</td>';
		// echo '<td>'.$arr['st_id'].'</td>';
		echo '<td>'.$arr1['sub_id'].'</td>';
		echo '<td>'.$arr3['fac_id'].'</td>';
		echo '<td>'.$arr1['category'].'</td>';
		echo '</tr>';
			         }
				}
				$i++;
		}
		 echo '</table>';

	}
	?>
</form>