<?php
include_once 'connect.inc.php';
$fac_id=$_GET['fac'];
$sub=$_GET['sub'];


$qry2="SELECT DISTINCT section FROM theory_response WHERE faculty_id='$fac_id' AND subject='$sub'";
$result2=mysqli_query($con, $qry2);

header('Content-Type: application/json');
$arr=[];
$i=0;
while ($fac=mysqli_fetch_assoc($result2))
{
    $arr[$i]['section']=$fac['section'];
    $i++;

}
print_r(json_encode($arr));



?>
