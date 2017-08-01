<!-- STATUS LIST -->
<!-- STATUS LIST -->
<script type="text/javascript">

  $(document).on('change' , '#status-list', function() {
   var  view_by = $(this).val(); 
  
                  if (view_by == "all") {

                          location.href="index.php"   ;
                  } else {
                          location.href="index.php?view=" + view_by ;
                }
      
}) ;

</script>


   <!-- ALL KASS -->
   <!-- ALL KASS -->

<!-- REMARKS  -->
<!-- REMARKS  -->

<script type="text/javascript">
  
// $("input").keydown(function(){
  $(document).on('keydown' , '#ViewKassActivity .rrr', function() {
    // this.value = this.value.replace(/[^ A-Z^a-z^0-9,.()]/g, '');
});

// $("input").focusout(function(){
  $(document).on('focusout' , '#ViewKassActivity .rrr', function() {
    // this.value = this.value.replace(/[^ A-Z^a-z^0-9,.()]/g, '');
});

  $(document).on('focusout' , '#subobjective-related-activity', function() {
    this.value = this.value.replace(/[^ A-Z^a-z^0-9,.()/]/g, '');
});

  $(document).on('keydown' , '#subobjective-related-activity', function() {
    this.value = this.value.replace(/[^ A-Z^a-z^0-9,.()/]/g, '');
});

  $(document).on('keydown' , '#related-activity', function() {
    this.value = this.value.replace(/[^ A-Z^a-z^0-9,.()/]/g, '');
});

   $(document).on('focusout' , '#related-activity', function() {
    this.value = this.value.replace(/[^ A-Z^a-z^0-9,.()/]/g, '');
});

   $(document).on('keydown' , '.re-remark', function() {
    // this.value = this.value.replace(/[^ A-Z^a-z^0-9,.()/]/g, '');
});

   $(document).on('focusout' , '.re-remark', function() {
    // this.value = this.value.replace(/[^ A-Z^a-z^0-9,.()/]/g, '');
});

 

</script>

<!-- CATEGORY -->
<!-- CATEGORY --> 

<script type="text/javascript">
  
// $("#kasm-list").change(function(){
$(document).on('change' , '#category', function() {
                  var category =  $("#category option:selected").val();
                  if (category == "FIELD") {
                          $("#office").css("display","none");
                          $("#field").css("display","block");
                          $("#field2").css("display","block");
                          $(".group-md").css("display","block");
                  } else {
                          $("#office").css("display","block");
                          $("#field").css("display","none");
                          $("#field2").css("display","none");
                          $(".group-md").css("display","none");
               
                  }
}) ;

</script>


<!-- CATEGORY -->
<!-- CATEGORY -->


<script type="text/javascript">
   
$(document).on('keydown' , '.rrr', function() {

      var id = $(this).data('id');
  
       if($(".remark" + id).val().trim() == '') {
           // $('#update-kass-activity').prop('disabled', false)  ;

                $(".update" + id).attr("disabled",false);

        } else {
             
               if($(".checkcheck").prop("checked") == true){
                                $(".update" + id).attr("disabled",false);
                } else {
                                $(".update" + id).attr("disabled",true);

                }
          
        }
 
});

$(document).on('focusout' , '.rrr', function() {
      var id = $(this).data('id');
 
       if($(".remark" + id).val().trim() == '') {
           // $('#update-kass-activity').prop('disabled', false)  ;

                $(".update" + id).attr("disabled",false);

        } else {
             
               if($(".checkcheck").prop("checked") == true){
                                $(".update" + id).attr("disabled",false);
                } else {
                                $(".update" + id).attr("disabled",true);

                }
          
        }
 
});

$(document).on('change' , '.checkcheck', function() {
                      
                      var get_id = $(this).val();

                      var remarks = $(".remark" + get_id).val();
                       
            // if($(".checkcheck" ).prop("checked") == true){
            if($(this).prop("checked") == true){

                            if ($(".remark" + get_id).val().trim() ) {
                                                      $(".update" + get_id).attr("disabled",false);
                            } else {
                                                      $(".update" + get_id).attr("disabled",true);
                            }

                       
            } else {
                           $(".update" + get_id).attr("disabled",true);

            }

  });

</script>
<!-- REMARKS  -->
<!-- REMARKS  -->

<!-- UPDATE ACTIVITY -->
<!-- UPDATE ACTIVITY -->

<script type="text/javascript">
  
  // $("#update-kass-activity").click(function(){
