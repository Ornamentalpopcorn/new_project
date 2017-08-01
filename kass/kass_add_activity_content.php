<?Php include('../includes/session.php');  

$username = $_SESSION['username'] ;
$user_id = $_SESSION['id'] ;
$employee_name = $_SESSION['name'] ;
$position = $_SESSION['position'] ;

?>

            <div id="testmodal" style="padding: 5px 20px;">
              <form id="antoform" class="form-horizontal calender" role="form">


                   <div class="form-group">
  
                       <div class="datePairDate"> 
                      
                                                    <div class="col-md-2"> 
                                                              <label class="control-label">From</label>
                                                              <input type="text" class="time start form-control" placeholder="Ex. 8:00 AM" /> 
                                                    </div>        
                               
                                                      <div class="col-md-2">
                                                                <label class="control-label">To</label>
                                                                <input type="text" class="time end form-control" placeholder="Ex. 12:00 PM"/>
                                                      </div>                
                      
                      </div>


                        <div class="col-sm-2">

                                                      <label class="control-label">Category</label>
                                                     
                                                      <select class="form-control"
                                                      name="category"
                                                      id="category"
                                                      >
                                                                      <optgroup label="Select Category"> 
                                                                        <option value='FIELD' selected>FIELD</option>
                                                                        <option value='OFFICE' >OFFICE</option>
                                                      </select>
           
                          </div>

                            <div id="field">

                                         
                                            <div class="col-sm-2">
                                            <label class="control-label">MD Name</label>
                                            
                                                      <select class="form-control"
                                            name="md"
                                            id="md"
                                            >
                                                            <optgroup label="Select MD">
                                                            <?Php 
                                                            $select_kasm_md = mysqli_query($conn,
                                                              $s="SELECT DISTINCT md_name
                                                              FROM accounts_md
                                                              WHERE kass = '$employee_name'
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
                                                              echo"<option value='$cc' selected>$cc</option>" ;
                                                            ?>
                                            </select>
                            
                                            </div>
                                     
                                     
                                                    <div class="col-sm-2">
                                                           <label class="control-label">Area</label>

                                                                  <div id="md-area">
                                                                    
                                                                  <?Php 
                                                  
                                                                    $selectArea = mysqli_fetch_assoc(mysqli_query($conn,
                                                                      "SELECT DISTINCT area
                                                                      FROM accounts_md
                                                                      WHERE md_name = '$cc'
                                                                      ") )


                                                                    ?>
                                                                    <input type="text" readonly class="form-control areaaa" id="area" name="md-area" value="<?php echo $selectArea['area'] ; ?>">

                                                                  </div>

                                                    </div>
                                    

                                     
                                                    <div class="col-sm-2">
                                                            <label class="control-label">Class</label>
                                             
                                                                <div id="md-group">
                                                                  
                                                                <?Php 
                                                
                                                                  $selectArea = mysqli_fetch_assoc(mysqli_query($conn,
                                                                    "SELECT DISTINCT md_group
                                                                    FROM accounts_md
                                                                    WHERE md_name = '$cc'
                                                                    ") )


                                                                  ?>

                                                                  <input type="text" readonly class="form-control group-md" id="group-md"   value="<?php echo $selectArea['md_group'] ; ?>">

                                                                </div>

                                                    </div>
                                        
                           </div>

                           <div id="office" style="display:none;">
                                          <div class="form-group">
                                            <div class="col-sm-5">
                                            <label class="control-label">Agenda</label>
                                     
                                            <select class="form-control"
                                            name="md"
                                            id="agenda" 
                                            >
                                                            <optgroup label="Select Agenda">
                                                            <?Php 
                                                            $select_category = mysqli_query($conn,
                                                              $s="SELECT DISTINCT agenda
                                                              FROM office_work 
                                                              ORDER BY agenda ASC
                                                              ");

                                                            $rows = mysqli_num_rows($select_category);
                                                            $count = 1;
                                                            while ($row_category = mysqli_fetch_assoc($select_category) ) {
                                                              $categ = strtoupper($row_category['agenda']) ;

                                                                     if ($count++ != $rows) {
                                                                     echo"<option value='$categ' selected>$categ</option>" ; 
                                                                     } else {
                                                                        echo"<option value='$categ'>$categ</option>" ;   
                                                                     }
                                                            }
                                                     
                                                            ?>
                                            </select>

                                              <input type="text" readonly class="form-control group-md" id="group-md" name="md-group" value="<?php echo $selectArea['md_group'] ; ?>">

                                      

                                            </div>
                                        </div>

                           </div>

                  
                  </div>


                  <div class="form-group">
                  <div class="col-sm-2">
                  <!-- <label class="control-label">Category</label> -->
                 
<!--                   <select class="form-control"
                  name="category"
                  id="category"
                  >
                                  <optgroup label="Select Category"> 
                                    <option value='FIELD' selected>FIELD</option>
                                    <option value='OFFICE' >OFFICE</option>
                  </select> -->
   
                  </div>
                  <div class="col-sm-12">
                 
 
   
                  </div>
                </div>
  
<div id="field2"> 
                 <div class="form-group">
                    <div class='aa-objective'>
                      
                                                    <table class="table table-bordered"
                                                          style="  text-align:center;"
                                                    >
                                                      <tr>
                                                          <td colspan="3">NO OBJECTIVE YET</td>

                                                      </tr>

                                                    </table>

                    </div>
                  </div>

<br>
<br>
 


         <div class="form-group">
               <button type="button" 
               class="btn btn-success 
               pull-right activity-btn"
               data-target="#newObjective"
               data-toggle="modal"

               ><i class="fa fa-plus"></i> Add Objective</button>
        </div>
              </form>


            </div>