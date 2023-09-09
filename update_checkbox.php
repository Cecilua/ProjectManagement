<?php
    /* update a checkbox in the database */
    
    /* connect to the database */
    include 'connection.php';

    /* if something has been posted */
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        
        /* get the query data */
		$is_done = $_POST["is_done"];
		$task_id = $_POST["task_id"];

        /* update checkbox query */ 
        $update_checkbox_query = "UPDATE Task SET is_done= ? WHERE task_id= ?";
        $update_checkbox = $con->prepare($update_checkbox_query);
        $update_checkbox->bind_param('ii', $is_done, $task_id); // get the values from posted array
        $update_checkbox->execute();
        $update_checkbox_result = $update_checkbox->get_result();
    }

    /* refresh the page */
    //header('Location: index.php');
?>