$(document).on('click' , '.uu', function() {

      var btn = $(this).data('btn');
 
            var remarks = $(".remark" + btn).val();
            
            var check_deviated = $(".deviate" + btn + "").is(':checked');
            var check_finish = $(".finish" + btn + "").is(':checked');

            if (check_deviated == true) {
                var status = "deviated";
                var activity_text = "Deviate Activity ?";

            } else if (check_finish == true) {

                var status = "done";
                var activity_text = "Update Activity ?";

            } else {

                swal("Please Select Type of Update!", "Please try again", "error");
                nothing
            }
            
            if (!remarks.trim()) {
                      swal("Please Fill Missing Field!", "Please try again", "error");
                      stopScript
            }

      var dataString = "id=" + btn + "&remarks=" + remarks + "&status=" + status ;
      
        swal({
          title:  activity_text, 
          type: "info",
          showCancelButton: true,
          confirmButtonColor: "#26B99A",
          confirmButtonText: "Yes, Update",
          closeOnConfirm: false,
           showLoaderOnConfirm: true,
      }, function (isConfirm) {
        // return 0;
          if (!isConfirm) return;
          
          $.ajax({
              url: "kass/update_activity_field.php",
              type: "GET",
              data:  dataString,
              success: function (data) {
                 swal("Activity Updated!", "", "success");
                // $(".asdf").html(data);
                                        setTimeout(function()
                                          { location.href="index.php"
                                        } , 1000);   
              },
              error: function (xhr, ajaxOptions, thrownError) {
                  swal("Failed to Update Activity!", "Please try again", "error");
              }
          });


      });


  });
</script>

<script type="text/javascript">
  
  // $("#update-kass-activity").click(function(){
$(document).on('click' , '.uuOffice', function() {

      var btn = $(this).data('btn');
   
            var remarks = $(".remark" + btn).val();
            var check_deviated = $(".deviate" + btn + "").is(':checked');
            var check_finish = $(".finish" + btn + "").is(':checked'); 

            if (check_deviated == true) {
                var status = "deviated";
                var activity_text = "Deviate Activity ?";

            } else if (check_finish == true) {

                var status = "done";
                var activity_text = "Update Activity ?";

            } else {

                swal("Please Select Type of Update!", "Please try again", "error");
                nothing
            }             


            if (!remarks.trim()) {
                      swal("Please Fill Missing Field!", "Please try again", "error");
                      stopScript
            }

      var dataString = "id=" + btn + "&remarks=" + remarks + "&status=" + status ;
 
        swal({
          title: activity_text, 
          type: "info",
          showCancelButton: true,
          confirmButtonColor: "#26B99A",
          confirmButtonText: "Yes, Update",
          closeOnConfirm: false,
           showLoaderOnConfirm: true,
      }, function (isConfirm) {
        // return 0;
          if (!isConfirm) return;
          
          $.ajax({
              url: "kass/update_activity_office.php",
              type: "GET",
              data:  dataString,
              success: function (data) {
                 swal("Activity Updated!", "", "success");
                // $(".asdf").html(data);
                                        setTimeout(function()
                                          { location.href="index.php"
                                        } , 1000);   
              },
              error: function (xhr, ajaxOptions, thrownError) {
                  swal("Failed to Update Activity!", "Please try again", "error");
              }
          });


      });


  });
</script>


<!-- UPDATE ACTIVITY -->
<!-- UPDATE ACTIVITY -->

<script type="text/javascript">
  
// $("input").keydown(function(){
  $(document).on('keydown' , '#KassModalNew input', function() {
    // this.value = this.value.replace(/[^ A-Z^a-z^0-9:]/g, '');
});

// $("input").focusout(function(){
  $(document).on('focusout' , '#KassModalNew input', function() {
    // this.value = this.value.replace(/[^ A-Z^a-z^0-9:]/g, '');
});

</script>
   
<script type="text/javascript">
    
$(document).ready(function() {

  // $("").change(function(){
  $(document).on('change' , '#md', function() {
    var md = $(this).val();
 
     var dataString = "md=" + md   ;
        ajax_request = $.ajax({
            type: "GET",
            url: "kass/kass_find_area.php",
            data: dataString,
            cache: true,
            success: function (data) {
        
               $("#md-area").html(data);

            }

        });
 
        ajax_request = $.ajax({
            type: "GET",
            url: "kass/kass_find_group.php",
            data: dataString,
            cache: true,
            success: function (data) {
        
               $("#md-group").html(data);

            }

        });


  }) ; // END CHANGE


 // $("#main-objective").change(function(){
    // $("#main-objective").on("change", function() {
$(document).on('change' , '#main-objective', function() {
    var main_objective = $(this).val();
    // var main_objective = $(this).val();
  
     var dataString = "main_objective=" + main_objective   ;
        ajax_request = $.ajax({
            type: "GET",
            url: "kass/kass_find_sub_objective.php",
            data: dataString,
            cache: true,
            success: function (data) {
        
               $("#sub-objective").html(data);
               $("#specific-objective").html('');
             $(".sub-label").css("display","block");
            }

        });
  
  }) ;

 // $("#sub-objective").change(function(){
  // $("#sub-objective").on("change", function() {
      $(document).on('change' , '#sub-objective', function() {
    // var sub_objective = $(this).val();
    var sub_objective = $("#sub-objective option:selected").val();
 
     var dataString = "sub_objective=" + sub_objective   ;
        ajax_request = $.ajax({
            type: "GET",
            url: "kass/kass_find_specific_objective.php",
            data: dataString,
            cache: true,
            success: function (data) {
              
                $(".check-sub-specific").html('');
               $("#specific-objective").html(data);
            }

        });
  
  }) ;

$(document).on('click' , '#sub-objective', function() {
    // var sub_objective = $(this).val();
    var sub_objective = $("#sub-objective option:selected").val();
 
     var dataString = "sub_objective=" + sub_objective   ;
        ajax_request = $.ajax({
            type: "GET",
            url: "kass/kass_find_specific_objective.php",
            data: dataString,
            cache: true,
            success: function (data) {
              
                $(".check-sub-specific").html('');
               $("#specific-objective").html(data);
            }

        });
  
  }) ;



}) ;
    
