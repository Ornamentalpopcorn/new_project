<?php include('includes/session.php'); 

 // if (isset($_GET['Confirm'])) {
 	 
	if ($_GET['Confirm'] == "Au3333vv!_ac33hJk") {

	} else {
		?>
		<script type="text/javascript">
			window.location.href = 'index.php';

		</script>
		<?Php 	
	}
	?>
 
	<?Php
 // } else {
		?>
		<!-- <script type="text/javascript"> -->
			<!-- window.location.href = 'index.php'; -->

		<!-- </script> -->
		<?Php 
 // }
 
 
$username = $_SESSION['username'];
$name = $_SESSION['name'];
$position = $_SESSION['position'];
$time_stamp = date('Y-m-d H:i:s', time());
date_default_timezone_set('Asia/Manila');
 
$p = array("KASM", "KASS", "KASH", "VIEW") ;

if (!in_array($position, $p) ) {
       header("location: logout.php") ;

}

  $connected =  @fsockopen('www.google.com', 80);
if(!$connected){
	?>
	<script type="text/javascript">
		 
		  alert('UNABLE TO SYNC, SOMETHING WENT WRONG');
		  window.location.href = 'index.php';
	</script>
	<?Php
}
 
?>

<!DOCTYPE html>
<html>
<head>
<title>KASS Calendar | SYNC</title>
   <link rel="shortcut icon" href="dist/img/icon.png">
     <meta content="width=device-width, initial-scale=0, maximum-scale=1" name="viewport">
<link href="build/css/bootstrap.css" rel="stylesheet">
  
  <!-- Theme style -->
  <link rel="stylesheet" href="build/css/AdminLTE.min.css"> 
    
  <link rel="stylesheet" href="build/css/skins/skin-blue-light.min.css">  
</head>
<body class="hold-transition skin-blue-light  sidebar-collapse" style="background-color:#f9fafc;">
 

<div class="wrapper" style="left:40%; top:25%">
<img src="images/sync.gif">
</div>

 <div hidden>
				<div id="user" ><?php echo $username ;?></div>
				<div id="name"  ><?php echo $name ;?></div>
				<div id="position"  ><?php echo $position ;?></div>
				<!-- <a href="#">CLICK ME</a> -->
 
				<!-- OFFLINE -->
				<!-- <br> -->
				<!-- <br> -->
				<!-- <h1>OFFLINE</h1> -->
				<section id='offline'   ></section>
				<div ></div>

				<!-- ONLINE -->
				<!-- <br> -->
				<!-- <br> -->
				<!-- <h1>ONLINE</h1> -->
				<span id='online'  ></span>

				<!-- GET ONLINE UPDATE -->
				<!-- <br> -->
				<!-- <br> -->
				<!-- <h1>ONLINE UPDATE</h1> -->
				<article id='online-update'  ></article>

</div>
				
  
<?Php require("includes/js.php") ; ?>

</body>
</html>
 
<script type="text/javascript">
	
// $("a").click(function(){
$(document).ready(function() {

 	var user = $("#user").text();
 	var name = $("#name").text();
 	var position = $("#position").text();
 	var dt = new Date();

	var currentdate = new Date(); 
	 // var time_stamp =  currentdate.getFullYear()   + "-"
  //               +  (currentdate.getMonth()+1)    + "-" 

  //               + currentdate.getDate() + " " +

  //               + currentdate.getHours() + ":"  

  //               + currentdate.getMinutes() + ":" 

  //               + currentdate.getSeconds();

        	 var time_stamp =   (currentdate.getMonth()+1)  + "/"
                + currentdate.getDate()   + "/" 
                + currentdate.getFullYear() + " " +
                + currentdate.getHours() + ":"  
                + currentdate.getMinutes() + ":" 
                + currentdate.getSeconds();
           

 	// var time_stamp = $("#time_stamp").text();
 	 var check_get = ""; 
 	 var cmd = ""; 	 

 		// OFFLINE CREATION OF FILE
	           ajax_request = $.ajax({
	            type: "POST",
	            url: "sync/offline.php", 
	            cache: true,
	            async: false,
            	                data:  { 
	                                'time_stamp': time_stamp, 
	                },
	            success: function (data) {
	              	// alert('db created');
	              	  $("#offline").html(data); 
            	 	cmd = $(".sql-textarea").val();
	            }

	        });
  	 

            		// ONLINE FETCHING OF FILE
	           ajax_request = $.ajax({
	            type: "POST",
	            //url: "sync/sync_online.php", 
	            url: "http://kass-calendar.mutants.club/main/sync_data.php",  

              	async: false,
	                data:  { 
	                                'user': user,
	                                'name' : name,
	                                'position' : position,
	                                'time_stamp' : time_stamp,
	                                'cmd' : cmd
	                },	            
	            cache: true,
	            success: function (data) {
	             
	            	 $("#online").html(data);
	       
	            	 check_get = $("#update-sql").text() ;
	            } ,
	              error: function (xhr, ajaxOptions, thrownError) {
	                  // swal("Something Went Wrong !", "Please try again", "error");
	                  // alert('UNABLE TO SYNC, NO INTERNET CONNECTION') ;
	                  alert('UNABLE TO SYNC, SOMETHING WENT WRONG');
	                   window.location.href = 'index.php';
	              }

	        });
	       
	        // GET NEW ACTIVITIES MADE BY KASM/KASH 
	       if (check_get != 0)  {
 
		           ajax_request = $.ajax({
		            type: "POST",
		            url: "sync/get_online_update.php", 
		                data:  { 
		                                'user': user,
		                                'name' : name,
		                                  'position' : position,
		                                 'time_stamp' : time_stamp,
		                                'cmd' : check_get
		                },	            
		            cache: true,
		            success: function (data) {
		      	 
		            	$("#online-update").html(data);
		            	window.location.href = 'index.php';
		            }

		        });	           
	       }


});

