<?php
    /* update a status in the database */
    
    /* connect to the database */
    include 'connection.php';

    /* if something has been posted */
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        
        /* get the query data */
        $status_id = $_POST["status_id"];
		$task_id = $_POST["task_id"];
		
        /* update status query */ 
        $update_status_query = "UPDATE Task SET status_id= ? WHERE task_id= ?";
        $update_status = $con->prepare($update_status_query);
        $update_status->bind_param('ii', $status_id, $task_id); // get the values from posted array
        $update_status->execute();
        $update_status_result = $update_status->get_result();
    }

    /* refresh the page */
    //header('Location: index.php');
?>