</script>

 
 
<script type="text/javascript">


$("#KassModalNew").on('shown.bs.modal', function (event) {
       
   ajax_request = $.ajax({
            type: "GET",
            url: "kass/kass_add_activity_content.php", 
            cache: true,
            success: function (data) {
              
                $("#kass-laman").html(data);
          
            }

        });
  
       var date = $("#currentDate").text();
      $('.datePairDate .time').timepicker('remove');
 
            var dataString = "date=" + date ;
            ajax_request = $.ajax({
            type: "GET",
            url: "kass/disabled_time.php",
            data: dataString,
            cache: true,
            success: function (data) {
              
                  $("#KassModalNew .disable-disable").html(data);
                  $(".aa-objective").html('<table class="table table-bordered" style="  text-align:center;"><tr><td colspan="3">NO OBJECTIVE YET</td></tr></table>');
          
            }

        });  
      
 });

$("#KassModalNew").on('hidden.bs.modal', function (event) {
        $('.datePairDate').timepicker('remove');
})

</script>


<!-- EDIT ACTIVITY -->
<!-- EDIT ACTIVITY -->
<script type="text/javascript">


$("#EditActivity").on('shown.bs.modal', function (event) {
 
     var button = $(event.relatedTarget) // Button that triggered the modal
      var id = button.data('id')
 
      var dataString = "id=" + id ;
       ajax_request = $.ajax({
            type: "GET",
            url: "kass/edit_activity.php", 
            cache: true,
            data: dataString,
            success: function (data) {
              
                $("#EditActivity #editActivity-content").html(data);
          
            }

        });
 
      
 });

$("#EditActivity").on('hidden.bs.modal', function (event) {
  

})


$("#kass-editObjective").on('hide.bs.modal', function (event) {
 

})
  


$("#kass-editObjective").on('show.bs.modal', function (event) {
      var button = $(event.relatedTarget) // Button that triggered the modal
      var id = button.data('id')

 

   var dataString = "id=" + id ;
            $.ajax({
              url: "kass/edit_objective.php",
              type: "GET",  
              data:  dataString,
              success: function (data) {
                 // swal("Activity Added!", "", "success");
                $("#KassNewActivity").hide();
                $("#new-edit-objective-modal").html(data);
                                
              },
              error: function (xhr, ajaxOptions, thrownError) {
                  swal("Failed to Add Activity!", "Please try again", "error");
              }
          });


})

$("#EditActivity").on('hide.bs.modal', function (event) {
   
})


 $("#edit-add-objective").on("click", function() {
  
   var main_objective = $("#main-objective option:selected").val();
   var sub_objective = $("#sub-objective option:selected").val();
   var specific_objective = $("#specific-objective option:selected").val();
  var id = $(".edit-id").html();

     
    // SPECIFIC TEXTBOX
   var related_activity_text = $("#related-activity").val(); 
    if (related_activity_text) {
       
    } else {
        related_activity_text = "0001";
   } 

 
    var sub_related_activity_text = $("#subobjective-related-activity").val(); 
    if (sub_related_activity_text) {
       
    } else {
        sub_related_activity_text = "0001";
   } 
 
    var dataString = "main="  + main_objective +
    "&sub=" + sub_objective + 
    "&specific=" + specific_objective + 
    "&sub_text=" + sub_related_activity_text + 
    "&specific_text=" + related_activity_text +
    "&id=" + id +
    "&new_activity=new"
    ;

      swal({
          title: "Update Objective ?",
          // text: "You will not be able to recover this imaginary file!",
          type: "info",
          showCancelButton: true,
          confirmButtonColor: "#26B99A",
          confirmButtonText: "Yes, Update Objective",
          closeOnConfirm: false,
           showLoaderOnConfirm: true,
      }, function (isConfirm) {
        // return 0;
          if (!isConfirm) return;
          $.ajax({
              url: "kass/edit_temp.php",
              type: "GET",
              data:  dataString,
              success: function (data) {
                 swal("Objective Updated!", "", "success");
                // $("#qwer").html(data);
 
                                        setTimeout(function()
                                          { 
                                            $("#kass-editObjective").modal('hide');
                                            $(".new-aa-objective").html(data);
                                            $(".new-aa-objective .hehe").css("white-space", "nowrap");


                                        } , 1000);   

               

              },
              error: function (xhr, ajaxOptions, thrownError) {
                  swal("Failed to Submit Activity!", "Please try again", "error");
              }
          });
      });
 

}); 

