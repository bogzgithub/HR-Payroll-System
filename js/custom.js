$(document).ready(function(){
	// JQUERY CODES GOES HERE


  // HERE ALL THE ONLOAD VALUES
//  $("input[name='bioId']").attr("maxlength","4");
  //$("input[name='bioId']").keydown(function(){
   //    $("input[name='bioId']").attr("maxlength","3");
   //});

 // for registration in department will output the position
    $("select[name='department']").change(function(){
       var datastring = "department_id="+$(this).val();
       $.ajax({
            type: "GET",
            url: "ajax/append_position.php",
            data: datastring,
            cache: false,
           // datatype: "php",
            success: function (data) {
              $("select[name='position']").html(data);
               // $('#update_modal_body').html(data);
              //  $("#update_info_modal").modal("show");
            }
        });

    });


    // for handling security in bio ID
    $("input[name='bioId']").on('input', function(){
       if ($("input[name='bioId']").attr("maxlength") != 4){
            if ($("input[name='bioId']").val().length > 4){
                $("input[name='bioId']").val($("input[name='bioId']").val().slice(0,-1));
            }
           $("input[name='bioId']").attr("maxlength","4");
       }

       if ($(this).val() != ""){
        $(this).val(parseInt($(this).val()) / 1);
      }
   });

    // for handling security in contactNo
    $("input[name='contactNo']").on('input', function(){
       if ($("input[name='contactNo']").attr("maxlength") != 11){
            if ($("input[name='contactNo']").val().length > 11){
                $("input[name='contactNo']").val($("input[name='contactNo']").val().slice(0,-1));
            }
           $("input[name='contactNo']").attr("maxlength","11");
       }

   });

   

     


     // for DEPARTMENT LIST
     // ONCLICK UPDATING
     $("a[id='edit_deptartment']").on("click", function () {
       var datastring = "department_id="+$(this).closest("tr").attr("id");
       $.ajax({
            type: "GET",
            url: "ajax/append_edit_department_modal.php",
            data: datastring,
            cache: false,
           // datatype: "php",
            success: function (data) {
              $("#edit_modal_body").html(data);
              $("#editModal").modal("show");
            }
        });
         
     });

      // ONCLICK DELETING
     $("a[id='delete_department']").on("click", function () {
       var datastring = "department_id="+$(this).closest("tr").attr("id");
      $.ajax({
            type: "GET",
            url: "ajax/append_delete_department_modal.php",
            data: datastring,
            cache: false,
           // datatype: "php",
            success: function (data) {     
              $("#delete_modal_body").html(data);

              // if edited by user
              if (data == "<center><span class='glyphicon glyphicon-remove' style='color:#CB4335'></span> There is an error during getting of data</center>"){
                $("#delete_modal_footer").remove();
              }

              $("#deleteDepartmentConfirmationModal").modal("show");

            }
        });
         
     }); 

     // for DELETING YES BUTTON
    $("#delete_yes_dept").on("click", function () {
          $(this).attr("href","php script/delete_department_script.php");

     }); 


    // for POSITION LIST
     // ONCLICK UPDATING
     $("a[id='edit_position']").on("click", function () {
       var datastring = "position_id="+$(this).closest("tr").attr("id");
       $.ajax({
            type: "GET",
            url: "ajax/append_edit_position_modal.php",
            data: datastring,
            cache: false,
           // datatype: "php",
            success: function (data) { 
             $("#edit_modal_body").html(data);
            $("#editModal").modal("show");
            }
        }); 
         
     });

      // ONCLICK DELETING
     $("a[id='delete_position']").on("click", function () {
       var datastring = "position_id="+$(this).closest("tr").attr("id");
       $.ajax({
            type: "GET",
            url: "ajax/append_delete_position_modal.php",
            data: datastring,
            cache: false,
           // datatype: "php",
            success: function (data) { 
             $("#delete_modal_body").html(data);
              // if edited by user
              if (data == "<center><span class='glyphicon glyphicon-remove' style='color:#CB4335'></span> There is an error during getting of data</center>"){
                $("#delete_modal_footer").remove();
              }
             $("#deletePositionConfirmationModal").modal("show");
            }
        }); 
         
     });

       // for DELETING YES BUTTON
    $("#delete_yes_position").on("click", function () {
          $(this).attr("href","php script/delete_position_script.php");

     }); 


    // for birthdate onpaste is false
       // for security purpose return false
     $("input[name='birthdate").on("paste", function(){
          return false;
     });



     // for DEPARTMENT LIST
     // ONCLICK UPDATING
     $("a[id='view_emp_profile']").on("click", function () {
       var datastring = "emp_id="+$(this).closest("tr").attr("id");

       var tr_id = $(this).closest("tr").attr("id");

       var id = $(this).attr("id"); 
      // alert($("#"+tr_id).children().next().next().next().next().next().children().next().next().next().next().next().next().next().html()););

      

      // check muna natin if nag eexist ung emp id sa database kapag nag eexist render ung page kapag hindi error message
       $.ajax({
            type: "GET",
            url: "ajax/script_emp_view_profile.php",
            data: datastring,
            cache: false,
           // datatype: "php",
            success: function (data) {
              //$("#edit_modal_body").html(data);
             // $("#editModal").modal("show");
             if (data == "Error" || data == 1){
                $("#errorModal").modal("show");
             }
             else {
              // alert(tr_id);
              // alert(id);
              // $("#"+tr_id).find("a[id='"+id+"']").attr("href","view_emp_profile.php");
              // window.location = $("#"+tr_id).find("a[id='"+id+"']").attr('href');
               $("#submit_form").html(
                   "<form id='view_profile_form' action='php script/view_emp_profile_script.php' method='post'><input type='text' value='"+data+"' name='emp_id'></form>"
                );
               $("#view_profile_form").submit();
               // window.location = $("#"+tr_id).find("a[id='"+id+"']").attr('href');

               // $("#"+tr_id).find("a[id='"+id+"']").html());
                //$("#"+id).attr("href","view_emp_profile.php");
             //  $(this).attr("href","view_emp_profile.php");
             }
            }
        }); 
         
     });

   
     
});