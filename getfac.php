<?php
include_once 'connect.inc.php';
$dpt=$_GET['dpt'];
$qry2="SELECT * FROM faculty WHERE department='$dpt'";
$result2=mysqli_query($con, $qry2);

        header('Content-Type: application/json');
        $arr=[];
        $i=0;
        while ($fac=mysqli_fetch_assoc($result2))
        {
            $arr[$i]['id']=$fac['id'];
            $arr[$i]['name']=$fac['name'];
            $i++;

        }
        print_r(json_encode($arr));



?>
