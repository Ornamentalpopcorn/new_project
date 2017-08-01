<?Php include("../includes/session.php") ; ?> 

<?php 
$username = $_SESSION['username'] ;
$name = $_SESSION['name'] ;

$delete = mysqli_query($conn,
  "DELETE FROM activity_temp_edit
  WHERE username = '$username'
  ");

$id = $_GET['id'] ;

$md_info = mysqli_fetch_assoc(mysqli_query($conn,
  $s="SELECT DISTINCT time_start,time_end, date, md_name,area, md_group, position,  agenda, category
  FROM activity
  WHERE action_id = '$id' 
  ") );
 
// $select_activity_md = mysqli_query($conn,
//  "SELECT main,sub,spec
//  FROM activity_md_list
//  WHERE activity_id = '$id'
//  ");

// while ($row_activity_list = mysqli_fetch_assoc($select_activity_md) ) {
//   $main = $row_activity_list['main'];
//   $sub = $row_activity_list['sub'];
//   $spec = $row_activity_list['spec'];

//   $insert = mysqli_query($conn,
//    "INSERT INTO activity_temp
//    VALUES ('',
//    '$username',
//    '$main',
//    '$sub',
//    '$spec')
//    ");

// } 

$time_start = $md_info['time_start'] ; 
$time_end = $md_info['time_end'] ; 
$date = $md_info['date'] ; 
$md = $md_info['md_name'] ; 
$area = $md_info['area'] ;
$group = $md_info['md_group'] ;
$category = $md_info['category'] ;
$agenda = $md_info['agenda'] ;
 
?>
<form  class="form-horizontal calender" role="form">
<div id="update-id" hidden><?php echo $id; ?></div>
                   <div class="form-group">

       <!-- <label class="col-sm-3 control-label"><p class="pull-right">DATE</p></label> -->
              
                  <div class="col-md-2"> 
                         <label class="control-label">DATE</label>
                               <input type="text" class="form-control datepicker"
                               placeholder="Select Date..."
                               > 
                  </div>   
  
                      <div id="class-time">  
                          <div id="datePairDate2">
                           
                                              <div class="col-md-2"> 
                                               <label class="control-label">From</label>
                                                        <input type="text" class="time start form-control" placeholder="Ex. 8:00 AM" /> 
                                              </div>           

                                              <div class="col-md-2">
                                              <label class="control-label">To</label>
                                                        <input type="text" class="time end form-control" placeholder="Ex. 12:00 PM"/>
                                              </div>                     
                       
                          </div>
                      </div>
   
                          <div class="col-md-5">
                                <label class="control-label">Category</label>
                                 <input type="text" class="form-control" id="category"  value="<?Php echo $category; ?>" readonly />
                             
                                 
                          </div>  
                   </div>   

<?Php  if ($category == "FIELD") {  ?>
           

                <div class="form-group">
                                  <div class="col-sm-6">
                                  <label class="control-label">MD NAME</label>
                     
                                      <select class="form-control"
                                            name="md"
                                            id="md"
                                            >
                                                            <optgroup label="Select MD">
                                                            <?Php 
                                                            $select_kasm_md = mysqli_query($conn,
                                                              $s="SELECT DISTINCT md_name
                                                              FROM accounts_md
                                                              WHERE kass = '$name'
                                                              ORDER BY md_name ASC
                                                              ");

                                                            $rows = mysqli_num_rows($select_kasm_md);
                                                            $count = 1;
                                                            while ($rowss = mysqli_fetch_assoc($select_kasm_md) ) {
                                                              $cc = $rowss['md_name'] ;

                                                                     if ($count++ != $rows) {
                                                                     echo"<option value='$cc'>$cc</option>" ; 
                                                                     }
                                                            }
                                                            echo"<option value='$md' selected>$md</option>" ;
                                                            ?>
                                            </select>


                                  </div>

                                    <div class="form-group">
                                                <div class="col-sm-3">
                                                <label class="control-label">AREA</label>

                                                                                    <div id="md-area">
                                                                                      

                                                                                      <input type="text" class="form-control"  id="area" readonly
                                                                                       value="<?php echo $area ; ?>"
                                                                                      >
                                                                                    </div>
                                                </div>

                                              <div class="col-sm-2">
                                              <label class="control-label">MD GROUP</label>

                                                                                      <div id="md-group">

                                                                                                                <input type="text" class="form-control"  id="group-md" readonly
                                                                                                                 value="<?php echo $group ; ?>"
                                                                                                                >
                                                                                    </div>
                                              </div> 
                                    </div> 
                </div>

 

<?Php } else { ?>

                <div class="form-group"> 
                  <div class="col-sm-6">
                    <label class="control-label">AGENDA</label>
                   <input type="text" class="form-control"  name="title"   readonly
                    value="<?php echo $agenda ; ?>"
                   >
                  </div>
                </div>


<?Php }   
 
 
$select_activity_md = mysqli_query($conn,
  $s="SELECT main, sub, spec, remarks
  FROM activity_md_list
  WHERE activity_id = '$id'
  AND for_approval = ''
  ");
 
  while ($row = mysqli_fetch_assoc($select_activity_md)) {
    $main = $row['main'] ;
    $remarks = $row['remarks'] ;
    $remarks =mysqli_real_escape_string($conn, $remarks) ;  

    $sub = str_replace("0001", "", $row['sub']) ;
    $spec = str_replace("0001", "", $row['spec']) ;

    $insert = mysqli_query($conn,
      "INSERT INTO activity_temp_edit
      VALUES ('',
      '$username',
      '$main',
      '$sub',
      '$spec',
      '$remarks'
      )
      ");

  }

?>

<div class="form-group">
<div class="col-md-12">
              
                <div id="new-activity-objective">
                   
                                    <div class='new-aa-objective'>
                                      
                                                                    <table class="table table-bordered"
                                                                          style="  text-align:center; "
                                                                    >
                                                           <thead style="background-color: #337ab7; color:white;">         
                                                      <tr>
                                                          <td>#</td>
                                                          <td>MAIN OBJECTIVE</td>
                                                          <td>SUB OBJECTIVE</td>
                                                          <td>SPECIFIC ACTIVITY</td>
                                                          <td>REMARKS</td>
                                                          <td>ACTION</td>
                                                      </tr> 
                                                      </thead>
                                                      <tbody>
                        <?Php 

                                      $select_activity = mysqli_query($conn,
                                        "SELECT  id,main, sub, spec, remarks
                                        FROM activity_temp_edit
                                        WHERE username = '$username'
                                        ORDER BY ID ASC
                                        ");
                                              $count = 1;
                                              while ($row = mysqli_fetch_assoc($select_activity)) {
                                                $id = $row['id'] ;
                                                $main = $row['main'] ;
                                                $sub =   $row['sub'] ;
                                                $remarks =   $row['remarks'] ;
                                                $remarks =mysqli_real_escape_string($conn, $remarks) ;  
                                                $spec =   $row['spec'] ;
                                                                             echo "<tr>";
                                                                             echo "<td>$count</td>";
                                                                             echo "<td>$main</td>";
                                                                             echo "<td>$sub</td>";
                                                                             echo "<td>$spec</td>";
                                                                             echo "<td><textarea cols='40' rows='4'>$remarks</textarea></td>";
                                       
                                                                               echo "<td class='hehe'>
                                                                               <button type='button' class='btn btn-primary new-edit-temp'
                                                                               data-target='#kass-editObjective' 
                                                                               data-toggle='modal'
                                                                               data-id='$id'
                                                                               ><i class='fa fa-edit'></i> EDIT</button>
                                                                               </td>";
                                                                               echo "</tr>";
                                                                               $count++;
                                              }

                                              ?>
                                            </tbody>
                                                                  </table>

                                </div>


                </div>
</div>
</div>
 

</form>

 <script type="text/javascript">
     $( function() {
       $( ".datepicker" ).datepicker({ minDate: 0  });
 } );

$(".datepicker").change(function(){
      var date = $(this).val();
    
     $('.datePairDate2 .time').timepicker('remove');
 
            var dataString = "date=" + date ;  
            ajax_request = $.ajax({
            type: "GET",
            url: "kass/disabled_time_resched.php",
            data: dataString,
            cache: true,
            success: function (data) {
              
                  $("#class-time").html(data);
                
            }

        });  

});

 </script>
 