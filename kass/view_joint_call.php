 <?Php   require("../includes/session.php") ; 
$action_id = $_GET['id'];
$username = $_SESSION['username'] ;

$select_date = mysqli_fetch_assoc(mysqli_query($conn,
	"SELECT date 
	FROM activity
	WHERE action_id = '$action_id'
	") );
$date = $select_date['date'];

$select_md = mysqli_query($conn,
	$s="SELECT DISTINCT time_start, time_end, md_name, 
	initial_remarks,
	final_remarks,
	overall_remarks,
	viewable, 
	status,
	action_id
	FROM activity_kasm_joint_call
	WHERE  action_id = '$action_id'
	ORDER BY time_start ASC
	");
 
 	if (mysqli_num_rows($select_md) > 0) {
 		  
 ?>
 	 
 	<div class="jc-kass" hidden><?php echo $kass; ?></div>
	<div class="col-md-4">
	<label class="control-label">DATE:</label>
 	 <input type="text" name="" class="form-control jc-date" readonly value="<?Php echo $date; ?>">

	</div>

          <table class="table table-striped table-bordered table-condensed table-jc-update" 
          style="width:100%"
          >
          <thead style="font-weight:bold; text-align:center;">
          	<th>TIME</th>
          	<th>MD NAME</th>
          	<th>INITIAL REMARK <br>(<i>PREVIOUS COMMENT / FEEDBACK OF MD</i>)</th>
          	<th>CONCERN / FEEDBACK OF MD <br>DURING JOINT CALL</th>
          </thead>
          <tbody style="text-align:center;">
          	
 <?Php

 	$checker = 0;
	while ($row = mysqli_fetch_assoc($select_md) ) {
		 $time_start = $row['time_start'] ;
		 $time_end = $row['time_end'] ;
		 $time = $time_start . " - " . $time_end;
		 $md = $row['md_name'] ;
		 $initial_remarks = $row['initial_remarks'] ;
		 $final_remarks = $row['final_remarks'] ;
		 $overall_remarks = $row['overall_remarks'] ;
		 $viewable = $row['viewable'] ;
		 $status = $row['status'] ; 
 		 
		 echo "<tr>";
		 echo "<td>$time</td>";
		 echo "<td>$md</td>";
		 echo "<td><textarea class='form-control' rows='4' readonly>$initial_remarks</textarea></td>";
		 echo "<td><textarea class='form-control'rows='4' readonly >$final_remarks</textarea></td>"; 
		 // <input type=\"checkbox\" class='chkchk' name='td' value=\"checked\" />&nbsp;
		 echo "</tr>";		

 
 
	}

 ?>
</tbody>
<tfoot>
	
 <tr>
 	<td colspan="2"></td> 
 	<td colspan="2"><p class="pull-left">Observed during joint call (<i>KNOWLEDGE, SKILLS, ATTITUDE of KASS):</i></p>
 
 	<textarea class='form-control' rows='5' id='overall-text' readonly><?php echo $overall_remarks ?></textarea>
 
 	</td>
 	</td>
 	<td></td>
 </tr>
</tfoot>
 </table>
 
<div class="asdf"></div>
           <div class="modal-footer">
            <button type="button" class="btn btn-default antoclose2" data-dismiss="modal"><i class="fa fa-ban"></i> Close</button>
 
            </div>


 <?php }   ?>

<style type="text/css">
	
th {
	text-align: center;
}

td {
	/*float: left;*/
	text-align: center;
	vertical-align: middle !important;
}

</style>