// SEND UPDATE
 $("#update-edited-activity").on("click", function() {
              var id = $("#update-id").html();
              var date = $("#EditActivity  .datepicker").val();
              var time_start = $("#EditActivity  .start").val();
              var time_end = $("#EditActivity  .end").val();
              var md = $("#EditActivity  #md").val();
              var area = $("#EditActivity  #area").val();
              var group = $("#EditActivity  #group-md").val();

          var remarks = []; var count = 0;
               $('#new-activity-objective').find('tbody').find('tr').each(function() {
                  remarks[count] = $(this).find('textarea').val();
                  count++;
        
           }); // EACH

          if ( !date) {
                  swal("Please Select Date!", "Please try again", "error");
                  stopScript
          } else if ( !time_start || !time_end) {
                  swal("Please Select Time!", "Please try again", "error");
                  stopScript
          }

 

                swal({
                    title: "Update Activity ?",
                    // text: "You will not be able to recover this imaginary file!",
                    type: "info",
                    showCancelButton: true,
                    confirmButtonColor: "#26B99A",
                    confirmButtonText: "Yes, Update Activity",
                    closeOnConfirm: false,
                     showLoaderOnConfirm: true,
                }, function (isConfirm) {
                  // return 0;
                    if (!isConfirm) return;
                    $.ajax({
                        url: "kass/edit_updated_activity.php",
                        type: "POST",
                        data:  { 
                                        'remarks': JSON.stringify(remarks),  
                                        'id': id,
                                        'date': date,
                                        'time_start': time_start,
                                        'time_end': time_end,
                                        'md': md,
                                        'area': area,
                                        'group': group
                        },
                        success: function (data) {
                           swal("Activity Updated!", "", "success");
                      
           
                                                  setTimeout(function()
                                                    { 
                                                location.href="index.php"
                                                      // $("#editActivity-content").append(data);

                                                  } , 1000);   
 

                        },
                        error: function (xhr, ajaxOptions, thrownError) {
                            swal("Failed to Submit Activity!", "Please try again", "error");
                        }
                    });
                });


 })
// SEND UPDATE

</script>




<!-- EDIT ACTIVITY -->
<!-- EDIT ACTIVITY -->


<script type="text/javascript">
  
// $(".kass_new_activity").click(function(){
   $(".kass_new_activity").on("click", function() {

        var time_start = $(".datePairDate .start").val();
        var time_end = $(".datePairDate .end").val();
        var md = $("#md").val();
        var area = $(".areaaa").val();
        var group = $(".group-md").val();
        var date = $("#currentDate").text();
       var category = $("#category option:selected").val();
       var agenda = $("#agenda option:selected").val();
 
        // var main_objective = $("#main-objective option:selected").val();
        // var sub_objective = $("#sub-objective option:selected").val();
        // var specific_objective = $("#specific-objective option:selected").val();
 
            if ( !time_start || !time_end) {
                  swal("Please Select Time!", "Please try again", "error");
                  stopScript
            }
  
            var check_table = $(".aa-objective").text().trim();
            
            if (category == "FIELD") {

                    if (check_table == "NOT AVAILABLE YET" || check_table == "NO OBJECTIVE YET") {
                        swal("Please Add \n Objective!", "", "error");
                        stopScript
                    }
            }
         
          var dataString = "time_start=" + time_start +
          "&time_end=" + time_end +
          "&md=" + md + 
          "&area=" + area + 
          "&date=" + date + 
          "&category=" + category + 
          "&agenda=" + agenda + 
          "&group=" + group 
 
            ;
 
         swal({
          title: "Add Activity ?",
          // text: "You will not be able to recover this imaginary file!",
          type: "info",
          showCancelButton: true,
          confirmButtonColor: "#26B99A",
          confirmButtonText: "Yes, proceed",
          closeOnConfirm: false,
           showLoaderOnConfirm: true,
      }, function (isConfirm) {
        // return 0;
          if (!isConfirm) return;
          $.ajax({
              url: "kass/add_activity.php",
              type: "GET",
              data:  dataString,
              success: function (data) {
                 swal("Activity Added!", "", "success");
                // $(".asdf").html(data);
                                        setTimeout(function()
                                          { location.href="index.php"
                                        } , 1000);   
              },
              error: function (xhr, ajaxOptions, thrownError) {
                  swal("Failed to Submit Activity!", "Please try again", "error");
              }
          });
      });
  

});

</script>

 
   <!-- ALL KASS -->
   <!-- ALL KASS -->

   <!-- ADD OBJECTIVE -->
   <!-- ADD OBJECTIVE -->

