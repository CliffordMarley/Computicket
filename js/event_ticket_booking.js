"use strict";
var standard_price, vip_price, event_name,event_id;
var ticket_orders = [];
$(document).ready(function(){
    $("#add_ticket").click(function(){
        addTicket();
    });

    $("#buy_tickets_btn").click(function(){
        var fname = $("#fname").val();
        var lname = $("#lname").val();
        var email_address = $("#email_address").val();
        if(email_address == null){
            swal("Attention!", "Make sure that you have provided the email"+
            "address that will be use to receive the ticket(s)!", "warning");
        }else if(fname == null || lname == null){
            swal("Attention!", "make sure that you have provide both the Firstname and Lastname!", "warning");
        }else{
            buyTickets(fname,lname,email_address);
        }
    });
});

function addTicket(){
    var parent = document.getElementById("ticket_body");
    var ticket = {
        event_id : event_id,
        ticket_class: $("#t_c").val(),
        quantity: $("#t_q").val()
    };
    //alert(ticket.ticket_class);
    if(ticket.ticket_class == null){
        document.getElementById("t_c").style.border = "1px solid red";
        return;
    }else if(ticket.quantity == null){
        document.getElementById("t_q").style.border = "1px solid red";
        return;
    }else{
        
        document.getElementById("t_c").style.border = "";
        document.getElementById("t_q").style.border = "";

        var name = document.createElement("td");
        name.innerHTML = event_name;

        var row = document.createElement("tr");
        var x = $("#ticket_table tr").length;
        row.setAttribute("id", ""+x+"");

        var type = document.createElement("td");
        type.innerHTML = ticket.ticket_class+" Ticket";

        var quantity = document.createElement("td");
        quantity.innerHTML = ticket.quantity;

        var total = document.createElement("td");
        
       if((standard_price != null && standard_price != "") || (vip_price != null && vip_price != "")){
            try{
                if(ticket.ticket_class == "Standard"){
                    total.innerHTML = "$"+(ticket.quantity * parseInt(standard_price));
                }else{
                    total.innerHTML = "$"+(ticket.quantity * parseInt(vip_price));
                }
        }catch(err){
                total.innerHTML = "FREE";
        }
       }else{
        total.innerHTML = "FREE";
       }

        var remove = document.createElement("td");
        remove.innerHTML = "<center><div onclick = 'removeTicketRow("+x+")'><i class='icon close'></i></div></center>";

        row.appendChild(name);
        row.appendChild(type);
        row.appendChild(quantity);
        row.appendChild(total);
        row.appendChild(remove);

        parent.appendChild(row);
        $("#ticket_form_reset").click();
        ticket_orders.push(ticket);
        console.log(JSON.stringify(ticket_orders));
    }
    if(ticket_orders.length > 0 & ($("#fname").val() != null && $("#lname").val() != null && $("#email_address").val() != null)){
        $("#fname").attr("readonly", "true");
        $("#lname").attr("readonly", "true");
        $("#email_address").attr("readonly", "true");
    }
}

function removeTicketRow(row_id){
    ticket_orders.splice(row_id -1);
    console.log(ticket_orders);
    $("#"+row_id).remove();
    if(ticket_orders.length <= 0){
        $("#fname").attr("readonly", "false");
        $("#lname").attr("readonly", "false");
        $("#email_address").attr("readonly", "false");
    }
}

function setPrices(id,evt_name,s_p,v_p){
    standard_price = s_p;
    vip_price = v_p;
    event_name = evt_name;
    event_id = id;
    document.getElementById("std_opt").innerHTML = "Standard Ticket ($"+standard_price+".00)";
    document.getElementById("vip_opt").innerHTML = "VIP Ticket ($"+vip_price+".00)";
}

function buyTickets(fname,lname,email_address){
    // swal("Sorry, this functionality has been tempolarily disabled. Thank you for your support!!!");
    // return;
    loading("show", "PROCESSING TICKETS...");
    $("#cls").click();
    $.ajax({
        url: baseURL+"buildEventTicket.php",
        data: "fname="+fname+"&lname="+lname+"&email_address="+email_address+"&data="+JSON.stringify(ticket_orders),
        type: "POST",
        dataType: "json",
        success: function(response){
            var json = response;//JSON.parse(response);
            if(json.status == "success"){
                //swal(json.title, json.message, json.status);
                swal({
                      title: json.title,
                      text: json.message,
                      type: "info",
                      showCancelButton: true,
                      closeOnConfirm: false,
                      confirmButtonText: "Pay Now!",
                      cancelButtonText: "Later",
                      showLoaderOnConfirm: true
                    }, function () {
                      setTimeout(function () {
                        swal("Redirecting to payments page...");
                        window.location.href = json.url;
                      }, 2000);
                    });
            }else{
                swal(json.title, json.message, json.status);
            }
            loading("hide", "");
        }, error: function(error){
            swal("Error 404", "The requested URL could not be found!", "error");
            loading("hide", "");
        }
        
    });
}