<?php
include_once 'connect.inc.php';
$fac_id=$_GET['fac'];


$qry2="SELECT DISTINCT subject FROM theory_response WHERE faculty_id='$fac_id'";
$result2=mysqli_query($con, $qry2);

header('Content-Type: application/json');
$arr=[];
$i=0;
while ($fac=mysqli_fetch_assoc($result2))
{
    $arr[$i]['subject']=$fac['subject'];
    $i++;

}
print_r(json_encode($arr));



?>
