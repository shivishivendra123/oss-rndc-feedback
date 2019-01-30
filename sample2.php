<?php 
require 'connect.inc.php';
require 'portal.inc.php';
?>
<form action="" method="POST">
	<input type="submit" name="submit" value="AS-HU"><span>To sync AS-HU Students</span><br><br>
	<input type="submit" name="submit" value="CE"><span>To sync CE Students</span><br><br>
	<input type="submit" name="submit" value="CSE"><span>To sync CSE Students</span><br><br>
	<input type="submit" name="submit" value="ECE"><span>To sync ECE Students</span><br><br>
	<input type="submit" name="submit" value="EI"><span>To sync EI Students</span><br><br>
	<input type="submit" name="submit" value="EN"><span>To sync EN Students</span><br><br>
	<input type="submit" name="submit" value="IT"><span>To sync IT Students</span><br><br>
	<input type="submit" name="submit" value="MBA"><span>To sync MBA Students</span><br><br>
	<input type="submit" name="submit" value="MCA"><span>To sync MCA Students</span><br><br>
	<input type="submit" name="submit" value="ME"><span>To sync ME Students</span><br><br>
	<input type="submit" name="submit" value="Sync"><span>To sync ALL Students</span><br><br>
	<?php
	if(isset($_POST['submit']))
	{
		
		$dept = $_POST['submit'];
		if($dept=='ALL')
			$result="SELECT * FROM `student` ORDER BY st_id ASC";
		else
			$result="SELECT * FROM `student` WHERE branch='$dept' ORDER BY st_id ASC";
		$run=mysqli_query($conn,$result);
		echo '
	 <table>
	 <tr>
	 <th>count</th>
 	<th>id</th>
	 	<th>sub_id</th>
	 	<th>fac_id</th>
	 	<th>category</th>
	 </tr>

	 ';
	 $i=1;
	 $qry = "SELECT * FROM student2 ORDER BY id DESC";
	 $run_qry = mysqli_query($con,$qry);
	 $row_qry = mysqli_fetch_assoc($run_qry);
	 if($row_qry!='')
	 	$i= $row_qry["id"];
		while($arr=mysqli_fetch_assoc($run))
		{
		
			$id=$i;

			$st_id = $arr['st_id'];
			$name=$arr['name'];
			$sem=$arr['semester'];
			//echo $year = $arr['year'];
			$sec=$arr['section']; 
			$bran=$arr['branch'];

			if($sem == 8 || $sem == 7)
				$year = 4;
			if($sem == 6 || $sem == 5)
				$year = 3;
			if($sem == 4 || $sem == 3)
				$year = 2;
			if($sem == 2 || $sem == 1)
				$year = 1;

			//Enter student details
			$check_student = "SELECT * FROM student2 WHERE Roll_no='$st_id' ";
			$run_check=mysqli_query($con,$check_student);
			if(mysqli_num_rows($run_check)==0)
			{
				$res="INSERT INTO `student2`(`id`, `Roll_no`, `Name`, `Branch`, `Section`, `Year`) VALUES ('$id','$st_id','$name','$bran','$sec','$year')";
				$run2=mysqli_query($con,$res);
			}
			else{
				$row_new = mysqli_fetch_assoc($run_check);
				$id=$row_new['id'];
			}

			//Loop To Get subjects in that branch and semester
			$sub="SELECT * FROM subject WHERE branch='$bran' && semester='$sem'";
			$sub_run=mysqli_query($conn,$sub);
			while($arr1=mysqli_fetch_assoc($sub_run))
			{
			    $sub_id  = $arr1['sub_id'];
				$subject = $arr1['sub_name'];
				$cat = $arr1['category'];
				if($cat=='T' ){
		        	$query="SELECT * FROM `assignrole` WHERE section='$sec' && sub_id='$sub_id'";
		     	}
		     	elseif($cat=='O')
		     	{
		     		$query="SELECT * FROM openelective WHERE st_id='$st_id' AND sub_id ='$sub_id' ";
		     	}

		        $query_run=mysqli_query($conn,$query);

		        //To enter details to final table
		        while($arr3=mysqli_fetch_assoc($query_run))
		        {
		        	$fac_id=$arr3['fac_id'];

		        	$get_fac = "SELECT * FROM faculty where faculty_id='$fac_id'";
		        	$run_fac = mysqli_query($con,$get_fac);
		        	$row_fac = mysqli_fetch_assoc($run_fac);
		        	$fac_id2 = $row_fac['id'];

		        	if($cat!='P')
		        	{
		        		$check_final = "SELECT * FROM final WHERE id='$id' AND subject='$sub_id' AND fac_id='$fac_id2' ";
		        		$run_check_final = mysqli_query($con,$check_final);
		        		if(mysqli_num_rows($run_check_final)==0){
			         		$final="INSERT INTO `final`(`id`,`subject`,`fac_id`,`category`,`fac_cat`,`subjectname`) VALUES ('$id','$sub_id','$fac_id2','$cat','F','$subject')"; 
			         		$final_run=mysqli_query($con,$final);
			         		//echo mysqli_error($con);
			         	}
		         	}
		        }  
		         	// else 
		         	// {
		         	// 	$check_final = "SELECT * FROM final WHERE id='$id' AND subject='$sub_id' AND fac_id='$fac_id2' ";
		        		// $run_check_final = mysqli_query($con,$check_final);
		        		// if(mysqli_num_rows($run_check_final)==0){
			         // 		//Query to add main faculty to table final
			         // 		$final="INSERT INTO `final`(`id`,`subject`,`fac_id`,`category`,`fac_cat`,`subjectname`) VALUES ('$id','$sub_id','$fac_id2','$cat','F','$subject')"; 
			         // 		$final_run=mysqli_query($con,$final);
			         // 	}
		         		
		         		

		         		//query to get side faculty and staff
		        $query2="SELECT * FROM assign_feedback_prac WHERE st_id='$st_id' AND sub_id ='$sub_id' ";
		        
		        	echo $query2;
		         		 $run_query = mysqli_query($conn,$query2);
		         		 echo mysqli_error($conn);
		         		
		         		//loop to add side faculty and staff to table final
         		while($row = mysqli_fetch_assoc($run_query))
         		{
         			echo $fac2_id = $row['staff_id'];
         			if($fac2_id[0] == 's')
         			{
         				$category = 'L';
         				$get_fac = "SELECT * FROM lab_assistant where assistant_id='$fac2_id'";
         			}
         			else{
         				$category = 'F';
         				$get_fac = "SELECT * FROM faculty where faculty_id='$fac2_id'";
     				}
    				$run_fac = mysqli_query($con,$get_fac);
    				$row_fac = mysqli_fetch_assoc($run_fac);
    				$fac_id2 = $row_fac['id'];

    				$check_final = "SELECT * FROM final WHERE id='$id' AND subject='$sub_id' AND fac_id='$fac_id2' ";
        			$run_check_final = mysqli_query($con,$check_final);
        			if(mysqli_num_rows($run_check_final)==0){
	         			$final1="INSERT INTO `final`(`id`,`subject`,`fac_id`,`category`,`fac_cat`,`subjectname`) VALUES ('$id','$sub_id','$fac_id2','$cat','$category','$subject')"; 
	         			$final_run1=mysqli_query($con,$final1);
	         			echo mysqli_error($con);
	         		}

         		}
		    }
		    $i++;
		         	
		}
			
			
	}
		echo "Enteries added Successfully";
		 echo '</table>';

	
	
	?>
</form>