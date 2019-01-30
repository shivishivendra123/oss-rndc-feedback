<?php
include_once 'header.php';
date_default_timezone_set("Asia/Kolkata");
$date = date("d-m-Y");
?>
<style type="text/css">
  .fxd{
    position: fixed; !important;
    z-index: 999;
    margin-top: -1.8%; !important;
    right:10px;
    padding-right: 20px;
    padding-left: 10px;
  }
  .scr{
    position: relative; !important;
    z-index: 0; 
  }
</style>
<body>
    <nav class="teal lighten-3">
      <div class="nav-wrapper">
        <a href="#" class="brand-logo center">Student Feedback Portal</a>
        <ul id="nav-mobile" class="left hide-on-med-and-down">
					<li><a href="logout.php" class="right"><i class="fa fa-sign-out" aria-hidden="true"></i>Logout</a></li>
				</ul>
      </div>
    </nav>
		<div class="container">
<?php
	session_start();
if(!isset($_SESSION['ses_name']) && isset($_POST['rollno'])){
	$_SESSION['ses_rollno']=$_POST['rollno'];
	$rollno = $_POST['rollno'];
}
else if(isset($_SESSION['ses_name']) && isset($_SESSION['ses_rollno'])){
	$rollno = $_SESSION['ses_rollno'];
}
	$query = "SELECT * FROM student WHERE rollno='$rollno'";
	if(!($result=mysqli_query($con,$query))){
		echo mysqli_error($con);
    die();
	}
	 if(!mysqli_num_rows($result)){
	 	header('Location:index.php?login=false');
	}
  $row=mysqli_fetch_assoc($result);
	if(!isset($_SESSION['ses_name'])){
			$_SESSION['ses_name']=$row['name'];
	}
	$branch = strtoupper(substr($row['section'],0,strlen($row['section'])-1));
     echo '
     <div class="row">
          <div class="col s12 m12"><br><br></div>
					<div class="col s12 m12">
					<table class="centered">
			<thead>
				<tr>
						<th>Name</th>
						<th>Roll No.</th>
						<th>Section</th>
						<th>Year</th>
				</tr>
			</thead>
			<tbody>
				<tr>
					<td>'.ucwords($row["name"]).'</td>
					<td>'.$row["rollno"].'</td>
					<td>'.strtoupper($row["section"]).'</td>
					<td>'.$row["year"].'</td>
				</tr>
			</tbody>
		</table>
					</div>
     </div>';
		 /*$sql = "select  from student where student_id = '$row[tid]'";
		 if(!($t=mysqli_query($con,$sql))){
			 echo mysqli_error($con);
			 die();
		 }
		 $sql = "select * from student_practical where student_id = '$row[pid]'";
		 if(!($p=mysqli_query($con,$sql))){
			 echo mysqli_error($con);
			 die();
		 }
		$theory  = mysqli_fetch_assoc($t);
		$practical = mysqli_fetch_assoc($p);*/
    $m;
    $la_name = array();
    $lab_assistant_id = '';
		$i=1;$no_of_theory=0;$no_of_practical=0;
		$subject=array();
    $subject['name'] = array();
    $subject['disabled'] = array();
		$faculty=array();
		$practical_sub=array();
    $practical_sub['name'] = array();
    $practical_sub['disabled'] = array();
		$practical_fac_1=array();
		$practical_fac_2=array();
    $stuid = $row['id'];
			while($i<=7){
				 $code="f".$i;	//faculty f1 f2 f3....
				 if($row[$code]!=null){ //if fac not null
           $th="t".$i;
           $check_response = "select * from theory_response where subject='$row[$th]' and student_id = '$stuid'";
           if(!($cr=mysqli_query($con,$check_response))){
						 echo mysqli_error($con);
						 die();
					 }
           if(mysqli_num_rows($cr)){
             $i++;
             array_push($subject['name'],$row[$th]);
             array_push($subject['disabled'],true);
             $no_of_theory++;
             continue;
           }
					 $fac_sql = "select * from faculty where faculty_id = '$row[$code]'"; //get faculty details
					 if(!($fa=mysqli_query($con,$fac_sql))){
						 echo mysqli_error($con);
						 die();
					 }
					$fac  = mysqli_fetch_assoc($fa);
						$no_of_theory++;
						//array_push($subject,$theory[$th]);
            array_push($subject['name'],$row[$th]);
            array_push($subject['disabled'],false);
						array_push($faculty,$fac);
						$modal_no_theory=$no_of_theory-1;
            $ques = "select * from theory_questions where part='a'";//Fetch Part A Questions
            if(!($qu=mysqli_query($con,$ques))){
              echo mysqli_error($con);
              die();
            }
            $ques2 = "select * from theory_questions where part='b'";//Fetch Part B Questions
            if(!($qu2=mysqli_query($con,$ques2))){
              echo mysqli_error($con);
              die();
            }

						echo '
						<div id="theory'.$modal_no_theory.'" class="modal bottom-sheet prmodal">
							<div class="modal-content">
              <div class="container">
                <div class="row fxd grey lighten-5">
                  <div class = "col l12">
                  <div class="col s6 m6">
									<div class="col s12 m12">
										Name:<div class="right">'.ucwords($row["name"]).'</div>
									</div>
									<div class="col s12 m12">
										Department:<div class="right">'.strtoupper($fac["department"]).'</div>
									</div>
									<div class="col s12 m12">
										Name of faculty:<div class="right">'.ucwords($fac["name"]).'</div>
									</div>
									<div class="col s12 m12">
										Subject Code:<div class="right">'.strtoupper($row[$th]).'</div>
									</div>
									</div>

									<div class="col s6 m6">
									<div class="col s12 m12">
									Subject Name:<div class="right">'.strtoupper($row[$th]).'</div>
									</div>
									<div class="col s12 m12">
									Branch/Year:<div class="right">'.$branch.'&nbsp;'.$row["year"].'</div>
									</div>
									<div class="col s12 m12">
									Section:<div class="right">'.strtoupper($row["section"]).'</div>
									</div>
									<div class="col s12 m12">
									Date:<div class="right">'.$date.'</div>
									</div>
									</div>
</div>
								</div>

		<div class="row scr">
    <div class="row"></div><div class="row"></div><div class="row"></div><div class="row"></div><div class="row"></div><div class="row"></div>
			<div class="col s12 m12"><h5>Part-A</h5></div>
			<div class="col s12 m12"><blockquote>Please indicate your assessment on a scale of 1 to 5. 5 is the best.</blockquote></div>
		</div>
    <form action="theory_response.php" method="post" id="fac-'.$fac["id"].'-sub-'.$row[$th].'-'.$row["section"].'-'.$row["year"].'-form">
    <input type="hidden" name="facultyid" value="'.$fac["id"].'">
    <input type="hidden" name="subject" value="'.$row[$th].'">
    <input type="hidden" name="year" value="'.$row["year"].'">
    <input type="hidden" name="section" value="'.$row["section"].'">
    <input type="hidden" name="studentid" value="'.$row["id"].'">';
   while($disp_ques  = mysqli_fetch_assoc($qu)){
     $disp_question = $disp_ques['question'];
     $qid = $disp_ques['id'];
      echo '
      <div class="row">
      <div class="col s7 m7">'.$qid.' '.$disp_question.'</div>

			<div class="col s1 m1">
				<p>
					<input name="tq'.$qid.'" type="radio" value="1" id="'.$modal_no_theory.$qid.'1" required/>
					<label for="'.$modal_no_theory.$qid.'1">1</label>
				</p>
			</div>
			<div class="col s1 m1">
				<p>
        <input name="tq'.$qid.'" type="radio" value="2" id="'.$modal_no_theory.$qid.'2" required/>
        <label for="'.$modal_no_theory.$qid.'2">2</label>
				</p>
			</div>
			<div class="col s1 m1">
				<p>
        <input name="tq'.$qid.'" type="radio" value="3" id="'.$modal_no_theory.$qid.'3" required/>
        <label for="'.$modal_no_theory.$qid.'3">3</label>
				</p>
			</div>
			<div class="col s1 m1">
				<p>
        <input name="tq'.$qid.'" type="radio" value="4" id="'.$modal_no_theory.$qid.'4" required/>
        <label for="'.$modal_no_theory.$qid.'4">4</label>
				</p>
			</div>
			<div class="col s1 m1">
				<p>
        <input name="tq'.$qid.'" type="radio" value="5" id="'.$modal_no_theory.$qid.'5" required/>
        <label for="'.$modal_no_theory.$qid.'5">5</label>
				</p>
			</div>
			</div><br>';
    }

    echo '<div class="row">
			<div class="col s12 m12"><h5>Part-B</h5></div>
			<div class="col s12 m12"><blockquote>Please put a tick on your answer.</blockquote></div>
		</div>';
    $number=1;
    $flag=0;
   while($disp_ques2  = mysqli_fetch_assoc($qu2)){
      if($row['year']!='1' && $flag==0)
       {
        $flag=1;
        continue;
       } 
     $disp_question = $disp_ques2['question'];
     $qid = $disp_ques2['id'];
      echo '
      <div class="row">
      <div class="col s9 m9">'.$number.' '.$disp_question.'</div>

			<div class="col s3 m3">
				<p>
					<input name="tq'.$qid.'" type="radio" id="'.$modal_no_theory.$qid.'b1" value="1" required>
          <label for="'.$modal_no_theory.$qid.'b1">YES</label>
          <input name="tq'.$qid.'" type="radio" id="'.$modal_no_theory.$qid.'b0" value="0" required>
          <label for="'.$modal_no_theory.$qid.'b0">NO</label>
				</p>
			</div>
			</div><br>';
      $number++;
    }
    echo'
		</div>
							<div class="modal-footer">
								<a id="fac-'.$fac["id"].'-sub-'.$row[$th].'-'.$row["section"].'-'.$row["year"].'" class="modal-action modal-close waves-effect waves-green btn-flat theory-form-submit" href="#">Submit</a>
							</div>
              </form>
              </div>
						</div>
						';
				 }
				 $i++;
			}
			$i=1;
			while($i<=4){
				 $code="l".$i;	//lab l1 l2 l3....
         $l="l".$i;
				 if($row[$code]!=null){ //if lab not null
           $check_response = "select * from practical_faculty_response where student_id = '$stuid' and subject = '$row[$code]'";
           if(!($cr=mysqli_query($con,$check_response))){
						 echo mysqli_error($con);
						 die();
					 }
           if(mysqli_num_rows($cr)){
             $i++;
             array_push($practical_sub['name'],$row[$l]);
             array_push($practical_sub['disabled'],true);
             $no_of_practical++;
             continue;
           }
					 $fac_1_code = "f".$i.'1';
					 $fac_2_code = "f".$i.'2';
           $la_code = "la".$i;
					 $fac_1_sql = "select * from faculty where faculty_id = '$row[$fac_1_code]'"; //get faculty 1 details
					 if(!($fa_1=mysqli_query($con,$fac_1_sql))){
						 echo mysqli_error($con);
						 die();
					 }
					$fac_1 = mysqli_fetch_assoc($fa_1);
						array_push($practical_sub,$row[$l]);
            array_push($practical_sub['name'],$row[$l]);
            array_push($practical_sub['disabled'],false);
						array_push($practical_fac_1,$fac_1);
						$fac_2_sql = "select * from faculty where faculty_id = '$row[$fac_2_code]'"; //get faculty 2 details
 					 if(!($fa_2=mysqli_query($con,$fac_2_sql))){
 						 echo mysqli_error($con);
 						 die();
 					 }
 					$fac_2 = mysqli_fetch_assoc($fa_2);
 						$l="l".$i;
 						array_push($practical_fac_2,$fac_2);
					$no_of_practical++;
          $modal_no_practical = $no_of_practical-1;
          if($i!=4) {
            $la_sql = "select * from lab_assistant where assistant_id='$row[$la_code]'";
            if(!($la=mysqli_query($con,$la_sql))){
              echo mysqli_error($con);
              die();
            }
             $la = mysqli_fetch_assoc($la);
          }
          else
          {
            $check = true;
            $k=1;
            while($check){
              $la_code1 = "la4".$k;
              //echo $row[$la_code];
              if($row[$la_code1]!=NULL){
                
                $la_sql = "select * from lab_assistant where assistant_id='$row[$la_code1]'";
                if(!($la=mysqli_query($con,$la_sql))){
                  echo mysqli_error($con);
                  die();

                }
                $la = mysqli_fetch_assoc($la);
                $la_name[$k]=$la["name"];
                $lab_assistant_id = $lab_assistant_id.$la["id"]."/";
               
                $k++;
              }
              else{
                $check=false;
                $m=$k;
              }
             //$m++;
            


            }
          }
          
          
            echo $lab_assistant_id;
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

          echo '
          <div id="practical'.$modal_no_practical.'" class="modal bottom-sheet prmodal">
            <div class="modal-content">
            <div class="container">
              <div class="row fxd grey lighten-5">

                <div class="col s6 m6">

                <div class="col s12 m12">

                  Name:<div class="right">'.ucwords($row["name"]).'</div>
                </div>
                <div class="col s12 m12">
                  Department:<div class="right">'.strtoupper($fac_1["department"]).'</div>
                </div>
                <div class="col s12 m12">
                  Subject Code:<div class="right">'.strtoupper($row[$code]).'</div>
                </div>
                <div class="col s12 m12">
                Date:<div class="right">'.$date.'</div>
                </div>
                </div>

                <div class="col s6 m6">
                <div class="col s12 m12">
                Subject Name:<div class="right">'.strtoupper($row[$code]).'</div>
                </div>
                <div class="col s12 m12">
                Branch/Year:<div class="right">'.$branch.'&nbsp;'.$row["year"].'</div>
                </div>
                <div class="col s12 m12">
                Section:<div class="right">'.strtoupper($row["section"]).'</div>
                </div>
                </div>
                <div class="col s12 m12">
                  Name of faculties:<div style="margin-right:50%;!important" class="right">'.ucwords($fac_1["name"]).' & '.ucwords($fac_2["name"]).'</div>
                </div>';
                if($modal_no_practical!=3){
                echo'
                <div class="col s12 m12">
                  Name of lab assistant:<div style="margin-right:50%;!important" class="right">'.ucwords($la["name"]).'</div>
                </div>';
                }

                if($modal_no_practical==3){
                echo'
                <div class="col s12 m12">
                  Name of lab assistant:<div style="margin-right:50%;!important" class="right">';
                  
                    for($o = 1;$o<$m;$o++){
                      echo $la_name[$o];
                      if ($o!=$m-1) {
                        echo " & ";
                      }
                    }
                  
                  
                  echo '</div>
                </div>';
                }

                echo '

              </div>


  <div class="row scr">
    <div class="col s12 m12"><h5>Faculty Feedback</h5></div>
    <div class="col s12 m12"><blockquote>Please indicate your assessment on a scale of 1 to 5. 5 is the best.</blockquote></div>
  </div>
  <form action="practical_response.php" method="post" id="fac1-'.$fac_1["id"].'-fac2-'.$fac_2["id"].'-la-1-sub-'.$row[$th].'-'.$row["section"].'-'.$row["year"].'-form">
  <input type="hidden" name="faculty_1_id" value="'.$fac_1["id"].'">
  <input type="hidden" name="faculty_2_id" value="'.$fac_2["id"].'">
  <input type="hidden" name="la_id" value="'.$la["id"].'">
  <input type="hidden" name="lab_assistant_id" value="'.$lab_assistant_id.'">
  <input type="hidden" name="no" value="'.$m.'">
  <input type="hidden" name="studentid" value="'.$row["id"].'">
  <input type="hidden" name="section" value="'.$row["section"].'">
  <input type="hidden" name="subject" value="'.$row[$code].'">
  <input type="hidden" name="year" value="'.$row["year"].'">';
  echo ' <div class="row">
    <div class="col s6 m6"></div>
    <div class="col s3 m3">'.ucwords($fac_1["name"]).'</div>
    <div class="col s3 m3">'.ucwords($fac_2["name"]).'</div>
    </div>';
 while($disp_ques  = mysqli_fetch_assoc($qu)){
   $disp_question = $disp_ques['question'];
   $qid = $disp_ques['id'];
    echo '
    <div class="row">
    
    <div class="col s6 m6">'.$qid.'. '.$disp_question.'</div>

    <div class="col s3 m3">
    <select name="pq-'.$qid.'-f-1">
      <option value="" disabled selected>Choose your option</option>
      <option value="1">1</option>
      <option value="2">2</option>
      <option value="3">3</option>
      <option value="4">4</option>
      <option value="5">5</option>
    </select>
    <label>Choose Your Option</label>
    </div>
    <div class="col s3 m3">
    <select name="pq-'.$qid.'-f-2">
      <option value="" disabled selected>Choose your option</option>
      <option value="1">1</option>
      <option value="2">2</option>
      <option value="3">3</option>

      <option value="4">4</option>
      <option value="5">5</option>
    </select>
    <label>Choose Your Option</label>
    </div>
    </div><br>';
  }

  echo '<div class="row">
    <div class="col s12 m12"><h5>Lab Assistant Feedback</h5></div>
    <div class="col s12 m12"><blockquote>Please indicate your assessment on a scale of 1 to 5. 5 is the best.</blockquote></div>
  </div>';
  $number=1;
  if($modal_no_practical!=3){
 while($disp_ques2  = mysqli_fetch_assoc($qu2)){
   $disp_question = $disp_ques2['question'];
   $qid = $disp_ques2['id'];
    echo '
    <div class="row">
    <div class="col s8 m8">'.$number.' '.$disp_question.'</div>

    <div class="col s4 m4">
      <p>
      <select name="pq'.$qid.'-la">
        <option value="" disabled selected>Choose your option</option>
        <option value="1">1</option>
        <option value="2">2</option>
        <option value="3">3</option>
        <option value="4">4</option>
        <option value="5">5</option>
      </select>
      <label>Choose Your Option</label>
      </p>
    </div>
    </div><br>';
    $number++;
  }
 
}
else{
  //echo $m;
  for($o=1;$o<$m;$o++){
    if($o>1)
    echo '<div class="col s12 m12"><blockquote>Please indicate your assessment on a scale of 1 to 5. 5 is the best.</blockquote></div>';
    echo $la_name[$o];
   $number=1;
  while($disp_ques2  = mysqli_fetch_assoc($qu2)){
     
   $disp_question = $disp_ques2['question'];
   $qid = $disp_ques2['id'];
    echo '
    <div class="row">
    <div class="col s8 m8">'.$number.' '.$disp_question.'</div>

    <div class="col s4 m4">
      <p>
      <select name="pq'.$qid.'-la'.$o.'">
        <option value="" disabled selected>Choose your option</option>
        <option value="1">1</option>
        <option value="2">2</option>
        <option value="3">3</option>
        <option value="4">4</option>
        <option value="5">5</option>
      </select>
      <label>Choose Your Option</label>
      </p>
    </div>
    </div><br>';
    $number++;
  }
   $qu2=mysqli_query($con,$ques2);
}
}

  echo'</div>
  
            <div class="modal-footer">
              <a href="#!" class="modal-action modal-close waves-effect waves-green btn-flat practical-form-submit" id="fac1-'.$fac_1["id"].'-fac2-'.$fac_2["id"].'-la-1-sub-'.$row[$th].'-'.$row["section"].'-'.$row["year"].'">Agree</a>
            </div>
            </form>
            </div>
          </div>
          ';
				}
				 $i++;
			}
			echo'
			<div class="row">
	<div class="col s6 m6">
  <div class="collection">
    <a href="#!" class="collection-item"><span class="badge">'.$no_of_theory.'</span>Theory Subjects</a>
  </div>
	</div>
	</div>
	<div class="row">';
	$j=0;
	foreach ($subject['name'] as $key => $value) {
    if(!$subject['disabled'][$j]){
		echo'<div class="col s2 m2"><a class="waves-effect waves-light btn red lighten-1 modal-button" href="#theory'.$j.'" id="theory-button-'.$j.'">'.$value.'</a></div>';
  }else{
    echo'<div class="col s2 m2"><a class="waves-effect waves-light btn red lighten-1 modal-button disabled" href="#theory'.$j.'" id="theory-button-'.$j.'">'.$value.'</a></div>';
  }
		$j++;
	}
	echo '</div>';

	echo'
	<div class="row">
