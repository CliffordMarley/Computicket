"use strict";
let current_card = "preview";
var persistent;
var imageUrl = ["snap.jpg","buses/b4.jpg","buses/b5.jpg","buses/b6.jpg"];
$(document).ready(function(){
     rotateBackground();
     $("#search_trips").click(function(){
          console.log("Search button clicked!");
          searchTrips();
     });

    $("#ticket_yes_btn").click(function(){
       if(current_card === "preview"){
          $("#ticket_data").hide();
            $("#price_preview").show();
            $("#nsr").html(persistent.company);
            $("#nsrdate").html(persistent.date);
            $("#nsrprice").html(persistent.price);
            $("#nsrseatcount").html($("#num_seats").val());
            $("#nsrtotal").html(parseInt(persistent.price) * parseInt($("#num_seats").val()));

            document.getElementById("ticket_yes_btn").innerHTML = "I Agree";
            document.getElementById("close_ticket_btn").innerHTML = "Go Back";
            current_card = "price_preview";
       }else if(current_card === "price_preview"){
            $("#price_preview").hide();
            $("#ticket_data").hide();
            $("#customer_info").show();
            current_card = "customer_info";
            //swal("Reservation Successfull", "You have up to 5 hours before the time of departure to pay for your ticket. Failure of which the ystem will automatically cancel your seat(s) reservation!","success");
            document.getElementById("ticket_yes_btn").innerHTML = "Ok, Reserve";
            document.getElementById("close_ticket_btn").innerHTML = "No, Ignore";
          }else if(current_card === "customer_info"){
               registerReservation(persistent.trip_id);
          }
    });

    $("#close_ticket_btn").click(function(){
        if(current_card === "price_preview"){
             $("#ticket_data").show();
             $("#price_preview").hide();
             document.getElementById("ticket_yes_btn").innerHTML = "Yes, Proceed";
             document.getElementById("close_ticket_btn").innerHTML = "No, Cancel";
             current_card = "preview";
        }else if(current_card === "preview"){
          $('#close_btn1').click();
        }
     });

     $("#num_seats").blur(function(){
          $("#total_fare").val($(this).val()*6500);
     });

     
});

async function rotateBackground(){
     var x = 0;
     setInterval(()=>{
          $("#upper").css("background-image", "url(../../assets/img/" + imageUrl[x] + ")").transition("fade in");
          x++;
          if(x == (imageUrl.length-1)){
               x = 0;
          }
     }, 2000);
}

function registerReservation(id){
     loading("show", "Preparing Ticket...");
     var customer = {
          step:"two",
          trip_id : id,
          num_seats: $("#num_seats").val(),
          customer_name:$("#customer_name").val(),
          gender: $("#gender").val(),
          phone: $("#phoneNo").val(),
          email: $("#email").val(),
          total: $("#num_seats").val() * persistent.price,
          //pay_method: $("#payment_method").val()
     }

     $.ajax({
          url:baseURL+"buildTicket.php",
          method:"GET",
          type: "application/x-www-form-urlencoded",
          data: customer,
          success:function(response){
               var json = JSON.parse(response);
               loading("hide","");
               if(json.status == "success"){
                   $('#close_btn1').click();
                   $('#customer_info').hide();
                   $("#price_preview").hide();
                   $("#ticket_data").show();
                   document.getElementById("ticket_yes_btn").innerHTML = "Yes, Proceed";
                   document.getElementById("close_ticket_btn").innerHTML = "No, Cancel";
                   current_card = "preview";
                   window.location.href = "../payments";
               }else{
                    swal("Reservation Sustained", json.message, json.status);
               }
               
          },error:function(err){
               swal("Connection Error", "The requested url could not be found!", "error")
          }

     });
}

async function buildTicket(trip_id){
     loading("show");
     $.get(baseURL+"buildTicket.php?step=one&trip_id="+trip_id, function(response){
          var json = JSON.parse(response);
          if(json.status === "success"){
               persistent = json.data;
               document.getElementById("num_seats").setAttribute("max", json.data.seats);;
               $("#v_trip_id").html("BTS-"+trip_id);
               $("#v_origin").html(json.data.origin);
               $("#v_destination").html(json.data.destination);
               $("#v_date").html(json.data.date);
               $("#v_dtime").html(json.data.d_time);
               $("#v_atime").html(json.data.a_time);
               $("#v_service").html(json.data.company);
               $("#v_eta").html(json.data.lapse);
               $("#v_fare").html(json.data.price);
               $("#v_seats").html(json.data.seats);

               loading("hide");
               $("#view_ticket").click();
              // HTMLtoPDF();
          }else{
               swal("Error Building a Ticket", json.message, "error");
          }
     }).fail(function(error){
               swal("Error "+error.status, "The requested URL could not be found", );
     });;
}

 function searchTrips(){
     var search_params = {
          bus_company : $("#bus_company").val(),
          travel_date : $("#dept_date").val(),
          origin : $("#origin").val(),
          destination : $('#destination').val()
     };

     $.ajax({
          url: baseURL+"searchTrip.php",
          method: "GET",
          type: "application/x-www-form-urlencoded",
          data: search_params,
          success: function(response){
               var json = JSON.parse(response);
               var parent = document.getElementById("bus_results");
               createDOM(json.data, parent);
          },error: function(){
               swal("Connection Error", "Could not reach the specified url!", 'error');
          }
     });
}

async function createDOM(data, parent){
     parent.innerHTML = "";
     var x = 0;
     for(var i = 0; i < data.length; i++){
          var div = document.createElement("div");
          div.setAttribute('class', "ui segment");
          div.innerHTML = "<div class='row'><div class='col-12 col-md-2'><h4 class='time'>From: "+data[i].departure_time+"</h4></div><div class='col-12 col-md-6'>"+
          "<h3 class='bus'>"+data[i].company_name+" ("+data[i].type.toUpperCase()+") / "+data[i].bus_id+"</span></h3></div>"+
          "<div class='col-12 col-md-3'><h2 class='float-right fare'>K "+data[i]._price+"</h2></div>"+
          "</div>"+
              "<div class='row'>"+
                        " <div class='col-12 col-md-2'><p class='midrow'>ETA: "+Math.abs(data[i].lapse/1000)+"hrs</p> </div>"+
                        "<div class='col-12 col-md-6'>"+
                              "<label class='midrow'>Origin: <span>"+data[i].origin+"</span> |   | Destination: "+data[i].destination+"</span></label>"+
                         "</div>"+
                             "<div class='col-12 col-md-3'><h4 class='float-right midrow'>"+data[i].avail_seats+" Seats Left</h4></div></div>"+
                         "<div class='row'>"+
                              "<div class='col-12 col-md-2'><h4 class='time'>To: "+data[i].arrival_time+"</h4></div>"+
                                   "<div class='col-12 col-md-6'>"+
                                                                      
                                   "</div>"+
                              "<div class='col-12 col-md-3'>"+
                                   "<button  type='button'  onclick='buildTicket("+data[i].trip_id+")'  class='float-right ui button basic mini blue circular booking_btn'>BOOK SEATS</button>"+
                              "</div></div></div>";
     parent.appendChild(div);
     x++;
     }
     var ele = document.getElementById('s_r_txt');
     if(x <= 0){
          $('#s_r_txt').html("Nothing Matched your search criteria!");
          ele.style.color = "red";
     }else{
          $('#s_r_txt').html(x+" Results Matched your search criteria!");
          ele.style.color = "green";
     }
}
