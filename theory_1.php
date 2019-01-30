<?php

include_once 'header.php';
session_start();
if(!(isset($_SESSION['username']))){
  header('Location:index.php');
}
?>


<script>
function goBack() {
    window.history.back();
}
</script>
<body>

                    <nav class="navbar navbar-dark bg-primary">
  <a class="navbar-brand" href=""><h3>Theory Response</h3></a>
  <button class="btn btn-large btn-danger ml-auto" onclick="goBack()">Go Back</button>
  &nbsp
  <a href="admin_home.php" class="btn btn-danger">Admin home</a>
</nav>
    <br><br>
<div  class="container">
                <form method="post" action="#">
                                    <?php
                                    $qry1="SELECT DISTINCT department FROM faculty";
                                    $result1=mysqli_query($con, $qry1);
                                    ?>
                                    <select id="department" class="form-control noPrint" name="department" required>
                                        <option value="" disabled selected>Select Branch</option>
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
                                    <button type="submit" name="sub" class="btn btn-lg btn-danger noPrint">Submit</button>
                




                </form>
                <?php
                if (isset($_POST['sub']))
                {

                     $depart=$_POST['department'];
                          echo "<div id = 'printAble'>
                          <center><h5><b>AJAY KUMAR GARG ENGINEERING COLLEGE<center><br>
                          DEPARTMENT OF ".$depart."<br>
                          (FEEDBACK)</h5></b><br>
                        <input type='checkbox' id='select-all-check' class='filled-in noPrint'> 
                                        <label for='select-all-check' class='noPrint'> Select All
                                        </label>
                    <table class='table table-bordered' id='save'>
                            <thead>
                              <tr>
                                  <th scope='col'>Faculty Name</th>
                                  <th>Section</th>
                                  <th>Subject-Code</th>
                                  <th>Branch</th>
                                  <th>Section-'A'Average Response</th>
                                  <th>Section-'B'Average Response</th>
                                  <th>Total Responses</th>

                              </tr>
                            </thead>";
                    //$section=$_POST['section'];
                    //$depart=$_POST['department'];
                    
                    //$faculty_id=$_POST['faculty'];
                    $year=1;
                     $i1=0;
                    $qryf="SELECT * FROM faculty WHERE department='$depart'";
                    $qry_execute=mysqli_query($con, $qryf);
                    while($fac_data=mysqli_fetch_array($qry_execute))
                    {
                          $faculty_name=$fac_data['name'];
                          $faculty_id=$fac_data['id'];
                        //$subject=$_POST['subject'];
                        $qry1="SELECT DISTINCT subject,section FROM theory_response WHERE faculty_id='$faculty_id' ORDER BY subject ASC";
                        $result1=mysqli_query($con, $qry1);
                        while ($data1=mysqli_fetch_assoc($result1))
                        {
                            $subject=$data1['subject'];
                            $section=$data1['section'];
                            
                            $qry11="SELECT * FROM theory_response WHERE faculty_id='$faculty_id' AND subject='$subject' AND section='$section' ";
                            $result11=mysqli_query($con, $qry11);
                            $arr=array();

                            $count=0;
                            $count1=0;
                            $check = array();
                            while ($data=mysqli_fetch_assoc($result11))
                            {
                                $st_id = $data['student_id'];
                                $year = $data['year'];
                                $arr[0]=$arr[0]+$data['q1'];
                                $arr[1]=$arr[1]+$data['q2'];
                                $arr[2]=$arr[2]+$data['q3'];
                                $arr[3]=$arr[3]+$data['q4'];
                                $arr[4]=$arr[4]+$data['q5'];
                                $arr[5]=$arr[5]+$data['q6'];
                                $arr[6]=$arr[6]+$data['q7'];
                                $arr[7]=$arr[7]+$data['q8'];
                                $arr[8]=$arr[8]+$data['q9'];
                                $arr[9]=$arr[9]+$data['q10'];
                                $count++;
                                if($check[$st_id]==0){
                                    $count1++;
                                    $check[$st_id]=1;
                                }
                            }
                            foreach ($check as $key => $value) {
                                $check[$key]==0;
                            }
                            $sum1=0;
                            for($i=0;$i<5;$i++)
                            {
                                
                                $arr[$i]=$arr[$i]/$count;
                                $sum1+=$arr[$i];
                            }
                            $total_avg1=$sum1/5;

                            if($year==1)
                            {
                              $i=5;
                              $max=5;
                            }


                            else 
                            {
                              $max=4;
                              $i=6;
                            }
                            $sum2=0;
                            for(;$i<=9;$i++)
                            {
                                $arr[$i]=$arr[$i]/$count;
                              $sum2+=$arr[$i];
                                //$arr[$i]*=100;
                            }
                            //$total_avg2=$sum2/$max;

                            $total_avg2=$sum2/$max;
                            $avg1 = round($total_avg1,2);
                            $i1++;
                            
                        ?>  

                            <tbody>
                               <?php echo "<tr class='noPrint dont_print' id='row".$i1."'>" ?>
                                <td><?php echo $faculty_name; ?></td>
                                <td><?php echo $section; ?></td>
                                <td><?php echo $subject; ?></td>
                                <td><?php echo $depart; ?></td>
                                <?php 
                                    echo"<td><a href='complete.php?fac_id=$faculty_id&sub_id=$subject&section=$section&year=$year&type=theory' class='avg'>$avg1</a></td>"; 
                                    ?>
                                <td><?php echo round($total_avg2,2) ; ?></td>
                                <td><?php echo $count1 ; ?></td>
                                <td class="noPrint dont_print"><input type="checkbox" id='<?php echo $i1;?>' class="filled-in chkbox" name="lab_ass" />
                                <label for='<?php echo $i1;?>'></label></td>
                              </tr>

                        </tbody>
                        <?php } ?>



                  <?php  } ?>

        </table></div>

                        
        <button onclick="prnt()" class="btn btn-large btn-success noPrint">Print</button>
        <button id="btn" class="btn btn-info noPrint">Save</button>
        <br><br><br>
        <!-- <form action="theory_1save.php" method="POST">
                    <input type="hidden" name="department" value="<?php  echo $depart; ?>">
                    <button type="submit" name="sub" class="btn btn-large noPrint">Save</button>

                </form> -->
        

                    


                    

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
                    url: "getsub.php",
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
                    url: "getsec.php",
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
