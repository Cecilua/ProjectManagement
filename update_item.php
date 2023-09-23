<?php
    /* -------------------------------------
        update an item in the database 
    ------------------------------------- */
    
    /* connect to the database */
    include 'connection.php';

    /* if something has been posted */
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        
        /* get the query data */
        $update_query = file_get_contents('php://input');
        
        /* simple error checking */
        if (!mysqli_query($con, $update_query)) {
            echo "error...";
        } else {
            echo "updated";
        }

    }

    /* refresh the page */
    header('Location: index.php');
?>