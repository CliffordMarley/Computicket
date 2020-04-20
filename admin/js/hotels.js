"use strict";
var baseURL = "http://www.computicket.mw/admin/php_scripts/";

var selected_rows = [];

var s_a_p = false;
$(document).ready(function(){
    $("#save_hotel").click(function(){
        addHotel();
    });

    $("#sap").change(function(){
        if(!s_a_p){
            $("#hotel_name").hide();
            s_a_p = true;
        }else{
            $("#hotel_name").show();
            s_a_p = false;
        }
    });

    $("#delete_hotels").click(function(){
        if(selected_rows.length > 0){
            removeHotels();
        }else{
            swal("Process Failed", "There are no rows selected for this operation!", "warning");
        }
    });
});

function addHotel(){
    var datax = {
        domain:$("#domain").val(),
        hotel_name:$("#hotel_name").val(),
        email_address: $("#email_address").val(),
        phone_number:$("#phone_number").val(),
        address:$("#address").val(),
        district:$("#district").val(),
        sap:s_a_p
    };


    $.ajax({
        url: baseURL+"addHotel.php",
        method: "GET",
        type: "application/x-www-form-urlencoded",
        data: datax,
        success: function(response){
            var  json = JSON.parse(response);   
            if(json.status === "success"){
                $("#modal_dismiss").click();
            }
            swal(json.title, json.message, json.status);     
        },error: function(){
            $("#modal_dismiss").click();
            swal("Connection Error", "Failed to connect to application server!", "error");
        }
    });
}

function removeHotels(){
    var dataToSend;
    for (var i = 0; i < selected_rows.length; i++) {
        if(i == 0){
            dataToSend = selected_rows[i];
        }else{
            dataToSend += "@"+selected_rows[i];
        }
    }
   //alert(dataToSend);
   $.ajax({
        url: baseURL+"deleteHotel.php",
        method: "POST",
        type: "application/x-www-form-urlencoded",
        data: "ids="+dataToSend,
        success: function(response){
            var json = JSON.parse(response);
            swal(json.title, json.message, json.status);
            if(json.status === 'success'){
                 var parent =  document.getElementById('hotels_list');
                 var child;
              for(var i = 0; i < selected_rows.length; i++){
                  child = document.getElementById(""+selected_rows[i]+"");
                  parent.removeChild(child);
              }
              selected_rows=[];
            }
        },
        error: function(error){
            swal("Connection Error", "Could not reach the Application Server!", "error");
        }
   });
}

function readyRow(row_id){
    var exist = false;
    var i;
    for (i = 0; i < selected_rows.length; i++) {
        if(selected_rows[i] == row_id){
            exist = true;
            break;
        }
    }
    if(exist){
        selected_rows.splice(i,1);
    }else{
        selected_rows.push(row_id);
    }
    //alert(selected_rows);
}