<?php
    /* -----------------------------
        delete item from database 
    ------------------------------ */
    
    /* connect to the database */
    include 'connection.php';

    /* get the item_id */
    $task_id = $_GET['del_task'];
    
    /* delete task query */
    $delete_query = "DELETE FROM Task WHERE task_id=?";

    $delete = $con->prepare($delete_query); // prepare query statement
    $delete->bind_param('i', $task_id); // bind task_id to prepared statement 
    $delete->execute(); // execute query
    $delete_result = $delete->get_result(); // get result

    /* refresh the page */
    header('Location: index.php');
?>
