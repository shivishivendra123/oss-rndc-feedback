<?php

include_once 'header.php';
session_start();
if(!(isset($_SESSION['username']))){
  header('Location:index.php');
}


?>
<body>
 <nav class="navbar navbar-dark bg-primary">
  <a class="navbar-brand" href=""><h3>Response</h3></a>
  <button class="btn btn-large btn-danger ml-auto" onclick="goBack()">Go Back</button>
  &nbsp
  <a href="admin_home.php" class="btn btn-danger">Admin home</a>
</nav>

















                <?php
                $fac_id=$_GET['fac_id'];
                $section=$_GET['section'];
                $sub_id=$_GET['sub_id'];
                $year=$_GET['year'];
                $type = $_GET['type'];
                $t=1;
                if ($t==1)
                {

                     //$depart=$_POST['department'];
                          echo "<div id = 'printAble'>
                          <center><h5><b>AJAY KUMAR GARG ENGINEERING COLLEGE<center><br>
                          DEPARTMENT OF <br>
                          (FEEDBACK)</h5></b><br>
                          SESSION 2017-18";
                          if($type=="theory") {

                            echo "<table class='table table-bordered' id='save'>
                                <thead>
                                <tr>
                                      <th>ROLL NO.</th>
                                      <th>NAME</th>
                                      <th>SECTION</th>
                                      <th>Subject-Code</th>

                                      <th>Q.1</th>
                                      <th>Q.2</th>
                                      <th>Q.3</th>
                                      <th>Q.4</th>
                                      <th>Q.5</th>
                                      <th>Q.6</th>
                                      <th>Q.7</th>
                                      <th>Q.8</th>
                                      <th>Q.9</th>
                                      <th>Q.10</th>
                                      ";
                             }
                            elseif($type=='practical' || $type='practical_assistant'){
                                echo "<table class='table table-bordered' id='save'>
                                <thead>
                                <tr>
                                      <th>ROLL NO.</th>
                                      <th>NAME</th>
                                      <th>SECTION</th>
                                      <th>Subject-Code</th>

                                      <th>Q.1</th>
                                      <th>Q.2</th>
                                      <th>Q.3</th>
                                      <th>Q.4</th>
                                      <th>Q.5</th>

                                      ";

                            }

                           echo" </tr>
                            </thead>";
                    //$section=$_POST['section'];
                    //$depart=$_POST['department'];

                    //$faculty_id=$_POST['faculty'];
                    if($type=='theory')
                    $qryf="SELECT * FROM theory_response WHERE year='$year' AND section='$section' AND faculty_id='$fac_id'  order by student_id asc";
                    elseif($type=='practical')
                            $qryf="SELECT * FROM practical_faculty_response WHERE year='$year' AND section='$section' AND faculty_id='$fac_id' order by student_id asc";
                         elseif($type=='practical_assistant')
                            $qryf="SELECT * FROM practical_lab_assistant_response WHERE year='$year' AND section='$section' AND la_id='$fac_id'  order by student_id asc ";
                    $qry_execute=mysqli_query($con, $qryf);
                    while($fac_data=mysqli_fetch_array($qry_execute))
                    {
                        $st_id = $fac_data['student_id'];
                        

                          $arr=array(0,0,0,0,0,0,0,0,0,0);




                                $arr[0]=$fac_data['q1'];
                                $arr[1]=$fac_data['q2'];
                                $arr[2]=$fac_data['q3'];
                                $arr[3]=$fac_data['q4'];
                                $arr[4]=$fac_data['q5'];
                                $arr[5]=$fac_data['q6'];
                                $arr[6]=$fac_data['q7'];
                                $arr[7]=$fac_data['q8'];
                                $arr[8]=$fac_data['q9'];
                                $arr[9]=$fac_data['q10'];

                        //$subject=$_POST['subject'];
                          if($type=='theory' || $type=='practical' || $type=='practical_assistant')
                            $qry1="SELECT * FROM student2 WHERE id='$st_id'";
                        
                        $result1=mysqli_query($con, $qry1);
                        while ($data1=mysqli_fetch_assoc($result1))
                        {
                            $roll_no  = $data1['Roll_no'];
                          $stu_name=$data1['Name'];
                          //$faculty_id=$fac_data['id'];
                            //$subject=$data1['subject'];
                            //$section=$data1['section'];








                         }
                        ?>

                            <tbody>
                              <tr>
                              <td><?php echo $roll_no; ?></td>
                                <td><?php echo $stu_name; ?></td>
                                <td><?php echo $section; ?></td>
                                <td><?php echo $sub_id; ?></td>
                                <td><?php echo $arr[0]; ?></td>
                                <td><?php echo $arr[1]; ?></td>
                                <td><?php echo $arr[2]; ?></td>
                                <td><?php echo $arr[3]; ?></td>
                                <td><?php echo $arr[4]; ?></td>
                                <td><?php echo $arr[5]; ?></td>
                                <td><?php echo $arr[6]; ?></td>
                                <td><?php echo $arr[7]; ?></td>
                                <td><?php echo $arr[8]; ?></td>
                                <td><?php echo $arr[9]; ?></td>

                              </tr>

                        </tbody>
                        <?php
                    } ?>

        </table></div>
        <button onclick="prnt()" class="btn btn-lg btn-danger">Print</button>

        <!-- <br><br><br>
        <form action='./complete_save.php' method='GET'>
        <input type="hidden" name="fac_id" value="<?php  echo $fac_id; ?>">
        <input type="hidden" name="section" value="<?php  echo $section; ?>">
        <input type="hidden" name="sub_id" value="<?php  echo $sub_id; ?>">
        <input type="hidden" name="year" value="<?php  echo $year; ?>">
        <input type="hidden" name="type" value="<?php  echo $type; ?>"> -->
        <button type="button" class="btn btn-lg btn-info" id="btn">Save</button>



        <script src="table2excel.js" type="text/javascript"></script>



        <!-- </form> -->



                    

                    <?php
                }

                ?>
            </div>
        </div>
    </div>

    <script>
         $(function () {
        $("#btn").click(function () {
            $("#save").table2excel({
                filename: "Table2.xls"
            });
        });
    });

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
            var cont = document.getElementById('printAble').innerHTML;
            var original_cont = document.body.innerHTML;

            document.body.innerHTML = cont;
            window.print();
            document.body.innerHTML = original_cont;
        }
    </script>

</body>
