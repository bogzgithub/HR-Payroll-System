 $(document).ready(function(){
 // FOR UPPERCASE
    // fucntion for first letter Upperletter
    $("input[id='txt_only']").on('input', function(){
        $(this).val($(this).val().charAt(0).toUpperCase() + $(this).val().slice(1));
       // document.getElementById(id).value = inputTxt.value.charAt(0).toUpperCase() + inputTxt.value.slice(1);
     }); 

    // for numbers only
    $(document).on('keypress', 'input[id="txt_only"]', function (event) {
        var regex = new RegExp("^[0-9!@#$%^&*()_+]+$");
        var key = String.fromCharCode(!event.charCode ? event.which : event.charCode);

        if (regex.test(key)) {
            event.preventDefault();
            return false;
        }
    });

       // for security purpose return false
     $("input[id='txt_only").on("paste", function(){
    
          return false;
     });


      // for handling security in contactNo
    $("input[id='txt_only']").on('input', function(){

       if ($("input[name='txt_only']").attr("maxlength") != 50){
            if ($("input[id='txt_only']").val().length > 50){
                $("input[id='txt_only']").val($("input[id='txt_only']").val().slice(0,-1));
            }
           $("input[id='txt_only']").attr("maxlength","50");
       }

   });

});