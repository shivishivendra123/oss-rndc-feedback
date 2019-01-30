<?php
include_once 'header.php';
include_once 'portal.inc.php';
date_default_timezone_set("Asia/Kolkata");
$date = date("d-m-Y");
?>



<?php
echo '<div class="container">';
error_reporting(0);
 if(isset($_POST['nomodelprac'])){
 	$studentid = $_POST['stud'];
 	$sub= $_POST['prac_sub'];
 	$year = $_POST['year'];
 	$section = $_POST['section'];
 	// echo $studentid;
 	// echo $sub;
 $psf=array();
 $pf=array();
 $lab_ass=array();
 $labassname = array();
 // $test = array(2,5,6,7,l);
	$selectp = "SELECT * FROM final WHERE id='$studentid' AND category='P' AND fac_cat='F' AND subject='$sub'";
   	$prt="SELECT DISTINCT(subject) FROM final WHERE id='$id' AND category='P' AND fac_cat='F' AND subject='$sub'";
   	$labassist="SELECT * FROM final WHERE id = '$studentid' AND category='P' AND fac_cat = 'L' AND subject = '$sub'";
   	$lab_run = mysqli_query($con,$labassist);
   	while($lab=mysqli_fetch_assoc($lab_run))
   	{
   		array_push($lab_ass,$lab['fac_id']);
   	}


   	$string=serialize($lab_ass);
   	$test = serialize($test);
   	// echo $string;
   	 $gg = sizeof($lab_ass);
   	for($r=0;$r<$gg;$r++){
   		$name = "select * from lab_assistant where id = '$lab_ass[$r]'";
   		$run = mysqli_query($con,$name);
   		$namearr = mysqli_fetch_assoc($run);
   		array_push($labassname,$namearr['name']);
   	}
   	$ty = 0;
   	$pfname = array();
   	// print_r($labassname);
   	$prt_run=mysqli_query($con,$prt);
   	$run=array();
   	while($arr=mysqli_fetch_assoc($prt_run))
   	{
     array_push($run,$arr['subject']);
   	}
   	$selectpque= mysqli_query($con,$selectp);
   	while($pr=mysqli_fetch_assoc($selectpque))
   	{
     array_push($psf,$pr['subject']);
     array_push($pf,$pr['fac_id']);

   	}


   	$f=array_unique($run);
   	$lfa=array();
   	$g  = sizeof($pf);
   	for($ty=0;$ty<$g;$ty++){
   		$insert = "select * from faculty where id='$pf[$ty]'";
   		$run = mysqli_query($con,$insert);
   		while($rt = mysqli_fetch_assoc($run))
   		{
   			array_push($pfname,$rt['name']);
   		}
   	}
   	// print_r($pfname);
   	// for($qw=0;$qw<$g;$qw++){
   	// 	$r = $qw+1;
   	// 	$fac.$r = $pf[$qw];
   	// 	$yu = $fac.$r;
   	// 	$yu;
   	// 		echo '<div style="margin-left:50em;margin-top:-1em;"> <select name="pq-'.$qid.'-f-1" required>
    //   <option value="" disabled selected>Choose your option</option>
    //   <option value="1">1</option>
    //   <option value="2">2</option>
    //   <option value="3">3</option>
    //   <option value="4">4</option>
    //   <option value="5">5</option>
    // </select>';
    // echo '&nbsp';
    // echo '&nbsp';
    // echo '&nbsp';
   	// 	// $facname= "select * from faculty where id='$yu'";
   	// }
   // 	if($g>1){
   // 	$fac1 = $pf[0];
   // 	$fac2 = $pf[1];
   // 	$facname= "select * from faculty where id='$fac1'";
   // 	$run = mysqli_query($con,$facname);
   // 	while($arrr=mysqli_fetch_assoc($run))
   // 	{
   // 		$facname1=$arrr['name'];
   // 	}
   // 	$facname= "select * from faculty where id='$fac2'";
   // 	$run = mysqli_query($con,$facname);
   // 	while($arrr= mysqli_fetch_assoc($run))
   // 	{
   // 		$facname2=$arrr['name'];
   // 	}
   // }
   // else{
   // 	$fac1=$pf[0];
   // 	$facname= "select * from faculty where id='$fac1'";
   // 	$run = mysqli_query($con,$facname);
   // 	while($arrr=mysqli_fetch_assoc($run))
   // 	{
   // 		$facname1=$arrr['name'];
   // 	}
   // }

   	// print_r($lab_ass);
   	   	$string1=serialize($pf);
   	$test = serialize($test);
$ques = "select * from practical_questions where part='a'";//Fetch Part A Questions
          if(!($qu=mysqli_query($con,$ques))){
            echo mysqli_error($con);
            die();
          }
          $ques2 = "select * from practical_questions where part='b'";//Fetch Part B Questions
          if(!($qu2=mysqli_query($con,$ques2))){
            echo mysqli_error($con);
            die();
          }

          echo '<br>';
          echo '<br>';
       echo'<h1><span class="badge badge-secondary">PRACTICAL FACULTY</span></h1>';
            // echo'<center style="margin-left:19em; font-size:20px; font-weight:bold;">'.$facname1.'&nbsp'.'&nbsp'.'&nbsp'.'&nbsp'.$facname2.'</center>';


            echo'

            <form action="practical_response.php" method="POST">';
            echo '<input type="hidden" name="facultyid" value="'.str_replace('"', "'", $string1).'">
    				<input type="hidden" name="subject" value="'.$sub.'">
    				<input type="hidden" name="year" value="'.$year.'">
    				<input type="hidden" name="section" value="'.$section.'">
    				<input type="hidden" name="studentid" value="'.$studentid.'">
    				<input type="hidden" name="num" value="'.$gg.'">
    				<input type="hidden" name="num_fac" value="'.$g.'">
    				<input type="hidden" name="lab" value="'.str_replace('"', "'", $string).'">';
    				$tyu = 0;
    				echo '<div class="row">';
    				echo '<div class="col">';
 		echo '</div>';
    				for($tyu=0;$tyu<$g;$tyu++){
    						echo '<div class="col-2">';
    						echo '<b>';
    						echo $pfname[$tyu];
 							echo '</b>';
 		
 			echo '</div>';					
    				}
    		echo '</div>';
    				
 while($disp_ques  = mysqli_fetch_assoc($qu)){
 	echo '<div class="row">';
 		echo '<div class="col">';
   $disp_question = $disp_ques['question'];
   $qid = $disp_ques['id'];
   
     
            	 echo $qid;
            	 echo '->';
            	 echo '&nbsp';
            	 echo $disp_question;
    
            	 echo '</div>';

            	 for($qw=0;$qw<$g;$qw++){
   		$r = $qw+1;
   		// $fac.$r = $pf[$qw];
   		// $yu = $fac.$r;
   		
   		echo '<div class="col-2">';
   			echo  '<select class="form-control" name="pq-'.$qid.'-f-'.$r.'" required>
      <option value="" disabled selected>Select</option>
      <option value="1">1</option>
      <option value="2">2</option>
      <option value="3">3</option>
      <option value="4">4</option>
      <option value="5">5</option>
    </select>';
    echo '&nbsp';
    echo '&nbsp';
    echo '&nbsp';
    echo '</div>';
   		// $facname= "select * from faculty where id='$yu'";
   	}

    //         	 			echo '<div style="margin-left:50em;margin-top:-1em;"> <select name="pq-'.$qid.'-f-1" required>
    //   <option value="" disabled selected>Choose your option</option>
    //   <option value="1">1</option>
    //   <option value="2">2</option>
    //   <option value="3">3</option>
    //   <option value="4">4</option>
    //   <option value="5">5</option>
    // </select>';
    // echo '&nbsp';
    // echo '&nbsp';
    // echo '&nbsp';

    // echo '<select name="pq-'.$qid.'-f-2" required>
    //   <option value="" disabled selected>Choose your option</option>
    //   <option value="1">1</option>
    //   <option value="2">2</option>
    //   <option value="3">3</option>
    //   <option value="4">4</option>
    //   <option value="5">5</option>
    // </select>'; 
    echo '</div>';
            	echo '<br>';
 		        echo '<br>';
 		    }

 	echo'<h1><span class="badge badge-secondary">LAB ASSISTANT</span></h1>';
 // echo mysqli_num_rows($qu2).'hola hola';
 	$q_arr = array();
 	$i_arr = array();
 	while ($rum=mysqli_fetch_assoc($qu2)) {
 		$q_arr[]=$rum['question'];
 		$i_arr[]=$rum['id'];
 	}

 for($f=0;$f<$gg;$f++){
 	$r = $f+1;
 	// $temp=$qu2;
 	echo '<div class="row">';
    	echo '<div class="col">';
    	echo '</div>';
    	echo '<div class="col-3">';
    	echo '<b>';
    	echo $labassname[$f];
    	echo '</b>';
    	echo '</div>';
    echo '</div>';

 	echo '<br>';
 	echo '<br>';

 	$kk=0;
	 foreach($q_arr as $v){
    	echo '<div class="row">';
    	echo '<div class="col">';
	 	echo $i_arr[$kk++];
	 	echo '->';
	 	echo $v;
    echo '</div>';
    
	 	echo '
    <div class="col-3">
    
    <select name="pq-'.$kk.'-la-'.$r.'"  class="form-control" required>


      <option value="" disabled selected>Choose your option</option>
      <option value="1">1</option>
      <option value="2">2</option>
      <option value="3">3</option>
      <option value="4">4</option>
      <option value="5">5</option>
    </select>';

	 		    echo '<br>';
	 		    echo '<br>';
	 		    echo '<br>
	 		    </div>
          </div> ';
	}
}
 		        echo '
          <button type="submit" name="sub" class="btn btn-lg btn-danger">Submit</button>
            
 		        </form>
          ';
 }
 echo '</div>';

  ?>
