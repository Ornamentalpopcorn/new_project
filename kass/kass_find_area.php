<?php  require("../includes/session.php") ; ?>

<?Php 

$md = $_GET['md'] ;
 
$selectArea = mysqli_fetch_assoc(mysqli_query($conn,
	"SELECT DISTINCT area
	FROM accounts_md
	WHERE md_name = '$md'
	") )


?>
<input type="text" readonly class="form-control areaaa" id="area" value="<?php echo $selectArea['area'] ; ?>">