<?php
include_once 'header.php';
include_once 'portal.inc.php';
date_default_timezone_set("Asia/Kolkata");
$date = date("d-m-Y");
?>
<?php
if(isset($_POST['nomodel']))
{
$name=$_POST['nam'];
$sub=$_POST['s'];
$faculty=$_POST['fac'];
$facname=$_POST['facnam'];
$facdep=$_POST['dep'];
$year=$_POST['year'];
$branch=$_POST['branch'];
$Section=$_POST['section'];
$id = $_POST['id'];
$roll =   $_POST['roll'];
echo '
<table class="table table-hover">
  <thead class="thead">
    <tr>
      <th scope="col">Name</th>
    <th scope="col">RollNo</th>
    <th scope="col">Branch</th>
    <th scope="col">Subject</th>
    <th scope="col">Faculty Name</th>
    <th scope="col">Department</th>
    <th scope="col">Year</th>

    <th scope="col">Section</th>
    </tr>
    </thead>
    <tbody>
    <tr>
           <td>';
           echo $name;
           echo '</td>';
           echo '<td>';
           echo $roll;
           echo '</td>';
           echo '<td>';
           echo $branch;
           echo '<td>';
           echo $sub;
           echo '</td>';
          echo '<td>';  
            echo $facname;
            echo '</td>';
            echo '<td>';
            echo $facdep;
            echo '</td>';  
           echo '<td>';
           echo $year;
           echo '</td>';
           echo '<td>';
           echo $Section;
           echo '</td>'; 
           echo'
           </tr>
</table>';

// $subname = "SELECT * FROM subject WHERE sub_id ='$sub' AND category='T'";
// $query1 = mysqli_query($conn,$subname);
// while($arr=mysqli_fetch_assoc($query1))
// {
// 		echo $arr['sub_name'];
// }
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
            echo'<h1><span class="badge badge-secondary">PART-A</span></h1>';
            echo'
            <div style="margin-left:28em;">
            <form action="theory_response.php" method="POST">';
            echo '<input type="hidden" name="facultyid" value="'.$faculty.'">
    				<input type="hidden" name="subject" value="'.$sub.'">
    				<input type="hidden" name="year" value="'.$year.'">
    				<input type="hidden" name="section" value="'.$Section.'">
    				<input type="hidden" name="studentid" value="'.$id.'">';
            while($disp_ques  = mysqli_fetch_assoc($qu)){
            	 $disp_question = $disp_ques['question'];
            	 $qid = $disp_ques['id'];

            	 echo '<br>';
               echo '<div style="font-size:20px;">';
            	 echo $qid;
            	 echo ')';

            	 echo $disp_question;
               echo '</div>';
            	 echo "<br>";

            	 			echo '
            	1<input type="radio" name="tq'.$qid.'" value="1" required/>&nbsp &nbsp &nbsp
            	2<input type="radio" name="tq'.$qid.'" value="2" required/>&nbsp &nbsp &nbsp
            	3<input type="radio" name="tq'.$qid.'" value="3" required/>&nbsp &nbsp &nbsp
            	4<input type="radio" name="tq'.$qid.'" value="4" required/>&nbsp &nbsp &nbsp
            	5<input type="radio" name="tq'.$qid.'" value="5" required/>';
            	echo '<br>';
 		         echo '<br>';
 		        }
 		        echo '</div>
             <h1><span class="badge badge-secondary">PART-B</span></h1>
        
            <div style="margin-left:28em;">';
 		          while($disp_ques2  = mysqli_fetch_assoc($qu2)){
 		          	$disp_question = $disp_ques2['question'];
    	 				$qid = $disp_ques2['id'];
              
              if($year!=1)
                if($qid==6)
              {
                continue;

              }
               echo '<div style="font-size:20px;">';


    	 				echo $qid;
            	 echo ')';
            	 echo $disp_question;
               echo '</div>';
            	 echo '<br>';
            	 echo '&nbsp';
     						echo '
            	1<input type="radio" name="tq'.$qid.'" value="1" required/>&nbsp &nbsp &nbsp
            	2<input type="radio" name="tq'.$qid.'" value="2" required/>&nbsp &nbsp &nbsp
            	3<input type="radio" name="tq'.$qid.'" value="3" required/>&nbsp &nbsp &nbsp
            	4<input type="radio" name="tq'.$qid.'" value="4" required/>&nbsp &nbsp &nbsp
            	5<input type="radio" name="tq'.$qid.'" value="5" required/>';
 		         echo '<br>';
 		         echo '<br>';
 		        }
 		        echo '
            <div style="margin-left:15em;">
            <button type="submit" value="Agree" name="sub" class="btn btn-lg btn-danger">Submit</button>
            </div>
 		        </form>
            </div>';
 		          }




?>
