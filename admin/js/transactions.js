"use strict";
var baseURL = "http://www.computicket.mw/admin/php_scripts/";
$(document).ready(function(){
    $("#log_transaction_btn").click(function(){
        manualTransactionLog();
    });
    $('#transid1, #transid2, #amount2, #amount1').bind("cut copy paste",function(e) {
        e.preventDefault();
    });
});

function manualTransactionLog(){
    var txn = {
        transid1 : $("#transid1").val(),
        transid2 : $("#transid2").val(),
        amount1 : $("#amount1").val(),
        amount2 : $("#amount2").val(),
        service : $("#money_service").val(),
    };
    //alert(JSON.stringify(txn));
    if(txn.transid1 == "" || txn.transid2 == ""){
        swal("Empty Fields Detected", "Make sure that both Transaction ID Fields are Filled properly!", "error");
        return;
    }else if(txn.transid1 != txn.transid2){
        swal("Input Mismatch Error", "Transaction ID fields do notmatch. Please re-enter correctly!", "error");
        return;
    }else if(txn.amount1 == "" || txn.amount2 == ""){
        swal("Empty Field Detected", "Make sure that both amount fields are not empty!", "error");
        return;
    }else if(txn.amount1 != txn.amount2){
        swal("Input Mismatch Error", "The Amount fields contain different value!", "error");
        return;
    }

    $.ajax({
        url:baseURL+"logTransaction.php",
        method: "GET",
        type: "application/x-www.form-urlencoded",
        data:txn,
        timeout:0,
        success:function(response){
            var json = JSON.parse(response);
            if(json.status === "logout"){
                window.location.href = "../cgi-bin.php";
            }else{
                if(json.status === "success"){
                    $('#modal_dimiss3').click();
                }
                swal(json.title, json.message, json.status);
            }
            
        }, 
        error:function(error){
            alert(JSON.parse(error));
        }
    });

}