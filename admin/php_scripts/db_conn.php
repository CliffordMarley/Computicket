<?php
    $host = "localhost";
    $user = "webmaster";
    $pass = "Angelsdie123";
    $db_name = "computicket_main_database";

    $conn = mysqli_connect($host,$user,$pass,$db_name);
    if(mysqli_connect_errno()){
        Die("Fatal Error: failed to connect to Database Server!");
    }
?>