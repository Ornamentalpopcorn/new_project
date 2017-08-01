         <?php  require("../includes/session.php") ; ?>
         <?php 
         error_reporting(0);
        $username = $_SESSION['username'];
  
        // CHECK IF NEW ACTIVITY
        $new_activity = $_GET['new_activity'];
        if ($new_activity == "new") {
            $delete_class = "new-delete-temp";
           // $new_activity = "true";
        } elseif ($new_activity == "resched") {
            $delete_class = "new-delete-temp-resched";
        } else {
            $delete_class = "delete-temp";

        }


        $main = $_GET['main'];
        $select_main = mysqli_fetch_assoc(mysqli_query($conn,
        	$s= "SELECT main_objective 
        	FROM objectives
        	WHERE main_objective_code = '$main'
        	") );
        $main = $select_main['main_objective'] ;

        $sub = $_GET['sub']; 
        if ($sub != "0001") {
        	  
	        $select_sub = mysqli_fetch_assoc(mysqli_query($conn,
	        	$s= "SELECT sub_objective 
	        	FROM objectives
	        	WHERE sub_objective_code = '$sub'
	        	") );
	        $sub = $select_sub['sub_objective'] ;
	 
	        $sub_text = strtoupper($_GET['sub_text']);
      
	        if (strpos($sub, "(") !== false) {
	 
                          $sub2 = strstr($sub, '(', true);
                          $sub22 = strstr($sub, ')' );
                          $sub22 = str_replace(")", "", $sub22);
                          
                		  $sub_objective = $sub2 . " " . $sub22 . " " . $sub_text ;
              } elseif(strpos($sub, "_") !== false) { 

                    $sub = str_replace("_", "" ,$sub );
                    
                      $sub_objective = $sub . " "  . $sub_text ;

	        } else {
	        	   $sub_objective = $sub;
	        }
 
        } else {
        	$sub_objective = "";
        }
        
        $specific = $_GET['specific'];
         if ($specific != "0001") {
	        $select_specific = mysqli_fetch_assoc(mysqli_query($conn,
	    	$s="SELECT specific_objective 
	    	FROM objectives
	    	WHERE specific_objective_code = '$specific'
	    	") );
	        $specific = $select_specific['specific_objective'] ;
	 
	        $specific_text = strtoupper($_GET['specific_text']);
	        $specific_pos = strpos($specific, "(");
	        $specific = substr($specific, 0, $specific_pos);  

	        $specific_objective = $specific . " " . $specific_text ;


    } else {
		$specific_objective = "";
    }
 

        $insert = mysqli_query($conn,
        	$s="INSERT INTO activity_temp
        	VALUES ('',
        	'$username', 
        	'$main',
        	'$sub_objective',
        	'$specific_objective'
        	)
        	") ;
 
         ?>

 
	
<table class="table table-bordered table-hover table-condensed" style="  text-align:center;"   >
                                      <thead style="background-color:#337ab7; color:white;">
                                      <tr>
                                          <td>#</td>
                                          <td>MAIN OBJECTIVE</td>
                                          <td>SUB OBJECTIVE</td>
                                          <td>SPECIFIC ACTIVITY</td>
                                          <td>ACTION</td>
                                      </tr>	
                                      </thead>

                                      <tbody>
                                      <?php 
                                      $select = mysqli_query($conn,
                                      	"SELECT *
                                      	FROM activity_temp
                                      	WHERE username = '$username'
                                      	ORDER BY ID ASC
                                      	");
                                      $count = 1;
                                      while ($row = mysqli_fetch_assoc($select) ) {
                                        $id = $row['id'];

                                      	 $main = $row['main'];
                                      	 $sub= $row['sub'];

                                      	 $spec= $row['spec'];
                                      	 if ($spec == "0001") {
                                      	 	$spec = "";
                                      	 }
                                      	 if ($sub == "0001") {
                                      	 	$sub = "";
                                      	 }
                                         $sub = str_replace("0001", "", $sub);
                                         $spec = str_replace("0001", "", $spec);
                                      	 echo "<tr>";
                                      	 echo "<td>$count</td>";
                                      	 echo "<td>$main</td>";
                                      	 echo "<td>$sub</td>";
                                          echo "<td>$spec</td>";
                                         // <button type='button' class='btn btn-info update-temp'
                                         // data-id='$id'
                                         // ><i class='fa fa-edit'></i> EDIT</button>
                                         echo "<td class='hehe'>
                                         <button type='button' class='btn btn-danger $delete_class'
                                         data-id='$id'
                                         ><i class='fa fa-close'></i> DELETE</button>
                                         </td>";
                                      	 echo "</tr>";
                                      	 $count++;
                                      }
                                      ?>	 
                                      </tbody>

</table>
 

