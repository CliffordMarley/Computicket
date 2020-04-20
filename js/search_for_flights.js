"use strict";

$(document).ready(function(){
    $("#quick_flight_search_btn").click(function(){
        var origin = $("#origin").val();
        var destination = $("#destination").val();
        alert(origin);
        var settings = {
            "method": "GET",
            "async": true,
            "dataType": "application/json",
            "url": "https://test.api.amadeus.com/v1/shopping/flight-destinations?origin="+origin,
            "headers": {
              "Authorization": "Bearer TfrgyB1K9PIG6DsPA6NFNDpqKDrt",
              "Cache-Control": "no-cache",
              "Postman-Token": "faab0af1-d8ea-7d94-7d4e-a338f8496666"
            }
          }
          
          $.ajax(settings).done(function (response) {
              console.log(response);
            //swal("Flights Queried!", JSON.parse(response), "success")
          });
    });
});


