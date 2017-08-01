 <?php  require("../includes/session.php") ; ?>

<?Php
 
$username = $_SESSION['username'] ;
$name = $_SESSION['name'] ;
$user_id = $_SESSION['id'] ;

$id = $_GET['id'];
$md = $_GET['md'];
$time_start = $_GET['time_start'];
$time_end = $_GET['time_end'];
$date = $_GET['date'];
$remarks = mysqli_real_escape_string($conn,$_GET['remarks'])  ;
$dateNow = date('n/d/Y h:i:s a') ;
 
$select_kasm = mysqli_fetch_assoc(mysqli_query($conn,
	"SELECT DISTINCT kasm 
	FROM accounts_md
	WHERE kass = '$name'
	") );
$kasm = $select_kasm['kasm'] ;
 
$select = mysqli_query($conn,
	$s="SELECT main,sub,spec
	FROM activity_temp
	WHERE username = '$username'
	 
	");
 
$select_md = mysqli_fetch_assoc(mysqli_query($conn,
	$s="SELECT md_name, area, md_group ,name, category, agenda, time_start, time_end, date
	FROM activity
	WHERE action_id = '$id'
	") );
  
$select_event_id = mysqli_fetch_assoc(mysqli_query($conn,
	$s="SELECT COUNT(DISTINCT event_id) as event_id
	FROM activity
	WHERE username = '$username'
	") ); 
$event_id = $select_event_id['event_id'] + 1;
$event_id = $user_id . "-" . $event_id;

$md_name = $select_md['md_name'];
$area = $select_md['area'];
$md_group = $select_md['md_group']; 
$kass = $select_md['name']; 
$agenda = $select_md['agenda']; 
$category = $select_md['category']; 
$prev_date = $select_md['date']; 
$prev_start = $select_md['time_start']; 
$prev_end = $select_md['time_end']; 


$dateNow = date('n/d/Y h:i:s a') ;

$check_if_something_is_done = mysqli_query($conn,
	"SELECT is_checked
	FROM activity_md_list
	WHERE is_checked = 'done'
	AND activity_id = '$id'
	");

if (mysqli_num_rows($check_if_something_is_done) <= 0) {
 
	$update = mysqli_query($conn,
		$s="UPDATE activity
		SET status = 'rescheduled'
		WHERE action_id = '$id' 
		") ;

}
	 
$update = mysqli_query($conn,
	$s="UPDATE activity_md_list
	SET for_approval = 'previous activity',
	is_checked = 'rescheduled'
	WHERE activity_id = '$id'
	AND is_checked = 'pending'
	");

$count = 1;
while ($row = mysqli_fetch_assoc($select) ) {
	 $main = $row['main'];
	 $sub = $row['sub'];
	 $spec = $row['spec'];
 
		if ($count++ == 1) {

			// SELECT COUNT(DISTINCT id) as i
			 $get_max_id = mysqli_fetch_assoc(mysqli_query($conn,
			 	"SELECT MAX(id) as i
				FROM activity
				WHERE username = '$username'
			 	") );
			 $max_id = $get_max_id['i'] + 1 ;
			$action_id = $user_id . "-" . $max_id;

			 $insert_new = mysqli_query($conn,
			$s="INSERT INTO activity
			VALUES ('',
			'$action_id',
			'$username',
			'$event_id',
			'$username', 
			'$kass',
			'KASS',
			'$md_name',
			'$area',
			'$md_group',
			'$time_start',
			'$time_end',
			'$date',
			'$dateNow',
			'normal',
			'',
			'$category',
			'$agenda',
			'activity',
			'',
			'' 
			)
			");
		  
		}

		$insert_new = mysqli_query($conn,
		$s="INSERT INTO activity_md_list
		VALUES ('',
		'$action_id',
		'$username',
		'$main',
		'$sub',
		'$spec',
		'pending',
		'',
		'',
		'',
		'$agenda',
		''
		)
		");
 	 	 
}


 
// $delete_temp = mysqli_query($conn,
// 	"DELETE FROM activity_temp
// 	WHERE username = '$username'
// 	");

$insert_logs = mysqli_query($conn,
	$s="INSERT INTO logs
	VALUES ('',
	'$name',
	'RESCHEDULE ACTIVITY OF $md_name , $prev_date ($prev_start - $prev_end) TO $date ($time_start - $time_end) REASON: $remarks',
	'$dateNow',
	''
	)
	");
echo $s;
?>