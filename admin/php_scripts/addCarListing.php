<?php
    session_start();
    require_once("beta_db_connect.php");
    
    if(isset($_POST['save_car_to_list'])){
        
        $insert  = $conn->query("INSERT INTO car(reg_number,company,brand,
        transmission,features,capacity,location,price,unit) 
        VALUES ('".$_POST['reg_number']."','".$_POST['company']."','".$_POST['brand']."','".$_POST['transmission']."'
        ,'".$_POST['features']."','".$_POST['capacity']."', '".$_POST["location"]."','".$_POST['price']."','".$_POST['unit']."')");
    
        if($insert){
            $upload = uploadImages();

            $_SESSION["message"] = "<div class='ui positive message'>
		            <i class='close icon'></i>
		            <div class='header'>
		              Success!
		            </div>
                    One Car (".$_POST['reg_number'].") successfully added to the listing!</div>";
                    //echo "Success!";
        }else{
            $_SESSION["message"] = "<div class='ui positive message'>
		            <i class='close icon'></i>
		            <div class='header'>
		              Error Ecountered!
		            </div>
		            System failed to add the Car to listing! error: ".mysqli_error($conn)."
                   </div>";
                   //echo "Failed!";
        }
        header("LOCATION:../car-rental.php");
    }else{
         $_SESSION["message"] = "<div class='ui positive message'>
                    <i class='close icon'></i>
                    <div class='header'>
                      Error Ecountered. Data was not uploaded!!
                    </div>
                    System failed to add the Car to listing! error: ".mysqli_error($conn)."
                   </div>";
    }


    function uploadImages(){
        for($i  = 0; $i < count($_FILES['file']['name']); $i++){
             $filename = $_FILES['file']['name'][$i];
             $filearray = explode('.', $filename);
             $file_ext = strtolower(end($filearray));
             $file_new_name = uniqid(".", true).".".$file_ext;
             $location = "../../uploads/carhires/".$file_new_name;

             if(move_uploaded_file($_FILES["file"]['tmp_name'][$i], $location)){
                $insert_images = $GLOBALS['conn']->query("INSERT INTO car_images (image_url,car) VALUES ('".$location."','".$_POST['reg_number']."')");
                if($insert_images){
                    $data["status"] = "success";
                    $data["title"] = "Car Added!!";
                    $data["message"] = "";
                }else{
                    $data["status"] = "warning";
                    $data["title"] = "Process Interrupted";
                    $data["message"] = "All the data was uploaded, but the system failed to upload some if not all images!";
                    $data["error"] = mysqli_error($GLOBALS["conn"]);
                }
             }else{
                $data["status"] = "warning";
                $data["title"] = "Partial Data Uploaded!";
                $data["message"] = "System failed to upload the Vehicle images!, But all the other Vehicle information was saved!";
             }
        }
        
         return $data;
    }

?>