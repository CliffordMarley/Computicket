var API_KEY = "bGcJxAFR4mvMNGnIlsJzyrz7ihJyVPJ0";
var SECRET = "rrC5vhnsA8gGgE0g";
var ACCESS_TOKEN;
$(document).ready(function(){
    
      $("#getNewTocken").click(function(){
        var settings = {
            "url": "https://test.api.amadeus.com/v1/security/oauth2/token",
            "method": "POST",
            "timeout": 0,
            "data": {
              "client_id": API_KEY,
              "client_secret": SECRET,
              "grant_type": "client_credentials"
            }
          };
          
          $.ajax(settings).done(function (res) {
              console.log(res);
              ACCESS_TOKEN = res.access_token;
          });
      });

      $("#search").click(function(){
        var settings = {
            "url": "https://test.api.amadeus.com/v2/shopping/hotel-offers?cityCode=LON",
            //"url" : "https://test.api.amadeus.com/v2/shopping/hotel-offers/by-hotel?hotelId=SUJNB098",
            //"url" : "https://test.api.amadeus.com/v2/shopping/hotels;///DTLAX213/offers/BA65FD3C737A45D18A5D0984254A3BDB86E2BD227FB67FEDD88A87DD2004A560",
            "method": "GET",
            "timeout": 0,
            async:true,
            beforeSend: function(xhr){
                xhr.setRequestHeader('Authorization', 'Bearer '+ACCESS_TOKEN);
            }
          };
          
          $.ajax(settings).done(function (response) {
            console.log(response);
          });
      });
});