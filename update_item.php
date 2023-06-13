<?php

// connect to the database
include 'connection.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // update the database
    $update_query = file_get_contents('php://input');
    if (!mysqli_query($con, $update_query)) {
        echo "error..";
    } else {
        echo "updated";
    }

}

?>






