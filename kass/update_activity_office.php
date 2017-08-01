        <?php  require("../includes/session.php") ; ?>

<?Php 

$action_id = $_GET['id'];
$remarks = $_GET['remarks'];
 $status = $_GET['status'] ;

$username =   $_SESSION['username'] ;
$name =         $_SESSION['name'] ;
 
$date = date('n/d/Y h:i:s a') ;
 
$update = mysqli_query($conn,
	$s="UPDATE activity_md_list
	SET is_checked = '$status',
	remarks = '$status : $remarks',
	date_checked = '$date'
	WHERE activity_id = '$action_id'
	");
 
// $select = mysqli_fetch_assoc(mysqli_query($conn,
// 	"SELECT DISTINCT activity_id
// 	FROM activity_md_list
// 	WHERE id = '$id'
// 	") ) ;
// $action_id = $select['activity_id'] ;

$get_md_details = mysqli_fetch_assoc(mysqli_query($conn,
	"SELECT DISTINCT md_name, date, time_start, time_end, category
	FROM activity
	WHERE action_id = '$action_id'
	") );
 

	$md_name = $get_md_details['md_name'];
	$d= $get_md_details['date'];
		$time_start= $get_md_details['time_start'];
			$time_end= $get_md_details['time_end'];
			$category= $get_md_details['category'];
 

 if ($status == "done") {

	$insert = mysqli_query($conn,
		"INSERT INTO logs
		VALUES ('',
		'$name',
		'DONE: OFFICE ACTIVITY UPDATED KASS EVENT WITH FOR $md_name $d ($time_start - $time_end) REMARKS: $remarks',
		'$date',
		''
		) 
		") ;

} else {

	$insert = mysqli_query($conn,
		"INSERT INTO logs
		VALUES ('',
		'$name',
		'DEVIATED: OFFICE ACTIVITY UPDATED KASS EVENT WITH FOR $md_name $d ($time_start - $time_end) REMARKS: $remarks',
		'$date',
		''
		) 
		") ;


} 			

        ?>