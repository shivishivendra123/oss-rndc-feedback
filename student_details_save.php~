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

<?php
                if (isset($_POST['sub']))
                {

                     $depart=$_POST['department'];
                          echo "<div id = 'printAble'>
                          <center><h5><b>AJAY KUMAR GARG ENGINEERING COLLEGE<center><br>
                          DEPARTMENT OF ".$depart."<br>
                          (FEEDBACK)<br> SESSION 2017-18</h5></b>

                    <table class='striped centered'>
                            <thead class='Print'>
                              <tr>
                              <th>ROLL NO</th>
                              <th>Student Name</th>
                                  <th>Year</th>
                                  <th>Section</th>
                                  <th>Subject-1</th>
                                  <th>Faculty</th>
                                  <th>Subject-2</th>
                                  <th>Faculty</th>
                                  <th>Subject-3</th>
                                  <th>Faculty</th>
                                  <th>Subject-4</th>
                                  <th>Faculty</th>
                                  <th>Subject-5</th>
                                  <th>Faculty</th>
                                  <th>Subject-6</th>
                                  <th>Faculty</th>
                                  <th>Practical-1</th>
                                  <th>Faculty-1</th>
                                  <th>Faculty-2</th>
                                  <th>ASSISTANT NAME </th>
                                  <th>Practical-2</th>
                                  <th>Faculty-1</th>
                                  <th>Faculty-2</th>
                                  <th>ASSISTANT NAME </th>
                                  <th>Practical-3</th>
                                  <th>Faculty-1</th>
                                  <th>Faculty-2</th>
                                  <th>ASSISTANT NAME </th>
                                  <th>Practical-4</th>
                                  <th>Faculty-1</th>
                                  <th>Faculty-2</th>
                                  <th>ASSISTANT NAME </th>
                              </tr>
                            </thead>";
                    //$section=$_POST['section'];
                    //$depart=$_POST['department'];
                    
                    //$faculty_id=$_POST['faculty'];
                    
                    $faculty_id=array();
                    if($depart=='CSE')
                        $depart1='CS';
                    else if($depart=='ECE')
                        $depart1='EC';
                    else 
                        $depart1=$depart;
                    
                    for($i=0;$i<=5;$i++)
                        for($j=0;$j<=5;$j++)
                            $facs[$i][$j]=0;
                    $year=1;
                    $qryf="SELECT * FROM student WHERE department='$depart'";

                    
                    $qry_execute=mysqli_query($con, $qryf);
                    echo mysqli_num_rows($qry_execute);
                    $labs=array();
                    $facs=array();
                    $facs_name=array();
                    $labs_name=array();
                    $subject=array();
                    $facs1=array();
                    $facs2=array();
                    $i1=0;
                     
                    while($fac_data=mysqli_fetch_array($qry_execute))
                    {
                        
                        $rollno=$fac_data['rollno'];
                        $name=$fac_data['name'];
                        $year=$fac_data['year'];
                        $section=$fac_data['section'];
                        for($t=1;$t<=6;$t++)
                        {
                            $f='f'.$t;
                            $fa=$fac_data[$f];
                            $facs[$t]=$fac_data[$f];
                            $qryf1="SELECT * FROM faculty WHERE faculty_id='$fa'";                
                            $qry_execute1=mysqli_query($con, $qryf1);
                            $fac_data1=mysqli_fetch_array($qry_execute1);
                            $facs_name[$t]=$fac_data1['name'];
                            $n='n'.$t;
                            $subject[$t]=$fac_data[$n];

                        }
                        
                        for($t=1;$t<=4;$t++)
                        {
                                $l='p'.$t;
                                $f1='f'.$t.'1';
                                $f2='f'.$t.'2';
                                $la='la'.$t;
                                $la1=$fac_data[$la];
                                $fa1=$fac_data[$f1];
                                $fa2=$fac_data[$f2];
                                $facs1[$t]=$fac_data[$f1];
                                $facs2[$t]=$fac_data[$f2];
                                $qryf1="SELECT * FROM faculty WHERE faculty_id='$fa1'";

                                $qry_execute1=mysqli_query($con, $qryf1);
                                $fac_data1=mysqli_fetch_array($qry_execute1);
                                $facs_name1[$t]=$fac_data1['name'];
                                $qryf2="SELECT * FROM faculty WHERE faculty_id='$fa2'";
                                      
                                $qry_execute2=mysqli_query($con, $qryf2);
                                $fac_data2=mysqli_fetch_array($qry_execute2);
                                $facs_name2[$t]=$fac_data2['name'];
                                $labs_name[$t]=$fac_data[$l];

                                $qryf3="SELECT * FROM lab_assistant WHERE assistant_id='$la1'";

                                $qry_execute3=mysqli_query($con, $qryf3);
                                $fac_data3=mysqli_fetch_array($qry_execute3);
                                $ass_name[$t]=$fac_data3['name'];
                            	$i1++;
                            

                       }?>



                            <tbody>
                              <?php echo "<tr class='noPrint dont_print' id='row".$i1."'>" ?>
                              <td><?php echo $rollno; ?></td>
                                <td><?php echo $name; ?></td>
                                <td><?php echo $year; ?></td>
                                <td><?php echo $section; ?></td>
                                <td><?php echo $subject[1]; ?></td>
                                <td><?php echo $facs_name[1]; ?></td>
                                <td><?php echo $subject[2]; ?></td>
                                <td><?php echo $facs_name[2]; ?></td>
                                <td><?php echo $subject[3]; ?></t2d>
                                <td><?php echo $facs_name[3]; ?></td>
                                <td><?php echo $subject[4]; ?></td>
                                <td><?php echo $facs_name[4]; ?></td>
                                <td><?php echo $subject[5]; ?></td>
                                <td><?php echo $facs_name[5]; ?></td>
                                <td><?php echo $subject[6]; ?></td>
                                <td><?php echo $facs_name[6]; ?></td>
                                <td><?php echo $labs_name[1]; ?></td>
                                <td><?php echo $facs_name1[1]; ?></td>
                                <td><?php echo $facs_name2[1]; ?></td>
                                <td><?php echo $ass_name[1]; ?></td>
                                <td><?php echo $labs_name[2]; ?></td>
                                <td><?php echo $facs_name1[2]; ?></td>
                                <td><?php echo $facs_name2[2]; ?></td>
                                <td><?php echo $ass_name[2]; ?></td>
                                <td><?php echo $labs_name[3]; ?></td>
                                <td><?php echo $facs_name1[3]; ?></td>
                                <td><?php echo $facs_name2[3]; ?></td>
                                <td><?php echo $ass_name[3]; ?></td>
                                <td><?php echo $labs_name[4]; ?></td>
                                <td><?php echo $facs_name1[4]; ?></td>
                                <td><?php echo $facs_name2[4]; ?></td>
                                <td><?php echo $ass_name[4]; ?></td>
                                
                              </tr>

                        </tbody>

                                
                              
                        <?php  }
                        
                    
                     ?>

        </table></div>
       <br><br>
        

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
        </table></div>
         
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
