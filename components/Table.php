<?php

    include 'config/db_connect.php';

    if(isset($_POST['delete'])){

        $roll_to_delete = mysqli_real_escape_string($conn, $_POST['roll_to_delete']);

        $sql = "DELETE FROM data WHERE roll = $roll_to_delete";

        if(mysqli_query($conn, $sql)){
            header('Location: index.php')
        } else {
            echo 'query error: '. mysqli_error($conn);
        }

    }

?>


