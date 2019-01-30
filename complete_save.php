<?php

include_once 'header.php';
session_start();
if(!(isset($_SESSION['username']))){
  header('Location:index.php');
}

header('Content-type: application/vnd.ms-excel');
header('Content-Disposition: attachment; filename=IMC('.$subjectid.'-'.$section.')_FRONT-PAGE.xls');
header("Pragma: no-cache");
header("Expires: 0");
?>
<body>

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

                            echo "<table class='striped centered'>
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
                                echo "<table class='striped centered'>
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
                    
                    $qryf="SELECT * FROM student WHERE year='$year' AND section='$section'";
                    $qry_execute=mysqli_query($con, $qryf);
                    while($fac_data=mysqli_fetch_array($qry_execute))
                    {
                        $roll_no  = $fac_data['rollno'];
                          $faculty_name=$fac_data['name'];
                          $faculty_id=$fac_data['id'];
                        //$subject=$_POST['subject'];
                          if($type=='theory')
                            $qry1="SELECT * FROM theory_response WHERE student_id='$faculty_id' AND subject='$sub_id' ";
                        elseif($type=='practical')
                            $qry1="SELECT * FROM practical_faculty_response WHERE student_id='$faculty_id' AND subject='$sub_id' ";
                         elseif($type=='practical_assistant')
                            $qry1="SELECT * FROM practical_lab_assistant_response WHERE student_id='$faculty_id' AND subject='$sub_id' ";
                        $result1=mysqli_query($con, $qry1);
                        while ($data1=mysqli_fetch_assoc($result1))
                        {
                            //$subject=$data1['subject'];
                            //$section=$data1['section'];
                            
                            
                            $arr=array(0,0,0,0,0,0,0,0,0,0);

                            
                            
                                
                                $arr[0]=$data1['q1'];
                                $arr[1]=$data1['q2'];
                                $arr[2]=$data1['q3'];
                                $arr[3]=$data1['q4'];
                                $arr[4]=$data1['q5'];
                                $arr[5]=$data1['q6'];
                                $arr[6]=$data1['q7'];
                                $arr[7]=$data1['q8'];
                                $arr[8]=$data1['q9'];
                                $arr[9]=$data1['q10'];
                          
                            
                           
                            

                         }   
                        ?>  

                            <tbody>
                              <tr>
                              <td><?php echo $roll_no; ?></td>
                                <td><?php echo $faculty_name; ?></td>
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
                                <td><?php echo $arr[10]; ?></td>
                                
                              </tr>

                        </tbody>
                        <?php 
                    } ?>

        </table></div>
        <button onclick="prnt()" class="btn btn-large">Print</button>
        <br><br><br>
        

                    <canvas id="myChart" width="400" height="400"></canvas>
                    <script>
                        function generateGraph() {
                            var ctx = document.getElementById("myChart");
                            var myChart = new Chart(ctx, {
                                type: 'bar',
                                data: {
                                    labels: ["Qus-1", "Qus-2", "Qus-3", "Qus-4", "Qus-5"],
                                    datasets: [{
                                        label: 'Qus Average #',
                                         data: ['<?php echo $arr[0];?>','<?php echo $arr[1];?>','<?php echo $arr[2];?>','<?php echo $arr[3];?>','<?php echo $arr[4];?>'],
//                                        data: ['10','20','15','20','30'],
                                        backgroundColor: [
                                            'rgba(255, 99, 132, 0.2)',
                                            'rgba(54, 162, 235, 0.2)',
                                            'rgba(255, 206, 86, 0.2)',
                                            'rgba(75, 192, 192, 0.2)',
                                            'rgba(153, 102, 255, 0.2)'
                                        ],
                                        borderColor: [
                                            'rgba(255,99,132,1)',
                                            'rgba(54, 162, 235, 1)',
                                            'rgba(255, 206, 86, 1)',
                                            'rgba(75, 192, 192, 1)',
                                            'rgba(153, 102, 255, 1)'
                                        ],
                                        borderWidth: 1
                                    }]
                                },
                                options: {
                                    scales: {
                                        yAxes: [{
                                            ticks: {
                                                beginAtZero:true
                                            }
                                        }]
                                    }
                                }
                            });
                        }
                        generateGraph();
                        window.facid='<?php echo $faculty_id;?>';
                    </script>

                    <?php
                }
            
                ?>
            </div>
        </div>
    </div>

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
            var cont = document.getElementById('printAble').innerHTML;
            var original_cont = document.body.innerHTML;

            document.body.innerHTML = cont;
            window.print();
            document.body.innerHTML = original_cont;
        }
    </script>

</body>