<script type="text/javascript">
  
 
 $("#add-objective").on("click", function() {
  
   var main_objective = $("#main-objective option:selected").val();
   var sub_objective = $("#sub-objective option:selected").val();
   var specific_objective = $("#specific-objective option:selected").val();
     
    // SPECIFIC TEXTBOX
   var related_activity_text = $("#related-activity").val(); 
    if (related_activity_text) {
       
    } else {
        related_activity_text = "0001";
   } 
 
    var sub_related_activity_text = $("#subobjective-related-activity").val(); 
    if (sub_related_activity_text) {
       
    } else {
        sub_related_activity_text = "0001";
   } 
 
    var dataString = "main="  + main_objective +
    "&sub=" + sub_objective + 
    "&specific=" + specific_objective + 
    "&sub_text=" + sub_related_activity_text + 
    "&specific_text=" + related_activity_text 
    ;

      swal({
          title: "Add Objective ?",
          // text: "You will not be able to recover this imaginary file!",
          type: "info",
          showCancelButton: true,
          confirmButtonColor: "#26B99A",
          confirmButtonText: "Yes, Add Objective",
          closeOnConfirm: false,
           showLoaderOnConfirm: true,
      }, function (isConfirm) {
        // return 0;
          if (!isConfirm) return;
          $.ajax({
              url: "kass/add_temp.php",
              type: "GET",
              data:  dataString,
              success: function (data) {
                 swal("Objective Added!", "", "success");
                // $("#qwer").html(data);
 
                                        setTimeout(function()
                                          { 
                                            $("#newObjective").modal('hide');
                                            $(".aa-objective").html(data);
                                        } , 1000);   
 

              },
              error: function (xhr, ajaxOptions, thrownError) {
                  swal("Failed to Submit Activity!", "Please try again", "error");
              }
          });
      });
 

}); 

$("#newObjective").on('hide.bs.modal', function (event) {
    $("#KassModalNew").fadeIn();

})
   
$("#newObjective").on('show.bs.modal', function (event) {
    $("#KassModalNew").fadeOut();

            $.ajax({
              url: "kass/add_objective.php",
              type: "GET",
              // data:  dataString,
              success: function (data) {
                 // swal("Activity Added!", "", "success");
                $("#add-objective-modal").html(data);
                                
              },
              error: function (xhr, ajaxOptions, thrownError) {
                  swal("Failed to Add Activity!", "Please try again", "error");
              }
          });


})
 

</script>
 
   <!-- ADD OBJECTIVE -->
   <!-- ADD OBJECTIVE -->

   <!-- RESCHED -->
   <!-- RESCHED -->

<!-- RESCHED ACTIVITY -->
<!-- RESCHED ACTIVITY -->
 
<script type="text/javascript">
  

$("#kass-resched-newObjective").on('hide.bs.modal', function (event) {
    $("#reschedActivity").fadeIn();

})
   
$("#kass-resched-newObjective").on('show.bs.modal', function (event) {
    $("#reschedActivity").fadeOut();

            $.ajax({
              url: "kass/add_objective.php",
              type: "GET",  
              // data:  dataString,
              success: function (data) {
                 // swal("Activity Added!", "", "success");
                $("#new-resched-objective-modal").html(data);
                                
              },
              error: function (xhr, ajaxOptions, thrownError) {
                  swal("Failed to Add Activity!", "Please try again", "error");
              }
          });


})



$("#reschedActivity").on('hide.bs.modal', function (event) {
        $("#ViewKassActivity").fadeIn();
        $("#ViewKassActivity").css("height","auto");
})

$(document).on('click' , '#resched-add-objective', function() {
 
   var main_objective = $("#main-objective option:selected").val();
   var sub_objective = $("#sub-objective option:selected").val();
   var specific_objective = $("#specific-objective option:selected").val();
 
    // SPECIFIC TEXTBOX
   var related_activity_text = $("#related-activity").val(); 
    if (related_activity_text) {
       
    } else {
        related_activity_text = "0001";
   } 

 
    var sub_related_activity_text = $("#subobjective-related-activity").val(); 
    if (sub_related_activity_text) {
       
    } else {
        sub_related_activity_text = "0001";
   } 
 
    var dataString = "main="  + main_objective +
    "&sub=" + sub_objective + 
    "&specific=" + specific_objective + 
    "&sub_text=" + sub_related_activity_text + 
    "&specific_text=" + related_activity_text +
    "&new_activity=resched"
    ;

     
      swal({
          title: "Add Objective ?",
          // text: "You will not be able to recover this imaginary file!",
          type: "info",
          showCancelButton: true,
          confirmButtonColor: "#26B99A",
          confirmButtonText: "Yes, Add Objective",
          closeOnConfirm: false,
           showLoaderOnConfirm: true,
      }, function (isConfirm) {
        // return 0;
          if (!isConfirm) return;
          $.ajax({
              url: "kass/add_temp.php",
              type: "GET",
              data:  dataString,
              success: function (data) {
                 swal("Objective Added!", "", "success");
         
                                        setTimeout(function()
                                          { 
                                            $("#kass-resched-newObjective").modal('hide');
                                            $(".re-objective").html(data);
                                        } , 1000);   
 

              },
              error: function (xhr, ajaxOptions, thrownError) {
                  swal("Failed to Submit Activity!", "Please try again", "error");
              }
          });
      });


});

 
  $(document).on('click' , '.btn-warning', function() {
        $("#ViewKassActivity").fadeOut();
          
        var id = $(this).data('resched');
   
       var dataString = "id=" + id   ;
        ajax_request = $.ajax({
            type: "GET",
            url: "kass/resched_modal.php",
            data: dataString,
            cache: true,
            success: function (data) {
        
               $("#resched-modal").html(data);


                         $('.datePairDate2 .time').timepicker({
                    'showDuration': true,
                    'timeFormat': 'g:i a',
                    'step': 60,
                    // 'minTime': '7:00 am',
                    'forceRoundTime': true,
                       'disableTimeRanges': [
                      
                    ]
                });
              $('.datePairDate2').datepair();

            }

        });
 
});


