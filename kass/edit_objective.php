<?php  require("../includes/session.php") ;  

$id = $_GET['id'];

 ?>

                  <!-- <label class="col-sm-2 control-label"><p class="pull-left">OBJECTIVE</p></label> -->
                 <div class="col-sm-10">
                <div class='edit-id' hidden><?php echo $id; ?></div>
                <label class="control-label">Main Objective</label>
                <select class="form-control"
                  name="m_objective"
                  id="main-objective"
                  >
                                  <optgroup label="Select Objective">
                                  <?Php 
                                  $selectClass = mysqli_query($conn,
                                    "SELECT DISTINCT main_objective, main_objective_code
                                    FROM objectives 
                                    GROUP BY main_objective
                                    ORDER BY ID ASC
                                    ");

                                  $ca = 1;
                                  while ($row = mysqli_fetch_assoc($selectClass) ) {
                                    $c = $row['main_objective'] ; 
                                    $code = $row['main_objective_code'] ;

                                    if ($ca++ == 1) {
                                     echo"<option value='$code' selected>$c</option>" ;
                                        $cc = $code;
                                     }  else {
                                     echo"<option value='$code'>$c</option>" ;
                                      
                                     }
                                  }

                                  ?>
                  </select>
  

                </div>

                <br>
                 <hr>

            
                 <?Php 

                 if (mysqli_num_rows($selectClass) > 0) {
                    
              

                 ?>
                <div class="col-sm-10" id="sub-objective">
                  
                  <label class="control-label">Sub-Objective</label>
              <select class="form-control"
                  name="s_objective"
                   class="sub-objective"
                  >
                                  <optgroup label="Select Sub-Objective">
                                  <?Php 
                                  $selectClass = mysqli_query($conn,
                                    $s="SELECT DISTINCT sub_objective, sub_objective_code
                                    FROM objectives 
                                    WHERE main_objective_code = '$cc'
                                    GROUP BY sub_objective
                                    ORDER BY sub_objective
                                    ");

                                  while ($row = mysqli_fetch_assoc($selectClass) ) {
                                    $c = $row['sub_objective'] ; 
                                    $code = $row['sub_objective_code'] ; 
                                     echo"<option value='$code'>$c</option>" ;
                                  }

                                  ?>
                  </select>
             
                </div>
                <div class="col-sm-10">
                    <div id="specific-objective">
                      
                    <?Php 

                 $select_sub = mysqli_fetch_assoc(mysqli_query($conn,
                  $s="SELECT sub_objective
                  FROM objectives
                  WHERE  sub_objective_code = '$code'
                  ") );
             
                $sub_obj = $select_sub['sub_objective'];

                     if (strpos($sub_obj, "(") !== false || strpos($sub_obj, "____") !== false){
                            ?>
                               <div class="form-group">
                              <div class="col-sm-12"> 
                                           <label class="control-label">Specify Sub-Objective</label>
                                      <input 
                                      class="form-control"
                                      type="text" id="subobjective-related-activity" placeholder="Ex. 1/1/2017" />
                                      </div>
                              </div>
                            <?Php
                    }
                    ?>
 
                    </div>
                </div>




        <?Php } ?>

 
            

<style type="text/css">

label{
margin-top:10px;
}

</style>