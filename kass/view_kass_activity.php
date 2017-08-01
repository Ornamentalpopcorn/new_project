<?php  require("../includes/session.php") ;  

$name = $_SESSION['name'] ;
// RESTRICTION

$select_restriction = mysqli_query($conn,
  $s="SELECT DISTINCT date, time_start, time_end
  FROM restriction 
     WHERE username IN 
     ( 
       SELECT DISTINCT username
       FROM kass_user
       WHERE full_name IN 
                                           (
                                             SELECT DISTINCT kasm 
                                             FROM  accounts_kass
                                             WHERE kass = '$name' 
                                           )  
     )
     AND status = 'active'
     ");
  
                                if (mysqli_num_rows($select_restriction) > 0) {
                                                                    $time_now =  strtotime( date("n/d/Y h:i a" ) );
                                                          
                                                                    $get_restriction_query = mysqli_fetch_assoc($select_restriction);
                                                                    $restrict_date = $get_restriction_query['date'];
                                                                    $restrict_start = $get_restriction_query['time_start'];
                                                                    $restrict_end = $get_restriction_query['time_end'];
                                                                    
                                                                    $restrict_start = strtotime($restrict_date . " " . $restrict_start);
                                                                    $restrict_end = strtotime($restrict_date . " " . $restrict_end); 
  
                                                                    if ($time_now >= $restrict_start && $time_now <= $restrict_end) {
                                                                             
                                                                                $restrict_edit = "no";

                                                                    } else {
                                                                      
                                                                                  $restrict_edit = "yes";

                                                                    }

                                } else {

                                      $restrict_edit = "yes";

                                }
// RESTRICTION


$info = explode(' / ' , $_GET['info'] );
$username = $_SESSION['username'] ;
 
$md = $info[0] ; 
$area = $info[1];
$group = $info[2];
   
$id = $info[3] ;
   
$md_info = mysqli_fetch_assoc(mysqli_query($conn,
  $s="SELECT DISTINCT md_name, area, md_group, event_id, comment, name, username,time_start,time_end, date , position, event_id,  agenda, category, comment, event_creator
  FROM activity
  WHERE action_id = '$id'
  AND username = '$username'
  ") );
 

$start_time = $md_info['time_start'];
$end_time = $md_info['time_end'];
$check_position = $md_info['position'];
$date = $md_info['date'] ;
$category = $md_info['category'];
$agenda = $md_info['agenda']; 
$name = $md_info['name'];
$comment = $md_info['comment'];
$event_creator = $md_info['event_creator'];
$event_id = $md_info['event_id'];

$sstart = $start_time;

$start_time = date("h:i a", strtotime($start_time) );
$end_time = date("h:i a", strtotime($end_time) );

if ($category =="RECRUITMENT") {

?>

<script type="text/javascript">
  
$("#CalenderModalEdit .modal-title").html("RECRUITMENT ACTIVITY");

</script>

<?Php

                     $kasm = mysqli_fetch_assoc(mysqli_query($conn,
                        $s="SELECT DISTINCT   
                                      is_checked, 
                                      remarks, 
                                      date_checked,
                                      purpose
                        FROM activity_kash
                        WHERE event_id = '$event_id'
                        ") );
                                        $md = $md_info['md_name'];            
                                        $area = $md_info['area'];           
                                        $group = $md_info['md_group']; 

                    include('view_kasm_activity_recruitment.php');
                    goto end;
} else {

?>

<script type="text/javascript">
  
$("#CalenderModalEdit .modal-title").html("KASS ACTIVITY");
  
</script>

<?Php

}
 
?>
 <div id='zxc'></div>
        <div id="category-val" hidden><?php echo $category; ?></div>
          
        <div class="form-group">
               
                  <div class="col-sm-6">
                              <label class="control-label">SCHEDULED TIME</label>
                           
                                <input type="text" class="form-control" value="<?Php echo $date . " / " . $start_time . " - " . $end_time ; ?>" readonly>
                  </div>

<?Php  if ($category == "FIELD") {  ?>
          
                <div class="form-group">
                  <div class="col-sm-3">
                  <label class="control-label">AREA</label>
                    <input type="text" class="form-control"  readonly
                     value="<?php echo $area ; ?>"
                    >
                  </div>
                
                  <div class="col-sm-3">
                  <label class="control-label">&nbsp;</label><br>
                    <?Php 

                          $check_joint_call = mysqli_query($conn,
                            $s="SELECT action_id
                            FROM activity_kasm_joint_call
                            WHERE action_id = '$id'
                            AND viewable = 'true'
                            ") ;
                             if (mysqli_num_rows($check_joint_call) > 0 ) {
                   
                             echo "<a href='#' 
                             class='btn btn-success'
                             data-toggle='modal'
                             data-id='$id'
                             data-target='#ViewJointCall'
                             ><i class='fa fa-reorder'></i> VIEW JOINT CALL</a>";
                             
                             }

                    ?>
                  </div>

                </div>



                <div class="form-group">
                                  <div class="col-sm-6">
                                  <label class="control-label">MD NAME</label>
                                    <input type="text" class="form-control"  readonly
                                    value="<?php echo $md ; ?>"
                                    >
                                  </div>

                                  <div class="col-sm-3">
                                    <label class="control-label">MD GROUP</label>
                                      <input type="text" class="form-control"  readonlyf
                                       value="<?php echo $group ; ?>"
                                      >
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


<?Php }  ?>
    </div>

 


<?Php  if ($category == "FIELD") {  ?>
 

<?Php } else {  

$select_checked = mysqli_fetch_assoc(mysqli_query($conn,
  $s="SELECT DISTINCT is_checked, for_approval, date_checked, remarks
  FROM activity_md_list
  WHERE activity_id = '$id'
  AND for_approval = ''
  ") ) ;


$is_checked = $select_checked['is_checked'];
$status_approval = $select_checked['for_approval'];
$date_checked = $select_checked['date_checked'];
$remarks = $select_checked['remarks'];
                                                  // CHECKBOX
                             if ($is_checked == "pending") {
                                                 if ($status_approval == "") {


                                                                         echo '
                                                                          <div class="form-group">
                                                                           <div class="col-sm-12">
                                                                           <div class="pull-right">
                                                                           <div class="radio">' ;

                                                                           echo '
                                                                             <label>
                                                                               <b>
                                                                                 
                                                                             <input type="radio" class="checkcheck deviate' .  $id . '"  name="checkActivity' . $id . '" value="' . $id .'">Activity Deviated<br> 
                                                                               </b> 
                                                                             </label>';
 
                                                                           echo '
                                                                             <label>
                                                                               <b>
                                                                                 
                                                                             <input type="radio" class="checkcheck  finish' .  $id . '" name="checkActivity' . $id . '" value="' . $id .'">Activity Finished<br> 
                                                                               </b> 
                                                                             </label>';
                                                                             
                                                                            

                                                                          echo '
                                                                           </div>
                                                                           </div>
                                                                           </div>
                                                                         </div>

                                                                                     ';

                              
                                              }
                             }
                          
                             echo "<div class='form-group'>";
                             echo '<label for="item" class="col-sm-3 control-label" ">REMARKS :</label>';

                             if ($is_checked == "pending") {

                                         if ($status_approval == "") {
                                         echo '<div class="col-sm-9">
                                        <textarea rows="6" class="boxsizingBorder rrr remark' . $id . '"
                                        data-id="' . $id . '"
                                        ></textarea>
                                           ';
                                           echo "</div>";
                                          }

                             } else {

                                        echo '<div class="col-sm-9">
                                        <textarea rows="6" class="boxsizingBorder"
                                        readonly
                                        >DATE CHECKED: ' . $date_checked . '&#10;&#10;' . $remarks .'</textarea>
                                          ';

                                          echo "</div>";
                             } 
                             echo '</div>';

                             if ($is_checked == "pending") {
                                               if ($status_approval == "") {
                                                                                 echo '<div class="pull-right"> 
                                                                                             <button type="button"      
                                                                                             class="btn btn-primary uuOffice update' . $id . '" 
                                                                                             data-btn="' . $id . '"disabled>Update Activity</button>
                                                       
                                                                          
                                                                                            </div>
                                                                                  ';
                                                }
                             }

                   
                             echo '</div>';
                             echo '</div>'; 
                    goto joint_call;

            }  ?>



<div class="clearfix"></div>

<?Php 

      $check_for = mysqli_fetch_assoc(mysqli_query($conn,
                $s=  "SELECT for_approval, is_checked 
                  FROM activity_md_list
                  WHERE activity_id = '$id'
                  AND for_approval = ''
                  -- AND is_checked = 'pending'
                  ") );
 
                   // -- AND for_approval = ''
                  // -- AND is_checked = 'pending'
 
                $status_approval = str_replace(" ", "",$check_for['for_approval']) ;
                $status_status = str_replace(" ", "",$check_for['is_checked']) ;

                  $check_if  = $date . " " . $sstart;
                  $dateNow = date('n/d/Y h:i:s a'); 
                  // echo $check_if . " " . $dateNow ;
                  if (strtotime($dateNow) < strtotime($check_if)) {
                                    // echo $dateNow . " " . $check_if ;
                              if ($status_approval == ""  ) {
                                          if ($status_status != "done") {
                                             
                                       echo "<a href='#'  
                                       style ='margin-left:5px;'
                                       class='btn btn-warning pull-right'
                                       data-resched='$id'
                                       data-toggle='modal'
                                       data-target='#reschedActivity'
                                       ><i class='fa fa-mail-forward'></i> RE-SCHEDULE ACTIVITY 
                                       </a>";


                                            if (strtotime($date) != strtotime(date('n/d/Y') ) ) {

                                                          if ($restrict_edit == "no") {
                                                             
                                                                                  echo "<a href='#'  
                                                                                             style ='margin-left:5px;'
                                                                                             class='btn btn-primary pull-right'
                                                                                             data-id='$id'
                                                                                             data-toggle='modal'
                                                                                             data-target='#EditActivity'
                                                                                             ><i class='fa fa-edit'></i>EDIT ACTIVITY 
                                                                                             </a>";
                                                          }
                                            }



                                          }
                              }
                  }
 
                   echo "<a href='#'  
                   style ='margin-left:5px;'
                   class='btn btn-info pull-right'
                   data-id='$id'
                   data-toggle='modal'
                   data-target='#KassNewActivity'
                   ><i class='fa fa-file-text'></i> COPY ACTIVITY 
                   </a>";
                        
?>

   <ul class="nav nav-tabs">

              <?Php 
              $get_objectives = mysqli_query($conn,
              $s=  "SELECT id, is_checked
                FROM activity_md_list
                WHERE activity_id = '$id'
                AND for_approval = '' 
                ORDER BY id ASC
                ") ;
         
              $count = 1;
              while ($row_objectives = mysqli_fetch_assoc($get_objectives) ) {
               
                $status = $row_objectives['is_checked'];
                if ($status == "done") {
                         $style = "style='color:green;' ";
                } else {
                         $style = "style='color:red;' ";

                }

                          if ($count == 1) {
                              echo '     <li class="active"><a data-toggle="tab" ' . $style . ' href="#menu' . $count . '" >OBJECTIVE ' . $count . '</a>  </li> ';
                          } else {
                              echo '    <li><a data-toggle="tab" ' . $style . ' href="#menu' . $count . '" >OBJECTIVE ' . $count . '</a>  </li> ' ;
                          }
                          $count++;
              }

              ?>
                               
 </ul>


 <div class="tab-content">
  

              <?Php 
              $get_objectives = mysqli_query($conn,
                $s="SELECT   id,main, sub, spec, is_checked, remarks, date_checked
                FROM activity_md_list
                WHERE activity_id = '$id'
                AND for_approval != 'previous activity'
                ORDER BY id ASC
                ") ;
 
              $count = 1;
              while ($row_objectives = mysqli_fetch_assoc($get_objectives) ) {
                 $main = strtoupper($row_objectives['main']) ;
                 $sub = strtoupper($row_objectives['sub']) ;
                 $spec = strtoupper($row_objectives['spec']) ;
                 $is_checked = $row_objectives['is_checked'] ;
                 $remarks = strtoupper($row_objectives['remarks']) ;
                 $date_checked = $row_objectives['date_checked'] ;
                 $activity_id = $row_objectives['id'];

                if ($is_checked == "done") {
                      $color = "#d5fbde";  
                 } else {
                      $color = "#fbf4f4";  

                 }
                          if ($count == 1) {
                            echo '<div id="menu' . $count . '"  class="tab-pane fade in active" style="background-color:' . $color . ';"

                            >' ;
                        
                            echo "<div class='' >";

                             echo "<table class='table borderless'>";
                             echo "<tr>";
                             echo "<td><h5><b><i class='fa fa-bullseye'></i> MAIN OBJECTIVE:</b></h5></td>";
                             echo "<td style='line-height: 38px;'>$main</td>";


                             echo "</tr>";

                             if ($sub != '0001') {
                                      if ($sub) {
                                        $sub = str_replace("0001" , "" , $sub);
                                         
                             echo "<tr>";
                             echo "<td><h5><b><i class='fa fa-bullseye'></i> SUB OBJECTIVE:</b></h5></td>";
                             echo "<td style='line-height: 38px;'>$sub</td>";
                             echo "</tr>";
                                      }
                             }

                             if ($spec != '0001') {
                                        $spec = str_replace("0001" , "" , $spec);
                              echo "<tr>";
                             echo "<td><h5><b><i class='fa fa-bullseye'></i> SPECIFIC ACTIVITY:</b></h5></td>";
                             echo "<td style='line-height: 38px;'>$spec</td>";
                             echo "</tr>";
                             }

                             echo "</table>";

                             echo "<hr>";

                             // CHECKBOX
                             if ($is_checked == "pending") {
                                                 if ($status_approval == "") {
                                                                         echo '
                                                                          <div class="form-group">
                                                                           <div class="col-sm-12">
                                                                           <div class="pull-right">
                                                                           <div class="radio">' ;

                                                                           echo '
                                                                             <label>
                                                                               <b>
                                                                                 
                                                                             <input type="radio" class="checkcheck deviate' .  $activity_id . '"  name="checkActivity' . $activity_id . '" value="' . $activity_id .'">Activity Deviated<br> 
                                                                               </b> 
                                                                             </label>';
 
                                                                           echo '
                                                                             <label>
                                                                               <b>
                                                                                 
                                                                             <input type="radio" class="checkcheck  finish' .  $activity_id . '" name="checkActivity' . $activity_id . '" value="' . $activity_id .'">Activity Finished<br> 
                                                                               </b> 
                                                                             </label>';
                                                                             
                                                                            

                                                                          echo '
                                                                           </div>
                                                                           </div>
                                                                           </div>
                                                                         </div>

                                                                                     ';
                                              // CHECKBOX
                                              }
                             }
                          
                             echo "<div class='form-group'>";
                             echo '<label for="item" class="col-sm-3 control-label" style="text-align:left">REMARKS :</label>';

                             if ($is_checked == "pending") {
                                         if ($status_approval == "") {
                                         echo '<div class="col-sm-9">
                                        <textarea rows="6" class="boxsizingBorder rrr remark' . $activity_id . '"
                                        data-id="' . $activity_id . '"
                                        ></textarea>
                                           ';
                                           echo "</div>";
                                          }
                             } else {

                                        echo '<div class="col-sm-9">
                                        <textarea rows="9" class="boxsizingBorder"
                                        readonly
                                        >DATE CHECKED: ' . $date_checked . '&#10;&#10;' . $remarks .'</textarea>
                                          ';
                                          echo "</div>";
                             } 
                             echo '</div>';

                             if ($is_checked == "pending") {
                                               if ($status_approval == "") {
                                                                 echo '<div class="pull-right"> 
                                                                             <button type="button"      
                                                                             class="btn btn-primary uu update' . $activity_id . '" 
                                                                             data-btn="' . $activity_id . '"disabled>Update Activity</button>
                                       
                                                          
                                                                            </div>
                                                                  ';
                                                }
                             }

                   
                             echo '</div>';
                             echo '</div>';
 
                          } else {

                              echo '   <div id="menu' . $count . '"  class="tab-pane fade" 
                              style="background-color:' . $color . ';"

                              >' ;
                      

                              echo "<table class='table borderless'>";
                             echo "<tr>";
                             echo "<td><h5><b><i class='fa fa-bullseye'></i> MAIN OBJECTIVE:</b></h5></td>";
                             echo "<td style='line-height: 38px;'>$main</td>";
                             echo "</tr>";
                           
                           if ($sub != '0001') {
                                    if ($sub) {
                                             $sub = str_replace("0001" , "" , $sub);
                             echo "<tr>";
                             echo "<td><h5><b><i class='fa fa-bullseye'></i> SUB OBJECTIVE:</b></h5></td>";
                             echo "<td style='line-height: 38px;'>$sub</td>";
                             echo "</tr>";
                                    }
                           }

                             if ($spec != '0001') {
                                             $spec = str_replace("0001" , "" , $spec);
                              echo "<tr>";
                             echo "<td><h5><b><i class='fa fa-bullseye'></i> SPECIFIC ACTIVITY:</b></h5></td>";
                             echo "<td style='line-height: 38px;'>$spec</td>";
                             echo "</tr>";
                             }

                             echo "</table>";

                                                          // CHECKBOX

                if ($status_approval == "") {
                                
                            if ($is_checked == "pending") {
                                                                         echo '
                                                                          <div class="form-group">
                                                                           <div class="col-sm-12">
                                                                           <div class="pull-right">
                                                                           <div class="radio">' ;

                                                                           echo '
                                                                             <label>
                                                                               <b>
                                                                                 
                                                                             <input type="radio" class="checkcheck deviate' .  $activity_id . '"  name="checkActivity' . $activity_id . '" value="' . $activity_id .'">Activity Deviated<br> 
                                                                               </b> 
                                                                             </label>';
 
                                                                           echo '
                                                                             <label>
                                                                               <b>
                                                                                 
                                                                             <input type="radio" class="checkcheck  finish' .  $activity_id . '" name="checkActivity' . $activity_id . '" value="' . $activity_id .'">Activity Finished<br> 
                                                                               </b> 
                                                                             </label>';

                                                                             
                                                                            

                                                                          echo '
                                                                           </div>
                                                                           </div>
                                                                           </div>
                                                                         </div>

                                                                                     ';
                           }
                             // CHECKBOX
                }

                            echo "<div class='form-group'>";
                             echo '<label for="item" class="col-sm-3 control-label" style="text-align:left">REMARKS :</label>';
                             if ($is_checked == "pending") {
                                         if ($status_approval == "") {
                                         echo '<div class="col-sm-9">
                                        <textarea rows="6" class="boxsizingBorder rrr remark' . $activity_id . '"
                                        data-id="' . $activity_id . '"
                                        ></textarea>
                                           ';
                                           echo "</div>";
                                          }
                             } else {

                                        echo '<div class="col-sm-9">
                                        <textarea rows="6" class="boxsizingBorder"
                                        readonly
                                        >DATE CHECKED: ' . $date_checked . '&#10;&#10;' . $remarks .'</textarea>
                                          ';
                                          echo "</div>";
                             } 

                             if ($is_checked == "pending") {
                                               if ($status_approval == "") {
                                                   echo '<div class="pull-right"> 
                                                                           <button type="button" 
                                                                           class="btn btn-primary uu update' . $activity_id . '" 
                                                                           data-btn="' . $activity_id . '"
                                                                           disabled>Update Activity</button>
                                     
                                                        
                                                                </div>
                                                                ';
                                              }
                             }

                            echo "</div>"; 
                             echo '</div> ';
                          }
                          $count++;
                           echo "<br>";
              }
                    joint_call:
                    // $check_joint_call = mysqli_query($conn,
                    //                             "SELECT name,remarks, viewable
                    //                             FROM activity_joint_call
                    //                             WHERE activity_id = '$id'
                    //                             AND viewable = 'true'
                    //                             ");

                    //      if (mysqli_num_rows($check_joint_call) > 0) {
 
                    //                                   while ($joint_call = mysqli_fetch_assoc($check_joint_call)) {
                                                     
                    //                                    $name = strtoupper($joint_call['name']);
                    //                                    $remarks = strtoupper($joint_call['remarks']);
                    //                                    $viewable = $joint_call['viewable'];

                    //                                     // REMARKS
                    //                                     // REMARKS 
                    //                                    echo '<br><hr><div class="form-group">
                    //                                         <label class="col-sm-3 control-label">' . $name . ' REMARKS:</label>
                    //                                         <div class="col-sm-5">
                    //                                          <textarea rows="6" class="boxsizingBorder"
                    //                                    readonly
                    //                                      >' . $remarks . '&#10;&#10;
                    //                                     </textarea> 
                    //                                         </div>
                    //                                       </div>
                    //                                    ';
                    //                                      // echo "<div class='form-group'>";
                    //                                      //  echo '<label for="item" class="col-sm-3 control-label" style="text-align:left">' .$name . ' REMARKS :</label>';
                    //                                      // echo '<div class="col-sm-9">
                    //                                      //  <textarea rows="6" class="boxsizingBorder"
                    //                                      //  readonly
                    //                                      //  >' . $remarks . '&#10;&#10;
                    //                                      //  </textarea>
                    //                                      //    </div>';
                    //                                      //    echo "</div>";
                    //                                    }         
                    //      }
              ?>
  
 </div>
<div class="asdf"></div>
      <div class="if-conflict"></div>
      
           <div class="modal-footer">
   <!--          <button type="button" class="btn btn-default antoclose2" data-dismiss="modal">Close</button>

   -->

            </div>

            <?Php end: ?>