</script>

<?Php

// DELETING PREVIOUS DATA FROM ONLINE SERVER
 
	//  $connected =  @fsockopen('www.google.com', 80);
	// if($connected){
	// 	//Clear Data First
	// 	// $mysqli -> query("TRUNCATE direct_database");
	// 	// $mysqli -> query("TRUNCATE line_db");
	// 	// $mysqli -> query("TRUNCATE mst_database");
	// 	// $mysqli -> query("TRUNCATE ssd_database");
	// 	// $mysqli -> query("DELETE FROM directsales_data WHERE salesdata_month='$month' AND salesdata_year='$year'");
	// 	// $mysqli -> query("DELETE FROM mercury_data WHERE merc_month='$month_previous' AND merc_year='$year'");
	// 	// $mysqli -> query("DELETE FROM south_star WHERE south_month='$month_previous' AND south_year='$year'");
		 
	// 	// $sql = file_get_contents('http://wizard2017.bellkenz.com/WIZARD-ADMIN/backup/backup.sql');
	// 	// $test_sql = explode(";", $sql);
	// 	// foreach($test_sql as $sql1){
	// 	// 	if ($mysqli->multi_query($sql1)) {
	// 	// 		//$mysqli->close();
	// 	// 	} 
	// 	// }
	// 	echo "<div class='callout callout-success'><i class='fa fa-check-square-o'></i> Synchronization Successful!</div>";
	// }else{
	// 	echo "<div class='callout callout-danger'><i class='fa fa-exclamation-triangle'></i> Synchronization failed! Please check internet connection!</div>";
	// }

 


function backup_tables($host,$user,$pass,$name,$tables = '*')
{
	$return = "";
	$conn = mysqli_connect(DB_SERVER, DB_USER, DB_PASS, DB_NAME);

	// $link = mysqli_connect($host,$user,$pass);
	mysqli_select_db($conn,$host);
	
	//get all of the tables
	if($tables == '*')
	{
		$tables = array();
		$result = mysqli_query($conn, 'SHOW TABLES');
		while($row = mysqli_fetch_row($result))
		{
			$tables[] = $row[0];
		}
	}
	else
	{
		$tables = is_array($tables) ? $tables : explode(',',$tables);
	}
	
	//cycle through
	foreach($tables as $table)
	{
		 
		$result = mysqli_query($conn, $s= 'SELECT * FROM '.$table);
		$num_fields = mysqli_num_fields($result);
		 
		$return.= 'DROP TABLE '.$table.';';
		$row2 = mysqli_fetch_array(mysqli_query($conn, 'SHOW CREATE TABLE '.$table));
		$return.= "\n\n".$row2[1].";\n\n";
		
		for ($i = 0; $i < $num_fields; $i++) 
		{
			while($row = mysqli_fetch_array($result))
			{
				$return.= 'INSERT INTO '.$table.' VALUES(';
				for($j=0; $j < $num_fields; $j++) 
				{
					$row[$j] = addslashes($row[$j]);
					$row[$j] = preg_replace("\n","\\n",$row[$j]);
					if (isset($row[$j])) { $return.= '"'.$row[$j].'"' ; } else { $return.= '""'; }
					if ($j < ($num_fields-1)) { $return.= ','; }
				}
				$return.= ");\n";
			}
			// echo $return . "<br>";
		}
		$return.="\n\n\n";
	}
	
	//save file
	$handle = fopen('db-backup-'.time().'-'.(md5(implode(',',$tables))).'.sql','w+');
	fwrite($handle,$return);
	fclose($handle);
}

