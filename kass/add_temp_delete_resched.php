<?Php include("../includes/session.php"); 

$id = $_GET['id'];
$username = $_SESSION['username'] ;

$delete = mysqli_query($conn,
	"DELETE FROM activity_temp
	WHERE id = '$id'
	");


?>


<?Php 

                      $select = mysqli_query($conn,
                                      	"SELECT *
                                      	FROM activity_temp
                                      	WHERE username = '$username'
                                      	ORDER BY ID ASC
                                      	");

if (mysqli_num_rows($select) > 0) {
 
?>

<div class="form-group">
	
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
                                         <button type='button' class='btn btn-danger new-delete-temp-resched'
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

<?Php 

} else {

?>
      <div class="form-group">
        <table class="table table-bordered"
              style="  text-align:center;"
        >
          <tr>
              <td colspan="3">NO OBJECTIVE YET</td>

          </tr>

        </table>
      </div>
<?Php


}

?>

