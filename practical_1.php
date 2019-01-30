<?php
error_reporting(0);
include_once 'header.php';
session_start();
if(!(isset($_SESSION['username']))){
  header('Location:index.php');
}
?>
<body>




   <nav class="navbar navbar-dark bg-primary">
  <a class="navbar-brand" href=""><h3>Practical Faculty Response</h3></a>
  <button class="btn btn-large btn-danger ml-auto" onclick="goBack()">Go Back</button>
  &nbsp
  <a href="admin_home.php" class="btn btn-danger">Admin home</a>
</nav>
                                    <div class="container">
                                         <form method="post" action="#">
                                    <?php
                                    $qry1="SELECT DISTINCT department FROM faculty";
                                    $result1=mysqli_query($con, $qry1);
                                    ?>
                                    <select id="department" name="department" required class="form-control noPrint"><br>
                                        <br>
                                        <option value="" disabled selected >Select Branch</option>
                                        <?php
                                        while ($department=mysqli_fetch_assoc($result1))
                                        {
                                            ?>
                                            <option><?php echo $department['department']; ?></option>

                                            <?php
                                        }
                                        ?>
                                    </select>
            
                            <!-- <div class="row">
                                <div class='input-field col s12'>
                                    <select id="faculty" name="faculty" required>
                                        <option value="" disabled selected>Select Faculty</option>
                                    </select>
                                </div>

                            </div>
                            <div class="row">
                                <div class="input-field col s12">
                                    <select id="subject" name="subject" required>
                                        <option value="" disabled selected>Select Subject</option>

                                    </select>
                                </div>
                            </div>
                            <div class="row">
                                <div class="input-field col s12">
                                    <select id="section" name="section" required>
                                        <option value="" disabled selected>Select Section</option>

                                    </select>
                                </div>
                            </div> --><br>
                                    <button type="submit" name="sub" class="btn btn-lg btn-danger noPrint">button</button>
                        
                </form>
                <?php
                if (isset($_POST['sub']))
                {
                        $depart=$_POST['department'];
                          echo "<div id = 'printAble'>
                          <center><b>AJAY KUMAR GARG ENGINEERING COLLEGE<center><br>
                          DEPARTMENT OF ".$depart."<br>
                          FEEDBACK
                          </b><br>SESSION 2017-18 <br>
                          <input type='checkbox' id='select-all-check' class='filled-in noPrint'> 
                                        <label for='select-all-check'> Select All
                                        </label><table class='table-bordered' id='save'>
                            <thead>
                              <tr>
                                  <th>Faculty Name</th>
                                  <th>Faculty Average Response</th>
                                  <th>Assistant name</th>
                                  <th>Average</th>
                                  <th>Section</th>
                                  <th>Practical-Code</th>
                                  <th>Practical name</th>
                                  <th>No Of Responses</th>
                                  <th class='noPrint'> 
                                  </th>
                                  
                                  
                              </tr>
                            </thead>";
                    //$section=$_POST['section'];
                    
                    //$lab_id=$_POST['faculty'];
                    $subject='';
                    $lab_name='';
                    $section='';
                    $year=1;
$i1=0;
                    $arr=array(array());
                            $sum1=array();
                    $qryf="SELECT * FROM faculty WHERE department='$depart'";
                    $qry_execute=mysqli_query($con, $qryf);
                    while($fac_data=mysqli_fetch_array($qry_execute))
                    {

                        $faculty_name=$fac_data['name'];
                        $faculty_id=$fac_data['id'];
                        
                        //$subject=$_POST['subject'];
                        // if($faculty_id==111)
                        // {
                        //     echo "www";
                        // }
                        $qry1="SELECT DISTINCT subject,section FROM practical_faculty_response WHERE faculty_id='$faculty_id' ORDER BY subject ASC";
                        $result1=mysqli_query($con, $qry1);
                        while ($data1=mysqli_fetch_assoc($result1))
                        {   
                            $subject=$data1['subject'];
                        //     if($faculty_id==118)
                        // {
                        //     echo $subject;
                        // }
                            
                            $section=$data1['section'];
                            
                           $qry11="SELECT * FROM practical_faculty_response WHERE faculty_id='$faculty_id' AND subject='$subject' AND section='$section' ";
                            $result11=mysqli_query($con, $qry11);
                            echo mysqli_error($result11);

                            for ($i=0;$i<=4;$i++)
                                $arr[$faculty_id][$i]=0;
                            $count=0;
                            $qry111="SELECT * FROM final WHERE subject='$subject'";
                            $result111=mysqli_query($con, $qry111);
                            while($run=mysqli_fetch_assoc($result111))
                            {
                                $prac_name = $run['subjectname'];
                            }
                            $count2=0;
                            $check = array();
                            while ($data=mysqli_fetch_assoc($result11))
                            {
                                $st_id = $data['student_id'];
                                $year = $data['year'];
                                
                                $faculty_id=$data['faculty_id'];


                                $qry12="SELECT * FROM faculty WHERE id='$faculty_id'";
                             
                                $result12=mysqli_query($con,$qry12);

                                while ($data12=mysqli_fetch_assoc($result12))
                                {
                                    $faculty_name=$data12['name'];
                        //             if($faculty_id==111)
                        // {
                        //     echo $faculty_name;
                        // }
                                }

                                $arr[$faculty_id][0]=$arr[$faculty_id][0]+$data['q1'];
                                $arr[$faculty_id][1]=$arr[$faculty_id][1]+$data['q2'];
                                $arr[$faculty_id][2]=$arr[$faculty_id][2]+$data['q3'];
                                $arr[$faculty_id][3]=$arr[$faculty_id][3]+$data['q4'];
                                $arr[$faculty_id][4]=$arr[$faculty_id][4]+$data['q5'];
                                /*$arr[5]=$arr[5]+$data['q6'];
                                $arr[6]=$arr[6]+$data['q7'];
                                $arr[7]=$arr[7]+$data['q8'];
                                $arr[8]=$arr[8]+$data['q9'];
                                $arr[9]=$arr[9]+$data['q10'];*/
                                $count++;
                                if($check[$st_id]==0){
                                    $count2++;
                                    $check[$st_id]=1;
                                }
                            }
                            foreach ($check as $key => $value) {
                                $check[$key]==0;
                            }
                            $sum1[$faculty_id]=0;
                            for($i=0;$i<5;$i++)
                            {
                                
                                $arr[$faculty_id][$i]=$arr[$faculty_id][$i]/$count;
                                $sum1[$faculty_id]+=$arr[$faculty_id][$i];

                            }
                             
                            $total_avg1=$sum1[$faculty_id]/5;
                            // echo $total_avg1;
                        
                        // for lab assistant
                                                                        
                            $qry13="SELECT * FROM practical_lab_assistant_response WHERE subject='$subject' AND section= '$section' ORDER BY la_id ";
                            $qry16="SELECT DISTINCT(la_id) FROM practical_lab_assistant_response WHERE subject='$subject' AND section='$section' ORDER BY la_id "; 
                            $result13=mysqli_query($con, $qry13);
                            $result16=mysqli_query($con, $qry16);
                            $num = mysqli_num_rows($result16);
                           // echo $num;
                           $lab_name = array();
                            $qry14="SELECT DISTINCT la_id FROM practical_lab_assistant_response WHERE subject='$subject' AND section='$section' ORDER BY la_id";
                            $result14=mysqli_query($con, $qry14);
                            $la_id=array();
                           while ($data14=mysqli_fetch_assoc($result14))
                             {   

                             $lab_id=$data14['la_id'];
                             $la_id[]=$lab_id;

                            $qry15="SELECT * FROM lab_assistant WHERE id='$lab_id'";
                                ;
                                $result15=mysqli_query($con,$qry15);
                                
                                while ($data15=mysqli_fetch_assoc($result15))
                                {
                                      $lab_name[]=$data15['name'];
                                      

                                }
                            for ($i=0;$i<=4;$i++)
                                $arr1[$lab_id][$i]=0;
                            }
                            
                            
                            $count1=array();
                            while ($data13=mysqli_fetch_assoc($result13))
                            {
                                
                                
                                 $lab_id=$data13['la_id'];

                                
                                
                                $arr1[$lab_id][0]=$arr1[$lab_id][0]+$data13['q1'];
                                $arr1[$lab_id][1]=$arr1[$lab_id][1]+$data13['q2'];
                                $arr1[$lab_id][2]=$arr1[$lab_id][2]+$data13['q3'];
                                $arr1[$lab_id][3]=$arr1[$lab_id][3]+$data13['q4'];
                                $arr1[$lab_id][4]=$arr1[$lab_id][4]+$data13['q5'];
                                /*$arr[5]=$arr[5]+$data['q6'];
                                $arr[6]=$arr[6]+$data['q7'];
                                $arr[7]=$arr[7]+$data['q8'];
                                $arr[8]=$arr[8]+$data['q9'];
                                $arr[9]=$arr[9]+$data['q10'];*/
                                $count1[$lab_id]++;
                            }
                            if($num==0)
                            {
                                // echo 0;
                                $j=0;
                            }
                            else{
                            $j = 0;
                            $result14=mysqli_query($con, $qry14);
                            while ($data14=mysqli_fetch_assoc($result14))
                             {    
                                
                                $lab_id=$data14['la_id'];
                                //echo $count1[$lab_id]."     ".$lab_id."<br>";
                                $sum2[$lab_id]=0;
                                for($i=0;$i<5;$i++)
                                {
                                
                                    $arr1[$lab_id][$i]=$arr1[$lab_id][$i]/$count1[$lab_id]."<br>";
                                    $sum2[$lab_id]+=$arr1[$lab_id][$i];

                                }
                                $count1[$lab_id]=0;
                                //echo $sum2[$lab_id]."<br>";
                                $total_avg2[$j]=$sum2[$lab_id]/5;
                                $j++;
                            }
                        }
                       
                                        // lab assisteant end
                    if($sum1[$faculty_id]>0)
                    {$i1++;
                        if($num!=0){
                        for($k = 0;$k<$num;$k++){
                            $avg3 = round($total_avg1,2);
                            $avg4=round($total_avg2[$k],2);
                        //     echo "www";
                        // }
                    ?>


                <tbody>
                <?php if($j!=0)
                {?>
                  <?php echo "<tr class='noPrint dont_print' id='row".$i1."'>" ?>
                  <td><?php echo $faculty_name; ?></td>
                  <td><?php 
                                    echo"<a href='complete.php?fac_id=$faculty_id&sub_id=$subject&section=$section&year=$year&type=practical&depart=$depart' class='avg'>$avg3</a>"; 
                                    ?>
                 </td>
                    <td><?php echo $lab_name[$k]; ?></td>
                    <td><?php echo "<a href='complete.php?fac_id=$la_id[$k]&sub_id=$subject&section=$section&year=$year&type=practical_assistant' class='avg'>$avg4</a>"; ?></td>
                    
                    <td><?php echo $section; ?></td>
                    <td><?php echo $subject; ?></td>
                    <td><?php echo $prac_name; ?></td>
                    <td><?php echo $count2; ?></td>
<td class="noPrint dont_print"><input type="checkbox" id='<?php echo $i1;?>' class="filled-in chkbox" name="lab_ass" />
                                <label for='<?php echo $i1;?>'></label></td>
                    
                    
                  </tr>
                  <?php }?>

                </tbody>
                <?php }}?>
                <?php
                if($num==0){
                        for($k = 0;$k<=$num;$k++){
                            $avg3 = round($total_avg1,2);
                            $avg4=round($total_avg2[$k],2);
                        //     echo "www";
                        // }
                    ?>


                <tbody>
                <?php if($j==0)
                {?>
                  <?php echo "<tr class='noPrint dont_print' id='row".$i1."'>" ?>
                  <td><?php echo $faculty_name; ?></td>
                  <td><?php 
                                    echo"<a href='complete.php?fac_id=$faculty_id&sub_id=$subject&section=$section&year=$year&type=practical&depart=$depart' class='avg'>$avg3</a>"; 
                                    ?>
                 </td>
                    <td><?php echo $lab_name[$k]; ?></td>
                    <td></td>
                    
                    <td><?php echo $section; ?></td>
                    <td><?php echo $subject; ?></td>
                    <td><?php echo $prac_name; ?></td>
                    <td><?php echo $count2; ?></td>
<td class="noPrint dont_print"><input type="checkbox" id='<?php echo $i1;?>' class="filled-in chkbox" name="lab_ass" />
                                <label for='<?php echo $i1;?>'></label></td>
                    
                    
                  </tr>
                  <?php }?>

                </tbody>
                <?php }}?>

                <?php }}}?>
        </table></div><button onclick="prnt()" class="btn btn-lg btn-danger noPrint">Print</button>
        <button id="btn" class="btn btn-lg btn-info noPrint">Save</button>
        <!-- <form action="practical_1save.php" method="POST">
                    <input type="hidden" name="department" value="<?php  echo $depart; ?>">
                    <button type="submit" name="sub" class="btn btn-lg btn-info noPrint">Save</button>

                </form> -->
        <br><br><br>



                    <?php
                }
                ?>
            </div>
        </div>
    </div>
    <script src="table2excel.js" type="text/javascript"></script>
