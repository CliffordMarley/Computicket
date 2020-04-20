"use strict";
const baseURL = "https://www.computicket.mw/admin/php_scripts/"
$(document).ready(function () {
    searchForRentals("onload");
    $(".page_tab_btns").click(function () {
        $(".page_tab_btns").removeClass("tabbed");
        $(this).addClass("tabbed");
    });

    $("#searchRentalsBtn").click(function () {
        searchForRentals("searching");
    });

    $('.message .close').on('click', function () {
        $(this).closest('.message').transition('fade');
    });
    $("#view_rentals").click(function () {
        $("#new_car_form").hide();
        $("#rental_details").show();
    });
    $("#add_cars").click(function () {
        $("#rental_details").hide();
        $("#new_car_form").show();
    });
    $("#add_cars_btn").click(function () {
        $("#images").click();
        console.log("Images btn clicked!");
    });

    $("#images").change(function () {
        console.log("Images state changed!!");
        readURL(this);
    });
});

function readURL(input) {
    if (input.files.length > 0 && input.files.length <= 4) {
        $.each(input.files, function (i, v) {
            var reader = new FileReader();
            reader.onload = function (e) {
                var name_now = "#image".concat(i.toString());
                $(name_now).attr("src", e.target.result);
            }
            reader.readAsDataURL(input.files[i]);
        });
    }
}

function searchForRentals(init) {
    var json = {
        ref_number: $("#ref_num").val(),
        customer: $("#customer_name").val(),
        v_status: $("#vehicle_status").val()
    }

    $.ajax({
        url: baseURL + "searchRentals.php",
        type: "POST",
        data: json,
        timeout: 0,
        contentType: "application/x-www-form-urlencoded",
        beforeSend: function () {
            loading("show", "Fetching Car Rental Records...");
        },
        success: function (response) {
            loading("hide", "");
            var json = JSON.parse(response);
            if (init != "onload") {
                swal(json.title, json.message, json.status);
            }
            if (json.status == "success") {
                renderRentalsDOM(json.data);
            }
        },
        error: function (xhr, status, error) {
            swal("Connection Error!", "The requested URL could not be reached!", "error");
        }

    });
}

function renderRentalsDOM(json) {
    var parent = document.getElementById("rental_list_body");
    parent.innerHTML = "";

    for (var x = 0; x < json.length; x++) {
        let row = document.createElement("tr");
        row.setAttribute("id",json[x].rental_id);

        let td1 = document.createElement("td");
        let td2 = document.createElement("td");
        let td3 = document.createElement("td");
        let td4 = document.createElement("td");
        let td5 = document.createElement("td");
        let td6 = document.createElement("td");
        let td7 = document.createElement("td");
        let td8 = document.createElement("td");
        let td9 = document.createElement("td");
        // let td10 = document.createElement("td");
        let td11 = document.createElement("td");
        let td12 = document.createElement("td");

        if (json[x].status == "Approved") {
            td9.innerHTML = "<button disabled type='button' class='approval_btn btn-block btn btn-sm btn-secondary flat-field'>" +
                "APPROVED</button>";
        } else {
            td9.innerHTML = "<button type='button' onclick=approveRental('" + json[x].rental_id +"') class='approval_btn btn-block btn btn-sm btn-success flat-field'>" +
                "APPROVE</button>";
         }
        // td10.innerHTML = "<button type='button' class='btn-block btn btn-sm btn-warning flat-field'>" +
        //     "UPDATE</button>";
        td11.innerHTML = "<button type='button' class='btn-block btn btn-sm btn-danger flat-field'>" +
            "CANCEL</button>";



        td1.innerHTML = json[x].rental_id;
        td2.innerHTML = json[x].fname + " " + json[x].lname;
        td3.innerHTML = json[x].email_address;
        td4.innerHTML = json[x].phone_number;
        td5.innerHTML = json[x].pickup;
        td6.innerHTML = json[x].drop_off;
        td7.innerHTML = json[x].Payment;
        td8.innerHTML = json[x].car;
        td12.innerHTML = json[x].status;

        row.appendChild(td1);
        row.appendChild(td2);
        row.appendChild(td3);
        row.appendChild(td4);
        row.appendChild(td5);
        row.appendChild(td6);
        row.appendChild(td7);
        row.appendChild(td8);
        row.appendChild(td12);
        row.appendChild(td9);
        // row.appendChild(td10);
        row.appendChild(td11);

        parent.appendChild(row);
    }
}

function approveRental(crid) { 
    if (crid == "" || crid == null) {
        swal("Process Error!", "Approval function received an empty Rental ID, try refreshing the page!", "error");
    } else { 
        $.ajax({
            url: baseURL + "approveCarRental.php",
            method: "POST",
            contentType: "application/x-www-form-urlencoded",
            data: "crid=" + crid,
            beforeSend: function () { 

            },
            success: function (response) {
                var json = JSON.parse(response);
                swal(json.title, json.message, json.status);
                if (json.status == "success" || json.status == "warning") { 
                    var ele = $("#" + crid + " td .approval_btn");
                    ele.html("APPROVED");
                    ele.removeClass("btn-success");
                    ele.addClass("btn-secondary");
                }
            }, error: function (xhr, status, error) { 
                swal("Connection Error!", "The requested URL could not be reached!", "error");
            }
        });
    }
}