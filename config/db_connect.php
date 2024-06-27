<?php 

    $conn = mysqli_connect('localhost','admin','admin123','students');

    if(!$conn){
        echo "Connection error" . mysqli_connect_error();
    }
?>