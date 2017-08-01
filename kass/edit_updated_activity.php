 <?php  require("../includes/session.php") ;  
error_reporting(0);
$username = $_SESSION['username'];
$user_id = $_SESSION['id'] ;
$name = $_SESSION['name'] ;
$position = $_SESSION['position'] ;

$old_id = $_POST['id'];
 $date = $_POST['date'];
 $time_start = $_POST['time_start'];
 $time_end = $_POST['time_end'];
 $md = $_POST['md'];
 $area = $_POST['area'];
 $group = $_POST['group'];
 
$date_now = date('n/d/Y h:i:s a') ;

			$select_event_id = mysqli_fetch_assoc(mysqli_query($conn,
				"SELECT COUNT(DISTINCT event_id) as event_id
				FROM activity
				WHERE username = '$username'
				") );
			$d = $select_event_id['event_id'] ;
			$d = $d +  1;
			$event_id = $user_id . "-" . $d;

			$selectMax = mysqli_fetch_assoc(
				mysqli_query($conn,
				"SELECT MAX(id) as id
				FROM activity
				WHERE username = '$username'
				") ) ;

			$id = $selectMax['id'] + 1;

			if ($id == 0) {
				$id = 1;
			} 
			$action_id = $user_id . "-" . $id;

			$insert_activity = mysqli_query($conn,
				$s="INSERT INTO activity
				VALUES ('',
				'$action_id',
				'$username',
				'$event_id',
				'$username', 
				'$name',
				'$position',
				'$md',
				'$area',
				'$group',
				'$time_start',
				'$time_end',
				'$date',  
				'$date_now' ,
				'normal',
				'',
				'FIELD',
				'',
				'activity',
				'',
				''
				)
				");
 

$data_remarks = $_POST["remarks"];
$data_remarks   = json_decode("$data_remarks", true); // remarks

foreach ($data_remarks as $p) {
	if ($p) {
		$remark[] =mysqli_real_escape_string($conn, $p);
	}
}
 
 $select_activity_temp = mysqli_query($conn,
 	$s="SELECT *
 	FROM activity_temp_edit
 	WHERE username = '$username'
 	");
  
 $select_activity =  mysqli_fetch_assoc(mysqli_query($conn,
 	$s="SELECT md_name, date, time_start, time_end, area
 	FROM activity
 	WHERE username = '$username'
 	AND action_id = '$old_id'
 	") );
 	$old_md = $select_activity['md_name'];
 	$old_area = $select_activity['area'];
 	$old_date = $select_activity['date'];
 	$old_time_start = $select_activity['time_start'];
 	$old_time_end = $select_activity['time_end'];
   

$update = mysqli_query($conn,
	$s="UPDATE activity_md_list
	SET for_approval = 'previous activity'
	WHERE activity_id = '$old_id'
	");
  	  
$update = mysqli_query($conn,
	$s="UPDATE activity
	SET status = 'previous activity'
	WHERE action_id = '$old_id'
	"); 


$i = 0;
while ($row = mysqli_fetch_assoc($select_activity_temp) ) {
	 $main = $row['main'] ;
	 $sub = $row['sub'] ;
	 $sub = str_replace("0001" , "" , $sub);
	 
	 $spec = $row['spec'] ;
	 $spec = str_replace("0001" , "" , $spec);

	 $comment = trim($remark[$i]) ;
	 if (strlen($comment) > 0 ) {
	 	$stat = "done";  
	 } else {
	 	$stat = "pending";  
	 }
	 $insert_new = mysqli_query($conn,
	 	$s="INSERT INTO activity_md_list
	 	VALUES ('',
	 	'$action_id',
	 	'$username',
	 	'$main',
	 	'$sub',
	 	'$spec',
	 	'$stat',
	 	'$comment',
	 	'$date_now',
	 	'',
	 	'',
	 	''
	 	)
 		");
	   
	 $i++;
}

	 $updated = mysqli_query($conn,
	 	"INSERT INTO logs
	 	VALUES ('',
	 	'$name',
	 	'UPDATED ACTIVITY: MD : $old_md - $old_area ($old_date / $old_time_start - $old_time_end) <br> TO $md - $area ($date / $time_start - $time_end ) ',
	 	'$date_now',
	 	''
	 	)
	 	");

 ?>

