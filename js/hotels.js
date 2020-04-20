"use strict";

$(document).ready(function(){
    loadData();
    $("search_hotels_btn").click(function(){
        searchReservationAvailability();
    });
    // $("#sub_btn").click(function(){
    //     subscribe($('#sub_email').val());
    // });
});

function searchReservationAvailability(){
    var data = {
         hotel_id : $("#destination").val(),
         checkin : $("#checkin").val(),
         checkout : $("#checkout").val(),
         num_adults : $("#num_adults").val(),
         num_children : $("#num_children").val()
    };
     alert(data);
    //swal("Data Preview" , JSON.stringify(data), "success");
}

async function loadData(){
    var adultsSelect = document.getElementById("sv_adults");
    var childrenSelect = document.getElementById("sv_children");
    var roomsSelect = document.getElementById("sv_rooms");
    for(var x = 1; x <= 32; x++){
        var option = document.createElement("option");
        if(x ==1){
            option.innerHTML = x+" Adult";
        }else{
            option.innerHTML = x+" Adults";
        }
        
        option.setAttribute("value",x);
        adultsSelect.appendChild(option);
    }
    for(var x = 1; x <= 10; x++){
        var option = document.createElement("option");
        if(x == 1){
            option.innerHTML = x+" Child";
        }else{
            option.innerHTML = x+" Children";
        }
        option.setAttribute("value",x);
        childrenSelect.appendChild(option);
    }
    for(var x = 1; x <= 30; x++){
        var option = document.createElement("option");
        if(x == 1){
            option.innerHTML = x+" Room";
            option.setAttribute("selected",true);
        }else{
            option.innerHTML = x+" Rooms";
        }
        option.setAttribute("value",x);
        roomsSelect.appendChild(option);
    }
}