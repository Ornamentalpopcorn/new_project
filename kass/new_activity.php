<?Php include("../includes/session.php") ; ?> 

<?php 
$username = $_SESSION['username'] ;
$delete = mysqli_query($conn,
	"DELETE FROM activity_temp
	WHERE username = '$username'
	");

$id = $_GET['id'] ;

$md_info = mysqli_fetch_assoc(mysqli_query($conn,
  $s="SELECT DISTINCT md_name,area, md_group, position,  agenda, category
  FROM activity
  WHERE action_id = '$id'
  ") );

// $select_activity_md = mysqli_query($conn,
// 	"SELECT main,sub,spec
// 	FROM activity_md_list
// 	WHERE activity_id = '$id'
// 	");

// while ($row_activity_list = mysqli_fetch_assoc($select_activity_md) ) {
// 	 $main = $row_activity_list['main'];
// 	 $sub = $row_activity_list['sub'];
// 	 $spec = $row_activity_list['spec'];

// 	 $insert = mysqli_query($conn,
// 	 	"INSERT INTO activity_temp
// 	 	VALUES ('',
// 	 	'$username',
// 	 	'$main',
// 	 	'$sub',
// 	 	'$spec')
// 	 	");

// }


$md = $md_info['md_name'] ; 
$area = $md_info['area'] ;
$group = $md_info['md_group'] ;
$category = $md_info['category'] ;
$agenda = $md_info['agenda'] ;
 
?>
  <form  class="form-horizontal calender" role="form">
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
                                    <input type="text" class="form-control" id="md"  readonly
                                    value="<?php echo $md ; ?>"
                                    >
                                  </div>

                                    <div class="form-group">
                                                <div class="col-sm-3">
                                                <label class="control-label">AREA</label>
                                                  <input type="text" class="form-control"  id="area" readonly
                                                   value="<?php echo $area ; ?>"
                                                  >
                                                </div>

                                              <div class="col-sm-2">
                                              <label class="control-label">MD GROUP</label>
                                                <input type="text" class="form-control"  id="group-md" readonly
                                                 value="<?php echo $group ; ?>"
                                                >
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


<?Php }  ?>
  

          

<?php 

if ($category == "FIELD") {

?>

<!--                 <div class="form-group">
                  <label class="col-sm-3 control-label">MD Name</label>
                  <div class="col-sm-9">
                   
               	<input type="text" class="form-control" id="md"  value="<?Php echo $md; ?>" readonly />
  
                  </div>
                </div>

                 <div class="form-group">
                  <label class="col-sm-3 control-label">Area</label>
                          <div class="col-sm-9">
 
 
                                          <input type="text" readonly class="form-control" id="area" name="md-area" value="<?php echo $area; ?>">
 
                          </div>
                </div>

                <div class="form-group">
                  <label class="col-sm-3 control-label">Class</label>
                          <div class="col-sm-9">
                    
                                        <input type="text" readonly class="form-control" id="group-md"   value="<?php echo $group ; ?>">
 
                          </div>
                </div> -->

<?Php
	 
} else {

?>

<!--                 <div class="form-group">
                  <label class="col-sm-3 control-label">Agenda</label>
                  <div class="col-sm-9">
                   
               	<input type="text" class="form-control" id="agenda"  value="<?Php echo $agenda; ?>" readonly />
  
                  </div>
                </div>
 -->
<?php
	
}

 

$select_activity_md = mysqli_query($conn,
	"SELECT main, sub, spec
	FROM activity_md_list
	WHERE activity_id = '$id'
	");

	while ($row = mysqli_fetch_assoc($select_activity_md)) {
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
                                                                               <button type='button' class='btn btn-danger new-delete-temp'
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


                </div>
</div>
</div>

           <div class="modal-footer">
               <button type="button" 
               class="btn btn-success 
               pull-right activity-btn"
               data-target="#kass-newObjective"
               data-toggle="modal"

               ><i class="fa fa-plus"></i> Add Objective</button>
              </div>


   </form>

 <script type="text/javascript">
     $( function() {
       $( ".datepicker" ).datepicker({ minDate: 1  });
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