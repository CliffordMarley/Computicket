"use strict";
var baseURL = "http://www.computicket.mw/admin/php_scripts/";



$(document).ready(function(){
    $('.tabular.menu .item').tab();
    $('#submit_bus').bind('click',function(){
        addBus();
    });
    $("#schedule_trip").click(function(){
            scheduleTrip();
    });
    

});

function addBus(){
   var datax ={
        reg_number : $('#reg_number').val(),
        company :$('#company').val(),
        bus_type : $("#bus_type").val(),
        num_seats : $('#num_seats').val(),
        description : $('#description').val()
    };  
    $.ajax({
           url : baseURL+"addBus.php?", 
           method: "GET",
           type:"application/x-www-form-urlencoded",
           data:datax ,
           success: function(response){
            var json = JSON.parse(response);
            swal(json.title, json.message, json.status);
             },
             error:function(err){
                swal("Error "+err.status, "The Requested URL could not be found", "error");
            }
        });
}

function scheduleTrip(){
     var td = {
            origin:$("#origin").val(),
            destination:$("#destination").val(),
            travel_date:$("#dept_date").val(),
            dept_time:$("#dept_time").val(),
            arrival_time:$("#arrival_time").val(),
            bus:$("#bus").val(),
            route:$("#route").val()
    };

    if(td.origin == "" || td.destination == "" || td.travel_date == "" || td.dept_time == "" || td.arrival_time == "" || td.bus == 0 || td.route == ""){
        swal("Attention!", "Make sure that the form has been properly and fully completed!","warning");
        return;
    }else{
        if(td.origin === td.destination){
            swal("Invalid Entry", "You cannot set a single Origin and Destination point.","warning");
        }else if(td.dept_time === td.arrival_time){
            swal("Invalid Entry", "The Departure and Arrival time cannot be the same!","warning");
        }else{
            $.ajax({
                url:baseURL+"addTrip.php",
                method: "GET",
                type:"application/x-wwww-form-urlencoded",
                data:td,
                success: function(response){
                    var json = JSON.parse(response);
                    if(json.status == "success"){
                        $("#reset_modal").click();
                    }
                    swal(json.title, json.message, json.status);
                },
                error: function(xhr, error, errorThrown){
                    swal("Error", error, "error");
                }
            });
        }
    }
}
