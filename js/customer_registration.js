"use strict";
$(document).ready(function(){
    $('#reg_btn').click(function(){
        loading("show", "Registeration in progress...");

        //Collecting data from Registration form
        
             var fname = $('#fname').val();
             var lname = $('#lname').val();
             var onames = $('#onames').val();
             var gender = $('#gender').val();
             var dob = $('#dob').val();
             var contact = $('#contact').val();

             var datax = "fname="+fname+"&lname="+lname+"&onames="+onames+"&gender="+gender+"&dob="+dob+"&contact="+contact;
  
            $.get(baseURL+"customer_registration.php?"+datax, function(response){
                var data = JSON.parse(response);
                if(data.status == "success"){
                    $("#reg_reset").click();
                    swal("Success", data.message, "success");
                    loading("hide", "");
                }else{
                    swal("Registration Failed", data.message, "error");
                    loading("hide", "");
                }
               
        }).fail(function(error){
                swal("XMLHttpRequest Failed!", "The requested URL could not be found!", "error");
                loading("hide", "");
        });

    });
});