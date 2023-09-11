<?php
    /* insert item into database */

    /* connect to the database */
    include 'connection.php';

    /* get the task name */
    $task = $_POST['task'];
    
    /* get the project_id */
    $project_id = $_POST['project_id'];

    /* insert task query */
    $insert_query = "INSERT INTO Task (task, project_id) VALUES (?, ?)";
    
    $insert = $con->prepare($insert_query);
    $insert->bind_param('si', $task, $project_id);
    $insert->execute();
    $insert_result = $insert->get_result();

    /* refresh the page */
	header("Location: index.php");
?>
