<?php
    /* delete item from database */
    
    /* connect to the database */
    include 'connection.php';

    /* get the item_id */
    $task_id = $_GET['del_task'];
    
    /* make the query */
    $delete_query = "DELETE FROM Task WHERE task_id=$task_id";

    /* simple error checking */
    if (!mysqli_query($con, $delete_query)) {

            echo "error...";
        } else {
            echo "deleted";
        }

    /* refresh the page */
    header('Location: index.php');
?>
