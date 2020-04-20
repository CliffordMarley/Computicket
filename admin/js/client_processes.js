"use strict";

var baseURL = "http://www.computicket.mw/admin/php_scripts/";
$(document).ready(function(){
    //Load Companies to table
    //getCompanies();
    $('.delete_btn').click(function(){
        var id = $(this).val();
        deleteClient(id);
    });

    $("#add_company_btn").click(function(){
        addCompany();
    });

    $("#delete_events_btn").click(function(){
        deleteEvents();
    });

    
    
});


async function addCompany(){
    var datax = {
        company_name: $('#company_name').val(),
        industry: $('#industry').val(),
        email_address: $("#email_address").val(),
        phone_number: $('#phone_number').val(),
        phy_address: $('#phy_address').val()
    };

    if(datax.company_name === "" ){
        swal("Error", "Make sure that you have entered a full & valid Company Name!", "error");
    }else if(datax.phone_number === ""){
        swal("Error", "Make sure that a valid Contact phone number has been provided!", "error");
    }else{
        // $.get(baseURL+"addcompany.php?"+data, function(response){
            
        // }).fail(function(err){
        //     swal("Error "+err.status, "The Requested URL could not be found", "error");
        // });
        $.ajax({
            url:baseURL+"addCompany.php",
            method:"POST",
            type:"application/x-www-form-urlencoded",
            data: datax,
            success: function(response){
                var json = JSON.parse(response);
                if(json.status === "success"){
                    $("#reset_modal").click();
                }
                swal(json.title, json.message, json.status);
            },
            error:function(err){
                swal("Error "+err.status, "The Requested URL could not be found", "error");
            }
        });
    }
}

function getCompanies(datax){
    var activeSearch = false;
    $.ajax({
        url:baseURL+"getCompanies.php?",
        method:"GET",
        type:"application/x-www-form-utlencoded",
        data:datax ,
        success:function(response){
            $('#modal_dismiss').click();
            var json = JSON.parse(response);
            var parent = document.getElementById("t_data_area");
            parent.innerHTML = "";

            for(var x = 0; x < json.data.length; x++){
                var th1 = document.createElement("th");
                th1.innerHTML = json.data[x].company_id;
                th1.setAttribute('id',json.data[x].company_id+'0');
                th1.setAttribute('class','data');

                var th2 = document.createElement("th");
                th2.innerHTML = json.data[x].company_name;
                th2.setAttribute('id',json.data[x].company_id+'1');
                th2.setAttribute('class','data');

                var th3 = document.createElement("th");
                th3.innerHTML = json.data[x].name;
                th3.setAttribute('id',json.data[x].company_id+'2');
                th3.setAttribute('class','data');

                var th4 = document.createElement("th");
                th4.innerHTML = json.data[x].email_address;
                th4.setAttribute('id',json.data[x].company_id+'3');
                th4.setAttribute('class','data');

                var th5 = document.createElement("th");
                th5.innerHTML = json.data[x].phone;
                th5.setAttribute('id',json.data[x].company_id+'4');
                th5.setAttribute('class','data');

                var th6 = document.createElement("th");
                th6.innerHTML = json.data[x].phy_address;
                th6.setAttribute('id',json.data[x].company_id+'5');
                th6.setAttribute('class','data');

                var th7 = document.createElement("th");
                th7.innerHTML =  "<div class='row no-gutters'>"+
                "<div class='col-6'>"+
                    "<button type='button' onclick = editRow("+JSON.stringify(json.data[x])+") class='btn btn-block btn-sm btn-warning flat-field'>Edit</button></div>"+
                  "<div class='col-6'>"+
                    "<a type='submit' href='client.php?delete_row="+json.data[x].company_id+"'  class='btn btn-block btn-sm btn-danger flat-field'>Delete</a></div></div>";
          

                var row = document.createElement("tr");
                row.setAttribute('id',json.data[x].company_id);
                row.appendChild(th1);
                row.appendChild(th2);
                row.appendChild(th3);
                row.appendChild(th4);
                row.appendChild(th5);
                row.appendChild(th6);
                row.appendChild(th7);

                parent.appendChild(row);
            }
            if(activeSearch){
                swal(json.title, json.message,json.status);
            }
        },
        error:function(err){
            swal("Error "+err.status, "The Requested URL could not be found", "error");
        }
    });
}

function editRow(data){
    alert(data);
    var json = JSON.parse(data);
    document.getElementById('edit_company_name').innerHTML = json.company_name;
    document.getElementById("edit_email_address").innerHTML = json.email_address;
    document.getElementById('edit_phone_number').innerHTML = json.phone;
    document.getElementById('edit_phy_address').innerHTML = json.phy_address;
    $('#showModal').click();
}

function delRow(row_id){
    var parent = document.getElementById('t_data_area');
    var ele = document.getElementById(""+row_id+"");
    parent.removeChild(ele);
}


function deleteClient(company_id){
    Swal.fire({
        title: 'Are you sure want to delete this Client?',
        text: "You won't be able to revert this!",
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, Proceed!'
      }).then((result) => {
        if (result.value) {
            $.get(baseURL+"deleteCompany.php?company_id="+company_id,function(response){
                if(response === "deleted"){
                    Swal.fire(
                        'Record Flushed!',
                        'Your file has been deleted.',
                        'success'
                      );
                      getCompanies();
                }else{
                    Swal.fire(
                        'Record Sustained!',
                        'Application failed to delete this record!.',
                        'error'
                      );
                }
                
            });
          
        }
      })
}

function deleteEvents(){
    
}