<script type="text/javascript">
    $(function () {
        $("#btn").click(function () {
            $("#save").table2excel({
                filename: "Table2.xls"
            });
        });
    });
        $(document).ready(function(){
            $(".dont_print").addClass("noPrint");
        });
        $(document).ready(function(){
            $('#select-all-check').click(function() {
                $("input.chkbox").click();
                $("input.chkbox").attr("checked","checked");
            });
        });
        
        $(":checkbox").on({
                click :function(){
                    // if($("#select_all").prop("checked")==true){
                    //     $(this).prop('checked',true);
                    // }
                    if($(this).prop("checked")==true){
                        $(this).closest("tr").removeClass("noPrint");
                    }
                    else {
                        $(this).closest("tr").addClass("noPrint");
                    }
                }
        });
    </script>
    <script>


        $(document).ready(function() {
            $("#department").change(function () {
                var department = $("#department").val();
                $.ajax({
                    url: "getfac.php",
                    data: {dpt: department},
                    success: function (json) {
                        $.each(json, function (i, obj) {
                            $('#faculty').append($('<option>', {
                                value: obj.id,
                                text : obj.name
                            }));
                        });
                        $('select').material_select();
                    }
                });
            });
            $("#faculty").change(function () {
                var fac = $("#faculty").val();
                $.ajax({
                    url: "getsub_prac.php",
                    data: {fac: fac},
                    success: function (json) {
                        $.each(json, function (i, obj) {
                            $('#subject').append($('<option>', {
                                value: obj.subject,
                                text : obj.subject
                            }));
                        });
                        $('select').material_select();
                    }
                });
            });
            $("#subject").change(function () {
                var sub = $("#subject").val();
                var fac = $("#faculty").val();
                $.ajax({
                    url: "getsec_prac.php",
                    data: {fac: fac, sub: sub},
                    success: function (json) {
                        $.each(json, function (i, obj) {
                            $('#section').append($('<option>', {
                                value: obj.section,
                                text : obj.section
                            }));
                        });
                        $('select').material_select();
                    }
                });
            });
        });
        function prnt(){
           window.print();
        }
    </script>
    

</div>
</body>
