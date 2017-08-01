        <?php  require("../includes/session.php") ; ?>

<?Php 

$sub_objective = trim($_GET['sub_objective']) ;
   
     $selectClass = mysqli_query($conn,
                                    $s="SELECT DISTINCT specific_objective, specific_objective_code
                                    FROM objectives 
                                    WHERE sub_objective_code = '$sub_objective'
                                    AND specific_objective != ''
                                    GROUP BY specific_objective
                                    ORDER BY specific_objective
                                    ");
 
        if (mysqli_num_rows($selectClass) > 0) {
                                     
                              
?>
  <label class="col-offset-sm-4 control-label" >SPECIFIC ACTIVITY</label>
              <select class="form-control"
                  name="s_objective"
                  id="specific-objective"
                  >
                                  <optgroup label="Select SPECIFIC ACTIVITY">
                                  <?Php 

                                  while ($row = mysqli_fetch_assoc($selectClass) ) {
                                    $c = $row['specific_objective'] ; 
                                    $code = $row['specific_objective_code'] ; 
                                     echo"<option value='$code'>$c</option>" ;
                                  }

                                  ?>
                  </select>
<?Php 
                                
                              if (strpos($c, "(") !== false || strpos($c, "__") !== false){
                              
                              ?>
                              <!-- <div class="form-group"> -->
                              <div class="col-sm-12">
                              <br>
                                        SPECIFY SPECIFIC ACTIVITY
                                      <input 
                                      class="form-control related-activity"
                                      id="related-activity"
                                      type="text"  placeholder="Ex. 1/1/2017" />
                                      <!-- </div> -->
                              </div>
                              <?Php      
                              
                              } else {
                            ?>

                              <?Php
                              }

      }  else {

                $select_sub = mysqli_fetch_assoc(mysqli_query($conn,
                  $s="SELECT sub_objective
                  FROM objectives
                  WHERE  sub_objective_code = '$sub_objective'
                  ") );
             
                $sub_obj = $select_sub['sub_objective'];

                     if (strpos($sub_obj, "(") !== false || strpos($sub_obj, "___") !== false){
                            ?>
                               <!-- <div class="form-group"> -->
                              <div class="col-sm-12">
                              <br>
                                        SPECIFY SUB-OBJECTIVE
                                      <input 
                                      class="form-control  "
                                      id="subobjective-related-activity"
                                      type="text"  placeholder="Ex. 1/1/2017" />
                                      </div>
                              <!-- </div> -->
                            <?Php
                    }

      }

?>
 

