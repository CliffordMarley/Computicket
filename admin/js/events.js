var baseURL = "http://www.computicket.mw/admin/php_scripts/";
var dx;
var selectedEvents = [];
$(document).ready(function(){
    $("#add_event_btn").click(function(){
        addNewEvent();
    });
    $("#checkAllEvents").change(function(){
        $(".toggleEventCheck").click();
    });
    $("#delete_event_btn").click(function(){
        if(selectedEvents.length <= 0){
            swal("Guide!", "Make sure that you have selected at least one event row!", "warning");
        }else{
            deleteEvents();
        }
    });
});

function addNewEvent(){
    $("#newEvent").modal("hide");
    loading("show","Dumping data to database...");
    dx = {
        event_name : $("#event_name").val(),
        organiser : $("#organiser").val(),
        venue : $("#venue").val(),
        type : $("#type").val(),
        date_of_event : $("#date_of_event").val(),
        time_of_event : $("#time_of_event").val(),
        regular_price : $("#regular_price").val(),
        vip_price : $("#vip_price").val(),
        desc : $("#desc").val(),
        process: "addNew"
    };

    if(dx.event_name == "" || dx.organiser == "" || dx.venue == "" || dx.type == "" || dx.date_of_event == "" || dx.time_of_event == "" || dx.desc == ""){
        swal("Unfulfilled Dataset", "Make sure that all required fields are not empty!", "error");
    }else{
        $.ajax({
            url: baseURL+"events.php",
            method: "GET",
            type: "application / x-www-form-urlencoded",
            data: dx,
            timeout: 0,
            success: function(response){
                var json = JSON.parse(response);
                if(json.status == "success"){
                    
                    try{
                        uploadImage(json.message);
                    }catch(err){
                        loading("hide", "");
                    }
                }else{
                    loading("hide", "");
                    $("#newEvent").modal("show");
                    swal(json.title, json.message, json.status);
                }
            },error: function(error){
                loading("hide", "");
                $("#newEvent").modal("show");
                swal("Error 404", "The requested URL could not be reached!", "error");
            }
        });
    }
}

function updateDOMTABLE(json){
                var row = document.createElement("tr");
                row.innerHTML = "<td class='data'>"+($('#events_table').find('tr').length+1)+"</td>"+
                "<td class='data'>"+json.event_name+"</td>"+
                "<td class='data'>"+json.organiser+"</td>"+
                "<td class='data'>"+json.type+"</td>"+
                "<td class='data'>"+json.venue+"</td>"+
                "<td class='data'>"+json.date_of_event+"</td>"+
                "<td class='data'>"+json.time_of_event+"</td>"+
                "<td class='data'>"+
                   "<input type='checkbox' class='toggleEventCheck' value=''>"+
                "</td>";
    document.getElementById('events_table_body').appendChild(row);;
}

function uploadImage(success_message){
    var property = document.getElementById("file").files[0];
    var filename = property.name;
    var filesize = property.size;
    var file_ext = filename.split(".").pop().toLowerCase();
    if(jQuery.inArray(file_ext, ['gif','jpeg','jpg','png']) == -1){
        alert("Invalid mage file");
    }else if(filesize > 5000000){
        alert("File too large");
    }else{
        var form_data  = new FormData();
        form_data.append("file", property);

        $.ajax({
            url: baseURL+"events.php",
            method: "POST",
            contentType:false,
            data: form_data,
            cache: false,
            processData: false,
            success: function(data){
                var res = JSON.parse(data); 
                if(res.status == "success"){
                    swal(res.title,success_message , res.status);
                }else{
                    swal(res.title, res.message, res.status);
                }
                loading("hide", "");
                $("#reset_modal").click();
                $("#newEvent").modal("hide");
                updateDOMTABLE(dx);
            }, error: function(error){

            }
        });
    }
}

function toggleSelection(row_id){
    var exist = false;
    var i;
    for ( i = 0; i < selectedEvents.length; i++) {
        if(selectedEvents[i] == row_id){
            exist = true;
            break;
        }
    }
    if(exist){
        selectedEvents.splice(i, 1);
    }else{
        selectedEvents.push(row_id);
    }
        console.log(selectedEvents);
}

function deleteEvents(){
    $.ajax({
        url: baseURL+"events.php",
        type: "POST",
        dataType: "json",
        timeout: 0,
        data: "process=delete&data="+JSON.stringify(selectedEvents),
        success: function(json){
                swal(json.title, json.message, json.status);
                if(json.status == "success"){
                    for(var i= 0; i < selectedEvents.length; i++){
                        $("#"+selectedEvents[i]).remove();
                    }
                }
        }, error: function(error){
            swal("Connection Error!", "The requested URL could not be reached!!", "error");
        }

    });
}