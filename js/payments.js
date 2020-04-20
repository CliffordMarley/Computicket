"use strict";
var toggle_payment = "offsite_payment";

$(document).ready(function(){

    $("#pay_btn").click(function(){
        payByTransID()
    });

    //$("#ref_id").html(pulled_red);
    $("#payment_method").change(function(){
        var method = $(this).val();
        var acc = document.getElementById("acc_num");
        $("#payment_code_body").show();
        if(method === "Mo626"){
            $("#lb_say_what").html("Nation Bank Acc # :");
            acc.setAttribute("placeholder", "NB Account Number");
            $("#payment_code").html("Send to National Bank account # '1005486218' and enter the Transaction ID below!");
        }else if(method === "Airtel-Money"){
            $("#lb_say_what").html("Airtel Money Number :");
            acc.setAttribute("placeholder", "e.g 265 99 518 0058");
            $("#payment_code").html("Pay via the Airtel Money Agent Code 'LL17276' and enter the Transaction ID below!");
        }else if(method === "TNM-Mpamba"){
            $("#lb_say_what").html("TNM Mpamba Number :");
            acc.setAttribute("placeholder", "e.g 265 88 12 3456");
            $("#payment_code").html("Pay via Mpamba Agent Code  '262730' and enter the Transaction ID below!");
        }
    });

    $("#toggle_pay_check").change(function(){
        if(toggle_payment === "offsite_payment"){
            $("#offsite_payment").hide();
            $("#onsite_payment").show();
            $("#payment_code").html("Use Transaction ID");
            toggle_payment = "onsite_payment";
        }else if(toggle_payment === "onsite_payment"){
            $("#offsite_payment").show();
            $("#onsite_payment").hide();
            //$("#prompt").html("Pay with your account here");
            toggle_payment = "offsite_payment";
        }
       // $("#toggle_pay_check").prop("checked", false);
    });
});

function payByTransID(){
    var txn = {
        pay_for : $("#service_paid_for").val(),
        trans_id1 : $("#trans_id1").val(),
        trans_id2 : $("#trans_id2").val(),
        ref_code : $("#service_ref").val()
    };
    
    if(txn.pay_for == ""){
        swal("Attention!", "Please Indicate which service you are paying for. Select from the list!", "info");
    }else if(txn.service_ref == ""){
        swal("Attention!", "Please enter the Reference Code of the service you are paying for!", "info");
    }else if(txn.trans_id1 == "" || txn.trans_id2 == ""){
        swal("Attention!", "Make sure that both Transaction fields are valid!", "info");
    }else if(txn.trans_id1 != txn.trans_id2){
        swal("Invalid Entry!", "The first and second Transaction IDs do not match!", "warning");
    }else{
        $.ajax({
            url : baseURL+"makePayment.php",
            method : "GET",
            type : "application / x-www-form-urlencoded",
            data: txn,
            success: function(response){
                var json = JSON.parse(response);
                swal(json.title, json.message, json.status);
                if(json.status == "success"){
                    $("#reset_modal").click();
                }
            }, error: function(err){
                swal("Error 404", "The requested url could not be found!", "error")
            }

        });
    }
}