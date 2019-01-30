<?php
include_once 'header.php';
$que = "select * from assign_feedback_prac where id>=25211 ";
$res = mysqli_query($conn,$que);
while($row = mysqli_fetch_assoc($res))
{
	$id = $row['id'];
	$st_id = $row['st_id'];
	$sub_id = $row['sub_id'];
	$staff_id = $row['staff_id'];

	$insert = "insert into assignrole_fac_prac_d values('$id','$st_id','$sub_id','$staff_id')";
	$insert_run = mysqli_query($conn,$insert);
	
}
?>