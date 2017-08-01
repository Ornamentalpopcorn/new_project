<?php  require("../includes/session.php") ; ?>

<?Php 

$start = $_GET['time_start'];
$end = $_GET['time_end'];
$md = $_GET['md'];
$date = $_GET['date'];

// print_r($_GET);

$check_schedule = mysqli_query($conn,
 	$s="SELECT kass, md_name
 	FROM activity
 	WHERE time_start >= '$start' 
 	AND time_start <= '$end'
 	AND date ='$date'
 	AND md_name = '$md'
 	AND status = ''
 	");
 
if (mysqli_num_rows($check_schedule) >= 1) {
	  $get_kass = mysqli_fetch_assoc($check_schedule) ;
	  $kass = $get_kass['kass'];

	  echo "MD ALREADY HAS APPOINT \n WITH KASS: " . strtoupper($kass);

	  ?>
	  <div id="kass"><?php echo strtoupper($kass) ; ?></div>
	  <script type="text/javascript">
	  var kass = $("#kass").text();

	  	     swal("" + kass , "MD ALREADY HAS APPOINTMENT \n WITH KASS:", "error");    

	  </script>
	  <?Php
} else {

	 $check_schedule_kasm = mysqli_query($conn,
 	"SELECT md_name
 	FROM activity_kasm
 	WHERE time_start >= '$start' 
 	AND time_end <= '$end'
 	AND date ='$date'
 	AND md_name = '$md'
 	");

	 if (mysqli_num_rows($check_schedule_kasm) >= 1 ) {
	 		  $kass = $get_kass['kass'];

			  echo "MD ALREADY HAS APPOINT \n WITH KASS: " . strtoupper($kass);

			  ?>
			  <div id="kass"><?php echo strtoupper($kass) ; ?></div>
			  <script type="text/javascript">
			  var kass = $("#kass").text();

			  	     swal("" + kass , "MD ALREADY HAS APPOINTMENT \n WITH KASM:", "error");    

			  </script>
			  <?Php
	 }  
}

?>