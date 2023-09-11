<?php
    /* delete item from database */
    
    /* connect to the database */
    include 'connection.php';

    /* get the item_id */
    $task_id = $_GET['del_task'];
    
    /* delete task query */
    $delete_query = "DELETE FROM Task WHERE task_id=?";

    $delete = $con->prepare($delete_query);
    $delete->bind_param('i', $task_id);
    $delete->execute();
    $delete_result = $delete->get_result();

    /* refresh the page */
    header('Location: index.php');
?>
