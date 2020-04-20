"use strict";
var baseURL = "http://localhost/computicket/backend/controller/";
$(document).ready(function(){

    $('.message .close').on('click', function() {
		$(this).closest('.message').transition('fade');
	});
   
    $('#sub_btn').click(function(){
        var email = $('#sub_email').val();
        subscribe(email);
    });

    $('.booking_btn').mouseenter(function(){
        $(this).removeClass("basic");
    });
    
    $(".unimplemented").click(function(){
        swal("Oops!!. This page is currently in test mode.");
    });
   
});

function subscribe(email){
    if(email !== ""){
        $.get(baseURL+"subscribe.php?sub_email="+email, function(res){
            var data = JSON.parse(res);
            if(data.status === "success"){
                swal("Congratulations",data.message, "success");
                $('#sub_email').val('');
            }else if(data.status === "warning"){
                swal({
                    title: "Subsription Cancelled",
                    text: data.message,
                    type: "warning",
                    showCancelButton: false,
                    confirmButtonClass: "btn-primary",
                    confirmButtonText: "OK, Cool",
                    closeOnConfirm: false
                  }).fail(function(error){
                    swal("XMLHttpRequest Failed!", error, "error");
            });
            }
            else{
                swal("Error", data.message, "error");
            }
        });
    }else{
        swal("Error", "An Valid Email address is required inorder to subscribe!", "error");
    }
}