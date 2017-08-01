<?php  require("../includes/session.php") ; ?>

<?Php 

$username = $_SESSION['username'] ;
$user_id = $_SESSION['id'] ;
$name = $_SESSION['name'] ;
$dateNow = date('n/d/Y h:i:s a') 	;
$position = $_SESSION['position'] ; 

       $time_start = $_GET['time_start'];	
       $time_end = $_GET['time_end'];
       $md = $_GET['md'];
       $area = $_GET['area'];
       $group = $_GET['group'];
       $date = $_GET['date'];
       $category = $_GET['category'] ;
    
if ($category == "FIELD") {
	$agenda = "";	

  } else {
  	$agenda = $_GET['agenda'] ;
	$md = "";
	$area = "";
	$group = "";
 }	
       // $main_objective = $_GET['main_objective'];
       // $sub_objective = $_GET['sub_objective'];
       // $specific_objective = $_GET['specific_objective'];

//   $select_kass = mysqli_fetch_assoc(mysqli_query($conn,
//   	"SELECT DISTINCT kasm, kass
//   	FROM  accounts_md
//   	WHERE md_name = '$md'
//   	") );
 
// $kasm = $select_kass['kasm'];
// $kass = $select_kass['kass'];

$select_event_id = mysqli_fetch_assoc(mysqli_query($conn,
	"SELECT COUNT(DISTINCT event_id) as event_id
	FROM activity
	WHERE username = '$username'
	") );
$event_id = $select_event_id['event_id'] + 1;
$event_id = $user_id . "-" . $event_id;

	// SELECT COUNT(DISTINCT id) as id
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
	'$dateNow' ,
	'normal',
	'',
	'$category',
	'$agenda',
	'activity',
	'',
	''
	)
	");
  


if ($category == "FIELD") {
	 
	$select_user = mysqli_query($conn,
	"SELECT  main, sub, spec
	FROM activity_temp
	WHERE username = '$username'
	");

	while ($row = mysqli_fetch_assoc($select_user)) {
		$main = $row['main'];
		$sub = $row['sub'];
		$spec = $row['spec'];

		$insert = mysqli_query($conn,
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
		                '',
		                ''
			)
			") ;
		 
	}
	 		$insert_logs = mysqli_query($conn,
			"INSERT INTO logs
			VALUES ('',
			'$name',
			'FIELD ACTIVITY ADDED $date ($time_start - $time_end) MD: $md',
			'$dateNow',
			''
			)") ;

 
} else {

			$insert = mysqli_query($conn,
			$s="INSERT INTO activity_md_list
			VALUES ('',
			'$action_id',
			'$username',
			'',
			'',
			'',
			 'pending',
		                '',
		                '',
		                '',
		                '$agenda',
		                ''
			)
			") ;
		 

	 		$insert_logs = mysqli_query($conn,
			"INSERT INTO logs
			VALUES ('',
			'$name',
			'OFFICE ACTIVITY ADDED $date ($time_start - $time_end) AGENDA: $agenda',
			'$dateNow',
			''
			)") ;



}

$delete_temp = mysqli_query($conn,
	"DELETE  
	FROM activity_temp 
	WHERE username = '$username'
	");


 

?>