// $(document).on('click' , '#add-objective2', function() {
$("#add-objective2").on("click", function() {
   
   var main_objective = $("#main-objective option:selected").val();
   var sub_objective = $("#sub-objective option:selected").val();
   var specific_objective = $("#specific-objective option:selected").val();
     
    // SPECIFIC TEXTBOX
   var related_activity_text = $("#related-activity").val(); 
    if (related_activity_text) {
       
    } else {
        related_activity_text = "0001";
   } 

 
    var sub_related_activity_text = $("#subobjective-related-activity").val(); 
    if (sub_related_activity_text) {
       
    } else {
        sub_related_activity_text = "0001";
   } 
 
    var dataString = "main="  + main_objective +
    "&sub=" + sub_objective + 
    "&specific=" + specific_objective + 
    "&sub_text=" + sub_related_activity_text + 
    "&specific_text=" + related_activity_text 
    ;

     
      swal({
          title: "Add Objective ?",
          // text: "You will not be able to recover this imaginary file!",
          type: "info",
          showCancelButton: true,
          confirmButtonColor: "#26B99A",
          confirmButtonText: "Yes, Add Objective",
          closeOnConfirm: false,
           showLoaderOnConfirm: true,
      }, function (isConfirm) {
        // return 0;
          if (!isConfirm) return;
          $.ajax({
              url: "kass/add_temp.php",
              type: "GET",
              data:  dataString,
              success: function (data) {
                 swal("Objective Added!", "", "success");
         
                                        setTimeout(function()
                                          { 
                                            $("#reschedObjective").modal('hide');
                                            $(".re-objective").html(data);
                                        } , 1000);   
 

              },
              error: function (xhr, ajaxOptions, thrownError) {
                  swal("Failed to Submit Activity!", "Please try again", "error");
              }
          });
      });

});

$("#reschedObjective").on('hide.bs.modal', function (event) {
    $("#reschedActivity").fadeIn();
         $("#reschedActivity").css("height","auto");
})
   
$("#reschedObjective").on('show.bs.modal', function (event) {
    $("#reschedActivity").fadeOut();

            $.ajax({
              url: "kass/add_activity_resched.php",
              type: "GET",
              // data:  dataString,
              success: function (data) {
                 // swal("Activity Added!", "", "success");
                $("#resched-objective").html(data);
                                
              },
              error: function (xhr, ajaxOptions, thrownError) {
                  swal("Failed to Add Activity!", "Please try again", "error");
              }
          });


})



</script>

<!-- RESCHED ACTIVITY -->
<!-- RESCHED ACTIVITY -->

<!-- RE-SUBMIT SCHEDULE -->
<!-- RE-SUBMIT SCHEDULE -->

<script type="text/javascript">
 
$("#submit-objective").on("click", function() {
  
  var id = $("#resched-id").text();
  var md = $("#resched-md").val();
  var date = $("#datepicker").val();
  var time_start = $(".datePairDate2 .start").val();
  var time_end = $(".datePairDate2 .end").val();
  var remark = $(".re-remark").val();
    
            if (!date) {
              swal("Please Select Date \n For Reschedule!", "", "info");
                stopScript
            }

            if (!remark.trim()) {
              swal("Please Enter Reason \n For Reschedule!", "", "info");
                stopScript
            }
  
            if (!time_start && !time_end) {
              swal("Please Select Time \n For Reschedule!", "", "info");
                stopScript
            }

            var check_table = $(".re-objective").text().trim();
  
          if (check_table == "NOT AVAILABLE YET" || check_table == "NO OBJECTIVE YET") {
              swal("Please Add \n Objective!", "", "error");
              stopScript
          }



          var dataString = "time_start=" + time_start +
          "&time_end=" + time_end +
          "&md=" + md +  
          "&date=" + date + 
          "&id=" + id  +
          "&remarks=" + remark  
            ;
  
        swal({
          title: "Re-Schedule Activity ?",
          // text: "You will not be able to recover this imaginary file!",
          type: "info",
          showCancelButton: true,
          confirmButtonColor: "#26B99A",
          confirmButtonText: "Yes, Reschedule",
          closeOnConfirm: false,
           showLoaderOnConfirm: true,
      }, function (isConfirm) {
        // return 0;
          if (!isConfirm) return;
          $.ajax({
              url: "kass/resched_activity.php",
              type: "GET",
              data:  dataString,
              success: function (data) {
                 swal("Activity Rescheduled !", "", "success");
                 // swal("Reschedule Request \nSubject For Approval!", "", "success");
                // $(".asdf").html(data);
                                        setTimeout(function()
                                          { location.href="index.php"
                                        } , 1000);   
              },
              error: function (xhr, ajaxOptions, thrownError) {
                  swal("Failed to Submit Activity!", "Please try again", "error");
              }
          });
      });


});  

