<?Php 
 
$is_checked = $kasm['is_checked'] ;
$invites = $kasm['invites'] ;
$invite_remarks = $kasm['invite_remarks'] ;
$purpose = $kasm['purpose'] ;


?>
 
 <div class="form-group">
         <div class="col-md-9"></div>
            <div class="asdf"></div>
                  <label class="col-sm-3 control-label">SCHEDULED TIME</label>
                  <div class="col-sm-5 pull-right">
               
                    <input type="text" class="form-control" value="<?Php echo $date . " / " . $start_time . " - " . $end_time ; ?>" readonly>
                  </div>
                </div>

<?Php  if ($category == "FIELD") {  ?>
 
                <div class="form-group">
                  <label class="col-sm-3 control-label">MD NAME</label>
                  <div class="col-sm-9">
                    <input type="text" class="form-control"  readonly
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

<?Php } else { ?>

                <div class="form-group">
                  <label class="col-sm-3 control-label">AGENDA</label>
                  <div class="col-sm-9">
                   <input type="text" class="form-control"  name="title"   readonly
                    value="<?php echo $agenda ; ?>"
                   >
                  </div>
                </div>

<?Php }  ?>


                <div class="form-group">
                  <label class="col-sm-3 control-label">PURPOSE</label>
                  <div class="col-sm-9">
  
             <input type="text" class="form-control" readonly
                    value="<?php echo $purpose ; ?>"
                   >

                  </div>
                </div>
 
                <div id="idid" hidden><?Php echo $id; ?></div>


<?Php 

 

             if ($is_checked == "pending") {
                     if ($username == $event_creator) {
?>
                  <div class="form-group">
                   <div class="col-sm-12">
                   <div class='pull-right'>
                   <div class="checkbox">
                     <label>
                       <b>
                         
                     <input type="checkbox" id="checkcheck" name="checkActivity" value="finish">Activity Finished<br>
                       </b>
                     </label>
                   </div>
                   </div>
                   </div>
                 </div>
<?Php 
                   }
            }  

                  if ($is_checked == "pending") {
                                        if ($username == $event_creator) {
 ?>
                 <div class="form-group">
                  <label class="col-sm-3 control-label">REMARKS</label>
                  <div class="col-sm-9">
                 <textarea rows="4" class="boxsizingBorder" id="kass_remark" placeholder="Enter Remarks Here (Ex. MD Visited)"></textarea>
                  </div>
                </div>
<?Php                            }
                  } else {
                    $remarks = $kasm['remarks'];
                    $date_checked = $kasm['date_checked'];
?>
                 <div class="form-group">
                  <label class="col-sm-3 control-label">REMARKS</label>
                  <div class="col-sm-9">
                 <textarea rows="4" class="boxsizingBorder" readonly ><?php echo "DATE CHECKED: $date_checked &#10; &#10;". $remarks  ; ?></textarea>
                  </div>
                </div>
<?Php

                  }

 ?>
           <div class="modal-footer">
            <button type="button" class="btn btn-default antoclose2" data-dismiss="modal">Close</button>

            <?Php       if ($is_checked == "pending") { 
                                             if ($username == $event_creator) {
              ?>
            <button type="button" class="btn btn-primary" id="update-kash-activity" disabled>Update Activity</button>
            <?Php     
                                             }
                                }    ?>
                <div class="update-id" ></div>
            </div>

     
 