<?php  require("../includes/session.php") ; ?>

<!-- RESCHED -->
<!-- RESCHED -->
<?Php 

$username = $_SESSION['username'] ;

$delete = mysqli_query($conn,
  "DELETE FROM activity_temp
  WHERE username = '$username'
  ") ;


$id = $_GET['id'] ;

$md_info = mysqli_fetch_assoc(mysqli_query($conn,
  $s="SELECT DISTINCT md_name,area, md_group,time_start,time_end, date
  FROM activity
  WHERE action_id = '$id'
  ") );
 
$md = $md_info['md_name'] ;
$area = $md_info['area'] ;
$group = $md_info['md_group'] ;
$date = $md_info['date'] ;

$start_time = date("h:i a", strtotime($md_info['time_start']) );
$end_time = date("h:i a", strtotime($md_info['time_end']) );
?>
 
 <div class="container">
   <!-- background-color:#EEEEEE; -->
<div class="col-md-6"  style=" border-radius:5px;">
              <div id="resched-id" hidden><?Php echo $id; ?></div>
        
                 <div class="form-group">
                 <h4><b>PREVIOUS ACTIVITY SCHEDULE</b></h4>
                 <hr>
                  <div class="col-md-9"></div>
                <div class="pull-left"></div>
                       <label class="col-sm-3 control-label">SCHEDULE</label>
                  <div class="col-sm-6 pull-right">
               
                    <input type="text" class="form-control" value="<?Php echo $date . " / " . $start_time . " - " . $end_time ; ?>" readonly>
                  </div>
                </div>

                <div class="form-group">
                  <label class="col-sm-3 control-label">MD NAME</label>
                  <div class="col-sm-9">
                    <input type="text" class="form-control"  id="resched-md" readonly
                    value="<?php echo $md ; ?>"
                    >
                  </div>
                </div>

                  <div class="form-group">
                  <label class="col-sm-3 control-label">AREA</label>
                  <div class="col-sm-9">
                    <input type="text" class="form-control"  readonly
                     value="<?php echo $area ; ?>"
                    >
                  </div>
                </div>

                <div class="form-group">
                  <label class="col-sm-3 control-label">MD GROUP</label>
                  <div class="col-sm-9">
                   <input type="text" class="form-control"  name="title"   readonly
                    value="<?php echo $group ; ?>"
                   >
                  </div>
                </div>
 
<ul class="nav nav-tabs">

              <?Php 
              $get_objectives = mysqli_query($conn,
                "SELECT id, is_checked
                FROM activity_md_list
                WHERE activity_id = '$id'
                AND is_checked = 'pending'
                AND for_approval != 'previous activity'
                ORDER BY id ASC
                ") ;

              $count = 100;
              $coun = 1;

              while ($row_objectives = mysqli_fetch_assoc($get_objectives) ) {
                
                $status = $row_objectives['is_checked'];
                if ($status == "pending") {
                         $style = "style='color:red;' ";
                } else {
                         $style = "style='color:green;' ";

                }

                          if ($count == 100) {
                              echo '     <li class="active"><a data-toggle="tab" ' . $style . ' href="#menu' . $count . '" >OBJECTIVE ' . $coun . '</a>  </li> ';
                          } else {
                              echo '    <li><a data-toggle="tab" ' . $style . ' href="#menu' . $count . '" >OBJECTIVE ' . $coun . '</a>  </li> ' ;
                          }
                          $count++;
                          $coun++;
              }

              ?>
                
                              
 </ul>


          
 <div class="tab-content">
  

              <?Php 
              $get_objectives = mysqli_query($conn,
                "SELECT id,main, sub, spec, is_checked, remarks, date_checked
                FROM activity_md_list
                      WHERE activity_id = '$id'
                AND is_checked = 'pending'
                AND for_approval != 'previous activity'
                ORDER BY id ASC
                ") ;

              $count = 100;
       
              while ($row_objectives = mysqli_fetch_assoc($get_objectives) ) {
                 $main = strtoupper($row_objectives['main']) ;
                 $sub = strtoupper($row_objectives['sub']) ;
                 $spec = strtoupper($row_objectives['spec']) ;
                 $is_checked = $row_objectives['is_checked'] ;
                 $remarks = strtoupper($row_objectives['remarks']) ;
                 $date_checked = $row_objectives['date_checked'] ;
                 $activity_id = $row_objectives['id'];

                          // echo "<div class='container' >";
                          if ($count == 100) {
                            echo '<div id="menu' . $count . '"  class="tab-pane fade in active">' ;
                            echo "<hr>";
                   
                             echo "<table class='table borderless'>";
                             echo "<tr>";
                             echo "<td><h5><b><i class='fa fa-bullseye'></i> MAIN OBJECTIVE:</b></h5></td>";
                             echo "<td style='line-height: 38px;'>$main</td>";
                             echo "</tr>";

                             if ($sub != '0001') {
                                      if ($sub) {
                                         $sub = str_replace("0001", "", $sub);
                             echo "<tr>";
                             echo "<td><h5><b><i class='fa fa-bullseye'></i> SUB OBJECTIVE:</b></h5></td>";
                             echo "<td style='line-height: 38px;'>$sub</td>";
                             echo "</tr>";
                                      }
                             }

                             if ($spec != '0001') {
                                          $spec = str_replace("0001", "", $spec);
                              echo "<tr>";
                             echo "<td><h5><b><i class='fa fa-bullseye'></i> SPECIFIC ACTIVITY:</b></h5></td>";
                             echo "<td style='line-height: 38px;'>$spec</td>";
                             echo "</tr>";
                             }

                             echo "</table>";

                             echo "<hr>";
 
                   

                
                             echo '</div>';
 
                          } else {

                              echo '   <div id="menu' . $count . '"  class="tab-pane fade">' ;
                             echo "<hr>";

                              echo "<table class='table borderless'>";
                             echo "<tr>";
                             echo "<td><h5><b><i class='fa fa-bullseye'></i> MAIN OBJECTIVE:</b></h5></td>";
                             echo "<td style='line-height: 38px;'>$main</td>";
                             echo "</tr>";
                           
                           if ($sub != '0001') {
                                    if ($sub) {
                                      $sub = str_replace("0001", "", $sub);
                             echo "<tr>";
                             echo "<td><h5><b><i class='fa fa-bullseye'></i> SUB OBJECTIVE:</b></h5></td>";
                             echo "<td style='line-height: 38px;'>$sub</td>";
                             echo "</tr>";
                                    }
                           }

                             if ($spec != '0001') {
                                            $spec = str_replace("0001", "", $spec);
                              echo "<tr>";
                             echo "<td><h5><b><i class='fa fa-bullseye'></i> SPECIFIC ACTIVITY:</b></h5></td>";
                             echo "<td style='line-height: 38px;'>$spec</td>";
                             echo "</tr>";
                             }

                             echo "</table>";
 
                                 
 
                             echo '</div>';
                          } 
                          $count++;
              }
            // echo '</div>'; 

                    $check_joint_call = mysqli_query($conn,
                                                "SELECT name,remarks, viewable
                                                FROM activity_joint_call
                                                WHERE activity_id = '$id'
                                                AND viewable = 'true'
                                                ");

                         if (mysqli_num_rows($check_joint_call) > 0) {


                                                      while ($joint_call = mysqli_fetch_assoc($check_joint_call)) {
                                                     
                                                       $name = strtoupper($joint_call['name']);
                                                       $remarks = strtoupper($joint_call['remarks']);
                                                       $viewable = $joint_call['viewable'];

                                                        // REMARKS
                                                       echo '
                                                       <hr>
                                                      <div class="form-group">
                                                            <label class="col-sm-3 control-label">' . $name . ' REMARKS:</label>
                                                            <div class="col-sm-9">
                                                             <textarea rows="6" class="boxsizingBorder"
                                                       readonly
                                                         >' . $remarks . '&#10;&#10;
                                                        </textarea> 
                                                            </div>
                                                          </div>
                                                       ';
                     
                                                       }         
                         }
              ?>
  
</div>
</div>
 
<!-- 2nd TAB -->
<!-- 2nd TAB -->
<!-- 2nd TAB -->

<h4><b style="margin-left: 7px;">NEW ACTIVITY SCHEDULE</b></h4>
<hr>
<div class="col-md-6"  >
       
         <div class="form-group">
  
    
           <!-- <label class="col-sm-2 control-label"><p class="pull-right">DATE</p></label> -->
              
                  <div class="col-md-3"> 
           <label class="control-label">DATE</label>
                               <input type="text" id="datepicker" class="form-control"
                               placeholder="Select Date..."
                               > 
                  </div>        
  
               <div class="datePairDate2">
                       
                          <div id="class-time">
          
       <!--                              <div class="col-md-2"> 
                                              <input type="text" class="time start form-control" /> 
                                    </div>        
 
                                    <div class="col-md-2">
                                              <input type="text" class="time end form-control" />
                                    </div>     -->            
                          </div>
             
                     
              </div>
        </div>
  
         <div class="form-group">
              <!-- TABLE OBJECTIVE -->
              <!-- TABLE OBJECTIVE -->
  

  <?php 
  $select = mysqli_query($conn,
    "SELECT main, sub, spec
    FROM activity_md_list
    WHERE activity_id = '$id'
    AND is_checked = 'pending'
    AND for_approval = ''
    ORDER BY ID ASC
    ");
  $count = 1;
  while ($row = mysqli_fetch_assoc($select) ) {
    $main = $row['main'] ;
    $sub = str_replace("0001", "", $row['sub']) ;
    $spec = str_replace("0001", "", $row['spec']) ;

    $insert = mysqli_query($conn,
      "INSERT INTO activity_temp
      VALUES ('',
      '$username',
      '$main',
      '$sub',
      '$spec')
      ");

  }
  ?>   

                  <div class='re-objective'>
  
                                      <table class="table table-bordered table-hover table-condensed" style="  text-align:center;"   >
                                      <thead style="background-color:#337ab7; color:white;">
                                      <tr>
                                          <td>#</td>
                                          <td>MAIN OBJECTIVE</td>
                                          <td>SUB OBJECTIVE</td>
                                          <td>SPECIFIC ACTIVITY</td>
                                          <td>ACTION</td>
                                      </tr> 
                                      </thead>

                                      <tbody>
        <?Php 

$select_activity = mysqli_query($conn,
  "SELECT  id,main, sub, spec
  FROM activity_temp
  WHERE username = '$username'
  ORDER BY ID ASC
  ");
        $count = 1;
        while ($row = mysqli_fetch_assoc($select_activity)) {
          $id = $row['id'] ;
          $main = $row['main'] ;
          $sub =   $row['sub'] ;
          $spec =   $row['spec'] ;
                                       echo "<tr>";
                                       echo "<td>$count</td>";
                                       echo "<td>$main</td>";
                                       echo "<td>$sub</td>";
                                          echo "<td>$spec</td>";
 
                                         echo "<td class='hehe'>
                                         <button type='button' class='btn btn-danger new-delete-temp-resched'
                                         data-id='$id'
                                         ><i class='fa fa-close'></i> DELETE</button>
                                         </td>";
                                         echo "</tr>";
                                         $count++;
        }
 
        ?>
                                      </tbody>

                                      </table>

                    </div>

              <div class="modal-footer">
               <button type="button" 
               class="btn btn-success 
               pull-right activity-btn"
               data-target="#kass-resched-newObjective"
               data-toggle="modal"

               ><i class="fa fa-plus"></i> Add Objective</button>
              </div>
      
                              

<!-- <div class="asdf">hehe</div> -->
              <!-- TABLE OBJECTIVE -->
              <!-- TABLE OBJECTIVE -->

<!--          <div class="form-group" style="margin: auto 0 0 0;">
               <button type="button" 
               class="btn btn-primary 
               pull-right "
               data-target="#reschedObjective"
               data-toggle="modal"

               ><i class="fa fa-plus"></i> Add Objective</button>
        </div> -->

                <!-- <hr> -->
                 <div class='form-group'>
                              <label for="item" class="col-sm-3 control-label" style="text-align:right">REASON FOR RE-SCHEDULE</label>

                                   <div class="col-sm-9">
                                        <textarea rows="5" class="boxsizingBorder re-remark"></textarea>
                                  </div>
                            </div>

                            <div class="asdf"></div>


        </div>
          <div id='conflict-scheduled'></div>
</div>  

 </div>

 <script type="text/javascript">
     $( function() {
       $( "#datepicker" ).datepicker({ minDate: 1  });
 } );


$("#datepicker").change(function(){
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
