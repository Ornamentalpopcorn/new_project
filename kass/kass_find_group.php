 <?php  require("../includes/session.php") ; ?>

<?Php 

$md = $_GET['md'] ;
 
$selectArea = mysqli_fetch_assoc(mysqli_query($conn,
	"SELECT DISTINCT md_group
	FROM accounts_md
	WHERE md_name = '$md'
	") )


?>
<input type="text" readonly id="group-md"  class="form-control group-md" value="<?php echo $selectArea['md_group'] ; ?>">