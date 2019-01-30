<html>
<head>
    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
<script src="table2excel.js" type="text/javascript"></script>

</head>

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
  <a class="navbar-brand" href=""><h3>Theory Response</h3></a>
  <button class="btn btn-large btn-danger ml-auto" onclick="goBack()">Go Back</button>
  &nbsp
  <a href="admin_home.php" class="btn btn-danger">Admin home</a>
</nav>
    <br><br>
            <div class="container">

                <form method="post" action="#">
                                <div class="input-field col s12">
                                    <?php
                                    $qry1="SELECT DISTINCT department FROM faculty";
                                    $result1=mysqli_query($con, $qry1);
                                    ?>
                                    <select id="department" name="department" class="form-control noPrint" required>
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
                            </div> -->
                            <br>
                                    <button type="submit" name="sub" class="btn btn-lg btn-danger noPrint">Submit</button>
                                



                </form>
                <?php
                if (isset($_POST['sub']))
                {
                        $depart=$_POST['department'];
                          echo "<div id = 'printAble'>
                          
                          <center><b>AJAY KUMAR GARG ENGINEERING COLLEGE<center><br>
                          DEPARTMENT OF ".$depart."<br>
                          FEEDBACK</b><br>
                          SESSION 2017-18
                          <input type='checkbox' id='select-all-check' class='filled-in noPrint'> 
                                        <label for='select-all-check' class='noPrint'> Select All
                                        </label>
                          <form name='form1'><table class='table table-bordered' id='table1'>
                            <thead>
                              <tr>
                                  <th>Assistant name</th>
                                  <th>Section</th>
                                  <th>Subject-Code</th>
                                  
                                  
                                  <th>Average</th>
                                
                                  <th class='noPrint'> 
                                  </th>
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
                                
                                $year = $data['year'];
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
                            $total_avg1=round($total_avg1,2);
                            if($sum1[$faculty_id]>0)
                                
                            {  $i1++;
                            ?>


                        <tbody>
			<tr class="noPrint dont_print">
                          <?php echo "<tr id='row".$i1."' class='dont_print noPrint'>" ?>
                            
                            <td><?php echo $faculty_name; ?></td>
                            <td><?php echo $section; ?></td>
                            <td><?php echo $subject; ?></td>
                                                     
                            <?php
                                    echo"<td><a href='complete.php?fac_id=$faculty_id&sub_id=$subject&section=$section&year=$year&type=practical_assistant' class='avg'>$total_avg1</a></td>";
                                    ?>
                           <td class="noPrint dont_print"><input type="checkbox" id='<?php echo $i1;?>' class="filled-in chkbox" name="lab_ass" />
                                <label for='<?php echo $i1;?>'></label></td>
                          </tr>

                        </tbody>

                        </form>
                        </div>


                                
                        
                                                                        
                            
                    
                <?php }}}?>

        </table></div><button onclick="window.print();" class="btn btn-lg btn-danger noPrint">Print</button>

        <!-- <form action="practical_2save.php" method="POST">
                    <input type="hidden" name="department" value="<?php  echo $depart; ?>">
                    <button type="submit" name="sub" class="btn btn-large noPrint">Save</button>

                </form> -->


                    
                  <button id='btn'class='btn btn-lg btn-info noPrint'>Save</button>
                    <?php
                }
                ?>
            </div>
        </div>
    </div>
<!--     <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script> -->
<script src="table2excel.js" type="text/javascript"></script>

<script type="text/javascript">
    $(function () {
        $("#btn").click(function () {
            $("#table1").table2excel({
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
        /*$('#table1 input[type=checkbox]:checked').each(function() { 

           var row = $(this).parent().parent();
           var rowcells = row.find('td');
           var cont = document.getElementById('printAble').innerHTML;
           rowcells.each(function() {var tdhtml = $(this).html();
            tdhtml.print();

            
        }); */
            

        // });
        function prnt(){
           window.print();
        }
        function prnt1(rowCount)  
        {
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
            </script>
</div>
</body>
