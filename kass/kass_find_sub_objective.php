        <?php  require("../includes/session.php") ; ?>

<?Php 

$main_objective = $_GET['main_objective'] ;
    
$m = mysqli_fetch_assoc($count=mysqli_query($conn,
  $s="SELECT DISTINCT sub_OBJECTIVE 
  FROM objectives 
  WHERE main_objective_code = '$main_objective'
  AND sub_objective != ''
  ") );
 
    if (mysqli_num_rows($count) > 0) {
    // if ($m['c'] > 0) {
      
?>
    
       <label class="col-offset-sm-4 control-label" >Sub-Objective</label>
              <select class="form-control"
                  name="s_objective"
                  class="sub-objective"
                  >
                                  <optgroup label="Select Sub-Objective">
                                  <?Php 
                                  $selectClass = mysqli_query($conn,
                                    $s="SELECT DISTINCT sub_objective, sub_objective_code
                                    FROM objectives 
                                    WHERE main_objective_code = '$main_objective'
                                    GROUP BY sub_objective
                                    ORDER BY sub_objective
                                    ");

                                  $ck = 1;
                                  while ($row = mysqli_fetch_assoc($selectClass) ) {
                                    $c = $row['sub_objective'] ; 
                                    $code = $row['sub_objective_code'] ;
                                    if ($ck++ == 1) {
                                        $cc = $row['sub_objective_code'] ;
                                     }   
                                     echo"<option value='$code'>$c</option>" ;
                                  }

                                  ?>
                  </select>

                   <div class="col-sm-10">
      
                        <div class='check-sub-specific'>
                          
                    <?Php 

                 $select_sub = mysqli_fetch_assoc(mysqli_query($conn,
                  $s="SELECT sub_objective
                  FROM objectives
                  WHERE  sub_objective_code = '$cc'
                  ") );
        
                $sub_obj = $select_sub['sub_objective'];

                   if (strpos($sub_obj, "(") !== false || strpos($sub_obj, "__") !== false){

                            ?>
                         
                         <!-- <div class="form-group"> -->
                              <div class="col-sm-12">
                              <br>
                                        SPECIFY SUB-OBJECTIVE
                                      <input 
                                      class="form-control"
                                      type="text" id="subobjective-related-activity" placeholder="Ex. 1/1/2017" />
                                      </div>
                              <!-- </div> -->
                        </div>
      
                            <?Php
                    } 
                    ?>
 
                </div>

<?Php } ?>
 