</script>

<!-- RE-SUBMIT SCHEDULE -->
<!-- RE-SUBMIT SCHEDULE -->


   <!-- RESCHED -->
   <!-- RESCHED -->

   <!-- ADD TEMP EDITS -->
   <!-- ADD TEMP EDITS -->

<script type="text/javascript">
  
$(document).on('click' , '.delete-temp', function() {

      var id = $(this).data('id');
      var dataString = "id=" + id ;
           swal({
          title: "Delete Activity ?",
          // text: "You will not be able to recover this imaginary file!",
          type: "info",
          showCancelButton: true,
          confirmButtonColor: "#26B99A",
          confirmButtonText: "Yes, Delete",
          closeOnConfirm: false,
           showLoaderOnConfirm: true,
      }, function (isConfirm) {
        // return 0;
          if (!isConfirm) return;
          $.ajax({
              url: "kass/add_temp_delete.php",
              type: "GET",
              data:  dataString,
              success: function (data) {
                 swal("", "", "success");
                $(".aa-objective").html(data);
                $(".aa-objective .hehe").css("white-space", "nowrap");
                                        // setTimeout(function()
                                        //   { location.href="index.php"
                                        // } , 1000);   
              },
              error: function (xhr, ajaxOptions, thrownError) {
                  swal("Failed to Submit Activity!", "Please try again", "error");
              }
          });
      });

});


$(document).on('click' , '.new-delete-temp', function() {

      var id = $(this).data('id');
      var dataString = "id=" + id ;
           swal({
          title: "Delete Activity ?",
          // text: "You will not be able to recover this imaginary file!",
          type: "info",
          showCancelButton: true,
          confirmButtonColor: "#26B99A",
          confirmButtonText: "Yes, Delete",
          closeOnConfirm: false,
           showLoaderOnConfirm: true,
      }, function (isConfirm) {
        // return 0;
          if (!isConfirm) return;
          $.ajax({
              url: "kass/add_temp_delete.php",
              type: "GET",
              data:  dataString,
              success: function (data) {
                 swal("", "", "success");
                $(".new-aa-objective").html(data);
                $(".new-aa-objective .hehe").css("white-space", "nowrap");
                                        // setTimeout(function()
                                        //   { location.href="index.php"
                                        // } , 1000);   
              },
              error: function (xhr, ajaxOptions, thrownError) {
                  swal("Failed to Submit Activity!", "Please try again", "error");
              }
          });
      });

});

$(document).on('click' , '.new-delete-temp-resched', function() {

      var id = $(this).data('id');
      var dataString = "id=" + id ;
           swal({
          title: "Delete Activity ?",
          // text: "You will not be able to recover this imaginary file!",
          type: "info",
          showCancelButton: true,
          confirmButtonColor: "#26B99A",
          confirmButtonText: "Yes, Delete",
          closeOnConfirm: false,
           showLoaderOnConfirm: true,
      }, function (isConfirm) {
        // return 0;
          if (!isConfirm) return;
          $.ajax({
              url: "kass/add_temp_delete_resched.php",
              type: "GET",
              data:  dataString,
              success: function (data) {
                 swal("", "", "success");
                $(".re-objective").html(data);
                $(".re-objective .hehe").css("white-space", "nowrap");
                                        // setTimeout(function()
                                        //   { location.href="index.php"
                                        // } , 1000);   
              },
              error: function (xhr, ajaxOptions, thrownError) {
                  swal("Failed to Submit Activity!", "Please try again", "error");
              }
          });
      });

});

</script>

   <!-- ADD TEMP EDITS -->
   <!-- ADD TEMP EDITS -->

   <!-- GET NEW ACTIVITY -->
   <!-- GET NEW ACTIVITY -->

<script type="text/javascript">

$("#KassNewActivity").on('hide.bs.modal', function (event) {
              $("#ViewKassActivity").fadeIn();
})
  
$("#KassNewActivity").on('show.bs.modal', function (event) {
       var button = $(event.relatedTarget) // Button that triggered the modal
      var id = button.data('id')
 
           var dataString = "id=" + id ;
            ajax_request = $.ajax({
            type: "GET",
            url: "kass/new_activity.php",
            data: dataString,
            cache: true,
            success: function (data) {
              
                $("#ViewKassActivity").fadeOut();
                $("#KassNewActivity #newActivity-content").html(data);
          
            }

        });  
})

$("#kass-newObjective").on('hide.bs.modal', function (event) {
    $("#KassNewActivity").fadeIn();

})
   
$("#kass-newObjective").on('show.bs.modal', function (event) {


            $.ajax({
              url: "kass/add_objective.php",
              type: "GET",  
              // data:  dataString,
              success: function (data) {
                 // swal("Activity Added!", "", "success");
                $("#KassNewActivity").hide();
                $("#new-add-objective-modal").html(data);
                                
              },
              error: function (xhr, ajaxOptions, thrownError) {
                  swal("Failed to Add Activity!", "Please try again", "error");
              }
          });


})

