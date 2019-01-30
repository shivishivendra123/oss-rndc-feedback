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

<
                <?php
                if (isset($_POST['sub']))
                {

                     $depart=$_POST['department'];
                          echo "<div id = 'printAble'>
                          <center><h5><b>AJAY KUMAR GARG ENGINEERING COLLEGE<center><br>
                          DEPARTMENT OF ".$depart."<br>
                          (FEEDBACK)<br> SESSION 2017-18</h5></b>

                    <table class='striped centered'>
                            <thead>
                              <tr>
                              <th>Faculty Name</th>
                                  <th>Branch</th>
                                  <th>Section</th>
                                  <th>Subject-Code</th>
                                  
                                  <th>Section- 'A' Average Response</th>
                                  <th>Section- 'B' Average Response</th>
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
                    $facs=array(array());
                    for($i=0;$i<=5;$i++)
                        for($j=0;$j<=5;$j++)
                            $facs[$i][$j]=0;
                    $year=1;
                    $qryf="SELECT * FROM student WHERE section LIKE '$depart1%' GROUP BY section";

                    
                    $qry_execute=mysqli_query($con, $qryf);
        
                    $labs=array();
                    $i1=1;
                     
                    while($fac_data=mysqli_fetch_array($qry_execute))
                    {
                        
                        for($qw=1;$qw<=6;$qw++)
                        { 
                          //  echo "l3";
                            $qw1=(string)$qw;
                            $facs1='f'.$qw1;
                                //$facs[$qw][$j]=;
                                $faculty_id[$i1]=$fac_data[$facs1];
                                $i1++;
                            
                            

                            $labs1='la'.$qw1;
                            $labs[$qw]=$fac_data[$labs];
                        }
                        $i1=1;
                        $temp=6;
                        while($temp--)
                        {
                       
                        
                            $facu=$faculty_id[$i1];
                            //echo $facu;
                            $i1++;
                            // echo $i1;
                            // echo "<br>";

                
                        $qryf1="SELECT * FROM faculty ";
                        $qry_execute1=mysqli_query($con, $qryf1);
                        while($fac_data1=mysqli_fetch_array($qry_execute1))
                        {
                            
                            
                            //echo $fac_data1['faculty_id'].$facu;
                            

                            if($fac_data1['faculty_id'] == $facu)
                            {


                                 $faculty_name=$fac_data1['name'];
                                 $faculty_id1=$fac_data1['id'];
                            }
                           
                            
                        }

                        
                          
                        //$subject=$_POST['subject'];
                        //echo "level1";
                        
                        
                        $qry1="SELECT DISTINCT subject,section FROM theory_response WHERE faculty_id='$faculty_id1' ORDER BY subject ASC";
                        $result1=mysqli_query($con, $qry1);
                        while ($data1=mysqli_fetch_assoc($result1))
                        {
                             $subject=$data1['subject'];
                            $section=$data1['section'];
                            //echo "level2";
                            $qry11="SELECT * FROM theory_response WHERE faculty_id='$faculty_id1' AND subject='$subject' AND section='$section' ";
                            $result11=mysqli_query($con, $qry11);
                            $arr=[0,0,0,0,0,0,0,0,0,0];

                            $count=0;
                            while ($data=mysqli_fetch_assoc($result11))
                            {
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
                              $sum2+=$arr[$i];
                                //$arr[$i]*=100;
                            }
                            //$total_avg2=$sum2/$max;
                            $total_avg2=$sum2/$count;
                            $avg1 = round($total_avg1,2);
                            //echo"final";
                            
                            
                        ?>  

                            <tbody>
                              <tr>
                              <td><?php echo $faculty_name; ?></td>
                                <td><?php echo $depart; ?></td>
                                <td><?php echo $section; ?></td>
                                <td><?php echo $subject; ?></td>
                                
                                <?php 
                                    echo"<td><a href='complete.php?fac_id=$faculty_id&sub_id=$subject&section=$section&year=$year&type=theory'>$avg1</a></td>"; 
                                    ?>
                                <td><?php echo round($total_avg2,2) ; ?></td>
                              </tr>

                        </tbody>
                        <?php  }
                        
                    }
                    } ?>

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
