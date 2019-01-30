<?php
require_once 'connect.inc.php';
var_dump($_POST);
if(isset($_POST['sub'])){
  // $fac_1_response = array();
  // $fac_2_response = array();
  $la_response = array();
  $lab_assistant_id=array();
  $lab = array();
  $fac = array();
  $lab_ass = $_POST['lab'];
  $lab_fac = $_POST['facultyid'];
  $lab_fac_real=str_replace("'", '"', $lab_fac);
  $lab_real=str_replace("'", '"', $lab_ass);
  print_r($lab_real);
  $lab = unserialize($lab_real);
  $fac = unserialize($lab_fac_real);
  print_r($lab);
  print_r($fac);
  $no = $_POST['num'];
  $noo =  $_POST['num_fac'];
  $i=1;
  echo '<br>'; 
  $m=$_POST['no'];
  
  // while($i<=5){
  //   $fac_1_response[] = $_POST['pq-'.$i.'-f-1'];
  //   $i++;
  // }
  // $i=1;
  // while($i<=5){
  //   $fac_2_response[] = $_POST['pq-'.$i.'-f-2'];
  //   $i++;
  // }
  for($u=1;$u<=$noo;$u++){
    for($t=1;$t<=5;$t++){
       $fac_response[$u][$t]= $_POST['pq-'.$t.'-f-'.$u];
    }
  }
  for($u=1;$u<=$no;$u++){
    for($t=1;$t<=5;$t++){
      $la_response[$u][$t]= $_POST['pq-'.$t.'-la-'.$u];
    }
  }
  // if($m>0){
  //   for($o=1;$o<$m;$o++){
  //     $i=6;
  //     while($i<=10){
  //     $la_response[$o][] = $_POST['pq'.$i.'-la'.$o];
  //     $i++;
  //     }
  //   }
  // }
  // else{
  //   while($i<=10){
  //     $la_response[] = $_POST['pq'.$i.'-la'];
  //     $i++;
  //     }

  // }
  $studentid = $_POST['studentid'];
  // $faculty_1_id = $_POST['facultyid1'];
  // $faculty_2_id = $_POST['facultyid2'];
  // if($m==0)
  //   $la_id = $_POST['la_id'];
  // else{
  //   $lab_assistant_id=explode("/",$_POST['lab_assistant_id']);

  // }
  $subject = $_POST['subject'];
  $year = $_POST['year'];
  $section = $_POST['section'];
  // $insert_faculty_1_response_sql = "insert into practical_faculty_response (`student_id`,`faculty_id`,`subject`,`year`,`section`,`q1`,`q2`,`q3`,`q4`,`q5`) values('$studentid','$faculty_1_id','$subject','$year','$section','$fac_1_response[0]','$fac_1_response[1]','$fac_1_response[2]','$fac_1_response[3]','$fac_1_response[4]')";
  // $insert_faculty_2_response_sql = "insert into practical_faculty_response (`student_id`,`faculty_id`,`subject`,`year`,`section`,`q1`,`q2`,`q3`,`q4`,`q5`) values('$studentid','$faculty_2_id','$subject','$year','$section','$fac_2_response[0]','$fac_2_response[1]','$fac_2_response[2]','$fac_2_response[3]','$fac_2_response[4]')";
  // if($m==0){
  // $insert_lab_ass_response = "insert into practical_lab_assistant_response (`student_id`,`la_id`,`subject`,`year`,`section`,`q1`,`q2`,`q3`,`q4`,`q5`) values('$studentid','$la_id','$subject','$year','$section','$la_response[0]','$la_response[1]','$la_response[2]','$la_response[3]','$la_response[4]')";
  for($o=1;$o<=$noo;$o++){
    $la = $fac[$o-1];
     $l1=$fac_response[$o][1];
    $l2=$fac_response[$o][2];
    $l3=$fac_response[$o][3];
     $l4=$fac_response[$o][4];
     $l5=$fac_response[$o][5];
  $insert_lab_fac_response = "insert into practical_faculty_response (`student_id`,`faculty_id`,`subject`,`year`,`section`,`q1`,`q2`,`q3`,`q4`,`q5`) values('$studentid','$la','$subject','$year','$section','$l1','$l2','$l3','$l4','$l5')";
 if(!($con->query($insert_lab_fac_response))){
  header('HTTP/1.1 500 Internal Server Error');
    header('Content-Type: application/json; charset=UTF-8');
    die(json_encode(array('message' => mysqli_error($con), 'code' => 500)));
 }
}
// else
// {
//   $con->query($insert_faculty_1_response_sql);
//   $con->query($insert_faculty_2_response_sql);
  for($o=1;$o<=$no;$o++){
    $la = $lab[$o-1];
    $l1=$la_response[$o][1];
    $l2=$la_response[$o][2];
    $l3=$la_response[$o][3];
    $l4=$la_response[$o][4];
    $l5=$la_response[$o][5];
  $insert_lab_ass_response = "insert into practical_lab_assistant_response (`student_id`,`la_id`,`subject`,`year`,`section`,`q1`,`q2`,`q3`,`q4`,`q5`) values('$studentid','$la','$subject','$year','$section','$l1','$l2','$l3','$l4','$l5')";
 if(!($con->query($insert_lab_ass_response))){
  header('HTTP/1.1 500 Internal Server Error');
    header('Content-Type: application/json; charset=UTF-8');
    die(json_encode(array('message' => mysqli_error($con), 'code' => 500)));
 }
 header('Location:stunew.php');
}

}
 ?>