// ADD NEW OBJECTIVE
// ADD NEW OBJECTIVE

 $("#new-add-objective").on("click", function() {
  
   var main_objective = $("#main-objective option:selected").val();
   var sub_objective = $("#sub-objective option:selected").val();
   var specific_objective = $("#specific-objective option:selected").val();
 
     
    // SPECIFIC TEXTBOX
   var related_activity_text = $("#related-activity").val(); 
    if (related_activity_text) {
       
    } else {
        related_activity_text = "0001";
   } 

 
    var sub_related_activity_text = $("#subobjective-related-activity").val(); 
    if (sub_related_activity_text) {
       
    } else {
        sub_related_activity_text = "0001";
   } 
 
    var dataString = "main="  + main_objective +
    "&sub=" + sub_objective + 
    "&specific=" + specific_objective + 
    "&sub_text=" + sub_related_activity_text + 
    "&specific_text=" + related_activity_text +
    "&new_activity=new"
    ;

      swal({
          title: "Add Objective ?",
          // text: "You will not be able to recover this imaginary file!",
          type: "info",
          showCancelButton: true,
          confirmButtonColor: "#26B99A",
          confirmButtonText: "Yes, Add Objective",
          closeOnConfirm: false,
           showLoaderOnConfirm: true,
      }, function (isConfirm) {
        // return 0;
          if (!isConfirm) return;
          $.ajax({
              url: "kass/add_temp.php",
              type: "GET",
              data:  dataString,
              success: function (data) {
                 swal("Objective Added!", "", "success");
                // $("#qwer").html(data);
 
                                        setTimeout(function()
                                          { 
                                            $("#kass-newObjective").modal('hide');
                                            $(".new-aa-objective").html(data);
                                            $(".new-aa-objective .hehe").css("white-space", "nowrap");


                                        } , 1000);   

              


              },
              error: function (xhr, ajaxOptions, thrownError) {
                  swal("Failed to Submit Activity!", "Please try again", "error");
              }
          });
      });
 

}); 

$("#New-add-objective").on("click", function() {

        // var time_start = $(".datePairDate2 .start").val();
        var time_start = $(".datePairDate2 .start").val();
        var time_end = $(".datePairDate2 .end").val();
        var date = $(".datepicker").val();
        // var date = $("#datepicker").val();
        var md = $("#md").val();
        var area = $("#area").val();
        var group = $("#group-md").val(); 
       var category = $("#category").val();
       var agenda = $("#agenda").val();
  
            if ( !time_start || !time_end) {
                  swal("Please Select Time!", "Please try again", "error");
                  stopScript
            }
  
            var check_table = $(".new-aa-objective").text().trim();
 
            if (category == "FIELD") {

                    if (check_table == "NOT AVAILABLE YET" || check_table == "NO OBJECTIVE YET") {
                        swal("Please Add \n Objective!", "", "error");
                        stopScript
                    }
            }
 
          var dataString = "time_start=" + time_start +
          "&time_end=" + time_end + 
          "&md=" + md + 
          "&area=" + area + 
          "&date=" + date + 
          "&category=" + category + 
          "&agenda=" + agenda + 
          "&group=" + group  
            ;
 
          swal({
          title: "Add Activity ?",
          // text: "You will not be able to recover this imaginary file!",
          type: "info",
          showCancelButton: true,
          confirmButtonColor: "#26B99A",
          confirmButtonText: "Yes, proceed",
          closeOnConfirm: false,
           showLoaderOnConfirm: true,
      }, function (isConfirm) {
        // return 0;
          if (!isConfirm) return;
          $.ajax({
              url: "kass/add_activity.php",
              type: "GET",
              data:  dataString,
              success: function (data) {
                 swal("Activity Added!", "", "success");
                // $(".asdf").html(data);
                                        setTimeout(function()
                                          { location.href="index.php"
                                        } , 1000);   
              },
              error: function (xhr, ajaxOptions, thrownError) {
                  swal("Failed to Submit Activity!", "Please try again", "error");
              }
          });
      });
  

});


</script>
 

   <!-- GET NEW ACTIVITY -->
   <!-- GET NEW ACTIVITY -->


<!-- JOINT CALL -->
<script type="text/javascript">
  
$("#ViewJointCall").on('show.bs.modal', function (event) {
      var button = $(event.relatedTarget) // Button that triggered the modal
      var id = button.data('id')
 
           var dataString = "id=" + id ;
            ajax_request = $.ajax({
            type: "GET",
            url: "kass/view_joint_call.php",
            data: dataString,
            cache: true,
            success: function (data) {
              
                $("#CalenderModalEdit").fadeOut();
                $("#ViewJointCall #joint-call-x").html(data);
      
            }

        }); 


});

$("#ViewJointCall").on('hide.bs.modal', function (event) {
       $("#CalenderModalEdit").fadeIn();
 // $("#KassModalNew").fadeOut();
});

</script>

<!-- JOINT CALL -->