<div class="col s6 m6">
<div class="collection">
<a href="#!" class="collection-item"><span class="badge">'.$no_of_practical.'</span>Practical Subjects</a>
</div>
</div>
</div>
<div class="row">';$j=0;
foreach ($practical_sub['name'] as $key => $value) {
  if(!$practical_sub['disabled'][$j]){
    echo'<div class="col s2 m2"><a class="waves-effect waves-light btn red lighten-1 modal-button" href="#practical'.$j.'" id="practical-button-'.$j.'">'.$value.'</a></div>';
  }else{
    echo'<div class="col s2 m2"><a class="waves-effect waves-light btn red lighten-1 modal-button disabled" href="#practical'.$j.'" id="practical-button-'.$j.'">'.$value.'</a></div>';
  }
$j++;
}
echo '</div>';
?>
			</div>
      <script type="text/javascript">
      $("body").on("contextmenu",function(e){
          return false;
      });
      window.modalButton='';
      $('.modal-button').click(function(){
        window.modalButton = $(this).attr('id');
      })
        $('.theory-form-submit').click(function(){
          var formid = $(this).attr('id')+'-form';
          $.ajax({
            type: 'post',
            url: 'theory_response.php',
            data: $('#'+formid).serialize(),
            success: function (result) {
              console.log(result);
              $('#'+window.modalButton).addClass('disabled');
            }
          });

        });
        $('.practical-form-submit').click(function(){
          var formid = $(this).attr('id')+'-form';
          $.ajax({
            type: 'post',
            url: 'practical_response.php',
            data: $('#'+formid).serialize(),
            success: function (result) {
              console.log(result);
              $('#'+window.modalButton).addClass('disabled');
            }
          });

        });
      </script>
     </body>
