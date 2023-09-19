<?php
    /* -----------------------------
        insert item into database 
    ----------------------------- */

    /* connect to the database */
    include 'connection.php';

    /* get the task name */
    $task = $_POST['task'];
    
    /* get the project_id */
    $project_id = $_POST['project_id'];

    /* insert task query */
    $insert_query = "INSERT INTO Task (task, project_id) VALUES (?, ?)";
    
    $insert = $con->prepare($insert_query); // prepare query statement
    $insert->bind_param('si', $task, $project_id); // bind task and project_id to prepared statement
    $insert->execute(); // execute query
    $insert_result = $insert->get_result(); // get result

    /* refresh the page */
	header("Location: index.php");
?>
