<?php  require("../includes/session.php") ; ?>

<?Php 


 $date = $_GET['date'];
 
$username = $_SESSION['username'];

 $disable_time = mysqli_query($conn,
    $s="SELECT time_start , time_end
    FROM activity
    WHERE username = '$username' 
    AND date = '$date'
    ");
 
     if (mysqli_num_rows($disable_time) > 0) {
        $time = "";
        $c = 0;
        while ($row_time = mysqli_fetch_assoc($disable_time)) {
            $start = str_replace(" ","",$row_time['time_start']) ;
            $end = str_replace(" " , "",$row_time['time_end']) ;

 
                 $time .= "['$start','$end'], ";
 
        }    // WHILE
     } else {
        $time = "";
     }
  
// $delete = mysqli_query($conn,
//     "DELETE FROM activity_temp
//     WHERE username = '$username'
//     ");
 
?>
 
                          <div class="datePairDate2">
                           
                                              <div class="col-md-2"> 
                                               <label class="control-label">From</label>
                                                        <input type="text" class="time start form-control" placeholder="Ex. 8:00 AM" /> 
                                              </div>           

                                              <div class="col-md-2">
                                              <label class="control-label">To</label>
                                                        <input type="text" class="time end form-control" placeholder="Ex. 12:00 PM"/>
                                              </div>                     
                       
                          </div>


<script type="text/javascript">
    
$(document).ready(function(){
 
                    $('.datePairDate2 .time').timepicker({
                    'showDuration': true,
                    'timeFormat': 'g:i a',
                    'step': 60,
                    // 'minTime': '7:00 am',
                    'forceRoundTime': true,
                       'disableTimeRanges': [
                         <?php  echo $time; ?>
                    ]
                });
             	$('.datePairDate2').datepair();
}) ;

</script>