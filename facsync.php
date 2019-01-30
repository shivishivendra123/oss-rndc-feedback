<?php
include_once 'header.php';
$que = "select * from login";
$res = mysqli_query($conn,$que);
while($row = mysqli_fetch_assoc($res))
{
	$user_id = $row['userid'];
	$name = $row['name'];
	$branch = $row['branch'];

	$insert = "insert into faculty values('','$user_id','$name','$branch')";
	$insert_run = mysqli_query($con,$insert);
	
}
?>