var cars = 0;
var selected_cars = [];
var ele;
$(document).ready(function () {
    ele = $("#cars_selected");
    $('.ui.dimmer, .ui.dimmer.content').click(function () {
        loader("hide", "");
    });
    $('.ui.checkbox').checkbox();
    $('#drop_off_different').bind("click", function () {
        let value = document.getElementById("drop_off_different").checked;
        let pickup = document.getElementById('pickup_location');
        let drop = document.getElementById('return_location');
        if (value) {
            pickup.setAttribute("class", "col-12 col-lg-6 form-group");
            drop.style.display = "block";
        } else {
            pickup.setAttribute("class", "col-12 col-lg-12 form-group");
            drop.style.display = "none";
        }
    });

    $(".book").click(function () {
        ToggleCarSelection($(this));
    });
    $("#checkout_btn").click(function () {
        if (selected_cars.length > 0) {
            loading("show", "Assigning selected vehicles...");
            window.location.href = "confirm_rental.php";
        } else {
            swal("Process Denied!", "Make sure that you have selected at least 1 car before checking out!", "warning");
        }
    });

    $("#confirm_btn").click(function () {
        confirmBooking();
    });
});

function ToggleCarSelection(e) {
    var car_id = e.val();
    car_id = parseInt(car_id);
    console.log("Car Selection Toggled with ID " + car_id);
    var match_status = false;
    for (var i = 0; i < selected_cars.length; i++) {
        if (selected_cars[i] == car_id) {
            selected_cars.pop(car_id);
            match_status = true;
            e.html("SELECT");
            break;
        }
    }

    if (match_status == false) {
        selected_cars.push(car_id);
        e.html("DESELECT");
    }
    $("#cars_selected").html(selected_cars.length);
    if (selected_cars.length > 0) {
        document.getElementById("checkout_btn").style.background = "green";
    } else {
        document.getElementById("checkout_btn").style.background = "red";
    }
    //console.log();
    console.log(JSON.stringify(selected_cars));
}

function confirmBooking() {
    var dx = {
        fname: $("#fname").val(),
        lname: $("#lname").val(),
        phone_number: $("#phone_number").val(),
        email_address: $("#email_address").val(),
        car_id: $("#car_id").val(),
        pickup: $("#pickup").val(),
        drop_off: $("#dropoff").val()
    };

    if (dx.fname == "" || dx.fname == null || dx.lname == "" || dx.lname == null) {
        swal("Attention", "Make sure that both name fields have been filled!", "warning");
        return;
    } else if (dx.phone_number == "" && dx.email_address == "") {
        swal("Contact Required!", "Make sure that you have provided either your Email address or mobile Phone number!", "warning");
        return;
    } else {
        $.ajax({
            url: baseURL + "confirmCarRental.php",
            method: "POST",
            type: "application/x-www-form-urlencoded",
            data: dx,
            timeout: 0,
            cache:true,
            beforeSend: function () {
                loading("show", "Processing Request...");
            },
            success: function (response) {
                var json = JSON.parse(response);
                if (json.status == "success") {
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
                } else {
                    swal(json.title, json.message, json.status);
                }
                loading("hide", "");
            },
            error: function (xhr, status, error) {
                loading("hide", "");
                if (status === "timeout") {
                    swal("Connection Timeout!", "The process is taking way too long!", "error");
                } else {
                    swal("Connection Error!", "The requested URL could not be reached!", "error");
                }
            }
        });
        // swal("Congratulations", "You have successfully rented your selected cars! You will receive an email or text confirmation soon.", "success");
        // window.location.href = "index.php";
    }

}