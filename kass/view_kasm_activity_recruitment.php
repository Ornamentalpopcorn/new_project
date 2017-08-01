<?Php 
 
$is_checked = $kasm['is_checked'] ; 
$purpose = $kasm['purpose'] ;
    
?>
 <div id='reschedule-id' hidden><?php echo $event_id; ?></div>
              <div class="form-group">
                     
                        <div class="col-sm-3">
                                    <label class="control-label">SCHEDULED TIME</label>
                                 
                                      <input type="text" class="form-control" value="<?Php echo $date . " / " . $start_time . " - " . $end_time ; ?>" readonly>
                        </div>

                         <div class="col-sm-4">
                                    <label class="control-label">KASS NAME</label>
                                 
                                      <input type="text" class="form-control" value="<?Php echo $name ; ?>" readonly>
                        </div>
                 
              </div>
 
                <div class="form-group">
                                  <div class="col-sm-5">
                                  <label class="control-label">MD NAME</label>
                                    <input type="text" class="form-control"  readonly
                                    value="<?php echo $md ; ?>"
                                    >
                                  </div>
 
                                    <div class="col-sm-3">
                                    <label class="control-label">AREA</label>
                                      <input type="text" class="form-control"  readonly
                                       value="<?php echo $area ; ?>"
                                      >
                                    </div>
                     
                                  <div class="col-sm-3">
                                    <label class="control-label">MD GROUP</label>
                                      <input type="text" class="form-control"  readonly
                                       value="<?php echo $group ; ?>"
                                      >
                                    </div>
                </div>
  
 
                <div class="form-group if-comment">
                                  <div class="col-sm-5">
                                                   <label class="control-label">Purpose</label>
                                                   <input type="text" class="form-control" readonly
                                                          value="<?php echo $purpose ; ?>"
                                                         >
                                  </div>

                                  <div class="col-sm-6">
                                    <label class="control-label">COMMENT</label>
                                      <textarea rows="3" class="boxsizingBorder"
                                        readonly
                                        ><?Php echo $comment ; ?></textarea>
                                    </div>
                </div>
            
 
                <div id="idid" hidden><?Php echo $event_id; ?></div>
 
<?Php      
         

 
                    $remarks = $kasm['remarks'];
                    $date_checked = $kasm['date_checked'];

                    if ($remarks) {
                       
                    
?>
                 <div class="form-group">
     
                  <div class="col-sm-8">
                  <label class="control-label">REMARKS</label>
                 <textarea rows="4" class="boxsizingBorder" readonly ><?php echo "DATE CHECKED: $date_checked &#10; &#10;". $remarks  ; ?></textarea>
                  </div>
                </div>
                   <?Php } ?>
           <div class="modal-footer">
            <button type="button" class="btn btn-default antoclose2" data-dismiss="modal"><i class="fa fa-ban"></i> Close</button>
 
 
                <div class="update-id" ></div>
            </div>



     
 