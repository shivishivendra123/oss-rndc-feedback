<html>
<head>
<title>Testing</title>
<style type="text/css">
@media print
{
.displayOnly {display: none;}
}
</style>

</head>

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
                          <center><b>AJAY KUMAR GARG ENGINEERING COLLEGE<center><br>
                          DEPARTMENT OF ".$depart."<br>
                          FEEDBACK</b><br>
                          SESSION 2017-18
                          <form name='form1'><table class='striped centered' id='table1'>
                            <thead>
                              <tr>
                                  <th>Assistant name</th>
                                  <th>Section</th>
                                  <th>Subject-Code</th>
                                  
                                  
                                  <th>Average</th>
                                  
                              </tr>
                            </thead>";
                    //$section=$_POST['section'];
                    
                    //$lab_id=$_POST['faculty'];
                    $subject='';
                    $i1=0;
                    $lab_name='';
                    $section='';
                    $year=1;
                    $arr=array(array());
                            $sum1=array();
                    $qryf="SELECT * FROM lab_assistant WHERE department='$depart'";
                    $qry_execute=mysqli_query($con, $qryf);
                    while($fac_data=mysqli_fetch_array($qry_execute))
                    {
                        
                          $faculty_name=$fac_data['name'];
                          $faculty_id=$fac_data['id'];
                        //$subject=$_POST['subject'];
                        $qry1="SELECT DISTINCT subject,section FROM practical_lab_assistant_response WHERE la_id='$faculty_id' ORDER BY subject ASC";
                        $result1=mysqli_query($con, $qry1);
                        while ($data1=mysqli_fetch_assoc($result1))
                        {   
                            
                            $subject=$data1['subject'];
                            
                            
                            $section=$data1['section'];
                            
                            $qry11="SELECT * FROM practical_lab_assistant_response WHERE la_id='$faculty_id' AND subject='$subject' AND section='$section' ";
                            $result11=mysqli_query($con, $qry11);
                            
                            for ($i=0;$i<=4;$i++)
                                $arr[$faculty_id][$i]=0;
                            $count=0;
                            while ($data=mysqli_fetch_assoc($result11))
                            {
                                
                                
                                $faculty_id=$data['la_id'];


                                $qry12="SELECT * FROM lab_assistant WHERE faculty_id='$faculty_id'";
                                $result12=mysqli_query($con,$qry12);
                                while ($data12=mysqli_fetch_assoc($result12))
                                {
                                    $faculty_name=$data12['name'];
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
                            }
                            $sum1[$faculty_id]=0;
                            for($i=0;$i<5;$i++)
                            {
                                
                                $arr[$faculty_id][$i]=$arr[$faculty_id][$i]/$count;
                                $sum1[$faculty_id]+=$arr[$faculty_id][$i];

                            }
                            $total_avg1=$sum1[$faculty_id]/5;
                            if($sum1[$faculty_id]>0)
                                
                            {  $i1++;
                            ?>


                        <tbody>
                          <?php echo "<tr id='row".$i1."'>" ?>
                            
                            <td><?php echo $faculty_name; ?></td>
                            <td><?php echo $section; ?></td>
                            <td><?php echo $subject; ?></td>
                                                     
                            <td><?php echo round($total_avg1,2); ?></td>
                          </tr>

                        </tbody>

                        </form>
                        </div>


                                
                        
                                                                        
                            
                    
                <?php }}}?>

        </table></div><button onclick="prnt(<?php echo $i1;?>)" class="btn btn-large">Print</button>
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
                        window.facid='<?php echo $lab_id;?>';
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
        /*$('#table1 input[type=checkbox]:checked').each(function() { 

           var row = $(this).parent().parent();
           var rowcells = row.find('td');
           var cont = document.getElementById('printAble').innerHTML;
           rowcells.each(function() {var tdhtml = $(this).html();
            tdhtml.print();

            
        }); */
            

        // });
        function prnt(rowCount)  {
        var table = document.getElementById('table1').tBodies[0];
        //var rowCount = table.rows.length;
        var cont = document.getElementById('printAble').innerHTML;
        var winprint=window.open('http://google.com','','width=100,height=100');
        
alert(rowCount);
        
        var i=1 to start after header
        for(var i=1; i<=rowCount; i++) {
            
            
            // index of td contain checkbox is 8
            var chkbox = document.getElementById(i).checked;
            var row=document.getElementById('row'+i);
            //alert("hi");
            if( chkbox) 
            {
                
                winprint.document.write(row.innerHTML);
                
            }
        }
        winprint.document.close();
        winprint.focus();
        winprint.print();
        winprint.close();
        document.body.innerHTML = cont;
        window.print();
}
        function prnt1(){
            var cont = document.getElementById('printAble').innerHTML;

            var original_cont = document.body.innerHTML;
            document.getElementById('printAble').style.visibility="hidden";


            document.body.innerHTML = cont;
            window.print();
            document.body.innerHTML = original_cont;
        }
    </script>

</body>
