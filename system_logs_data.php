<?php require("includes/session.php") ;  
  $name = $_SESSION['name'] ;
// storing  request (ie, get/post) global array to a variable  
$requestData= $_REQUEST;


$columns = array( 
// datatable column index  => database column name
	0 =>'user', 
	1 => 'action_executed',
	2=> 'date_executed', 
	3=> 'time_stamp' 
);


// DATE_FORMAT(STR_TO_DATE(time_stamp,'%m/%d/%Y %h:%i:%s'), '%m/%d/%Y %h:%i:%s %p' ) as

// getting total number records without any search
$sql = "SELECT user, action_executed, date_executed,  time_stamp ";
$sql.=" FROM logs " ;
// $sql .="WHERE user IN (
// 	SELECT DISTINCT kass 
// 	FROM accounts_kass
// 	WHERE kasm = '$name'
// 	)";
$sql .= " ORDER BY ID DESC";

$query=mysqli_query($conn, $sql) or die("kass-grid-data.php: get employees");
$totalData = mysqli_num_rows($query);
$totalFiltered = $totalData;  // when there is no search parameter then total number rows = total number filtered rows.

// DATE_FORMAT(STR_TO_DATE(time_stamp,'%m/%d/%Y %h:%i:%s'), '%m/%d/%Y %h:%i:%s %p' ) as
$sql = "SELECT user, action_executed, date_executed, 
	 time_stamp ";
$sql.=" FROM logs ";
// $sql .="WHERE user IN (
// 	SELECT DISTINCT kass 
// 	FROM accounts_kass
// 	WHERE kasm = '$name'
// 	)"; 
if( !empty($requestData['search']['value']) ) {   // if there is a search parameter, $requestData['search']['value'] contains search parameter
	$sql.=" AND ( user LIKE '%".$requestData['search']['value']."%' ";    
	$sql.=" OR action_executed LIKE '%".$requestData['search']['value']."%' ";
	$sql.=" OR time_stamp LIKE '%".$requestData['search']['value']."%' ";  

	$sql.=" OR date_executed LIKE '%".$requestData['search']['value']."%' )";
}
$query=mysqli_query($conn, $sql) or die("kass-grid-data.php: get employees");
$totalFiltered = mysqli_num_rows($query); // when there is a search parameter then we have to modify total number filtered rows as per search result. 

 $sql.= " ORDER BY ". $columns[$requestData['order'][0]['column']]."   ".$requestData['order'][0]['dir']."  LIMIT ".$requestData['start']." ,".$requestData['length']."   ";
//$sql.=  "  LIMIT ".$requestData['start']." ,".$requestData['length']."   ";
 

/* $requestData['order'][0]['column'] contains colmun index, $requestData['order'][0]['dir'] contains order such as asc/desc  */	
$query=mysqli_query($conn, $sql) or die("kass-grid-data.php: get employees");

$data = array();
while( $row=mysqli_fetch_array($query) ) {  // preparing an array
	$nestedData=array(); 

	$nestedData[] = $row["user"];
	$nestedData[] = $row["action_executed"];
	$nestedData[] = $row["date_executed"]; 
	// $sync_date =	 $row["time_stamp"];
	// $sync_date =	date_create($sync_date );
	// $sync_date = 	date_format($sync_date ,"n/d/Y H:i:s a"); 
	// $nestedData[] = $sync_date ; 
	 $nestedData[] = $row["time_stamp"] ; 
	
	$data[] = $nestedData;
}



$json_data = array(
			"draw"            => intval( $requestData['draw'] ),   // for every request/draw by clientside , they send a number as a parameter, when they recieve a response/data they first check the draw number, so we are sending same number in draw. 
			"recordsTotal"    => intval( $totalData ),  // total number of records
			"recordsFiltered" => intval( $totalFiltered ), // total number of records after searching, if there is no searching then totalFiltered = totalData
			"data"            => $data   // total data array
			);

echo json_encode($json_data);  // send data as json format

?>
